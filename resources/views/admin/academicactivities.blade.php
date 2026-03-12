<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الانشطة - نظام إدارة الحضانة</title>
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

                <div class="flex flex-col sm:flex-row flex-wrap justify-between items-start sm:items-center gap-4 mb-8">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-[#111811] dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-tight">صفحة الأنشطة اليومية والتعليمية</h1>
                        <p class="text-[#638863] dark:text-white/60 text-base font-normal">تابع وأدر جميع الأنشطة التعليمية والترفيهية للأطفال في حضانتنا</p>
                    </div>
                    <button class="flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                        <span class="material-symbols-outlined">add_circle</span>
                        <span>إضافة نشاط جديد</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    <aside class="lg:col-span-3 flex flex-col gap-6 order-2 lg:order-1">
                        <div class="bg-white dark:bg-white/5 p-5 rounded-2xl shadow-sm border border-[#f0f4f0] dark:border-white/5">
                            <div class="flex items-center justify-between mb-5">
                                <button class="size-9 flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                    <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
                                </button>
                                <p class="text-[#111811] dark:text-white text-base font-bold">أكتوبر 2023</p>
                                <button class="size-9 flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                                    <span class="material-symbols-outlined text-sm">arrow_back_ios</span>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center">
                                <p class="text-[#638863] text-xs font-bold py-2">أحد</p>
                                <p class="text-[#638863] text-xs font-bold py-2">اثن</p>
                                <p class="text-[#638863] text-xs font-bold py-2">ثلا</p>
                                <p class="text-[#638863] text-xs font-bold py-2">أرب</p>
                                <p class="text-[#638863] text-xs font-bold py-2">خميس</p>
                                <p class="text-[#638863] text-xs font-bold py-2">جمعة</p>
                                <p class="text-[#638863] text-xs font-bold py-2">سبت</p>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60">1</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60">2</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60">3</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm bg-primary text-white font-bold">4</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60 hover:bg-gray-50">5</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60">6</button>
                                <button class="h-9 w-full flex items-center justify-center rounded-lg text-sm dark:text-white/60">7</button>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-white/5 p-5 rounded-2xl shadow-sm border border-[#f0f4f0] dark:border-white/5">
                            <h3 class="text-[#111811] dark:text-white font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">filter_list</span>
                                تصفية النتائج
                            </h3>
                            <div class="flex flex-col gap-4">
                                <div class="p-4 bg-primary/10 rounded-xl border border-primary/20">
                                    <p class="text-sm font-bold text-primary mb-2">الحالة</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 bg-primary text-white text-xs rounded-full">الكل</span>
                                        <span class="px-3 py-1 bg-white dark:bg-white/10 text-xs rounded-full">مكتمل</span>
                                        <span class="px-3 py-1 bg-white dark:bg-white/10 text-xs rounded-full">قادم</span>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input checked class="rounded text-primary focus:ring-primary" type="checkbox" />
                                        <span class="text-sm text-[#111811] dark:text-white/80 group-hover:text-primary">تعليمي (12)</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input checked class="rounded text-primary focus:ring-primary" type="checkbox" />
                                        <span class="text-sm text-[#111811] dark:text-white/80 group-hover:text-primary">ترفيهي (8)</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input class="rounded text-primary focus:ring-primary" type="checkbox" />
                                        <span class="text-sm text-[#111811] dark:text-white/80 group-hover:text-primary">رياضي (5)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <div class="lg:col-span-9 flex flex-col gap-6 order-1 lg:order-2">

                        <div class="bg-white dark:bg-white/5 rounded-2xl shadow-sm border border-[#f0f4f0] dark:border-white/5 overflow-hidden">
                            <div class="flex border-b border-[#f0f4f0] dark:border-white/10">
                                <button class="flex-1 py-4 text-sm font-bold border-b-2 border-primary text-primary transition-all">كل الأنشطة</button>
                                <button class="flex-1 py-4 text-sm font-medium text-[#638863] dark:text-white/60 hover:text-primary transition-all">أنشطة فصلي</button>
                                <button class="flex-1 py-4 text-sm font-medium text-[#638863] dark:text-white/60 hover:text-primary transition-all">المهام المعلقة</button>
                            </div>
                            <div class="flex gap-3 p-5 flex-wrap">
                                <button class="flex h-10 items-center justify-center gap-x-2 rounded-xl bg-primary/10 border border-primary/20 px-5">
                                    <span class="text-primary text-sm font-bold">اليوم</span>
                                    <span class="material-symbols-outlined text-primary text-xl">calendar_today</span>
                                </button>
                                <button class="flex h-10 items-center justify-center gap-x-2 rounded-xl bg-[#f0f4f0] dark:bg-white/10 px-5">
                                    <span class="text-[#111811] dark:text-white text-sm font-medium">مكتمل</span>
                                    <span class="material-symbols-outlined text-[#111811] dark:text-white text-xl">check_circle</span>
                                </button>
                                <button class="flex h-10 items-center justify-center gap-x-2 rounded-xl bg-[#f0f4f0] dark:bg-white/10 px-5">
                                    <span class="text-[#111811] dark:text-white text-sm font-medium">قادم</span>
                                    <span class="material-symbols-outlined text-[#111811] dark:text-white text-xl">schedule</span>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="bg-white dark:bg-white/5 rounded-2xl shadow-md border border-[#f0f4f0] dark:border-white/5 overflow-hidden group hover:shadow-xl transition-all flex flex-col">
                                <div class="relative h-52 overflow-hidden">
                                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKn8b9W32LIsn4kiyYgBOJ7PbRpKy6brO_qJqjgamBLOIntpPwBjr0a7I0As9YYcNhjdL5kOBgwAo3ltXNGAMpf3BVUhSxKZT2L7r4SuD29FFBjY9_TfFwt8rhLJdOQqSbOt7HUJvm75wXemBGCp96fn4wI8Z_HYxBixGg6YlJ-tg0N1tjBvkaEz5bUquL4pdgyjGnrO66J5yT-IK2zM75aUGJnVvnE93FtRLlaX_QjrU-oPnqGMnDYOoQFoGKTp93Ec5D_1iJ51ui" />
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <span class="px-3 py-1 bg-blue-500 text-white text-xs font-bold rounded-full">تعليمي</span>
                                        <span class="px-3 py-1 bg-white/90 text-blue-600 text-xs font-bold rounded-full shadow-sm">09:30 ص</span>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col gap-4">
                                    <h3 class="text-xl font-bold text-[#111811] dark:text-white">وقت الرسم والألوان المائية</h3>
                                    <p class="text-sm text-[#638863] dark:text-white/60 leading-relaxed">نشاط إبداعي يهدف لتطوير المهارات الحركية الدقيقة لدى الأطفال من خلال الرسم الحر والتلوين بالألوان المائية.</p>
                                    <div class="flex items-center gap-4 mt-5 py-4 border-t border-gray-100 dark:border-white/5">
                                        <div class="size-10 rounded-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBn2pZCX_-kl3In62_RYON-tz8a2uXkKSLZHHNCVJI1ZosXBDlp3rqB7h-AzUyG5Tw56M8iNvm3BuGX2Nte7q4CNo4HrCL_Ui4pwW0GBUTk3ra_sHpsXr6Hnwy18ZdD2kyVFaVFp9AZ6p56de_3__yfSHwyJ74yK0SQmpWW14HMqHHWlxYACAzOsguAMi_I8qEiL02v2u5T0krHvPRaHqqjZGTOWZazxGn1cpwHqRM1260gboaZbxY8sMktcrHBxGEtL10lOLFpCVQ0");'></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-[#111811] dark:text-white">المعلمة: سارة الأحمد</p>
                                            <p class="text-xs text-[#638863] dark:text-white/40">فصل العصافير</p>
                                        </div>
                                        <div class="flex -space-x-2 space-x-reverse">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBRp4qlzCn5Eo4UWrxrSU0Jm3pffRWpkYVoHAfYIhQaUAmJWRHGFjf50-1HwNHPJiTERMI7BoI-ytu0MU_Gc9xRupCfuwOoX7Z6-jv--OdYH7UYbtnYj_NwVUVqFKmimLEeGDUDUywMv4cTprlOnM4i8_TjdYVzu62BtR-ZuxOmydhNTx3pXkjsBlhT-w_WsaLPYrqIkYHfl38FIbR919z5vIMujn2BBYzkD_4fkZzBmBxIApclMQAN8lvM5YYUBgvvPaPBVBbk1o68");'></div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCXFoTm_gaELeZnmLuTrJZD2on4ddi3UhmjodtRqsHiOIQo8vE0_M2TXl3C-7fvz0HmdwpX6NZj84Gmpl4jpLy-0hzcBXlO3D8Rhcdc-wlDXEwKoZ-3unDeI7BWGB_g5Cta6W4iEW8MC4HLHWnAxC7sUTNFLSxfrgNjfUzI6U_oYDHqsrV5Lknsps_dhbRdwqIDC-PgmaXO3LFAjEJl9eW5D8gCt3Ye0KYc8b9pJsf5n7QVLq8ZYi3OOFJMva5ee8vTm7zA_LmjO1n6");'></div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-gray-200 dark:bg-white/10 flex items-center justify-center text-xs font-bold">+12</div>
                                        </div>
                                    </div>
                                    <button class="w-full py-3 bg-[#f0f4f0] dark:bg-white/5 text-[#111811] dark:text-white rounded-xl text-sm font-bold hover:bg-primary hover:text-white transition-all">عرض التفاصيل</button>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-white/5 rounded-2xl shadow-md border border-[#f0f4f0] dark:border-white/5 overflow-hidden group hover:shadow-xl transition-all flex flex-col">
                                <div class="relative h-52 overflow-hidden">
                                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAI0-TU73ZMK_OI315MQb1sJaWtG3lTRAd7fYi2Asw8s6D6AM-x6AVt73Vk-VdKgxXHs2Rml9IPl9od8TcAs0gptaxyFcekHWhi1kSov_1yjgIrmIIJdwWQL1tswbt7ZRJc-_Dv7GQnwA0-nyGT2A7Xps-iOVQfzQUXzJIyLU30VwqBllXuBUL84EbBjmYCILLDx0IJcyQOGIK1OIU4KXL7otOTFGyn1192uUlAlkEOLtItv8lqrAFxG7eVko4JmreUUsUkO9We183i" />
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <span class="px-3 py-1 bg-orange-500 text-white text-xs font-bold rounded-full">رياضي</span>
                                        <span class="px-3 py-1 bg-white/90 text-orange-600 text-xs font-bold rounded-full shadow-sm">11:00 ص</span>
                                    </div>
                                    <div class="absolute bottom-4 left-4">
                                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full">مكتمل</span>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col gap-4">
                                    <h3 class="text-xl font-bold text-[#111811] dark:text-white">التمارين الصباحية والألعاب الخارجية</h3>
                                    <p class="text-sm text-[#638863] dark:text-white/60 leading-relaxed">وقت النشاط البدني في الحديقة الخارجية، يتضمن الجري الخفيف وألعاب الكرة الجماعية لتعزيز اللياقة البدنية.</p>
                                    <div class="flex items-center gap-4 mt-5 py-4 border-t border-gray-100 dark:border-white/5">
                                        <div class="size-10 rounded-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBMYEylWVMQKGcPHbZIiJYZ2qgXoOKTQ2HCc1gvBx6VndLf8OyStdB7HlPoJTg_rCDSUTVTwFNCoj5WjRKDlS59iIrrzONlqohRMj5YCvCBHz6yarAkFF3qT-OySEyKG0cWnwdlAvQpdvm6GqqTYPQjYxvy7Isa8xSDlX45p_hS19t1ZL6uOlxEZLmO8WvUSyQHiKkWPm11O96xUZt-vkkSrHNXmKsZ9H0RpuPCBreYW3PmWHRFXnIUlvKzOMwpPlXv0fS8C2V1OxQg");'></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-[#111811] dark:text-white">المعلم: محمد كريم</p>
                                            <p class="text-xs text-[#638863] dark:text-white/40">فصل النجوم</p>
                                        </div>
                                        <div class="flex -space-x-2 space-x-reverse">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD0i5-KaQMJBPu1IXWrJKcFKOcec6hIDzPSNa0UUZRSNZxkuvBz5VZeDZcUyf51iP_1NuwH8a4VoWwEDd_nUYZutE7a44IiIWlA6x6oUTtsoLJn7ZS6gSS42yRNzTGZ_ox3w7uu8-3TqA-Hh8x0pRj0lY4mJ6ciXtxg2me-Tt9rhAyzfmNkjKYtgRGDwe7BVqzLKU5B8HB7N1qcKVyls_J0L0E74euNo0brPXcNpk_C3Hs2jPowDQyh4aWOcJQ5RmRyPb3t7WI-UcFS");'></div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC9jel1OZf1DDcfOyblyc1VaDaflmrJ-eBrgQ15yCT_NILgwjW7r9O1XvYQI9-m_4We5ZOzJltZPcBSOwGBkEdTmWP8XVqSBltUOvbyuxIbuubiiepffvxxPEGvpKo_65cweN7mw2saakHsqFBwrUA-CpjOj5S055iaYtdPHFtl-Lp3sGQte6CGu5tM35JIJosIiRNl5GRaAELsML06la7P3LVu0UM8uog7wN_Ce7m8En0VVpMvQY2bIwrJvNyCZrsQVLO2xqXc7PXk");'></div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-gray-200 dark:bg-white/10 flex items-center justify-center text-xs font-bold">+15</div>
                                        </div>
                                    </div>
                                    <button class="w-full py-3 bg-[#f0f4f0] dark:bg-white/5 text-[#111811] dark:text-white rounded-xl text-sm font-bold hover:bg-primary hover:text-white transition-all">مشاهدة الصور</button>
                                </div>
                            </div>

                            <div class="border-2 border-dashed border-[#dce5dc] dark:border-white/10 rounded-2xl flex flex-col items-center justify-center p-10 gap-5 hover:border-primary/50 hover:bg-primary/5 transition-all group cursor-pointer">
                                <div class="size-20 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-5xl">add</span>
                                </div>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-[#111811] dark:text-white">إضافة نشاط لفترة الظهيرة</p>
                                    <p class="text-sm text-[#638863] dark:text-white/60">لا يوجد نشاط مجدول حالياً بين 12:00 م - 02:00 م</p>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-white/5 rounded-2xl shadow-md border border-[#f0f4f0] dark:border-white/5 overflow-hidden group hover:shadow-xl transition-all flex flex-col">
                                <div class="relative h-52 overflow-hidden">
                                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCpNaWEyUT4Ab02ViyJk1ogjx0I2PXx7_Ux05Dq7uXs2Ijo3lhotpd58CvXV4vJsGFjndibYJUo2L2pKK_VfkiJ2sajo1yBwR3jyc6uWKyJK8bp2Ol31VKh0yNrmGIWuSJii06Obgq5ZFzLlaFsGgsbbGSuNJM67pigrNYZ7f73jKvdPfxqdW4LVtwNRLDpfTwFc1RtSR3S63yOs9pgBlrJ5w7nk7v_7D8yujPzb_xfQWGtWP-joKCZrLlBs1Q9D6y7RKMZ-T-1Wx6V" />
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <span class="px-3 py-1 bg-purple-500 text-white text-xs font-bold rounded-full">ترفيهي</span>
                                        <span class="px-3 py-1 bg-white/90 text-purple-600 text-xs font-bold rounded-full shadow-sm">02:30 م</span>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col gap-4">
                                    <h3 class="text-xl font-bold text-[#111811] dark:text-white">بناء المكعبات والمهارات الذهنية</h3>
                                    <p class="text-sm text-[#638863] dark:text-white/60 leading-relaxed">جلسة بناء تفاعلية باستخدام مكعبات الليغو الكبيرة، تركز على العمل الجماعي وحل المشكلات الهندسية البسيطة.</p>
                                    <div class="flex items-center gap-4 mt-5 py-4 border-t border-gray-100 dark:border-white/5">
                                        <div class="size-10 rounded-full bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDocVa7crKYnvySYfb5gjD8W3wiAHFalWTe4IZiqXY97kOBCxFd13oI0XT1oCRsgTmE8bsMm7uUsgUDUOwj3CKYCpKJl85XlipYJ6rwcls-tECLee45ss4vdvEbGYBhU6Pon9aVsn0duVFgsqudIM-U_ishDKRtqmv8WIostaqOWWEnOBinXGAfe8Z83omSq52SPTWBRQNECtzi4YE2u4FcVtUqM_KAhim-F7TQxd1FBKDmUok53oXFkISYAMfrkT2CgWK6xaBG76WJ");'></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-[#111811] dark:text-white">المعلمة: مريم العلي</p>
                                            <p class="text-xs text-[#638863] dark:text-white/40">فصل الزهور</p>
                                        </div>
                                        <div class="flex -space-x-2 space-x-reverse">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC868zOWkhnEwayzZAtuRXB4H01Q4U2aUKpW8NeTzQ-gb0Np_6jE_aC4PEHsKllXxQG1FOblLwaakwJ3ZjipK9esqiKi3s4LHO6dgMUsNVrzwmprLumSvF2UZI8Mz6qj7_3AagP3oqT6QHQkBBP0g_izHvZ-rNis0biHoz7OFUH3oQafD8ctP3LTR2J_WVV3lpZtxhOfLpzs8ilB_7y9vhsso8cflN_z0cAAsG5OfSb9yEso-l21d8AIbUPCuiu_tg9PrXMLw3oUH0a");'></div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-background-dark bg-gray-200 dark:bg-white/10 flex items-center justify-center text-xs font-bold">+8</div>
                                        </div>
                                    </div>
                                    <button class="w-full py-3 bg-[#f0f4f0] dark:bg-white/5 text-[#111811] dark:text-white rounded-xl text-sm font-bold hover:bg-primary hover:text-white transition-all">عرض التفاصيل</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
        </main>

        <div class="fixed bottom-8 left-8 z-50">
            <button class="flex items-center justify-center size-16 bg-primary text-white rounded-full shadow-2xl shadow-primary/40 hover:scale-110 active:scale-95 transition-all group">
                <span class="material-symbols-outlined text-3xl group-hover:rotate-90 transition-transform">add</span>
            </button>
            <div class="absolute bottom-20 left-0 bg-white dark:bg-background-dark border border-gray-100 dark:border-white/10 p-3 rounded-2xl shadow-xl hidden group-hover:block w-56 animate-in fade-in slide-in-from-bottom-2">
                <ul class="flex flex-col gap-1">
                    <li><button class="w-full text-right px-5 py-3 hover:bg-primary/10 rounded-lg text-sm font-bold text-[#111811] dark:text-white flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">school</span> نشاط تعليمي
                        </button></li>
                    <li><button class="w-full text-right px-5 py-3 hover:bg-primary/10 rounded-lg text-sm font-bold text-[#111811] dark:text-white flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">palette</span> نشاط ترفيهي
                        </button></li>
                    <li><button class="w-full text-right px-5 py-3 hover:bg-primary/10 rounded-lg text-sm font-bold text-[#111811] dark:text-white flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">sports_soccer</span> نشاط رياضي
                        </button></li>
                </ul>
            </div>
        </div>

    </div>
    </div>
</body>

</html>