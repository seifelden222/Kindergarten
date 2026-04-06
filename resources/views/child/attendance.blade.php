<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>سجل حضوري الجميل</title>
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
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;
        }

        /* تكبير الأيقونات */
        .text-5xl .material-symbols-outlined,
        .text-6xl .material-symbols-outlined {
            font-size: 5rem;
        }

        /* تأثيرات hover للبطاقات */
        .hover\\:scale-105:hover {
            transform: scale(1.08);
            box-shadow: 0 20px 40px rgba(244, 140, 37, 0.3);
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen">
    <script src="child-functions.js"></script>
    <!-- Top Navigation Bar -->
    <x-child-navbar />

    <div class="px-4 lg:px-40 flex justify-center">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="@container">
                <div class="@[480px]:py-3">
                    <div class="bg-cover bg-center flex flex-col justify-center items-center overflow-hidden bg-white @[480px]:rounded-xl min-h-[260px] relative shadow-lg" style='background-image: linear-gradient(135deg, rgba(244,140,37,0.9) 0%, rgba(255,210,150,0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqCMDR69dBI9jAp6dr3Y9tjur_KJz77IghhoXE1tcsCXPOcKatVAruQ98SzemuUfHWSssCOCSse1jcJl-4U0PrK__3qkOXxhwA7MyRyeZJM84NVHaYVCfkq37pw7hIpegcqBMowXdo3-t2NbtCQ2Br-5MiepV_5xqGHgo3kVn_fcOSXfc419FsGMyr-LCm1ER_4JgWb4g_iC6mAhWrJzpAnFkzw49V1fReekWMGlTEyPEdBNzENQ7MOA49T6hzMAqE8PqEkz5e8k_E");'>
                        <div class="flex flex-col items-center gap-4 p-6 text-center">
                            <span class="material-symbols-outlined text-white text-7xl drop-shadow-md">celebration</span>
                            <p class="text-white tracking-light text-[32px] md:text-[42px] font-black leading-tight drop-shadow-sm">ممتاز! لقد كنت معنا اليوم</p>
                            <div class="bg-white/30 backdrop-blur-md px-6 py-2 rounded-full border border-white/40">
                                <p class="text-white text-lg font-bold">نحن سعيدون جداً برؤيتك يا بطل!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 lg:px-40 flex justify-center py-2">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex items-center justify-between px-4 pb-3 pt-6">
                <button id="attendance-next-month" class="bg-white dark:bg-zinc-800 p-3 rounded-full shadow-md text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl">arrow_forward</span>
                </button>
                <h1 id="attendance-month-title" class="text-[#111811] dark:text-white tracking-light text-[36px] font-black leading-tight text-center">شهر أكتوبر 2026</h1>
                <button id="attendance-prev-month" class="bg-white dark:bg-zinc-800 p-3 rounded-full shadow-md text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl">arrow_back</span>
                </button>
            </div>
        </div>
    </div>
    <div class="px-4 lg:px-40 flex justify-center">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="pb-3 overflow-x-auto">
                <div class="flex border-b border-[#dce5dc] dark:border-zinc-700 px-4 gap-4 md:gap-8 min-w-max justify-center">
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">السبت</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-primary text-primary pb-[13px] pt-4">
                        <p class="text-sm font-black">الأحد</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">الاثنين</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">الثلاثاء</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">الأربعاء</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">الخميس</p>
                    </div>
                    <div class="flex flex-col items-center justify-center border-b-[4px] border-b-transparent text-[#8a7560] pb-[13px] pt-4 opacity-60">
                        <p class="text-sm font-black">الجمعة</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 lg:px-40 flex justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex justify-center gap-8 mb-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-3xl">light_mode</span>
                    <span class="text-sm font-bold dark:text-white">حاضر (شمس مبتسمة)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-indigo-400 text-3xl">bedtime</span>
                    <span class="text-sm font-bold dark:text-white">غائب (قمر نائم)</span>
                </div>
            </div>
            <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-7 gap-4 p-4">
                <div class="flex flex-col items-center gap-3 p-4 bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border-2 border-primary/20 hover:scale-105 transition-transform">
                    <div class="w-full flex justify-center text-primary">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">light_mode</span>
                    </div>
                    <div class="text-center">
                        <p class="text-primary text-xl font-black">1</p>
                        <p class="text-[#8a7560] dark:text-zinc-400 text-xs font-bold">حاضر</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border-2 border-primary/20 hover:scale-105 transition-transform">
                    <div class="w-full flex justify-center text-primary">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">light_mode</span>
                    </div>
                    <div class="text-center">
                        <p class="text-primary text-xl font-black">2</p>
                        <p class="text-[#8a7560] dark:text-zinc-400 text-xs font-bold">حاضر</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl shadow-sm border-2 border-indigo-200 dark:border-indigo-800 hover:scale-105 transition-transform">
                    <div class="w-full flex justify-center text-indigo-400">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">bedtime</span>
                    </div>
                    <div class="text-center">
                        <p class="text-indigo-600 dark:text-indigo-400 text-xl font-black">3</p>
                        <p class="text-indigo-400 text-xs font-bold">غائب</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border-2 border-primary/20 hover:scale-105 transition-transform">
                    <div class="w-full flex justify-center text-primary">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">light_mode</span>
                    </div>
                    <div class="text-center">
                        <p class="text-primary text-xl font-black">4</p>
                        <p class="text-[#8a7560] dark:text-zinc-400 text-xs font-bold">حاضر</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border-2 border-primary/20 hover:scale-105 transition-transform border-4 border-primary">
                    <div class="w-full flex justify-center text-primary relative">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">light_mode</span>
                        <div id="attendance-today-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">اليوم!</div>
                    </div>
                    <div class="text-center">
                        <p class="text-primary text-xl font-black">5</p>
                        <p class="text-[#8a7560] dark:text-zinc-400 text-xs font-bold">حاضر</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-zinc-100/50 dark:bg-zinc-800/50 rounded-2xl border-2 border-dashed border-zinc-300 dark:border-zinc-700 opacity-40">
                    <div class="w-full flex justify-center text-zinc-400">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">help</span>
                    </div>
                    <div class="text-center">
                        <p class="text-zinc-400 text-xl font-black">6</p>
                        <p class="text-zinc-400 text-xs font-bold">قريباً</p>
                    </div>
                </div>
                <div class="flex flex-col items-center gap-3 p-4 bg-zinc-100/50 dark:bg-zinc-800/50 rounded-2xl border-2 border-dashed border-zinc-300 dark:border-zinc-700 opacity-40">
                    <div class="w-full flex justify-center text-zinc-400">
                        <span class="material-symbols-outlined text-5xl md:text-6xl">help</span>
                    </div>
                    <div class="text-center">
                        <p class="text-zinc-400 text-xl font-black">7</p>
                        <p class="text-zinc-400 text-xs font-bold">قريباً</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 lg:px-40 flex justify-center py-10">
        <div class="layout-content-container flex flex-col max-w-[960px] flex-1 text-center">
            <div class="bg-primary/10 border-2 border-primary/20 p-8 rounded-3xl">
                <div class="flex justify-center mb-4">
                    <span class="material-symbols-outlined text-primary text-6xl">stars</span>
                </div>
                <h3 class="text-2xl font-black text-[#111811] dark:text-white mb-2">يا لك من رائع!</h3>
                <p class="text-lg text-[#8a7560] dark:text-zinc-400">لقد جمعت 14 شمساً مشرقة هذا الشهر. استمر في التألق!</p>
                <button type="button" onclick="window.location.href='{{ route('child.home') }}'" class="mt-6 bg-primary hover:bg-primary/90 text-white font-black py-4 px-10 rounded-full text-xl shadow-lg transition-transform hover:scale-105">
                    نراك غداً!
                </button>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const title = document.getElementById('attendance-month-title');
            const nextMonthButton = document.getElementById('attendance-next-month');
            const prevMonthButton = document.getElementById('attendance-prev-month');

            let currentDate = new Date();

            function renderMonthTitle() {
                if (!title) {
                    return;
                }

                const monthText = currentDate.toLocaleDateString('ar-EG', {
                    month: 'long',
                    year: 'numeric'
                });

                title.textContent = `شهر ${monthText}`;
            }

            function syncTodayBadge() {
                const todayBadge = document.getElementById('attendance-today-badge');

                if (!todayBadge) {
                    return;
                }

                const dayCards = Array.from(document.querySelectorAll('div.grid > div'));

                dayCards.forEach((card) => {
                    card.classList.remove('border-4', 'border-primary');
                });

                const todayDay = String(new Date().getDate());
                const matchingCard = dayCards.find((card) => {
                    const dayNumberElement = card.querySelector('p.text-primary.text-xl.font-black, p.text-indigo-600.dark\\:text-indigo-400.text-xl.font-black, p.text-zinc-400.text-xl.font-black');

                    if (!dayNumberElement) {
                        return false;
                    }

                    return dayNumberElement.textContent.trim() === todayDay;
                });

                if (!matchingCard) {
                    todayBadge.classList.add('hidden');
                    return;
                }

                const iconWrapper = matchingCard.querySelector('.w-full.flex.justify-center');

                if (!iconWrapper) {
                    todayBadge.classList.add('hidden');
                    return;
                }

                matchingCard.classList.add('border-4', 'border-primary');
                iconWrapper.classList.add('relative');
                iconWrapper.appendChild(todayBadge);
                todayBadge.classList.remove('hidden');
            }

            if (nextMonthButton) {
                nextMonthButton.addEventListener('click', function () {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderMonthTitle();
                    syncTodayBadge();
                });
            }

            if (prevMonthButton) {
                prevMonthButton.addEventListener('click', function () {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    renderMonthTitle();
                    syncTodayBadge();
                });
            }

            renderMonthTitle();
            syncTodayBadge();
        });
    </script>
    <script src="{{ asset('js/child-functions.js') }}"></script>

</body>

</html>
