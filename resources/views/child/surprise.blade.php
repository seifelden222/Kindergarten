<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>صندوق مفاجآتي</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f4c025",
                        "background-light": "#f8f8f5",
                        "background-dark": "#221e10",
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
            font-size: 48px;
        }

        body {
            font-family: 'Cairo', sans-serif;
        }

        .gift-card:hover {
            transform: scale(1.05) rotate(2deg);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* تكبير الأيقونات في البطاقات */
        .size-32 .material-symbols-outlined {
            font-size: 5rem;
        }

        /* تأثيرات إضافية */
        .gift-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gift-card:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen">
    <script src="child-functions.js"></script>
    <div class="layout-container flex h-full grow flex-col">
        <!-- Top Navigation Bar -->
        <x-child-navbar />
        <main class="flex-1 overflow-y-auto pb-10">
            <div class="px-6 md:px-40 py-8">
                <div class="layout-content-container flex flex-col max-w-[960px] mx-auto text-center">
                    <h1 class="text-[#181611] dark:text-white tracking-light text-[40px] font-bold leading-tight pb-3">
                        مرحباً بك يا بطل! 🎁
                    </h1>
                    <p class="text-[#8a8060] dark:text-gray-400 text-lg">انقر على الصناديق لتكتشف مفاجآت اليوم</p>
                </div>
            </div>
            <div class="px-6 md:px-40 py-5">
                <div class="layout-content-container flex flex-col max-w-[960px] mx-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 p-4">
                        <div onclick="openGiftBox('وسام')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-primary transition-all">
                            <div class="absolute -top-4 -right-4 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold shadow-md animate-bounce">
                                جديد! ✨
                            </div>
                            <div class="size-32 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-primary" style="font-size: 64px;">emoji_events</span>
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">وسام جديد!</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">أنت طفل مبدع اليوم</p>
                        </div>
                        <div onclick="openGiftBox('رسالة')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-blue-400 transition-all">
                            <div class="size-32 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-blue-500" style="font-size: 64px;">face_6</span>
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">رسالة المعلمة</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">اضغط لتعرف ماذا قالت لك</p>
                        </div>
                        <div onclick="openGiftBox('صورة')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-green-400 transition-all">
                            <div class="size-32 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-green-500" style="font-size: 64px;">palette</span>
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">صورة النشاط</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">انظر إلى رسمتك الجميلة</p>
                        </div>
                        <div onclick="openGiftBox('وجبة')" class="gift-card cursor-pointer group relative flex flex-col items-center justify-center bg-white dark:bg-background-dark p-8 rounded-xl shadow-xl border-b-8 border-orange-400 transition-all">
                            <div class="size-32 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-orange-500" style="font-size: 64px;">restaurant</span>
                            </div>
                            <h3 class="text-[#181611] dark:text-white text-2xl font-bold mb-2">وقت الوجبة</h3>
                            <p class="text-[#8a8060] dark:text-gray-400 text-center">وجبتك الشهية جاهزة الآن</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 md:px-40 pt-10">
                <div class="layout-content-container flex flex-col max-w-[960px] mx-auto">
                    <h2 class="text-[#181611] dark:text-white text-2xl font-bold px-4 pb-6">ذكريات الأسبوع الماضي 🎈</h2>
                    <div class="flex overflow-x-auto gap-6 p-4 scrollbar-hide">
                        <div class="flex-none w-64 bg-white dark:bg-background-dark rounded-lg overflow-hidden shadow-md">
                            <div class="h-48 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBtQM3MI3V5zqX9j8smdtcyovdLFMR-mznr9b7rVXiNEVVVCzQpOLQP1oW_h2ryFHn41QMmssKNdXQuAscQfI-I3PPrDLM5BSePP1UjjunHe6Il-cW3SbpLgVIJFfb_JjhTV5GthwS67lqJR01GFQHHndQhpJ5LIbVX4ee9nIThGC1YKzn5kkpr_swj0M01lcGvH4PaT9AE8agNlTUqSUOkbtctPeIgXl9WYNlQubwuNXVgZwVCmTleINCLHvQAkLaomIw9R6ivQG-R");'>
                            </div>
                            <div class="p-4">
                                <p class="text-[#181611] dark:text-white font-bold">لعبنا معاً</p>
                                <p class="text-sm text-[#8a8060]">الأحد</p>
                            </div>
                        </div>
                        <div class="flex-none w-64 bg-white dark:bg-background-dark rounded-lg overflow-hidden shadow-md">
                            <div class="h-48 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuArOZsU3UWjMxVhkYZj4M4P-lmC3WhzExSoxTx4GHPGy1V90oOGnHcPL3FLDFNiu4GDc97UObCAhWay9GcZVhS9_-xHBDITJcbV9D0eztOm1eMB67kmsqopVQK0_IfKla0uaLwZoX6eaIEp8HiHPIelW0q0vnLlZvi5WEu8mntKLAav7OXFd1fz4BBMgjosFPwrV4552UYqNBcDR9dNe14lw0XobzIthrnYUKq1s4CdBi-X1oUo7sf2jNuOkGDquGW0kXVgTEG3IqqZ");'>
                            </div>
                            <div class="p-4">
                                <p class="text-[#181611] dark:text-white font-bold">يوم الألوان</p>
                                <p class="text-sm text-[#8a8060]">الاثنين</p>
                            </div>
                        </div>
                        <div class="flex-none w-64 bg-white dark:bg-background-dark rounded-lg overflow-hidden shadow-md">
                            <div class="h-48 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDBg3H1XWdasDGREqsB4E8xAzzVZHCvV7_mxVbbHt3Tr1bZp8rHmEqEQdhQ8xah3V7akGR_RuK60G7ZaUA6uo8TArpK2ZVnmIMFLRjSHPL8R5mXZynFUtoUgY0cBgGEUpg7sbGM0aAmV5ToG32ar6Vf64HL81SWYPax-0TK-r4zH7qRgObr7yW70C7n5YHzffjG9iFsVFzBiV2MI8kSleU8Q3SwiXcNKDnChj6pMFvNahVeTucP8vT_vV7EVwcD0I80cXfTilXzxTyB");'>
                            </div>
                            <div class="p-4">
                                <p class="text-[#181611] dark:text-white font-bold">غداء صحي</p>
                                <p class="text-sm text-[#8a8060]">الثلاثاء</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="fixed bottom-8 left-8">
            <button class="size-20 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
                <a href="{{ route('child.home') }}"><span class="material-symbols-outlined" style="font-size: 40px;">home</span></a>
            </button>
        </div>
    </div>
    <script src="{{ asset('js/child-functions.js') }}"></script>
</body>

</html>
