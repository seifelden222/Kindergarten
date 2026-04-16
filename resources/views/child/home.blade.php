<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الرئيسية - يا بطل!</title>
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
            font-size: 3.2rem;
        }

        body {
            font-family: 'Cairo', sans-serif;
        }

        .nav-icon {
            font-size: 3.5rem;
        }

        /* تكبير الأيقونات في البطاقات */
        .bg-white .material-symbols-outlined,
        .bg-gradient-to-br .material-symbols-outlined {
            font-size: 4rem;
        }

        /* تأثيرات hover للبطاقات */
        .bg-white:hover,
        .bg-gradient-to-br:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(244, 140, 37, 0.3);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#181411] dark:text-white min-h-screen">
    <script src="child-functions.js"></script>

    <!-- Top Navigation Bar -->
    <x-child-navbar />

    <!-- Main Content -->
    <div class="max-w-[1200px] mx-auto px-6 py-12">

        <section class="mb-16">
            <div class="bg-gradient-to-br from-primary/20 to-orange-300/20 dark:from-primary/10 dark:to-orange-900/10 p-2 rounded-[3rem] shadow-2xl">
                <div class="bg-white dark:bg-[#322820] rounded-[2.8rem] p-10 text-center">
                    <h2 class="text-6xl font-bold mb-8 text-primary">جاهز للمغامرة اليوم؟</h2>
                    <p class="text-3xl text-[#8a7560] dark:text-[#cbb8a6] mb-10">اختر نشاطك المفضل وابدأ المتعة الآن!</p>
                    <a href="{{ route('child.activties') }}" class="bg-primary text-white text-3xl font-bold py-8 px-16 rounded-full shadow-2xl hover:scale-105 transition-transform flex items-center gap-6 mx-auto">
                        <span class="material-symbols-outlined text-5xl">rocket_launch</span>
                        ابدأ اليوم!
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <div class="bg-white dark:bg-[#322820] rounded-3xl shadow-xl overflow-hidden border-t-8 border-primary hover:scale-[1.03] transition-transform">
                <div class="h-64 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC76sB_Ju1k3m1JiJTMjhwn5rshqpJ6BRAdfuoZWp7eh75xv_pkSSByadS0KKiXsNMqdiRyRMVc2icsmyZUzZaoJ6wMGlIuGI3GF0SMHsj7gy5UDEnT3ySczl3BC8IlTRqLLRY9ZCMZggV7BOsS10LJk4shq0o_CHnHkApGv8UeraKeTCaJt8JQpGZnXuP6AiUt9THr1PfT51NhdClKLwfvqJdfAoXEaUGpwgA7CyaL2Lti13p0TWhKjY6rUpiGTpBKef98IPjaPVhH");'></div>
                <div class="p-8 text-center">
                    <h3 class="text-4xl font-bold mb-4">الرسم السحري</h3>
                    <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6] mb-6">ارسم عالمك الخاص!</p>
                    <button class="bg-primary/90 text-white text-2xl py-5 px-12 rounded-full hover:bg-primary transition">
                        العب الآن
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-[#322820] rounded-3xl shadow-xl overflow-hidden border-t-8 border-green-500 hover:scale-[1.03] transition-transform">
                <div class="h-64 bg-cover bg-center" style='background-image: url("https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                <div class="p-8 text-center">
                    <h3 class="text-4xl font-bold mb-4">لعبة الحركة</h3>
                    <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6] mb-6">انضم وارقص الآن!</p>
                    <button class="bg-green-500 text-white text-2xl py-5 px-12 rounded-full hover:bg-green-600 transition">
                        ابدأ الحركة
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-[#322820] rounded-3xl shadow-xl overflow-hidden border-t-8 border-purple-500 hover:scale-[1.03] transition-transform">
                <div class="h-64 bg-cover bg-center" style='background-image: url("https://images.unsplash.com/photo-1516978101789-720eacb59e79?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80");'></div>
                <div class="p-8 text-center">
                    <h3 class="text-4xl font-bold mb-4">قصة المغامرة</h3>
                    <p class="text-2xl text-[#8a7560] dark:text-[#cbb8a6] mb-6">اسمع قصة جديدة!</p>
                    <button class="bg-purple-500 text-white text-2xl py-5 px-12 rounded-full hover:bg-purple-600 transition">
                        اسمع الآن
                    </button>
                </div>
            </div>
        </section>

    </div>
    <script src="{{ asset('js/child-functions.js') }}"></script>

</body>

</html>
