<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));
        $from = $request->string('from')->toString();
        $to = $request->string('to')->toString();
        $showAll = $request->boolean('all');

        $reports = $this->buildReportsCollection();

        if ($search !== '') {
            $needle = Str::lower($search);
            $reports = $reports->filter(function (array $report) use ($needle) {
                $haystack = Str::lower(implode(' ', [
                    $report['title'],
                    $report['type'],
                    $report['creator_name'],
                    $report['search_terms'] ?? '',
                    $report['date']->format('Y-m-d'),
                ]));

                return Str::contains($haystack, $needle);
            })->values();
        }

        if ($from !== '') {
            $reports = $reports->filter(fn (array $report) => $report['date']->toDateString() >= $from)->values();
        }

        if ($to !== '') {
            $reports = $reports->filter(fn (array $report) => $report['date']->toDateString() <= $to)->values();
        }

        $reports = $reports->sortByDesc(fn (array $report) => $report['date']->timestamp)->values();

        $totalCount = $reports->count();
        $perPage = $showAll ? max($totalCount, 1) : 10;
        $page = max(1, (int) $request->integer('page', 1));

        $paginatedReports = new LengthAwarePaginator(
            $reports->forPage($page, $perPage)->values(),
            $totalCount,
            $perPage,
            $page,
            [
                'path' => url()->current(),
                'query' => $request->query(),
            ]
        );

        $monthlyPaymentsTotal = Payment::query()
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $attendanceTotal = Attendance::query()->count();
        $attendanceWithoutAbsence = Attendance::query()->where('absence_count', 0)->count();
        $attendanceRate = $attendanceTotal > 0
            ? round(($attendanceWithoutAbsence / $attendanceTotal) * 100, 1)
            : 0;

        return view('admin.reports', [
            'reports' => $paginatedReports,
            'search' => $search,
            'from' => $from,
            'to' => $to,
            'showAll' => $showAll,
            'monthlyPaymentsTotal' => $monthlyPaymentsTotal,
            'attendanceRate' => $attendanceRate,
            'totalReportsCount' => $totalCount,
        ]);
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function buildReportsCollection(): Collection
    {
        $activityReports = Activity::query()
            ->with('user:id,name')
            ->latest('activity_date')
            ->get()
            ->map(function (Activity $activity): array {
                return [
                    'id' => 'activity-'.$activity->id,
                    'title' => $activity->name,
                    'type' => 'نشاط',
                    'date' => $activity->activity_date ?? $activity->created_at,
                    'creator_name' => $activity->user?->name ?? 'غير محدد',
                    'search_terms' => implode(' ', [
                        $activity->id,
                        $activity->name,
                        $activity->user?->name ?? '',
                    ]),
                ];
            });

        $paymentReports = Payment::query()
            ->with('guardian:id,name')
            ->latest()
            ->get()
            ->map(function (Payment $payment): array {
                return [
                    'id' => 'payment-'.$payment->id,
                    'title' => 'دفعة رقم '.$payment->reference,
                    'type' => 'مالي',
                    'date' => $payment->paid_at ?? $payment->created_at,
                    'creator_name' => $payment->guardian?->name ?? 'غير محدد',
                    'search_terms' => implode(' ', [
                        $payment->id,
                        $payment->reference,
                        $payment->payment_method,
                        $payment->status,
                        $payment->guardian?->name ?? '',
                    ]),
                ];
            });

        $attendanceReports = Attendance::query()
            ->with('user:id,name')
            ->latest('check_in')
            ->get()
            ->map(function (Attendance $attendance): array {
                return [
                    'id' => 'attendance-'.$attendance->id,
                    'title' => 'سجل حضور '.($attendance->user?->name ?? 'طالب'),
                    'type' => 'حضور',
                    'date' => $attendance->check_in ?? $attendance->created_at,
                    'creator_name' => $attendance->user?->name ?? 'غير محدد',
                    'search_terms' => implode(' ', [
                        $attendance->id,
                        $attendance->user?->name ?? '',
                    ]),
                ];
            });

        return $activityReports
            ->concat($paymentReports)
            ->concat($attendanceReports)
            ->values();
    }
}
