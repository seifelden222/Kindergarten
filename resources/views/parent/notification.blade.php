<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>التنبيهات - نظام إدارة الحضانة</title>
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
        <x-parent-sidebar />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8">

                <header class="flex flex-wrap justify-between items-center gap-6 mb-10">
                    <div class="flex flex-col gap-1">
                        <h2 class="text-3xl font-black tracking-tight">التنبيهات</h2>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-lg">آخر الإشعارات والتنبيهات المهمة</p>
                    </div>
                    <button class="px-5 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl text-sm font-bold hover:bg-gray-50 dark:hover:bg-white/10 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined">done_all</span>
                        <span>تحديد الكل كمقروء</span>
                    </button>
                </header>

                <div class="space-y-5">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between bg-red-50/50 dark:bg-red-950/20">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-2xl">warning</span>
                                <h3 class="font-bold text-lg text-red-700 dark:text-red-300">تنبيه عاجل</h3>
                            </div>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">منذ ٤٥ دقيقة</span>
                        </div>
                        <div class="p-6">
                            <p class="text-base font-medium mb-3">غياب مفاجئ لـ ليلى أحمد اليوم دون إبلاغ مسبق</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-4">يرجى التواصل مع إدارة الحضانة في أقرب وقت ممكن لتوضيح سبب الغياب.</p>
                            <div class="flex gap-4">
                                <button class="px-5 py-2 bg-red-600 text-white text-sm font-bold rounded-xl hover:brightness-110 transition-colors">الاتصال بالحضانة</button>
                                <button class="px-5 py-2 bg-gray-200 dark:bg-[#2d402d] text-sm font-bold rounded-xl hover:bg-gray-300 dark:hover:bg-[#3a523a] transition-colors">تأجيل التذكير</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-2xl">campaign</span>
                                <h3 class="font-bold text-lg">إعلان عام</h3>
                            </div>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">منذ ٣ ساعات</span>
                        </div>
                        <div class="p-6">
                            <p class="text-base font-medium mb-3">موعد التقييم الشهري للأطفال</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-4">سيتم إجراء التقييم الشهري يوم الأحد القادم الموافق ٢ نوفمبر من الساعة ٩ صباحاً حتى ١٢ ظهراً. يرجى الحضور في الموعد المحدد.</p>
                            <div class="flex gap-3 mt-4">
                                <button class="px-5 py-2 bg-primary text-[#111811] text-sm font-bold rounded-xl hover:brightness-110 transition-colors">إضافة إلى التقويم</button>
                                <button class="px-5 py-2 bg-background-light dark:bg-[#112111] text-sm font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-[#1e3a1e] transition-colors">عرض التفاصيل</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">restaurant_menu</span>
                                <h3 class="font-bold text-lg">تحديث وجبة اليوم</h3>
                            </div>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">منذ ٥ ساعات</span>
                        </div>
                        <div class="p-6">
                            <p class="text-base font-medium mb-3">تغيير في قائمة وجبة الغداء اليوم</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-4">تم تعديل وجبة الغداء اليوم لتصبح: رز بالدجاج + خضار مشوية + زبادي بالعسل بدلاً من المعكرونة بالصلصة.</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">يرجى إبلاغنا في حال وجود حساسية غذائية لم يتم الإفصاح عنها مسبقاً.</p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 text-2xl">event</span>
                                <h3 class="font-bold text-lg">تذكير بموعد</h3>
                            </div>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">منذ يوم واحد</span>
                        </div>
                        <div class="p-6">
                            <p class="text-base font-medium mb-3">موعد تسليم التقرير الطبي الدوري</p>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-4">يُرجى تسليم التقرير الطبي المحدث لكلا الطفلين (ليلى وعمر) قبل نهاية الأسبوع القادم.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center py-10">
                    <button class="px-8 py-3 bg-primary text-[#111811] font-bold rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                        عرض المزيد من التنبيهات
                    </button>
                </div>

            </div>
        </main>
    </div>
</body>

</html>