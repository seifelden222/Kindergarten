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
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

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
                    <div class="flex gap-3 items-center">
                        <select id="monthFilter" onchange="filterByMonth(this.value)" class="px-4 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <option value="2025-10">أكتوبر 2025</option>
                            <option value="2025-09">سبتمبر 2025</option>
                            <option value="2025-08">أغسطس 2025</option>
                            <option value="2025-07">يوليو 2025</option>
                            <option value="2025-06">يونيو 2025</option>
                            <option value="2025-05">مايو 2025</option>
                        </select>
                        <button onclick="printAttendanceReport()" class="px-5 py-2 bg-primary text-[#111811] rounded-xl text-sm font-bold hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                            طباعة التقرير
                        </button>
                    </div>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#0ea60e] mb-2">96%</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">نسبة الحضور الشهرية</p>
                    </div>
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#f59e0b] mb-2">3</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">أيام الغياب (الإجمالي)</p>
                    </div>
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm text-center">
                        <div class="text-5xl font-black text-[#ef4444] mb-2">1</div>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-sm font-medium">غياب بدون عذر</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md mb-10">
                    <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                        <h3 class="text-lg font-bold">سجل الحضور والغياب - الشهر الحالي</h3>
                        <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">أكتوبر 2025</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-gray-50/70 dark:bg-white/5">
                                <tr class="border-b border-[#dce5dc] dark:border-[#2d402d]">
                                    <th class="px-6 py-4 text-sm font-semibold">التاريخ</th>
                                    <th class="px-6 py-4 text-sm font-semibold">اليوم</th>
                                    <th class="px-6 py-4 text-sm font-semibold">ليلى أحمد</th>
                                    <th class="px-6 py-4 text-sm font-semibold">عمر أحمد</th>
                                    <th class="px-6 py-4 text-sm font-semibold">الملاحظات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#dce5dc] dark:divide-[#2d402d]">
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-sm">2025-10-27</td>
                                    <td class="px-6 py-4 text-sm">الإثنين</td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضرة</span></td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضر</span></td>
                                    <td class="px-6 py-4 text-sm text-[#638863] dark:text-[#a3c2a3]">-</td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-sm">2025-10-26</td>
                                    <td class="px-6 py-4 text-sm">الأحد</td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضرة</span></td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">غائب بعذر</span></td>
                                    <td class="px-6 py-4 text-sm text-[#638863] dark:text-[#a3c2a3]">زيارة طبيب</td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-sm">2025-10-25</td>
                                    <td class="px-6 py-4 text-sm">السبت</td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضرة</span></td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضر</span></td>
                                    <td class="px-6 py-4 text-sm text-[#638863] dark:text-[#a3c2a3]">-</td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors bg-red-50/40 dark:bg-red-950/20">
                                    <td class="px-6 py-4 text-sm">2025-10-24</td>
                                    <td class="px-6 py-4 text-sm">الجمعة</td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">غائبة</span></td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">غائب</span></td>
                                    <td class="px-6 py-4 text-sm text-red-700 dark:text-red-400">عطلة رسمية</td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4 text-sm">2025-10-23</td>
                                    <td class="px-6 py-4 text-sm">الخميس</td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضرة</span></td>
                                    <td class="px-6 py-4"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">حاضر</span></td>
                                    <td class="px-6 py-4 text-sm text-[#638863] dark:text-[#a3c2a3]">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm">
                        <h3 class="text-lg font-bold mb-5 flex items-center gap-2">
                            <span class="w-2 h-6 bg-primary rounded-full"></span>
                            ملخص حضور ليلى أحمد
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">إجمالي الأيام الدراسية</span>
                                <span class="font-bold">22 يوم</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">أيام الحضور</span>
                                <span class="font-bold text-green-600 dark:text-green-400">21 يوم</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">نسبة الحضور</span>
                                <span class="font-bold text-green-600 dark:text-green-400">95.5%</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2d402d] shadow-sm">
                        <h3 class="text-lg font-bold mb-5 flex items-center gap-2">
                            <span class="w-2 h-6 bg-primary rounded-full"></span>
                            ملخص حضور عمر أحمد
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">إجمالي الأيام الدراسية</span>
                                <span class="font-bold">22 يوم</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">أيام الحضور</span>
                                <span class="font-bold text-green-600 dark:text-green-400">20 يوم</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#638863] dark:text-[#a3c2a3]">نسبة الحضور</span>
                                <span class="font-bold text-green-600 dark:text-green-400">90.9%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="parent-functions.js"></script>
    <script>
        // ربط زر طباعة التقرير والفلتر
        document.addEventListener('DOMContentLoaded', function() {
            const printBtn = document.querySelector('button[onclick*="printAttendanceReport"]');
            if (printBtn) printBtn.onclick = printAttendanceReport;

            const monthFilter = document.getElementById('monthFilter');
            if (monthFilter) {
                monthFilter.onchange = function() {
                    filterByMonth(this.value);
                };
            }
        });
    </script>
    <script src="{{ asset('js/parent-functions.js') }}"></script>

</body>

</html>