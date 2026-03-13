<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>صفحة أنشطتي الممتعة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f48c25",
                        "background-light": "#f8f7f5",
                        "background-dark": "#221910",
                    },
                    fontFamily: {
                        "display": ["Cairo", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1.5rem",
                        "lg": "2.5rem",
                        "xl": "4rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;
            font-size: 2.5rem;
        }

        body {
            font-family: 'Cairo', sans-serif;
        }

        /* تكبير الأيقونات في البطاقات */
        .bg-white .material-symbols-outlined {
            font-size: 5rem;
        }

        /* تأثيرات hover للبطاقات */
        .group:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 25px 50px rgba(244, 140, 37, 0.4);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#181411] dark:text-white min-h-screen">
    <script src="child-functions.js"></script>
    <x-child-navbar />

    <div class="max-w-[1200px] mx-auto px-6 py-8">

        <section class="bg-white dark:bg-[#322820] p-8 rounded-xl shadow-sm mb-12 border-b-8 border-primary/10">
            <div class="flex flex-col gap-6">
                <div class="flex justify-between items-end">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">map</span>
                        <h2 class="text-2xl font-bold">رحلتي اليومية</h2>
                    </div>
                    <p class="text-3xl font-bold text-primary">65%</p>
                </div>
                <div class="w-full bg-[#e6e0db] dark:bg-[#4a3d31] h-8 rounded-full overflow-hidden p-1">
                    <div class="h-full bg-primary rounded-full relative shadow-inner" style="width: 65%;">
                        <div class="absolute right-0 top-0 h-full w-8 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-sm">rocket_launch</span>
                        </div>
                    </div>
                </div>
                <p class="text-lg font-medium text-[#8a7560] dark:text-[#cbb8a6] text-center">شارفت على الانتهاء! أنت مبدع جداً</p>
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-3xl font-bold mb-6 px-4">أنا أفعل الآن...</h2>
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-l from-orange-400 to-primary p-1 shadow-2xl">
                <div class="bg-white dark:bg-background-dark rounded-[2.8rem] p-8 flex flex-col md:flex-row items-center gap-10">
                    <div class="w-full md:w-1/2 aspect-video rounded-lg overflow-hidden bg-cover bg-center shadow-lg border-4 border-white dark:border-[#322820]" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC76sB_Ju1k3m1JiJTMjhwn5rshqpJ6BRAdfuoZWp7eh75xv_pkSSByadS0KKiXsNMqdiRyRMVc2icsmyZUzZaoJ6wMGlIuGI3GF0SMHsj7gy5UDEnT3ySczl3BC8IlTRqLLRY9ZCMZggV7BOsS10LJk4shq0o_CHnHkApGv8UeraKeTCaJt8JQpGZnXuP6AiUt9THr1PfT51NhdClKLwfvqJdfAoXEaUGpwgA7CyaL2Lti13p0TWhKjY6rUpiGTpBKef98IPjaPVhH");'>
                    </div>
                    <div class="w-full md:w-1/2 text-center md:text-right flex flex-col items-center md:items-start gap-4">
                        <span class="bg-primary/20 text-primary px-6 py-2 rounded-full font-bold text-lg">النشاط الحالي</span>
                        <h3 class="text-5xl font-bold">وقت الرسم الحر</h3>
                        <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6]">استخدم الألوان لتعبر عن خيالك الرائع!</p>
                        <button class="mt-4 bg-primary text-white text-2xl font-bold py-6 px-12 rounded-full shadow-xl hover:scale-105 transition-transform flex items-center gap-4">
                            <span class="material-symbols-outlined text-4xl">play_circle</span>
                            ابدأ الآن
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="flex justify-between items-center mb-8 px-4">
                <h2 class="text-3xl font-bold">جدول يومي الممتع</h2>
                <div class="flex gap-2">
                    <button class="bg-white dark:bg-[#322820] p-3 rounded-full shadow border border-gray-100 dark:border-gray-800">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                    <button class="bg-white dark:bg-[#322820] p-3 rounded-full shadow border border-gray-100 dark:border-gray-800">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group flex flex-col bg-white dark:bg-[#322820] rounded-lg shadow-lg hover:shadow-2xl transition-all cursor-pointer border-t-8 border-green-400">
                    <div class="p-6 flex flex-col items-center text-center gap-4">
                        <div class="w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined text-green-500 text-5xl">palette</span>
                        </div>
                        <h4 class="text-2xl font-bold">وقت الفنون</h4>
                        <div class="bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 px-4 py-1 rounded-full text-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            مكتمل
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-[#3d3126] rounded-b-lg flex justify-center">
                        <span class="material-symbols-outlined text-yellow-500">star</span>
                        <span class="material-symbols-outlined text-yellow-500">star</span>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-[#322820] rounded-lg shadow-lg hover:shadow-2xl transition-all cursor-pointer border-t-8 border-blue-400">
                    <div class="p-6 flex flex-col items-center text-center gap-4">
                        <div class="w-24 h-24 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined text-blue-500 text-5xl">sports_soccer</span>
                        </div>
                        <h4 class="text-2xl font-bold">وقت الرياضة</h4>
                        <div class="bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 px-4 py-1 rounded-full text-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            9:00 صباحاً
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-[#3d3126] rounded-b-lg flex justify-center">
                        <span class="text-[#8a7560] font-medium">قريباً</span>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-[#322820] rounded-lg shadow-lg hover:shadow-2xl transition-all cursor-pointer border-t-8 border-red-400">
                    <div class="p-6 flex flex-col items-center text-center gap-4">
                        <div class="w-24 h-24 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined text-red-500 text-5xl">restaurant</span>
                        </div>
                        <h4 class="text-2xl font-bold">وجبة الغداء</h4>
                        <div class="bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 px-4 py-1 rounded-full text-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">restaurant_menu</span>
                            12:30 ظهراً
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-[#3d3126] rounded-b-lg flex justify-center">
                        <span class="text-[#8a7560] font-medium">وقت الطعام!</span>
                    </div>
                </div>
                <div class="group flex flex-col bg-white dark:bg-[#322820] rounded-lg shadow-lg hover:shadow-2xl transition-all cursor-pointer border-t-8 border-purple-400">
                    <div class="p-6 flex flex-col items-center text-center gap-4">
                        <div class="w-24 h-24 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined text-purple-500 text-5xl">menu_book</span>
                        </div>
                        <h4 class="text-2xl font-bold">وقت القصص</h4>
                        <div class="bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300 px-4 py-1 rounded-full text-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">auto_stories</span>
                            2:00 ظهراً
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-[#3d3126] rounded-b-lg flex justify-center">
                        <span class="text-[#8a7560] font-medium">حكايات ممتعة</span>
                    </div>
                </div>
            </div>
        </section>
        <div class="fixed bottom-10 left-10">
            <button class="bg-primary text-white p-8 rounded-full shadow-2xl hover:scale-110 transition-transform flex items-center gap-3">
                <span class="material-symbols-outlined text-4xl">home</span>
                <a href="home.html"><span class="text-2xl font-bold ml-2">الرئيسية</span></a>
            </button>
        </div>
    </div>
    <script src="{{ asset('js/child-functions.js') }}"></script>

</body>

</html>