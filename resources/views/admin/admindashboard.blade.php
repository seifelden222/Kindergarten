<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>لوحة التحكم الإدارية - نظام إدارة الحضانة </title>
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
                    <h2 class="text-xl font-bold">نظرة عامة</h2>
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="البحث عن طفل، معلم، أو ملف..." type="text" />
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
                            <span class="material-symbols-outlined p-2 bg-blue-50 text-blue-500 rounded-lg">face</span>
                            <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded">+5%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">إجمالي الأطفال</p>
                            <h3 class="text-3xl font-bold mt-1">120</h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-2 bg-purple-50 text-purple-500 rounded-lg">school</span>
                            <span class="text-xs font-bold text-zinc-400 bg-zinc-50 px-2 py-1 rounded">ثابت</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">إجمالي المعلمين</p>
                            <h3 class="text-3xl font-bold mt-1">15</h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-2 bg-red-50 text-red-500 rounded-lg">account_balance_wallet</span>
                            <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded">-10%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">مدفوعات معلقة</p>
                            <h3 class="text-3xl font-bold mt-1">2,500 <span class="text-sm font-normal text-zinc-400">ر.س</span></h3>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 flex flex-col gap-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="material-symbols-outlined p-2 bg-primary/10 text-primary rounded-lg">task_alt</span>
                            <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded">+2%</span>
                        </div>
                        <div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm font-medium">نسبة الحضور اليوم</p>
                            <h3 class="text-3xl font-bold mt-1">94%</h3>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-zinc-900 p-8 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">الإيرادات الشهرية</h4>
                                <p class="text-zinc-500 text-sm">مقارنة بآخر 6 أشهر</p>
                            </div>
                            <div class="text-left">
                                <h3 class="text-2xl font-bold text-primary">45,000 ر.س</h3>
                                <span class="text-xs text-green-500 font-bold">+15% زيادة</span>
                            </div>
                        </div>
                        <div class="flex items-end justify-between h-48 gap-3 pt-4">
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary/20 rounded-t-lg border-t-4 border-primary" style="height: 50%;"></div>
                                <span class="text-[10px] font-bold text-zinc-400">يناير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary/20 rounded-t-lg border-t-4 border-primary" style="height: 65%;"></div>
                                <span class="text-[10px] font-bold text-zinc-400">فبراير</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary/20 rounded-t-lg border-t-4 border-primary" style="height: 40%;"></div>
                                <span class="text-[10px] font-bold text-zinc-400">مارس</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary/20 rounded-t-lg border-t-4 border-primary" style="height: 80%;"></div>
                                <span class="text-[10px] font-bold text-zinc-400">أبريل</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary/20 rounded-t-lg border-t-4 border-primary" style="height: 95%;"></div>
                                <span class="text-[10px] font-bold text-zinc-400">مايو</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                                <div class="w-full bg-primary rounded-t-lg shadow-lg shadow-primary/20" style="height: 100%;"></div>
                                <span class="text-[10px] font-bold text-zinc-900 dark:text-white">يونيو</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-8 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold">اتجاهات التسجيل</h4>
                                <p class="text-zinc-500 text-sm">عدد المسجلين الجدد ربع سنوياً</p>
                            </div>
                            <div class="text-left">
                                <h3 class="text-2xl font-bold">+12 طفل</h3>
                                <span class="text-xs text-red-500 font-bold">-5% عن الربع السابق</span>
                            </div>
                        </div>
                        <div class="flex-1 relative min-h-[180px] mt-4">
                            <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 400 150">
                                <defs>
                                    <linearGradient id="lineGrad" x1="0" x2="0" y1="0" y2="1">
                                        <stop offset="0%" stop-color="#0ea60e" stop-opacity="0.3"></stop>
                                        <stop offset="100%" stop-color="#0ea60e" stop-opacity="0"></stop>
                                    </linearGradient>
                                </defs>
                                <path d="M0,120 Q50,40 100,100 T200,60 T300,110 T400,20 L400,150 L0,150 Z" fill="url(#lineGrad)"></path>
                                <path d="M0,120 Q50,40 100,100 T200,60 T300,110 T400,20" fill="none" stroke="#0ea60e" stroke-linecap="round" stroke-width="4"></path>
                                <circle cx="100" cy="100" fill="white" r="4" stroke="#0ea60e" stroke-width="2"></circle>
                                <circle cx="200" cy="60" fill="white" r="4" stroke="#0ea60e" stroke-width="2"></circle>
                                <circle cx="300" cy="110" fill="white" r="4" stroke="#0ea60e" stroke-width="2"></circle>
                                <circle cx="400" cy="20" fill="#0ea60e" r="5"></circle>
                            </svg>
                            <div class="flex justify-between mt-4 px-2">
                                <span class="text-[10px] font-bold text-zinc-400">Q1</span>
                                <span class="text-[10px] font-bold text-zinc-400">Q2</span>
                                <span class="text-[10px] font-bold text-zinc-400">Q3</span>
                                <span class="text-[10px] font-bold text-zinc-400">Q4</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">آخر النشاطات</h4>
                        <button class="text-primary text-sm font-bold hover:underline">عرض الكل</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الطفل</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النشاط</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">التاريخ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الحالة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-zinc-200" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                            <span class="text-sm font-medium">سارة محمد</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">تسجيل طالب جديد</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">منذ ساعتين</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">مكتمل</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-zinc-200" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBV7P4SdEd01ffqWAF3dqXXqHdRbffgWVgMwzlfjiZK5eCJ90nmldqfjEMrIKD0U1wP3KqclFGz8rcWpAoM3gaDJ1lHN2uKS5fbC74QRAlh6EBoeoOlFIjSvMf0Vk1NH89qgNtiX7H3psP1bQ4rL94H3hq7bjXyUxzXqi21aHmfDNKTQ0v1dNViTh14Z75eJHtFISrMiXDSMEuerLhd6cNDI25YKbSs6HQ3FzaayOaTjHbPRAxeIjT85-LBXFRrIXCkfOJ2o8ZCHUza')"></div>
                                            <span class="text-sm font-medium">علي خالد</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">دفع رسوم الفصل الدراسي</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">اليوم، 10:30 صباحاً</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-yellow-100 text-yellow-700">قيد المعالجة</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-zinc-200" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBVIJlTM5sXPuGdkc3BSny7APE5WfF4IK18M7Hx1GdrJLO6Twz84hk3CALnTk6RJ3U0JiBGpfkB2DXOMugQNSvH-txjYeVWwKn5lHEP9pUKv7K75BVCm_TCe2FRt8CLYWiiWOaGcpzQBUKMN_1uSyuiv_ImMtuX0udd7jDCK4uwDAYTLuL4T72274vkq7tAGUJbgEyf0U299oSJyCyNUlNWQmgOanx4yJayy6NiNEFwFeIdnjPuaviwsXIm0B7z1mECkVOD6mlLKK76')"></div>
                                            <span class="text-sm font-medium">نورة السعد</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">تغيير الجدول الدراسي</td>
                                    <td class="px-6 py-4 text-sm text-zinc-500">أمس</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">مكتمل</span>
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