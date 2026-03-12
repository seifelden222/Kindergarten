<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الجداول الدراسية - نظام إدارة الحضانة</title>
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
                    <h2 class="text-xl font-bold">الجداول الدراسية</h2>
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="البحث عن جدول أو مجموعة..." type="text" />
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
                <div class="flex flex-col lg:flex-row gap-6 items-start justify-between flex-wrap">
                    <div class="flex items-center gap-4">
                        <select class="bg-white dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/50">
                            <option>الفصل الدراسي الأول 2025-2026</option>
                            <option>الفصل الدراسي الثاني 2025-2026</option>
                        </select>
                        <select class="bg-white dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/50">
                            <option>جميع المجموعات</option>
                            <option>مجموعة الدببة الصغيرة (3-4 سنوات)</option>
                            <option>مجموعة الفراشات (4-5 سنوات)</option>
                            <option>مجموعة الأسود (5-6 سنوات)</option>
                        </select>
                    </div>
                    <button class="bg-primary text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-primary/90 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">add</span>
                        إضافة جدول جديد
                    </button>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">جدول مجموعة الفراشات (4-5 سنوات)</h4>
                        <div class="flex items-center gap-3">
                            <button class="text-primary hover:underline text-sm">تعديل الجدول</button>
                            <button class="text-primary hover:underline text-sm">طباعة</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse min-w-[900px]">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-24">اليوم</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الفترة الصباحية<br>8:00 - 10:00</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الفترة الثانية<br>10:15 - 12:00</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">بعد الظهر<br>12:30 - 2:00</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النشاط اليومي<br>2:15 - 4:00</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                <tr>
                                    <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">الأحد</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>لغة عربية<br><span class="text-xs text-zinc-500">أ. نورة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>رياضيات ممتعة<br><span class="text-xs text-zinc-500">أ. سارة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">الراحة والغداء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-amber-500 text-2xl">sports_soccer</span>
                                            <span>رياضة وحركة<br><span class="text-xs text-zinc-500">الملعب الخارجي</span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">الإثنين</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>الفنون والرسم<br><span class="text-xs text-zinc-500">أ. ليلى</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>قراءة قصصية<br><span class="text-xs text-zinc-500">أ. نورة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">الراحة والغداء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-blue-500 text-2xl">music_note</span>
                                            <span>موسيقى ورقص<br><span class="text-xs text-zinc-500">قاعة الموسيقى</span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">الثلاثاء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>علوم وتجارب<br><span class="text-xs text-zinc-500">أ. محمد</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>مهارات حياتية<br><span class="text-xs text-zinc-500">أ. فاطمة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">الراحة والغداء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-purple-500 text-2xl">theater_comedy</span>
                                            <span>مسرح وألعاب تمثيل<br><span class="text-xs text-zinc-500">قاعة النشاط</span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">الأربعاء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>لغة إنجليزية<br><span class="text-xs text-zinc-500">أ. سارة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>حساب ممتع<br><span class="text-xs text-zinc-500">أ. نورة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">الراحة والغداء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-red-500 text-2xl">directions_run</span>
                                            <span>ألعاب حركية<br><span class="text-xs text-zinc-500">حديقة الألعاب</span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">الخميس</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>فنون تشكيلية<br><span class="text-xs text-zinc-500">أ. ليلى</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-cover bg-center"></div>
                                            <span>قصة ومسرح<br><span class="text-xs text-zinc-500">أ. نورة</span></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">الراحة والغداء</td>
                                    <td class="px-4 py-5">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-cyan-500 text-2xl">pool</span>
                                            <span>نشاط مائي/سباحة<br><span class="text-xs text-zinc-500">حمام السباحة الصغير</span></span>
                                        </div>
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