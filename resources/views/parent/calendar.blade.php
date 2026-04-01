<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>التقويم - نظام إدارة الحضانة</title>
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
        <x-parent-sidebar active-page="calendar" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8 space-y-8">
                <header class="flex flex-wrap items-end justify-between gap-6">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-black tracking-tight">التقويم</h2>
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-lg">كل المواعيد المهمة والتنبيهات المضافة من لوحة ولي الأمر في مكان واحد.</p>
                    </div>
                    <div class="rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#1a2e1a] px-5 py-4 shadow-sm">
                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الشهر الحالي</p>
                        <p class="text-xl font-black">أبريل ٢٠٢٦</p>
                    </div>
                </header>

                <section class="grid gap-6 lg:grid-cols-3">
                    <div class="rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#1a2e1a] p-6 shadow-sm lg:col-span-2">
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-xl font-bold">المواعيد القادمة</h3>
                            <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary">محدّث تلقائيًا</span>
                        </div>
                        <div class="space-y-4" data-calendar-events>
                            <div class="rounded-xl border border-dashed border-[#dce5dc] dark:border-[#2d402d] px-5 py-8 text-center text-sm text-[#638863] dark:text-[#a3c2a3]">
                                لا توجد أحداث مضافة بعد. استخدم زر "إضافة إلى التقويم" من صفحة التنبيهات لإظهارها هنا.
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#1a2e1a] p-6 shadow-sm">
                            <h3 class="mb-4 text-lg font-bold">مواعيد ثابتة</h3>
                            <div class="space-y-4 text-sm">
                                <div class="rounded-xl bg-[#f6fbf6] dark:bg-[#112111] p-4">
                                    <p class="font-bold">رسوم أبريل</p>
                                    <p class="mt-1 text-[#638863] dark:text-[#a3c2a3]">آخر موعد للسداد: ١٥ أبريل</p>
                                </div>
                                <div class="rounded-xl bg-[#f8f6ff] dark:bg-[#1f1730] p-4">
                                    <p class="font-bold">تقرير المتابعة</p>
                                    <p class="mt-1 text-[#638863] dark:text-[#a3c2a3]">يُرسل آخر خميس من كل شهر</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#1a2e1a] p-6 shadow-sm">
                            <h3 class="mb-4 text-lg font-bold">اختصارات سريعة</h3>
                            <div class="space-y-3">
                                <a class="flex items-center justify-between rounded-xl bg-background-light dark:bg-[#112111] px-4 py-3 text-sm font-bold hover:bg-[#ebf5eb] dark:hover:bg-[#173117] transition-colors" href="{{ route('parent.notification') }}">
                                    <span>فتح التنبيهات</span>
                                    <span class="material-symbols-outlined text-primary">notifications</span>
                                </a>
                                <a class="flex items-center justify-between rounded-xl bg-background-light dark:bg-[#112111] px-4 py-3 text-sm font-bold hover:bg-[#ebf5eb] dark:hover:bg-[#173117] transition-colors" href="{{ route('parent.payment') }}">
                                    <span>الانتقال إلى الدفع</span>
                                    <span class="material-symbols-outlined text-primary">payments</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/parent-functions.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            renderParentCalendar();
        });
    </script>
</body>

</html>
