<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));
        $showAllActivities = $request->boolean('all_activities');

        $activitiesQuery = Activity::query()
            ->with('user:id,name')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('activity_type', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('activity_date');

        $activities = $activitiesQuery
            ->paginate($showAllActivities ? 20 : 5)
            ->withQueryString();

        $totalChildren = User::query()->where('role', 'child')->count();
        $totalTeachers = User::query()->where('role', 'teacher')->count();
        $pendingPayments = Payment::query()->where('status', '!=', 'paid')->sum('amount');

        $attendanceTotal = Attendance::query()->count();
        $attendanceWithoutAbsence = Attendance::query()->where('absence_count', 0)->count();
        $attendanceRate = $attendanceTotal > 0
            ? round(($attendanceWithoutAbsence / $attendanceTotal) * 100)
            : 0;

        return view('admin.admindashboard', [
            'activities' => $activities,
            'search' => $search,
            'showAllActivities' => $showAllActivities,
            'totalChildren' => $totalChildren,
            'totalTeachers' => $totalTeachers,
            'pendingPayments' => $pendingPayments,
            'attendanceRate' => $attendanceRate,
        ]);
    }
}
