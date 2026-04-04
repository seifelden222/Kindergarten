<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));
        $semester = $request->string('semester')->toString();
        $group = $request->string('group')->toString();

        $semesters = WeeklySchedule::query()
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        $groups = WeeklySchedule::query()
            ->select('group_name')
            ->distinct()
            ->orderBy('group_name')
            ->pluck('group_name');

        if ($semester !== '' && ! $semesters->contains($semester)) {
            $semester = '';
        }

        if ($group !== '' && ! $groups->contains($group)) {
            $group = '';
        }

        $schedules = WeeklySchedule::query()
            ->when($semester !== '', fn ($query) => $query->where('semester', $semester))
            ->when($group !== '', fn ($query) => $query->where('group_name', $group))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('day_name', 'like', "%{$search}%")
                        ->orWhere('morning_subject', 'like', "%{$search}%")
                        ->orWhere('second_subject', 'like', "%{$search}%")
                        ->orWhere('afternoon_period', 'like', "%{$search}%")
                        ->orWhere('daily_activity', 'like', "%{$search}%")
                        ->orWhere('activity_location', 'like', "%{$search}%")
                        ->orWhere('morning_teacher', 'like', "%{$search}%")
                        ->orWhere('second_teacher', 'like', "%{$search}%")
                        ->orWhere('group_name', 'like', "%{$search}%")
                        ->orWhere('semester', 'like', "%{$search}%");
                });
            })
            ->ordered()
            ->get();

        return view('admin.tables', [
            'schedules' => $schedules,
            'search' => $search,
            'semester' => $semester,
            'group' => $group,
            'semesters' => $semesters,
            'groups' => $groups,
        ]);
    }
}
