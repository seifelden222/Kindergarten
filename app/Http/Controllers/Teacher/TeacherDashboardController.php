<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherAttendanceRequest;
use App\Http\Requests\UpdateTeacherProfileRequest;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\TeacherReport;
use App\Models\User;
use App\Models\WeeklySchedule;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeacherDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $teacher = $request->user();
        $levels = $teacher->levels()->orderBy('name')->get();

        $className = $levels->first()?->name ?? 'غير محدد';
        $totalChildren = (int) $levels->sum('children_count');

        $students = User::query()
            ->where('role', 'child')
            ->latest('registration_date')
            ->limit(max($totalChildren, 1))
            ->get(['id', 'name', 'level_name', 'allergies', 'chronic_diseases']);

        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        $todayAttendanceMap = Attendance::query()
            ->whereIn('user_id', $students->pluck('id'))
            ->whereBetween('check_in', [$todayStart, $todayEnd])
            ->get()
            ->keyBy('user_id');

        $presentToday = $todayAttendanceMap->where('absence_count', 0)->count();

        $studentsForDashboard = $students->take(6)->map(function (User $student) use ($todayAttendanceMap): array {
            $attendance = $todayAttendanceMap->get($student->id);
            $isPresent = $attendance ? $attendance->absence_count === 0 : false;

            return [
                'id' => $student->id,
                'name' => $student->name,
                'level_name' => $student->level_name,
                'is_present' => $isPresent,
            ];
        });

        $pendingReportsCount = TeacherReport::query()
            ->where('teacher_id', $teacher->id)
            ->where('status', 'pending_review')
            ->count();

        $todaySchedule = WeeklySchedule::query()
            ->where(function ($query) use ($teacher) {
                $query->where('morning_teacher', $teacher->name)
                    ->orWhere('second_teacher', $teacher->name);
            })
            ->where('day_name', $this->arabicDayName(now()->dayOfWeek))
            ->ordered()
            ->get();

        if ($todaySchedule->isEmpty()) {
            $todaySchedule = WeeklySchedule::query()
                ->where('day_name', $this->arabicDayName(now()->dayOfWeek))
                ->ordered()
                ->get();
        }

        $alerts = $this->buildAlerts($students);

        $recentPhotos = Activity::query()
            ->whereIn('user_id', $students->pluck('id'))
            ->latest()
            ->take(3)
            ->get();

        $nameParts = preg_split('/\s+/u', trim((string) $teacher->name)) ?: [];
        $firstName = $nameParts[0] ?? '';
        $lastName = count($nameParts) > 1
            ? implode(' ', array_slice($nameParts, 1))
            : '';

        return view('teacher.teacherdashboard', [
            'teacher' => $teacher,
            'teacherFirstName' => $firstName,
            'teacherLastName' => $lastName,
            'className' => $className,
            'totalChildren' => $totalChildren,
            'presentToday' => $presentToday,
            'pendingReportsCount' => $pendingReportsCount,
            'studentsForDashboard' => $studentsForDashboard,
            'todaySchedule' => $todaySchedule,
            'alerts' => $alerts,
            'recentPhotos' => $recentPhotos,
        ]);
    }

    /**
     * @param  Collection<int, User>  $students
     * @return Collection<int, array<string, string>>
     */
    private function buildAlerts(Collection $students): Collection
    {
        return $students
            ->filter(fn (User $student) => filled($student->allergies) || filled($student->chronic_diseases))
            ->take(3)
            ->map(function (User $student): array {
                $details = $student->allergies ?: $student->chronic_diseases;

                return [
                    'type' => 'emergency',
                    'message' => $student->name.' لديه ملاحظة صحية: '.$details,
                ];
            })
            ->values();
    }

    private function arabicDayName(int $dayOfWeek): string
    {
        return match ($dayOfWeek) {
            Carbon::SUNDAY => 'الأحد',
            Carbon::MONDAY => 'الإثنين',
            Carbon::TUESDAY => 'الثلاثاء',
            Carbon::WEDNESDAY => 'الأربعاء',
            Carbon::THURSDAY => 'الخميس',
            Carbon::FRIDAY => 'الجمعة',
            Carbon::SATURDAY => 'السبت',
            default => '-',
        };
    }

    public function storeAttendance(StoreTeacherAttendanceRequest $request): RedirectResponse
    {
        $attendanceRows = $request->validated('attendance');
        $today = now()->toDateString();

        foreach ($attendanceRows as $row) {
            $userId = (int) $row['user_id'];
            $status = $row['status'];

            $attendance = Attendance::query()
                ->where('user_id', $userId)
                ->whereDate('check_in', $today)
                ->first();

            $payload = [
                'absence_count' => $status === 'present' ? 0 : 1,
                'check_out' => $status === 'present' ? now() : null,
            ];

            if ($attendance !== null) {
                $attendance->update($payload);

                continue;
            }

            Attendance::query()->create([
                'user_id' => $userId,
                'check_in' => now(),
                'check_out' => $status === 'present' ? now() : null,
                'absence_count' => $status === 'present' ? 0 : 1,
            ]);
        }

        return redirect()
            ->route('teacher.teacherdashboard')
            ->with('status', 'تم تسجيل الحضور بنجاح.');
    }

    public function updateProfile(UpdateTeacherProfileRequest $request): RedirectResponse
    {
        $teacher = $request->user();
        $validated = $request->validated();
        $fullName = trim($validated['first_name'].' '.$validated['last_name']);

        if (Str::lower($teacher->email) !== Str::lower($validated['email'])) {
            $teacher->email_verified_at = null;
        }

        $teacher->update([
            'name' => $fullName,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return redirect()
            ->route('teacher.teacherdashboard')
            ->with('status', 'تم تحديث الملف الشخصي بنجاح.');
    }
}
