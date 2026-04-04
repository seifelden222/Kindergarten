<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>صفحة تسجيل الدخول - نظام إدارة الحضانة</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .nursery-pattern {
            background-color: #f6f8f6;
            background-image: radial-gradient(#0ea60e 0.5px, transparent 0.5px), radial-gradient(#0ea60e 0.5px, #f6f8f6 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="flex min-h-screen flex-col bg-[#f6f8f6] text-[#111811]">
    <header class="sticky top-0 z-50 flex items-center justify-between border-b border-[#dce5dc] bg-white/90 px-6 py-3 backdrop-blur-sm lg:px-40">
        <a href="{{ route('register') }}" class="flex items-center gap-4 text-[#111811]">
            <div class="flex size-8 items-center justify-center rounded-lg bg-[#0ea60e] text-white">
                <span class="material-symbols-outlined">child_care</span>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">نظام إدارة الحضانة</h2>
        </a>

        <div class="flex flex-1 justify-end gap-8">
            <div class="hidden items-center gap-9 md:flex">
                <a class="text-sm font-medium leading-normal text-[#111811] transition-colors hover:text-[#0ea60e]" href="{{ url('/') }}">الرئيسية</a>
                <a class="text-sm font-medium leading-normal text-[#111811] transition-colors hover:text-[#0ea60e]" href="{{ url('contactus') }}">اتصل بنا</a>
            </div>
        </div>
    </header>

    <main class="relative flex flex-grow items-center justify-center overflow-hidden px-4 py-12">
        <div class="nursery-pattern pointer-events-none absolute inset-0"></div>
        <div class="pointer-events-none absolute -left-24 -top-24 h-96 w-96 rounded-full bg-[#0ea60e]/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-[#0ea60e]/10 blur-3xl"></div>

        <div class="relative grid w-full max-w-[960px] grid-cols-1 overflow-hidden rounded-[28px] bg-white shadow-2xl lg:grid-cols-2">
            <div class="flex flex-col justify-center p-8 md:p-12">
                <div class="mb-8">
                    <h1 class="pb-2 text-[32px] font-bold leading-tight tracking-tight text-[#111811]">مرحباً بك مجدداً</h1>
                    <p class="text-base font-normal leading-normal text-[#638863]">سجّل دخولك ببياناتك، وسيتم توجيهك تلقائيًا إلى البوابة المناسبة حسب نوع الحساب.</p>
                </div>

                <div class="mb-8 rounded-2xl border border-[#dce5dc] bg-[#f6fbf6] px-4 py-4 text-sm text-[#4a5f4a]">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined rounded-full bg-white p-2 text-[#0ea60e] shadow-sm">account_circle</span>
                        <div class="space-y-1">
                            <p class="font-bold text-[#111811]">دخول موحد</p>
                            <p>لا تحتاج لاختيار ولي أمر أو معلم أو طفل قبل تسجيل الدخول، فالنظام يتعرف على الحساب تلقائيًا.</p>
                        </div>
                    </div>
                </div>

                <x-auth-session-status class="mb-4 rounded-xl border border-[#dce5dc] bg-[#f6f8f6] px-4 py-3 text-sm text-[#638863]" :status="session('status')" />

                <form class="space-y-4" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-col">
                        <p class="pb-2 text-sm font-medium leading-normal text-[#111811]">البريد الإلكتروني</p>
                        <div class="group flex w-full items-stretch rounded-xl">
                            <div class="flex items-center justify-center rounded-r-xl border border-l-0 border-[#dce5dc] bg-white pr-4 text-[#638863] transition-colors group-focus-within:border-[#0ea60e]">
                                <span class="material-symbols-outlined text-[20px]">mail</span>
                            </div>
                            <input class="form-input h-14 w-full flex-1 rounded-l-xl rounded-r-none border border-r-0 border-[#dce5dc] bg-white p-[15px] text-base font-normal leading-normal text-[#111811] placeholder:text-[#638863] focus:border-[#0ea60e] focus:outline-0 focus:ring-0" id="email" name="email" placeholder="user@example.com" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex flex-col">
                        <div class="flex items-center justify-between pb-2">
                            <p class="text-sm font-medium leading-normal text-[#111811]">كلمة المرور</p>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-[#0ea60e] hover:underline" href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                            @endif
                        </div>
                        <div class="group flex w-full items-stretch rounded-xl">
                            <div class="flex items-center justify-center rounded-r-xl border border-l-0 border-[#dce5dc] bg-white pr-4 text-[#638863] transition-colors group-focus-within:border-[#0ea60e]">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </div>
                            <input class="form-input h-14 w-full flex-1 rounded-none border border-r-0 border-[#dce5dc] bg-white p-[15px] text-base font-normal leading-normal text-[#111811] placeholder:text-[#638863] focus:border-[#0ea60e] focus:outline-0 focus:ring-0" id="password" name="password" placeholder="••••••••" type="password" required autocomplete="current-password" />
                            <button class="flex cursor-pointer items-center justify-center rounded-l-xl border border-r-0 border-[#dce5dc] bg-white pl-4 text-[#638863] transition-colors group-focus-within:border-[#0ea60e]" type="button" data-toggle-password>
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <label class="mt-2 inline-flex items-center gap-3 text-sm text-[#638863]">
                        <input id="remember" type="checkbox" class="rounded border-[#dce5dc] text-[#0ea60e] shadow-sm focus:ring-[#0ea60e]" name="remember">
                        <span>تذكرني</span>
                    </label>

                    <button class="mt-6 flex h-14 w-full cursor-pointer items-center justify-center overflow-hidden rounded-xl bg-[#0ea60e] text-base font-bold leading-normal tracking-[0.015em] text-[#111811] shadow-lg shadow-[#0ea60e]/20 transition-all hover:bg-[#0c940c]" type="submit">
                        تسجيل الدخول
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-[#638863]">
                        ليس لديك حساب؟
                        <a class="font-bold text-[#0ea60e] hover:underline" href="{{ route('register') }}">أنشئ حساباً جديداً الآن</a>
                    </p>
                </div>
            </div>

            <div class="relative hidden flex-col items-center justify-center overflow-hidden bg-[#f0f9f0] p-12 lg:flex">
                <div class="z-10 text-center">
                    <div class="mb-6 inline-flex rounded-full bg-white p-4 shadow-xl">
                        <span class="material-symbols-outlined text-[64px] text-[#0ea60e]">school</span>
                    </div>
                    <h2 class="mb-4 text-3xl font-bold text-[#111811]">نحن نهتم بمستقبل أطفالكم</h2>
                    <p class="mx-auto max-w-md leading-relaxed text-[#638863]">
                        انضم إلى مجتمعنا التعليمي المتميز وتابع تطور طفلك خطوة بخطوة من خلال منصتنا الذكية.
                    </p>
                </div>

                <div class="absolute right-10 top-10 h-24 w-24 rounded-full border-4 border-white bg-[#0ea60e]/20"></div>
                <div class="absolute bottom-10 left-10 h-32 w-32 rotate-12 rounded-lg border-4 border-white bg-yellow-400/20"></div>
                <div class="absolute left-4 top-1/2 h-16 w-16 rounded-full border-4 border-white bg-blue-400/20"></div>

                <div class="mt-12 grid w-full max-w-xs grid-cols-2 gap-4">
                    <div class="rounded-xl bg-white/50 p-4 text-center backdrop-blur-md">
                        <span class="material-symbols-outlined mb-2 block text-[#0ea60e]">trending_up</span>
                        <span class="text-xs font-bold">تتبع التقدم</span>
                    </div>
                    <div class="rounded-xl bg-white/50 p-4 text-center backdrop-blur-md">
                        <span class="material-symbols-outlined mb-2 block text-[#0ea60e]">forum</span>
                        <span class="text-xs font-bold">تواصل مباشر</span>
                    </div>
                </div>

                <img alt="Nursery environment" class="pointer-events-none absolute bottom-0 left-0 h-full w-full object-cover opacity-10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlBBx5qgTKB6MfN3CCpN2x5HGIEVOXZsFblS7SV9v6TSBxIcMkRazJbAHSFF94C69FWYODaH0abcDg2xVs9reHHAZrqKXZwHBjlHMH_y2tgm6BBv1aghVn_lJig7HXNDOxVoyACltMW41IRLLa_3G80NsoN0du0m-7FGUAeTV2M8KmzC6kULSO603qIk-cgeOOz8beGg9IBfpK9f9FDP3Z2YRTTlU3tMrOnKRCBBH7XCxv2YAR-z5HQUrMbNOcWRLcdo78yF8hb4Yl" />
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-[#638863]">
        <p>© 2026 نظام إدارة الحضانة الذكي. جميع الحقوق محفوظة.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.querySelector('[data-toggle-password]');
            const passwordInput = document.getElementById('password');

            if (toggleButton && passwordInput) {
                toggleButton.addEventListener('click', function () {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    toggleButton.querySelector('span').textContent = isPassword ? 'visibility_off' : 'visibility';
                });
            }
        });
    </script>
</body>
</html>
