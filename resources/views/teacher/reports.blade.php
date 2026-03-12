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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white min-h-screen">

    <div class="flex h-screen">

        <x-teacher-sidebar active="levels" />

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-y-auto py-8 px-6 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-8">

                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex min-w-72 flex-col gap-2">
                            <h1 class="text-4xl font-black leading-tight tracking-tight">التقارير</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">عرض وإدارة التقارير اليومية والأسبوعية</p>
                        </div>
                        <button class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-sm hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined ml-2 text-xl">add</span>
                            تقرير جديد
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold">التقارير اليومية</h3>
                                <button class="text-primary text-sm font-medium hover:underline">عرض الكل</button>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-lg">
                                    <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">تقرير يوم الأحد - 5 مارس</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">تم إرساله إلى 3 أولياء أمور</p>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">منذ 3 أيام</span>
                                </div>
                                <div class="flex items-center gap-4 p-4 bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-lg">
                                    <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">تقرير يوم السبت - 4 مارس</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">في انتظار الموافقة</p>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">منذ 4 أيام</span>
                                </div>
                                <div class="flex items-center gap-4 p-4 bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-lg opacity-70">
                                    <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">تقرير يوم الجمعة - 3 مارس</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">تمت المراجعة</p>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">منذ 5 أيام</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold">إحصائيات الحضور الأسبوعية</h3>
                                <select class="bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-lg px-3 py-1.5 text-sm">
                                    <option>هذا الأسبوع</option>
                                    <option>الأسبوع الماضي</option>
                                    <option>الشهر الحالي</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-primary">91%</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">نسبة الحضور</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-orange-500">7</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">أيام غياب</p>
                                </div>
                            </div>
                            <div class="h-48 bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-lg flex items-center justify-center text-[#638863] dark:text-[#a0b0a0]">
                                <p>مكان الرسم البياني للحضور الأسبوعي</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold">آخر التقارير المرسلة</h3>
                            <button class="text-primary text-sm font-medium hover:underline">تصدير الكل</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead>
                                    <tr class="border-b border-[#dce5dc] dark:border-[#2a3a2a]">
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">التاريخ</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الفصل</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">المعلمة</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الحالة</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#dce5dc] dark:divide-[#2a3a2a]">
                                    <tr>
                                        <td class="py-4">الأحد 5 مارس 2026</td>
                                        <td class="py-4">فصل الزهور (أ)</td>
                                        <td class="py-4">أ. سارة أحمد</td>
                                        <td class="py-4"><span class="inline-block px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs">مرسل</span></td>
                                        <td class="py-4">
                                            <button class="text-primary hover:underline text-sm">عرض</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">السبت 4 مارس 2026</td>
                                        <td class="py-4">فصل الفراشات (ب)</td>
                                        <td class="py-4">أ. نورا محمد</td>
                                        <td class="py-4"><span class="inline-block px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-full text-xs">قيد المراجعة</span></td>
                                        <td class="py-4">
                                            <button class="text-primary hover:underline text-sm">عرض</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">الخميس 2 مارس 2026</td>
                                        <td class="py-4">فصل النجوم (ج)</td>
                                        <td class="py-4">أ. لمى خالد</td>
                                        <td class="py-4"><span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs">تمت الموافقة</span></td>
                                        <td class="py-4">
                                            <button class="text-primary hover:underline text-sm">عرض</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a2a1a] border-t border-[#dce5dc] dark:border-[#2a3a2a] px-6 py-2 flex justify-between items-center z-50">
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">home</span>
            <span class="text-[10px]">الرئيسية</span>
        </button>
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">groups</span>
            <span class="text-[10px]">الفصول</span>
        </button>
        <button class="size-12 rounded-full bg-primary text-white flex items-center justify-center -mt-8 border-4 border-[#f6f8f6] dark:border-background-dark shadow-lg">
            <span class="material-symbols-outlined">add</span>
        </button>
        <button class="flex flex-col items-center text-primary">
            <span class="material-symbols-outlined">description</span>
            <span class="text-[10px]">التقارير</span>
        </button>
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="text-[10px]">حسابي</span>
        </button>
    </div>

</body>

</html>