<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $dateStr = $request->string('date')->toString() ?: now()->toDateString();
        $date = Carbon::parse($dateStr);
        $status = $request->string('status', 'all')->toString();
        $class = $request->string('class')->toString();

        $query = User::query()
            ->where('role', 'child')
            ->with(['attendances' => function ($q) use ($dateStr) {
                $q->whereDate('check_in', $dateStr);
            }])
            ->when($class !== '', function ($q) use ($class) {
                $q->where('level_name', $class);
            });

        // Statistics (based on full list for the selected filters except status)
        $allChildrenForStats = (clone $query)->get();
        $totalChildrenCount = $allChildrenForStats->count();

        $presentCount = $allChildrenForStats->filter(function ($child) {
            return $child->attendances->isNotEmpty() && $child->attendances->first()->absence_count === 0;
        })->count();

        $absentCount = $totalChildrenCount - $presentCount;
        $attendanceRate = $totalChildrenCount > 0 ? round(($presentCount / $totalChildrenCount) * 100, 1) : 0;

        // Apply status filter for the list
        if ($status === 'present') {
            $query->whereHas('attendances', function ($q) use ($dateStr) {
                $q->whereDate('check_in', $dateStr)->where('absence_count', 0);
            });
        } elseif ($status === 'absent') {
            $query->whereDoesntHave('attendances', function ($q) use ($dateStr) {
                $q->whereDate('check_in', $dateStr)->where('absence_count', 0);
            });
        }

        $children = $query->latest()->paginate(10)->withQueryString();

        $allChildren = User::where('role', 'child')->orderBy('name')->get(['id', 'name']);

        // Get available classes for the filter
        $levels = User::where('role', 'child')
            ->whereNotNull('level_name')
            ->distinct()
            ->pluck('level_name');

        return view('admin.absense', [
            'children' => $children,
            'allChildren' => $allChildren,
            'totalChildren' => $totalChildrenCount,
            'presentToday' => $presentCount,
            'absentToday' => $absentCount,
            'attendanceRate' => $attendanceRate,
            'levels' => $levels,
            'selectedDate' => $dateStr,
            'selectedStatus' => $status,
            'selectedClass' => $class,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'nullable',
            'check_out' => 'nullable',
            'status' => 'required|in:present,absent',
        ]);

        $date = $validated['date'];

        Attendance::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'check_in' => Carbon::parse($date)->startOfDay(), // Use start of day as unique key for date-based attendance
            ],
            [
                'check_in' => $validated['status'] === 'present'
                    ? ($validated['check_in'] ? Carbon::parse($date.' '.$validated['check_in']) : now())
                    : Carbon::parse($date)->startOfDay(),
                'check_out' => ($validated['status'] === 'present' && $validated['check_out'])
                    ? Carbon::parse($date.' '.$validated['check_out'])
                    : null,
                'absence_count' => $validated['status'] === 'absent' ? 1 : 0,
            ]
        );

        return back()->with('success', 'تم تسجيل الحضور بنجاح');
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'check_in' => 'nullable',
            'check_out' => 'nullable',
            'status' => 'required|in:present,absent',
        ]);

        $date = $attendance->check_in->toDateString();

        $attendance->update([
            'check_in' => $validated['status'] === 'present'
                ? ($validated['check_in'] ? Carbon::parse($date.' '.$validated['check_in']) : $attendance->check_in)
                : $attendance->check_in->startOfDay(),
            'check_out' => ($validated['status'] === 'present' && $validated['check_out'])
                ? Carbon::parse($date.' '.$validated['check_out'])
                : null,
            'absence_count' => $validated['status'] === 'absent' ? 1 : 0,
        ]);

        return back()->with('success', 'تم تحديث الحضور بنجاح');
    }
}
