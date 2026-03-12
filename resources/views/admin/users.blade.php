<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إدارة المستخدمين - نظام إدارة الحضانة</title>
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
                    <h2 class="text-xl font-bold">إدارة المستخدمين</h2>
                    <div class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="البحث عن مستخدم..." type="text" />
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
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between flex-wrap gap-4">
                        <h4 class="text-lg font-bold">قائمة المستخدمين</h4>
                        <div class="flex items-center gap-3">

                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الاسم</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النوع</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">البريد الإلكتروني</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">رقم الجوال</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">تاريخ التسجيل</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الحالة</th>
                                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                                <span class="text-sm font-medium">سارة محمد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">طالب</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">sarah@example.com</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">+966 55 123 4567</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-09-15</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">نشط</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-primary hover:underline ml-2">تعديل</button>
                                            <button class="text-red-500 hover:underline">حذف</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                                <span class="text-sm font-medium">علي خالد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">طالب</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">ali@example.com</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">+966 50 987 6543</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-10-02</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">نشط</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-primary hover:underline ml-2">تعديل</button>
                                            <button class="text-red-500 hover:underline">حذف</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                                <span class="text-sm font-medium">نورة السعد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">معلم</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">noura@example.com</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">+966 54 321 0987</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-01-10</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">نشط</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-primary hover:underline ml-2">تعديل</button>
                                            <button class="text-red-500 hover:underline">حذف</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                                <span class="text-sm font-medium">محمد أحمد</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">ولي أمر</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">mohammed@example.com</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">+966 59 876 5432</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2025-11-20</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-yellow-100 text-yellow-700">معلق</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-primary hover:underline ml-2">تعديل</button>
                                            <button class="text-red-500 hover:underline">حذف</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAMHEEzzwmcwhlrNc7CwMk5WwtKoOSocZGgJ96s6SoAyUEWJLQ2XAiMbZuUm7KolPLnGwoC3r5zPnJekmN6oGavwiU0uiAUDQNwYhDPuvtCB40kAY4bNaozyGxi1g2dkuyt4dr2G4iNEJ7y1OhQZVP8NBSp0vLcs8DmHzBS_rdGUN1ZraEO4YrLgaWmsK0u9I0kAlQ9D-8inqnA9jUy12NKf3tQveE0itH0Zz4Yp-BoWk01jT6W_mM2bB0XxfF5SYwkR9eKNRXKgQUm')"></div>
                                                <span class="text-sm font-medium">فاطمة علي</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">معلم</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">fatima@example.com</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">+966 56 789 0123</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">2024-12-05</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">نشط</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-primary hover:underline ml-2">تعديل</button>
                                            <button class="text-red-500 hover:underline">حذف</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-sm text-zinc-500">
                            <span>عرض 1-5 من 48 مستخدم</span>
                            <div class="flex items-center gap-2">
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