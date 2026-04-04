<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AbsenceController extends Controller
{
    public function index(Request $request): View
    {
        $guardian = $request->user();

        $children = $guardian->children()
            ->where('role', 'child')
            ->orderBy('name')
            ->get(['id', 'name']);

        $childIds = $children->pluck('id');

        $baseAttendanceQuery = Attendance::query()
            ->whereIn('user_id', $childIds)
            ->with('user:id,name');

        $months = $baseAttendanceQuery->clone()
            ->selectRaw("DATE_FORMAT(check_in, '%Y-%m') as month_key")
            ->groupBy('month_key')
            ->orderByDesc('month_key')
            ->pluck('month_key');

        $selectedMonth = $request->string('month')->toString();
        if ($selectedMonth === '') {
            $selectedMonth = (string) ($months->first() ?? now()->format('Y-m'));
        }

        $selectedChildId = (int) $request->integer('child_id', 0);

        $monthStart = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        $monthAttendances = $baseAttendanceQuery->clone()
            ->whereBetween('check_in', [$monthStart, $monthEnd])
            ->when($selectedChildId > 0, fn ($query) => $query->where('user_id', $selectedChildId))
            ->orderByDesc('check_in')
            ->get();

        $tableChildren = $selectedChildId > 0
            ? $children->where('id', $selectedChildId)->values()
            : $children;

        $dailyRows = $this->buildDailyRows($monthAttendances, $tableChildren);

        $presentCount = $monthAttendances->where('absence_count', 0)->count();
        $totalRows = $monthAttendances->count();
        $attendanceRate = $totalRows > 0 ? round(($presentCount / $totalRows) * 100) : 0;
        $totalAbsenceDays = $monthAttendances->where('absence_count', '>', 0)->count();
        $unexcusedAbsenceDays = $totalAbsenceDays;

        $childrenSummary = $children->map(function ($child) use ($monthAttendances): array {
            $records = $monthAttendances->where('user_id', $child->id);
            $totalDays = $records->count();
            $presentDays = $records->where('absence_count', 0)->count();

            return [
                'name' => $child->name,
                'total_days' => $totalDays,
                'present_days' => $presentDays,
                'attendance_rate' => $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0,
            ];
        });

        return view('parent.absence', [
            'months' => $months,
            'selectedMonth' => $selectedMonth,
            'children' => $children,
            'selectedChildId' => $selectedChildId,
            'tableChildren' => $tableChildren,
            'dailyRows' => $dailyRows,
            'attendanceRate' => $attendanceRate,
            'totalAbsenceDays' => $totalAbsenceDays,
            'unexcusedAbsenceDays' => $unexcusedAbsenceDays,
            'childrenSummary' => $childrenSummary,
        ]);
    }

    /**
     * @param  Collection<int, Attendance>  $attendances
     * @param  Collection<int, mixed>  $tableChildren
     * @return Collection<int, array<string, mixed>>
     */
    private function buildDailyRows(Collection $attendances, Collection $tableChildren): Collection
    {
        $groupedByDate = $attendances->groupBy(fn (Attendance $attendance) => $attendance->check_in?->toDateString());

        return $groupedByDate
            ->map(function (Collection $rows, string $date) use ($tableChildren): array {
                $dayName = $this->arabicDayName(Carbon::parse($date)->dayOfWeek);

                $childrenStatuses = $tableChildren->map(function ($child) use ($rows): array {
                    $record = $rows->firstWhere('user_id', $child->id);

                    if ($record === null) {
                        return [
                            'status' => 'غير مسجل',
                            'badge' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-700 dark:text-zinc-200',
                        ];
                    }

                    if ($record->absence_count > 0) {
                        return [
                            'status' => 'غائب',
                            'badge' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
                        ];
                    }

                    return [
                        'status' => 'حاضر',
                        'badge' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
                    ];
                });

                return [
                    'date' => $date,
                    'day_name' => $dayName,
                    'statuses' => $childrenStatuses,
                    'note' => '-',
                ];
            })
            ->sortByDesc('date')
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
}
