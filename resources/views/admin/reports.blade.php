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

        .active-nav {
            background-color: #0ea60e;
            color: white !important;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
      
<x-admin-slider />
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-6 flex-1">
                    <h2 class="text-xl font-bold">التقارير</h2>
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="البحث في التقارير..." type="text" />
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-primary/10 hover:text-primary transition-all relative">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-2 right-2.5 size-2 bg-red-500 rounded-full border-2 border-white dark:border-zinc-900"></span>
                    </button>
                    <button class="p-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-primary/10 hover:text-primary transition-all">
                        <span class="material-symbols-outlined">help_outline</span>
                    </button>
                </div>
            </header>
            <div class="p-8 space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-zinc-900 p-8 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">نسب الحضور الشهرية</h4>
                                <p class="text-zinc-500 text-sm">آخر 6 أشهر</p>
                            </div>
                            <div class="text-left">
                                <h3 class="text-2xl font-bold text-primary">92.4%</h3>
                                <span class="text-xs text-green-500 font-bold">+3.2% تحسن</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between h-64 gap-4 pt-6">
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary/30 rounded-t-xl" style="height: 65%;"></div>
                                <span class="text-xs font-medium text-zinc-500">يناير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary/30 rounded-t-xl" style="height: 70%;"></div>
                                <span class="text-xs font-medium text-zinc-500">فبراير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary/30 rounded-t-xl" style="height: 58%;"></div>
                                <span class="text-xs font-medium text-zinc-500">مارس</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary/30 rounded-t-xl" style="height: 88%;"></div>
                                <span class="text-xs font-medium text-zinc-500">أبريل</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary/30 rounded-t-xl" style="height: 95%;"></div>
                                <span class="text-xs font-medium text-zinc-500">مايو</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 justify-end">
                                <div class="w-full bg-primary rounded-t-xl shadow-lg shadow-primary/30" style="height: 100%;"></div>
                                <span class="text-xs font-bold text-zinc-900 dark:text-white">يونيو</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-8 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">توزيع الأطفال حسب الفئة العمرية</h4>
                                <p class="text-zinc-500 text-sm">الفصل الحالي</p>
                            </div>
                        </div>
                        <div class="flex-1 flex items-center justify-center py-8">
                            <div class="relative w-64 h-64">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-3xl font-bold text-primary">120</span>
                                </div>
                                <svg class="w-full h-full" viewBox="0 0 200 200">
                                    <circle cx="100" cy="100" r="90" fill="none" stroke="#e2e8f0" stroke-width="20" class="dark:stroke-zinc-700" />
                                    <circle cx="100" cy="100" r="90" fill="none" stroke="#0ea60e" stroke-width="20" stroke-dasharray="565" stroke-dashoffset="141" transform="rotate(-90 100 100)" />
                                    <circle cx="100" cy="100" r="90" fill="none" stroke="#a3e635" stroke-width="20" stroke-dasharray="565" stroke-dashoffset="282" transform="rotate(-90 100 100)" />
                                    <circle cx="100" cy="100" r="90" fill="none" stroke="#fbbf24" stroke-width="20" stroke-dasharray="565" stroke-dashoffset="452" transform="rotate(-90 100 100)" />
                                </svg>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 text-center text-sm">
                            <div>
                                <div class="w-4 h-4 bg-primary rounded-full mx-auto mb-1"></div>
                                <span class="text-zinc-600 dark:text-zinc-300">3-4 سنوات</span>
                                <p class="font-bold">48</p>
                            </div>
                            <div>
                                <div class="w-4 h-4 bg-lime-400 rounded-full mx-auto mb-1"></div>
                                <span class="text-zinc-600 dark:text-zinc-300">4-5 سنوات</span>
                                <p class="font-bold">52</p>
                            </div>
                            <div>
                                <div class="w-4 h-4 bg-amber-400 rounded-full mx-auto mb-1"></div>
                                <span class="text-zinc-600 dark:text-zinc-300">5-6 سنوات</span>
                                <p class="font-bold">20</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">آخر التقارير المُنشأة</h4>
                        <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-primary/90 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined">add_chart</span>
                            إنشاء تقرير جديد
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">اسم التقرير</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النوع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">التاريخ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">المُنشئ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                            <div>
                                                <span class="text-sm font-medium block">تقرير الحضور الشهري</span>
                                                <span class="text-xs text-zinc-500">يونيو 2025</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">حضور</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">2025-06-30</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">أحمد العمر</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary hover:underline ml-3">عرض</button>
                                        <button class="text-primary hover:underline">تنزيل</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                            <div>
                                                <span class="text-sm font-medium block">تقرير الرسوم المالية</span>
                                                <span class="text-xs text-zinc-500">الفصل الدراسي الثاني</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">مالي</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">2025-05-15</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">أحمد العمر</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary hover:underline ml-3">عرض</button>
                                        <button class="text-primary hover:underline">تنزيل</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                            <div>
                                                <span class="text-sm font-medium block">تقرير تقييم الأداء</span>
                                                <span class="text-xs text-zinc-500">المعلمين</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">أداء</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">2025-04-10</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">نورة السعد</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <button class="text-primary hover:underline ml-3">عرض</button>
                                        <button class="text-primary hover:underline">تنزيل</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>