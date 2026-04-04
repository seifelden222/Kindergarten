<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherReportRequest;
use App\Models\TeacherReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherReportController extends Controller
{
    public function index(Request $request): View
    {
        $teacher = $request->user();

        $reports = TeacherReport::query()
            ->with(['level:id,name', 'teacher:id,name'])
            ->where('teacher_id', $teacher->id)
            ->latest('report_date')
            ->latest()
            ->get();

        $levels = $teacher->levels()
            ->orderBy('name')
            ->get(['id', 'name']);

        $weeklyReports = $reports->where('report_date', '>=', now()->subDays(6)->startOfDay());
        $attendanceRecords = $teacher->attendances()
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->get();

        $attendanceTotal = $attendanceRecords->count();
        $presentTotal = $attendanceRecords->where('absence_count', 0)->count();
        $attendanceRate = $attendanceTotal > 0
            ? (int) round(($presentTotal / $attendanceTotal) * 100)
            : 0;

        return view('teacher.reports', [
            'levels' => $levels,
            'reports' => $reports,
            'recentReports' => $reports->take(3)->values(),
            'weeklyReportsCount' => $weeklyReports->count(),
            'attendanceRate' => $attendanceRate,
            'absenceDaysCount' => $attendanceRecords->sum('absence_count'),
        ]);
    }

    public function store(StoreTeacherReportRequest $request): RedirectResponse
    {
        $teacher = $request->user();
        $validated = $request->validated();

        $level = $teacher->levels()->findOrFail($validated['level_id']);

        TeacherReport::query()->create([
            'teacher_id' => $teacher->id,
            'level_id' => $level->id,
            'report_type' => $validated['report_type'],
            'title' => $this->generateTitle($validated['report_type'], $validated['report_date']),
            'report_date' => $validated['report_date'],
            'content' => $validated['content'],
            'status' => 'sent',
        ]);

        return redirect()
            ->route('teacher.reports')
            ->with('status', 'تم إنشاء التقرير وحفظه في قاعدة البيانات بنجاح.');
    }

    private function generateTitle(string $reportType, string $reportDate): string
    {
        $typeLabel = match ($reportType) {
            'daily' => 'تقرير يومي',
            'weekly' => 'تقرير أسبوعي',
            'monthly' => 'تقرير شهري',
            'activity' => 'تقرير نشاط',
            default => 'تقرير',
        };

        return "{$typeLabel} - {$reportDate}";
    }
}
