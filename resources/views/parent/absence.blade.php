<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الحضور والغياب - نظام إدارة الحضانة</title>
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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-parent-sidebar active-page="absence" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8">

                <header class="flex flex-wrap justify-between items-center gap-6 mb-10">
                    <h2 class="text-3xl font-black tracking-tight">الحضور والغياب</h2>

                    <form method="GET" action="{{ route('parent.absence') }}" class="flex gap-3 items-center flex-wrap">
                        <select name="month" class="px-4 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/50">
                            @forelse ($months as $month)
                                <option value="{{ $month }}" @selected($selectedMonth === $month)>{{ $month }}</option>
                            @empty
                                <option value="{{ now()->format('Y-m') }}">{{ now()->format('Y-m') }}</option>
                            @endforelse
                        </select>

                        <select name="child_id" class="px-4 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <option value="0" @selected($selectedChildId === 0)>كل الأطفال</option>
                            @foreach ($children as $child)
                                <option value="{{ $child->id }}" @selected($selectedChildId === $child->id)>{{ $child->name }}</option>
                            @endforeach
                        </select>

                     

                        <button type="button" onclick="window.print()" class="px-5 py-2 bg-zinc-200 text-zinc-700 rounded-xl text-sm font-bold hover:bg-zinc-300 transition-colors">
                            طباعة التقرير
                        </button>
                    </form>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#0ea60e] mb-2">{{ $attendanceRate }}%</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">نسبة الحضور الشهرية</p>
                    </div>
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#f59e0b] mb-2">{{ $totalAbsenceDays }}</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">أيام الغياب (الإجمالي)</p>
                    </div>
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#ef4444] mb-2">{{ $unexcusedAbsenceDays }}</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">غياب بدون عذر</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md mb-10">
                    <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                        <h3 class="text-lg font-bold">سجل الحضور والغياب - الشهر الحالي</h3>
                        <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">{{ $selectedMonth }}</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-gray-50/70 dark:bg-white/5">
                                <tr class="border-b border-[#dce5dc] dark:border-[#2d402d]">
                                    <th class="px-6 py-4 text-sm font-semibold">التاريخ</th>
                                    <th class="px-6 py-4 text-sm font-semibold">اليوم</th>
                                    @foreach ($tableChildren as $child)
                                        <th class="px-6 py-4 text-sm font-semibold">{{ $child->name }}</th>
                                    @endforeach
                                    <th class="px-6 py-4 text-sm font-semibold">الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#dce5dc] dark:divide-[#2d402d]">
                                @forelse ($dailyRows as $row)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4 text-sm">{{ $row['date'] }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $row['day_name'] }}</td>
                                        @foreach ($row['statuses'] as $status)
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['badge'] }}">{{ $status['status'] }}</span>
                                            </td>
                                        @endforeach
                                        <td class="px-6 py-4 text-sm text-[#638863] dark:text-[#a3c2a3]">{{ $row['note'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ 3 + $tableChildren->count() }}" class="px-6 py-8 text-center text-[#638863] dark:text-[#a3c2a3]">لا توجد بيانات حضور لهذا الشهر.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($childrenSummary as $summary)
                        <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm">
                            <h3 class="text-lg font-bold mb-5 flex items-center gap-2">
                                <span class="w-2 h-6 bg-primary rounded-full"></span>
                                ملخص حضور {{ $summary['name'] }}
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#638863] dark:text-[#a3c2a3]">إجمالي الأيام الدراسية</span>
                                    <span class="font-bold">{{ $summary['total_days'] }} يوم</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#638863] dark:text-[#a3c2a3]">أيام الحضور</span>
                                    <span class="font-bold text-green-600 dark:text-green-400">{{ $summary['present_days'] }} يوم</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#638863] dark:text-[#a3c2a3]">نسبة الحضور</span>
                                    <span class="font-bold text-green-600 dark:text-green-400">{{ $summary['attendance_rate'] }}%</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm col-span-full">
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">لا يوجد أطفال مرتبطون بهذا الحساب حالياً.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>
</body>

</html>
