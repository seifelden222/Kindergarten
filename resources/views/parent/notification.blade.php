<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
        <x-parent-sidebar active-page="notification" />
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
                    <div class="py-16 text-center text-[#638863]">
                        <span class="material-symbols-outlined text-5xl block mb-3">notifications_none</span>
                        <p class="text-lg font-bold">لا توجد تنبيهات حالياً</p>
                        <p class="text-sm mt-1">ستظهر هنا التنبيهات والإشعارات الخاصة بطفلك بمجرد وصولها.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="parent-functions.js"></script>
    <script>
        // ربط أزرار الإشعارات
        document.querySelectorAll('button').forEach(btn => {
            const btnText = btn.textContent.trim();

            if (btnText.includes('تحديد الكل كمقروء')) {
                btn.onclick = markAllAsRead;
            } else if (btnText.includes('الاتصال بالحضانة')) {
                btn.onclick = callNursery;
            } else if (btnText.includes('تأجيل التذكير')) {
                btn.onclick = snoozeReminder;
            } else if (btnText.includes('إضافة إلى التقويم')) {
                const originalOnclick = btn.getAttribute('onclick');
                if (!originalOnclick) {
                    btn.onclick = () => addToCalendar('موعد', 'تاريخ');
                }
            }
            // أزرار عرض التفاصيل تم ربطها مباشرة في HTML
        });
    </script>
    <script src="{{ asset('js/parent-functions.js') }}"></script>
</body>

</html>
