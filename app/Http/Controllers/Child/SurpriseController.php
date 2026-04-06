<?php

namespace App\Http\Controllers\Child;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Level;
use App\Models\TeacherReport;
use App\Models\WeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SurpriseController extends Controller
{
    public function index(Request $request): View
    {
        $child = $request->user();
        $level = Level::query()
            ->with('user:id,name')
            ->where('name', $child->level_name)
            ->first();

        $latestReport = TeacherReport::query()
            ->with(['teacher:id,name', 'level:id,name'])
            ->when($child->level_name !== null, function ($query) use ($child): void {
                $query->whereHas('level', function ($levelQuery) use ($child): void {
                    $levelQuery->where('name', $child->level_name);
                });
            })
            ->latest('report_date')
            ->latest()
            ->first();

        $latestActivity = Activity::query()
            ->with('user:id,name')
            ->when($level?->user_id !== null, function ($query) use ($level): void {
                $query->where('user_id', $level->user_id);
            })
            ->latest('activity_date')
            ->latest()
            ->first();

        $todaySchedule = WeeklySchedule::query()
            ->where('day_name', $this->arabicDayName(now()->dayOfWeek))
            ->ordered()
            ->first();

        if ($todaySchedule === null) {
            $todaySchedule = WeeklySchedule::query()
                ->ordered()
                ->first();
        }

        $attendanceStats = Attendance::query()
            ->where('user_id', $child->id)
            ->selectRaw('COUNT(*) as total_days, SUM(CASE WHEN absence_count = 0 THEN 1 ELSE 0 END) as present_days')
            ->first();

        $presentDays = (int) ($attendanceStats?->present_days ?? 0);
        $totalDays = (int) ($attendanceStats?->total_days ?? 0);

        return view('child.surprise', [
            'child' => $child,
            'surpriseCards' => [
                'badge' => [
                    'emoji' => '🏆',
                    'label' => 'جديد! ✨',
                    'title' => $presentDays > 0 ? 'وسام الحضور المميز' : 'وسام البداية الجميلة',
                    'message' => $presentDays > 0
                        ? "أنت حاضر في {$presentDays} يوم من أصل {$totalDays} يوم."
                        : 'ابدأ يومك بنشاط لتحصل على أول وسام خاص بك.',
                    'reward' => $presentDays > 1 ? 'نجمتين' : 'نجمة واحدة',
                    'meta' => $presentDays > 0 ? 'الحضور اليومي المتواصل' : 'الانطلاقة الأولى',
                ],
                'message' => [
                    'emoji' => '💌',
                    'label' => 'رسالة المعلمة',
                    'title' => $latestReport?->title ?? 'رسالة خاصة لك',
                    'message' => $latestReport?->content ?? 'لا توجد رسالة جديدة اليوم، لكن المعلمة فخورة بك دائماً.',
                    'reward' => 'نجمة واحدة',
                    'meta' => $latestReport?->teacher?->name ? 'من '.$latestReport->teacher->name : 'رسالة اليوم',
                ],
                'activity' => [
                    'emoji' => '🖼️',
                    'label' => 'صورة النشاط',
                    'title' => $latestActivity?->name ?? 'النشاط الممتع اليوم',
                    'message' => $latestActivity?->description ?? 'هنا ستجد أجمل لحظات نشاطك مع الفصل.',
                    'reward' => 'نجمة واحدة',
                    'meta' => $latestActivity?->activity_date?->format('Y-m-d') ?? 'صورة اليوم',
                    'image' => $latestActivity?->image_path ? Storage::url($latestActivity->image_path) : null,
                ],
                'meal' => [
                    'emoji' => '🍽️',
                    'label' => 'وقت الوجبة',
                    'title' => $todaySchedule?->daily_activity ?? 'الوجبة جاهزة',
                    'message' => $todaySchedule?->activity_location
                        ? 'مكان اليوم: '.$todaySchedule->activity_location
                        : 'وجبتك جاهزة الآن ومليئة بالطاقة!',
                    'reward' => 'نجمة واحدة',
                    'meta' => $todaySchedule?->day_name ?? 'جدول اليوم',
                ],
            ],
        ]);
    }

    private function arabicDayName(int $dayOfWeek): string
    {
        return match ($dayOfWeek) {
            0 => 'الأحد',
            1 => 'الإثنين',
            2 => 'الثلاثاء',
            3 => 'الأربعاء',
            4 => 'الخميس',
            5 => 'الجمعة',
            6 => 'السبت',
            default => '-',
        };
    }
}
