<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>الصفحة الرئيسية - نظام إدارة الحضانة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
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

        @keyframes slideDown {
            from {
                transform: translate(-50%, -100%);
                opacity: 0;
            }

            to {
                transform: translate(-50%, 0);
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slideDown 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white transition-colors duration-300">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header
            class="sticky top-0 z-50 w-full border-b border-solid border-[#dce5dc] bg-white/80 dark:bg-background-dark/80 backdrop-blur-md px-4 md:px-20 lg:px-40 py-3">
            <div class="flex items-center justify-between whitespace-nowrap">
                <a href="{{ route('register') }}" class="flex items-center gap-3 text-[#111811] dark:text-white">
                    <img
                        src="{{ asset('img/Kindergarten-logo.jpeg') }}"
                        alt="شعار الحضانة"
                        class="h-12 w-12 shrink-0 rounded-lg object-contain"
                    />

                    <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">نظام إدارة الحضانة</h2>
                </a>
                <nav class="hidden md:flex flex-1 justify-center gap-8">
                    <a class="text-[#111811] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                        href="{{ url('/') }}">الرئيسية</a>

                    <a class="text-[#111811] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                        href="{{ url('contactus') }}">اتصل بنا</a>
                </nav>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}"
                        class="flex min-w-[100px] cursor-pointer items-center justify-center rounded-xl h-10 px-4 bg-primary text-[#111811] text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                        <span class="truncate">بوابة الدخول</span>
                    </a>
                </div>
            </div>
        </header>
        <main class="flex-1">
            <section class="px-4 md:px-20 lg:px-40 py-10 @container">
                <div class="flex flex-col gap-6 py-10 @[864px]:flex-row-reverse items-center">
                    <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl @[864px]:w-1/2 shadow-2xl shadow-primary/10"
                        data-alt="Children playing together in a bright modern classroom environment"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBpBPWg7Q-UkKNW7A76EOM-dCUDizPywwEV2XLAdhN96hoQpIulSshOpQNRYie-QHMHrLAyVAd0cKlt8YsMJnL-3b5HfI9sVkFo2rWp9WN0XeT84PXpMcYaBK1uM2_UDXQODkKdaV7Csd4veuLcxwaV4OgWryKB_NfBUpk0QiM9CMm0Yl4V7z9NUB90f5iuS6cMQMWPGa6sV1d0EMY5SZKkKdYAQbXDYrWOb8I-M8XKOwOV7W48aqOTYgz1k-0tx4iuiyLoYqcu8oSx");'>
                    </div>
                    <div class="flex flex-col gap-6 @[864px]:w-1/2 @[864px]:justify-center text-right">
                        <div class="flex flex-col gap-4">
                            <h1
                                class="text-[#111811] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-6xl">
                                الرائد في إدارة <span class="text-primary">الحضانات الحديثة</span>
                            </h1>
                            <h2
                                class="text-[#111811] dark:text-gray-300 text-lg font-normal leading-relaxed max-w-[500px]">
                                منصة متكاملة تهدف لربط الأهالي والمعلمين والإدارة في بيئة رقمية آمنة تضمن أفضل رعاية
                                وتعليم لأطفالكم.
                            </h2>
                        </div>
                        <div class="flex gap-4">
                            <button
                                class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-14 px-6 bg-primary text-[#111811] text-lg font-bold hover:scale-105 transition-transform">
                                <span class="truncate"><a href="{{ route('login') }}">انضم إلينا الآن</a></span>
                            </button>
                            <button
                                class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-14 px-6 border-2 border-primary text-primary text-lg font-bold hover:bg-primary/10 transition-colors">
                                <a href="{{ route('contactus') }}">تعرف على المزيد</a>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="px-4 md:px-20 lg:px-40 py-10 bg-white dark:bg-background-dark/50">
                <div class="flex flex-wrap gap-6 justify-center">
                    <div
                        class="flex min-w-[200px] flex-1 flex-col items-center gap-2 rounded-xl p-8 border border-[#dce5dc] dark:border-white/10 bg-background-light dark:bg-background-dark">
                        <span class="material-symbols-outlined text-primary text-4xl">emoji_emotions</span>
                        <p class="text-[#111811] dark:text-white text-base font-medium">طفل سعيد</p>
                        <p class="text-primary tracking-light text-4xl font-black"><span class="counter"
                                data-target="500">0</span>+</p>
                    </div>
                    <div
                        class="flex min-w-[200px] flex-1 flex-col items-center gap-2 rounded-xl p-8 border border-[#dce5dc] dark:border-white/10 bg-background-light dark:bg-background-dark">
                        <span class="material-symbols-outlined text-primary text-4xl">school</span>
                        <p class="text-[#111811] dark:text-white text-base font-medium">معلم معتمد</p>
                        <p class="text-primary tracking-light text-4xl font-black"><span class="counter"
                                data-target="40">0</span>+</p>
                    </div>
                    <div
                        class="flex min-w-[200px] flex-1 flex-col items-center gap-2 rounded-xl p-8 border border-[#dce5dc] dark:border-white/10 bg-background-light dark:bg-background-dark">
                        <span class="material-symbols-outlined text-primary text-4xl">verified</span>
                        <p class="text-[#111811] dark:text-white text-base font-medium">سنوات خبرة</p>
                        <p class="text-primary tracking-light text-4xl font-black"><span class="counter"
                                data-target="10">0</span>+</p>
                    </div>
                    <div
                        class="flex min-w-[200px] flex-1 flex-col items-center gap-2 rounded-xl p-8 border border-[#dce5dc] dark:border-white/10 bg-background-light dark:bg-background-dark">
                        <span class="material-symbols-outlined text-primary text-4xl">home_work</span>
                        <p class="text-[#111811] dark:text-white text-base font-medium">فرع حول الجمهورية</p>
                        <p class="text-primary tracking-light text-4xl font-black"><span class="counter"
                                data-target="15">0</span></p>
                    </div>
                </div>
            </section>
            <section class="px-4 md:px-20 lg:px-40 py-20">
                <div class="flex flex-col gap-12 @container">
                    <div class="flex flex-col gap-4 text-center items-center">
                        <h1
                            class="text-[#111811] dark:text-white tracking-light text-[32px] font-bold leading-tight @[480px]:text-4xl @[480px]:font-black">
                            مميزات النظام الذكي
                        </h1>
                        <p class="text-[#638863] dark:text-gray-400 text-lg font-normal max-w-[720px]">
                            نقدم مجموعة من الأدوات المتطورة التي تجعل تجربة التعليم وإدارة الحضانة أكثر سهولة وفعالية
                            لجميع الأطراف.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">متابعة فورية</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">ابق على اتصال دائم
                                    مع طفلك طوال اليوم من خلال تحديثات الأنشطة والوجبات والنمو بشكل لحظي.</p>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">security</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">إدارة آمنة</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">نظام تشفير متطور
                                    يحمي خصوصية بيانات الأطفال وسجلاتهم الطبية والأكاديمية بأعلى المعايير.</p>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">calendar_month</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">جدولة ذكية</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">تنظيم الحصص،
                                    الفعاليات، والمناسبات الخاصة بكل سهولة مع إرسال تنبيهات تلقائية للأهالي.</p>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">payments</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">دفع إلكتروني</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">سهولة سداد الرسوم
                                    الدراسية والاشتراكات عبر بوابات دفع آمنة ومتنوعة مع إصدار فواتير آلية.</p>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">chat_bubble</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">تواصل مباشر</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">نظام مراسلة متكامل
                                    يتيح للأهالي التواصل المباشر مع المعلمين لمناقشة احتياجات أطفالهم.</p>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col gap-4 rounded-xl border border-[#dce5dc] dark:border-white/10 bg-white dark:bg-background-dark/40 p-8 hover:border-primary transition-all shadow-sm hover:shadow-lg">
                            <div
                                class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">monitoring</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h2 class="text-[#111811] dark:text-white text-xl font-bold">تقارير التقييم</h2>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">تحليل بياني لتطور
                                    مستوى الطفل السلوكي والمهاري وتقديمه في تقارير دورية واضحة.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="px-4 md:px-20 lg:px-40 py-20 bg-primary/5">
                <div class="flex flex-col gap-10">
                    <div class="text-center">
                        <h2 class="text-[#111811] dark:text-white text-3xl font-bold mb-4">قالوا عنا</h2>
                        <p class="text-[#638863] dark:text-gray-400">آراء أولياء الأمور الذين وضعوا ثقتهم بنا</p>
                    </div>
                    <div class="flex overflow-x-auto gap-8 pb-8 no-scrollbar">
                        <div
                            class="flex min-w-[320px] max-w-[320px] flex-col gap-6 text-center rounded-2xl bg-white dark:bg-background-dark p-8 shadow-sm">
                            <div class="size-20 bg-center bg-no-repeat bg-cover rounded-full self-center border-4 border-primary/20"
                                data-alt="Portrait of a happy mother"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDROuCgGWYfPSAZwjd1E7ube1cG_qLNyoszq4iwu9Q6zh12vsWEEymGNIe7xvDtF3-RsQdGP4oHz2yLo3MCedE8D6UyqsWwVmcBHCTv_oVEe6EUXTweDcorS1pxeKmNUJ2XuTmsh47L3l0-Oo2eGiVpCGJw5_ciHN9QjLO2edGZ3a8CLAAIaXKjJpYfsqwIVmCo7AlO93e6two-WcMjpeiH8rF5W4wxHoyLWL4TIECoLPxaXpJphjec_1Rb2G39USYRRolifVed1tsJ");'>
                            </div>
                            <div>
                                <p class="text-[#111811] dark:text-white text-lg font-bold">سارة أحمد</p>
                                <div class="flex justify-center text-yellow-400 my-2">
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                </div>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">"نظام رائع سهل علي
                                    التواصل مع المعلمين ومتابعة طفلي خلال اليوم. أشعر بالاطمئنان الدائم بفضله."</p>
                            </div>
                        </div>
                        <div
                            class="flex min-w-[320px] max-w-[320px] flex-col gap-6 text-center rounded-2xl bg-white dark:bg-background-dark p-8 shadow-sm">
                            <div class="size-20 bg-center bg-no-repeat bg-cover rounded-full self-center border-4 border-primary/20"
                                data-alt="Portrait of a smiling father"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAkOJYtfqR0ZU-6yuj0XvVosLc7DuCCJE9FAooZH0fwiHOGCjpMXRy3zmfLZr33gnaBr7hYqXDCXGZEexGycDOJ3loC33Or6qbkMLmXwtWwh9UKAMWCHMVcBBAIN9pd2Fs1aaho-2SX0gHIZN_ScuTsElFXuEQlGd4ozUnnT9B_9td4sfLUIsUXV5jFvfDNrdPPWNUBrwzkoPfrsPRnIbmV6aFLFAOM2JXgIpUCl226E2toaqVItJhmnMlDDUB-x2U514jkxpydCpDR");'>
                            </div>
                            <div>
                                <p class="text-[#111811] dark:text-white text-lg font-bold">محمد علي</p>
                                <div class="flex justify-center text-yellow-400 my-2">
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                </div>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">"أفضل منصة لإدارة
                                    الحضانات استخدمتها على الإطلاق. التنظيم والسهولة في الدفع والتقارير مذهل جداً."</p>
                            </div>
                        </div>
                        <div
                            class="flex min-w-[320px] max-w-[320px] flex-col gap-6 text-center rounded-2xl bg-white dark:bg-background-dark p-8 shadow-sm">
                            <div class="size-20 bg-center bg-no-repeat bg-cover rounded-full self-center border-4 border-primary/20"
                                data-alt="Portrait of a young woman"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAMVlpZy6VjsJNgEdca15H5_2AegW8ks4IsKi_ZfSSG1UJvfhQZ0A6h1io737_uQ1fhJB9W2hTMqgLPk5kVkzjdX3qWt2x-QDj7p2BLeG8Ud3k6XrGG7XQGZW_l0LddcicrqEMYqBvJKZx8UWHDRaTJ6m_LsQmnIMVCCfKVz2PK791_WQETa4dvb7cf7OopLw2rY3Q7JwtCP3Kn6-KoaZVq8S_7OL785XOE0_87FDE566Lndd_GPAT2O8rahuXD9Fw3POTGeTeJYkIh");'>
                            </div>
                            <div>
                                <p class="text-[#111811] dark:text-white text-lg font-bold">ليلى حسن</p>
                                <div class="flex justify-center text-yellow-400 my-2">
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined fill-1">star</span>
                                    <span class="material-symbols-outlined">star_half</span>
                                </div>
                                <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">"شكراً لكم على هذا
                                    التنظيم والاحترافية. ابني أصبح يحب الحضانة أكثر بفضل التفاعل الذي نراه عبر المنصة."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer
            class="bg-white dark:bg-background-dark border-t border-[#dce5dc] dark:border-white/10 px-4 md:px-20 lg:px-40 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-right">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-2">
                        <div class="size-6 bg-primary rounded-md flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-sm">child_care</span>
                        </div>
                        <h3 class="text-xl font-bold dark:text-white">إدارة الحضانة</h3>
                    </div>
                    <p class="text-[#638863] dark:text-gray-400 text-sm leading-relaxed">
                        نهدف إلى تغيير مستقبل التعليم المبكر من خلال حلول تقنية مبتكرة تضع مصلحة الطفل وأمنه في المقام
                        الأول.
                    </p>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-lg font-bold dark:text-white">روابط سريعة</h4>
                    <nav class="flex flex-col gap-2">
                        <a class="text-[#638863] dark:text-gray-400 hover:text-primary text-sm transition-colors"
                            href="{{ url('/') }}">الرئيسية</a>
                        <a class="text-[#638863] dark:text-gray-400 hover:text-primary text-sm transition-colors"
                            href="{{ url('contactus') }}">تواصل معنا</a>

                    </nav>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-lg font-bold dark:text-white">تواصل معنا</h4>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
                            <span class="material-symbols-outlined text-sm text-primary">mail</span>
                            <a href="mailto:info@nursery.edu.eg"
                                class="hover:text-primary transition-colors">info@nursery.edu.eg</a>
                        </div>
                        <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
                            <span class="material-symbols-outlined text-sm text-primary">call</span>
                            <a href="tel:+201012345678" class="hover:text-primary transition-colors">+201012345678</a>
                        </div>
                        <div class="flex items-center gap-2 text-[#638863] dark:text-gray-400 text-sm">
                            <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                            <button onclick="showMapPopup()"
                                class="hover:text-primary transition-colors cursor-pointer">القاهرة، مصر</button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-lg font-bold dark:text-white">النشرة البريدية</h4>
                    <p class="text-[#638863] dark:text-gray-400 text-sm">اشترك لتصلك أحدث نصائح تربية الأطفال</p>
                    <form id="newsletterForm" class="flex gap-2" onsubmit="subscribeNewsletter(event)">
                        <input id="newsletterEmail"
                            class="flex-1 rounded-xl border-[#dce5dc] dark:border-white/20 dark:bg-background-dark/50 p-2 text-sm focus:border-primary focus:ring-primary"
                            placeholder="البريد الإلكتروني" type="email" required />
                        <button type="submit"
                            class="bg-primary text-[#111811] rounded-xl px-4 py-2 font-bold hover:opacity-90">اشترك</button>
                    </form>
                </div>
            </div>
            <div
                class="mt-12 pt-8 border-t border-[#dce5dc] dark:border-white/10 text-center text-[#638863] dark:text-gray-400 text-sm">
                <p>© 2026 نظام إدارة الحضانة الذكي. جميع الحقوق محفوظة.</p>
            </div>
        </footer>
    </div>

    <!-- Toast Notification -->
    <div id="toast"
        class="hidden fixed top-20 left-1/2 transform -translate-x-1/2 bg-white dark:bg-background-dark border-2 border-primary rounded-xl shadow-2xl px-6 py-4 z-[110] min-w-[300px] animate-slide-down">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-3xl">check_circle</span>
            <div>
                <p class="text-[#111811] dark:text-white font-bold">تم الاشتراك بنجاح!</p>
                <p class="text-[#638863] dark:text-gray-400 text-sm">شكراً لاشتراكك في نشرتنا البريدية</p>
            </div>
        </div>
    </div>

    <!-- Map Popup Modal -->
    <div id="mapPopup"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4"
        onclick="closeMapPopup(event)">
        <div class="bg-white dark:bg-background-dark rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden"
            onclick="event.stopPropagation()">
            <div class="flex items-center justify-between p-6 border-b border-[#dce5dc] dark:border-white/10">
                <h3 class="text-2xl font-bold text-[#111811] dark:text-white">موقعنا - القاهرة، مصر</h3>
                <button onclick="closeMapPopup()" class="text-[#638863] hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            <div class="p-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456840.3974978924!2d28.684273!3d26.820553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2z2KzZhdmH2YjYsdmK2Kkg2YXYtdixINin2YTYudix2KjZitip!5e0!3m2!1sar!2seg!4v1234567890123!5m2!1sar!2seg"
                    width="100%" height="450" style="border:0; border-radius: 1rem;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="shadow-lg">
                </iframe>
            </div>
            <div class="p-6 bg-background-light dark:bg-background-dark/50 flex flex-col gap-3">
                <div class="flex items-center gap-3 text-[#111811] dark:text-white">
                    <span class="material-symbols-outlined text-primary">call</span>
                    <a href="tel:+201012345678" class="hover:text-primary transition-colors">+201012345678</a>
                </div>
                <div class="flex items-center gap-3 text-[#111811] dark:text-white">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    <a href="mailto:info@nursery.edu.eg"
                        class="hover:text-primary transition-colors">info@nursery.edu.eg</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show map popup
        function showMapPopup() {
            const popup = document.getElementById('mapPopup');
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close map popup
        function closeMapPopup(event) {
            if (!event || event.target.id === 'mapPopup') {
                const popup = document.getElementById('mapPopup');
                popup.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Close popup with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMapPopup();
            }
        });

        // Newsletter subscription with toast
        function subscribeNewsletter(event) {
            event.preventDefault();
            const emailInput = document.getElementById('newsletterEmail');
            const email = emailInput.value;

            if (email) {
                // Show toast notification
                showToast();

                // Clear input
                emailInput.value = '';

                // Here you can add code to send email to backend
                console.log('Subscribed email:', email);
            }
        }

        // Show toast notification
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');

            // Auto hide after 3 seconds
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60 FPS
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            };

            updateCounter();
        }

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    animateCounter(entry.target);
                }
            });
        }, observerOptions);

        // Observe all counter elements
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => observer.observe(counter));
        });
    </script>
</body>

</html>
