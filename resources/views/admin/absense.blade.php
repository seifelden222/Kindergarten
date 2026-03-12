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

        .active-nav {
            background-color: #0ea60e;
            color: white !important;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-admin-slider />

        <main class="flex-1 overflow-y-auto px-6 py-8">
            <div class="max-w-[1280px] mx-auto">

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-8">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-4xl font-black leading-tight tracking-tight">سجل الحضور والغياب</h1>
                        <p class="text-[#638863] dark:text-gray-400 text-base font-normal">تتبع حضور وغياب الأطفال اليومي والأسبوعي بكل سهولة</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button class="flex items-center justify-center gap-2 bg-white dark:bg-background-dark border border-[#dce5dc] dark:border-[#2a4a2a] rounded-xl px-5 py-2.5 text-sm font-bold hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <span class="material-symbols-outlined text-xl">download</span>
                            <span>تصدير التقرير</span>
                        </button>
                        <button class="flex items-center justify-center gap-2 bg-primary text-white rounded-xl px-5 py-2.5 text-sm font-bold hover:bg-[#16cc16] transition-colors shadow-md">
                            <span class="material-symbols-outlined text-xl">add</span>
                            <span>تسجيل حضور جديد</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                    <div class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">إجمالي الأطفال</p>
                            <span class="material-symbols-outlined text-primary">groups</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">١٢٠</p>
                        <p class="text-[#078823] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            <span>+٥% عن الشهر الماضي</span>
                        </p>
                    </div>

                    <div class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">الحضور اليوم</p>
                            <span class="material-symbols-outlined text-primary">check_circle</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">١٠٥</p>
                        <p class="text-[#078823] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            <span>+٢% اليوم</span>
                        </p>
                    </div>

                    <div class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">الغياب اليوم</p>
                            <span class="material-symbols-outlined text-red-500">cancel</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">١٥</p>
                        <p class="text-[#e72208] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_down</span>
                            <span>-٣% غياب مبرر</span>
                        </p>
                    </div>

                    <div class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">نسبة الحضور الأسبوعية</p>
                            <span class="material-symbols-outlined text-primary">analytics</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">٩٢%</p>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 h-2.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-primary h-full w-[92%] rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-background-dark rounded-xl border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm overflow-hidden">
                    <div class="flex flex-col">
                        <div class="flex flex-wrap items-center justify-between gap-4 p-5 border-b border-[#f0f4f0] dark:border-[#2a4a2a]">
                            <div class="flex flex-wrap gap-4">
                                <button class="flex items-center gap-2 text-sm font-medium px-5 py-2.5 rounded-lg bg-background-light dark:bg-[#2a4a2a] text-[#111811] dark:text-white">
                                    <span class="material-symbols-outlined text-xl">calendar_today</span>
                                    <span>اليوم: ٢٤ مايو ٢٠٢٤</span>
                                </button>
                                <button class="flex items-center gap-2 text-sm font-medium px-5 py-2.5 rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] text-[#111811] dark:text-white">
                                    <span class="material-symbols-outlined text-xl">filter_list</span>
                                    <span>تصفية حسب الفصل</span>
                                </button>
                            </div>
                            <div class="flex items-center gap-1.5 bg-background-light dark:bg-[#2a4a2a] p-1.5 rounded-xl">
                                <button class="px-5 py-2 rounded-lg bg-white dark:bg-background-dark shadow-sm text-sm font-bold text-primary">الكل</button>
                                <button class="px-5 py-2 rounded-lg text-sm font-medium text-[#638863] dark:text-gray-400">حاضر</button>
                                <button class="px-5 py-2 rounded-lg text-sm font-medium text-[#638863] dark:text-gray-400">غائب</button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr class="bg-background-light/60 dark:bg-[#1e331e] text-[#638863] dark:text-gray-400 text-sm uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold">اسم الطفل</th>
                                        <th class="px-6 py-4 font-semibold">التاريخ</th>
                                        <th class="px-6 py-4 font-semibold text-center">الحالة</th>
                                        <th class="px-6 py-4 font-semibold">وقت الدخول</th>
                                        <th class="px-6 py-4 font-semibold">وقت الخروج</th>
                                        <th class="px-6 py-4 font-semibold text-center">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#f0f4f0] dark:divide-[#2a4a2a]">
                                    <tr class="hover:bg-gray-50 dark:hover:bg-[#233a23] transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="size-11 rounded-full bg-blue-100 flex items-center justify-center border border-blue-200 overflow-hidden">
                                                    <img alt="Ahmed" class="size-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCp82e3LRwDZ2a6F6kcbsdGbMrs8mhekZOO5dYebZu8P_c87kYZNgkfFcPUCxGXLk6Jvhc4iL0LYDwO3qnboC9KjANBY8zOnP0swBCP5iTezQSCnTBRYcwWkCrnrYM9bnO6TXoQkaY011qAbceDyhCzyRRiviQUoEYRZJiXbR9LSg7RKuULLgUA8KNxZR-I1Ci45-n5Q3381o5yVFrEoDbkxAK9Pz-7SaLnFeBfjfAbWVOJH57S3CVt0IX5P-Y7LioLntnMku1Iywgu" />
                                                </div>
                                                <div>
                                                    <span class="font-bold block">أحمد محمد علي</span>
                                                    <span class="text-xs text-[#638863] dark:text-gray-400">فصل العصافير</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-medium">٢٤ مايو ٢٠٢٤</td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#e8fbe8] dark:bg-[#0a3a0a] text-[#078823] text-xs font-bold">
                                                <span class="size-2 rounded-full bg-[#078823]"></span>
                                                حاضر
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm">٠٧:٤٥ ص</td>
                                        <td class="px-6 py-5 text-sm">٠٢:٣٠ م</td>
                                        <td class="px-6 py-5 text-center">
                                            <button class="p-2 hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                            <button class="p-2 hover:text-red-500 transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50 dark:hover:bg-[#233a23] transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="size-11 rounded-full bg-pink-100 flex items-center justify-center border border-pink-200 overflow-hidden">
                                                    <img alt="Sara" class="size-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHoeW49mdv40_Htdh8UXkVE4rgYOLzioW27ZX_nDbhLKSyXT5SeAYtMzK7MveSa_W1RCi-0YcoW1kH3Mw3Gqa3V1CZcT7HZ3zra_2gC13dqf92SmPRlwUrLiBWun0Qr-6adHNCF3Z29Q5CoFjn7Slzl8i-oSsO9x86Ecr1pJLMI_ykiBZaUjpRLxENm9uWcUZO9yIzlkM4ovI8rZMV4IrErdqLAxkwH-rvSDNDYjhMi2bCoKlrOiQvY_fVoP27ZXsL-SvS4ps9xbUT" />
                                                </div>
                                                <div>
                                                    <span class="font-bold block">سارة خالد</span>
                                                    <span class="text-xs text-[#638863] dark:text-gray-400">فصل النجوم</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-medium">٢٤ مايو ٢٠٢٤</td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#fde8e8] dark:bg-[#3a1a1a] text-[#e72208] text-xs font-bold">
                                                <span class="size-2 rounded-full bg-[#e72208]"></span>
                                                غائب
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-gray-400">-- : --</td>
                                        <td class="px-6 py-5 text-sm text-gray-400">-- : --</td>
                                        <td class="px-6 py-5 text-center">
                                            <button class="p-2 hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                            <button class="p-2 hover:text-red-500 transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50 dark:hover:bg-[#233a23] transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="size-11 rounded-full bg-green-100 flex items-center justify-center border border-green-200 overflow-hidden">
                                                    <img alt="Youssef" class="size-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmXHMbM0V44tK-clRWDW1e064GpxzQ9pp60BxgCh9EnLG5jZyuKXBhRw53w0yd0jmCIl8wLl85vzMm4RRS07g3_ZzLbXLFno3S0E4g35ziRiv8bug9m-SwUxsbSQ027vw4UumVKELgQFijQ7KQaDWU1u5feMg30vA8R9tbA6UsapUoEwlOJJ0HI4_0soD28keKj09HFXpUwsLOAbCPQjGl5R1Y2ejPWP98cYyQ9JU35ea5QHXb7bogusERR3pmBcblnoBnMB8NwXpo" />
                                                </div>
                                                <div>
                                                    <span class="font-bold block">يوسف إبراهيم</span>
                                                    <span class="text-xs text-[#638863] dark:text-gray-400">فصل العصافير</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-medium">٢٤ مايو ٢٠٢٤</td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#e8fbe8] dark:bg-[#0a3a0a] text-[#078823] text-xs font-bold">
                                                <span class="size-2 rounded-full bg-[#078823]"></span>
                                                حاضر
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm">٠٨:٠٥ ص</td>
                                        <td class="px-6 py-5 text-sm text-gray-400">لم يخرج بعد</td>
                                        <td class="px-6 py-5 text-center">
                                            <button class="p-2 hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                            <button class="p-2 hover:text-red-500 transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-gray-50 dark:hover:bg-[#233a23] transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="size-11 rounded-full bg-purple-100 flex items-center justify-center border border-purple-200 overflow-hidden">
                                                    <img alt="Laila" class="size-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9wGZmSJpFJVw3hhdv01fOfqgqvFSTJuMcluDGJ21IiSEz4V_wJrxYTZFNj5etDI9XH8iRdjT2FERWY9P0iduwJ-_VbP2MYFlEaV_HfGbKUtASrBVZSU4aErKc7rEmJD3KD4S-6RO3wVR29wEkuQZz0KkZj22YfDcvGOV07mPGUFlQ3o3zoXGh5cVidB5J5BqG1MWckzHjMPsQMuKDMmFQ-COntlXkzlNCROryWcx0_DNZWQF4aE8oaDrWlpZhPunYDT5UBXYbDTaU" />
                                                </div>
                                                <div>
                                                    <span class="font-bold block">ليلى محمود</span>
                                                    <span class="text-xs text-[#638863] dark:text-gray-400">فصل الفراشات</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-medium">٢٤ مايو ٢٠٢٤</td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#e8fbe8] dark:bg-[#0a3a0a] text-[#078823] text-xs font-bold">
                                                <span class="size-2 rounded-full bg-[#078823]"></span>
                                                حاضر
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm">٠٧:٥٠ ص</td>
                                        <td class="px-6 py-5 text-sm">٠٢:٤٥ م</td>
                                        <td class="px-6 py-5 text-center">
                                            <button class="p-2 hover:text-primary transition-colors"><span class="material-symbols-outlined">edit</span></button>
                                            <button class="p-2 hover:text-red-500 transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-5 flex items-center justify-between border-t border-[#f0f4f0] dark:border-[#2a4a2a]">
                            <p class="text-sm text-[#638863] dark:text-gray-400">عرض ١ إلى ٤ من أصل ١٢٠ طفل</p>
                            <div class="flex gap-2">
                                <button class="size-9 flex items-center justify-center rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </button>
                                <button class="size-9 flex items-center justify-center rounded-lg bg-primary text-white font-bold shadow-sm">١</button>
                                <button class="size-9 flex items-center justify-center rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">٢</button>
                                <button class="size-9 flex items-center justify-center rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">٣</button>
                                <button class="size-9 flex items-center justify-center rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    <span class="material-symbols-outlined">chevron_left</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
        </main>

        <button class="md:hidden fixed bottom-8 left-8 z-50 size-16 rounded-full bg-primary text-white flex items-center justify-center shadow-2xl shadow-primary/30 hover:scale-110 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-3xl">add</span>
        </button>

    </div>
    </div>
</body>

</html>