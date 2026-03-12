<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>المالية - نظام إدارة الحضانة</title>
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
                    <h2 class="text-xl font-bold">المالية</h2>
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="البحث عن دفعة أو فاتورة..." type="text" />
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-3 bg-green-50 text-green-600 rounded-xl text-3xl">trending_up</span>
                            <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">+18%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">إجمالي الإيرادات الشهرية</p>
                            <h3 class="text-3xl font-bold mt-2">87,450 <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-3 bg-blue-50 text-blue-600 rounded-xl text-3xl">account_balance</span>
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">+4%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">الرصيد الحالي</p>
                            <h3 class="text-3xl font-bold mt-2">142,300 <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-3 bg-red-50 text-red-600 rounded-xl text-3xl">pending</span>
                            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded">+12%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">المدفوعات المعلقة</p>
                            <h3 class="text-3xl font-bold mt-2">18,750 <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-3 bg-amber-50 text-amber-600 rounded-xl text-3xl">warning</span>
                            <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded">متأخر</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">الديون المتأخرة</p>
                            <h3 class="text-3xl font-bold mt-2">9,200 <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-zinc-900 p-8 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div>
                                <h4 class="text-lg font-bold">الإيرادات والمصروفات الشهرية</h4>
                                <p class="text-zinc-500 text-sm">آخر 6 أشهر</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-2 text-sm">
                                    <span class="size-3 bg-primary rounded-full"></span> الإيرادات
                                </span>
                                <span class="flex items-center gap-2 text-sm">
                                    <span class="size-3 bg-red-500 rounded-full"></span> المصروفات
                                </span>
                            </div>
                        </div>
                        <div class="h-64 flex items-end justify-between gap-3 pt-6">
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 35%;"></div>
                                <div class="w-full bg-primary/70 mt-1 rounded-t-lg" style="height: 75%;"></div>
                                <span class="text-xs text-zinc-500 mt-2">يناير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 40%;"></div>
                                <div class="w-full bg-primary/70 mt-1 rounded-t-lg" style="height: 68%;"></div>
                                <span class="text-xs text-zinc-500 mt-2">فبراير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 38%;"></div>
                                <div class="w-full bg-primary/70 mt-1 rounded-t-lg" style="height: 82%;"></div>
                                <span class="text-xs text-zinc-500 mt-2">مارس</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 42%;"></div>
                                <div class="w-full bg-primary/70 mt-1 rounded-t-lg" style="height: 95%;"></div>
                                <span class="text-xs text-zinc-500 mt-2">أبريل</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 45%;"></div>
                                <div class="w-full bg-primary/70 mt-1 rounded-t-lg" style="height: 88%;"></div>
                                <span class="text-xs text-zinc-500 mt-2">مايو</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-red-400/60 rounded-t-lg" style="height: 40%;"></div>
                                <div class="w-full bg-primary rounded-t-lg shadow-lg shadow-primary/30" style="height: 100%;"></div>
                                <span class="text-xs font-bold text-zinc-900 dark:text-white mt-2">يونيو</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between flex-wrap gap-4">
                            <h4 class="text-lg font-bold">آخر العمليات المالية</h4>
                            <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-primary/90 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined">add</span>
                                تسجيل دفعة جديدة
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الطفل / ولي الأمر</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النوع</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">المبلغ</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">التاريخ</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center"></div>
                                                <span class="font-medium">سارة محمد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">رسوم شهرية</td>
                                        <td class="px-6 py-4 text-sm font-medium text-green-600">3,200 ج.م</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-06-28</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">مدفوع</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center"></div>
                                                <span class="font-medium">علي خالد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">رسوم التسجيل</td>
                                        <td class="px-6 py-4 text-sm font-medium text-green-600">5,000 ج.م</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-06-25</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">مدفوع</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center"></div>
                                                <span class="font-medium">محمد أحمد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">رسوم شهرية</td>
                                        <td class="px-6 py-4 text-sm font-medium text-yellow-600">3,200 ج.م</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-06-20</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700">معلق</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center"></div>
                                                <span class="font-medium">فاطمة علي</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">مصروفات رواتب</td>
                                        <td class="px-6 py-4 text-sm font-medium text-red-600">-12,500 ج.م</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-06-15</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">مدفوع</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-6 border-t border-zinc-100 dark:border-zinc-800 flex justify-between text-sm text-zinc-500">
                            <span>عرض 1-4 من 87 عملية</span>
                            <div class="flex gap-2">
                                <button class="p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-50" disabled>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </button>
                                <button class="p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                                    <span class="material-symbols-outlined">chevron_left</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</body>

</html>