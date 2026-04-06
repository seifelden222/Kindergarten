<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>التقارير - نظام إدارة الحضانة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0ea60e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112111",
                    },
                    fontFamily: {
                        "display": ["Cairo", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav { background-color: #0ea60e; color: white !important; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-admin-slider />

        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4 flex items-center justify-between gap-6">
                <h2 class="text-xl font-bold">التقارير</h2>
                <form method="GET" action="{{ route('admin.reports') }}" class="relative w-full max-w-md">
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                    <input name="q" value="{{ $search }}" type="text" placeholder="ابحث بالعنوان أو المرجع أو المنشئ..." class="w-full rounded-xl border-none bg-zinc-100 py-2.5 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary/50 dark:bg-zinc-800" />
                    @if ($from !== '')
                        <input type="hidden" name="from" value="{{ $from }}" />
                    @endif
                    @if ($to !== '')
                        <input type="hidden" name="to" value="{{ $to }}" />
                    @endif
                    @if ($showAll)
                        <input type="hidden" name="all" value="1" />
                    @endif
                </form>
            </header>

            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 p-5">
                        <p class="text-sm text-zinc-500">إجمالي السجلات</p>
                        <p class="text-2xl font-bold mt-1">{{ $totalReportsCount }}</p>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 p-5">
                        <p class="text-sm text-zinc-500">إجمالي المدفوعات هذا الشهر</p>
                        <p class="text-2xl font-bold mt-1 text-primary">{{ number_format((float) $monthlyPaymentsTotal, 2) }} ج.م</p>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 p-5">
                        <p class="text-sm text-zinc-500">نسبة الحضور</p>
                        <p class="text-2xl font-bold mt-1">{{ $attendanceRate }}%</p>
                    </div>
                </div>



                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">جدول التقارير</h4>
                        <a href="{{ route('admin.reports', array_filter(['q' => $search, 'from' => $from, 'to' => $to, 'all' => $showAll ? null : 1])) }}" class="text-primary text-sm font-bold hover:underline">
                            {{ $showAll ? 'عرض أقل' : 'عرض الكل' }}
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">اسم التقرير</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النوع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">التاريخ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">المنشئ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @forelse ($reports as $report)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium">{{ $report['title'] }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $report['type'] }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ $report['date']->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ $report['creator_name'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500">لا توجد تقارير حالياً.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
