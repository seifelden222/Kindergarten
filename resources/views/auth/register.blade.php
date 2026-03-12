<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>إنشاء حساب جديد - نظام إدارة الحضانة</title>
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
    </style>
</head>
<body class="flex min-h-screen flex-col bg-[#f6f8f6]">
    <header class="sticky top-0 z-50 flex items-center justify-between border border-b-[#dce5dc] bg-white px-6 py-3 md:px-40">
        <div class="flex items-center gap-4 text-[#111811]">
            <div class="flex size-8 items-center justify-center rounded-lg bg-[#0ea60e] text-white">
                <span class="material-symbols-outlined">child_care</span>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-[#111811]">نظام إدارة الحضانة</h2>
        </div>

        <div class="flex flex-1 justify-end gap-8">
            <div class="hidden items-center gap-9 md:flex">
                <a class="text-sm font-medium leading-normal text-[#111811] transition-colors hover:text-[#0ea60e]" href="{{ url('/') }}">الرئيسية</a>
                <a class="text-sm font-medium leading-normal text-[#111811] transition-colors hover:text-[#0ea60e]" href="#">اتصل بنا</a>
            </div>
        </div>
    </header>

    <main class="flex flex-1 items-center justify-center p-4 md:p-10">
        <div class="grid w-full max-w-[1100px] grid-cols-1 overflow-hidden rounded-xl bg-white shadow-2xl lg:grid-cols-2">
            <div class="relative hidden flex-col justify-center overflow-hidden bg-[#eef7ee] p-12 lg:flex">
                <div class="relative z-10">
                    <h1 class="mb-6 text-4xl leading-tight font-black text-[#111811]">ابدأ رحلة طفلك <br /><span class="text-[#0ea60e]">التعليمية معنا</span></h1>
                    <p class="mb-8 max-w-md text-lg text-[#4a5f4a]">نحن هنا لنوفر بيئة آمنة ومحفزة لنمو طفلك. سجل الآن لتكون جزءاً من مجتمعنا التعليمي المتميز.</p>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-full bg-white p-2 text-[#0ea60e] shadow-sm">verified_user</span>
                            <span class="font-medium text-[#111811]">بيئة تعليمية آمنة وموثوقة</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-full bg-white p-2 text-[#0ea60e] shadow-sm">group</span>
                            <span class="font-medium text-[#111811]">تواصل مباشر بين المعلمين وأولياء الأمور</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-full bg-white p-2 text-[#0ea60e] shadow-sm">monitoring</span>
                            <span class="font-medium text-[#111811]">متابعة دقيقة لتقدم الطفل اليومي</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-10 -right-10 h-64 w-64 rounded-full bg-[#0ea60e]/10 blur-3xl"></div>
                <div class="absolute -left-10 top-10 h-48 w-48 rounded-full bg-[#0ea60e]/20 blur-2xl"></div>
                <div class="mt-12 h-48 w-full rotate-2 rounded-xl border-4 border-white bg-cover bg-center shadow-lg" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCX5KEokA-DQpnNpV13bOvM1EXwf_isUsMn7Z484UaU6aBUGbsBG2HYHoeXWdGsAmnd-3AchEO6tf0fnGSC0aafv6ZIo3_s4F6Gz62KRIJHaL8Ih_zoQlSnICprylI6Fh0Zh_7n2WBdR57gF4d5w8Ph1boZk4S4njJoL73Ews975f1ToIOkXs2loJoQObFiEAlclfPB80lR_2P70kfuowD3f0qjVZWprUb3ATTWmO-XGVa_KjGtQt9tw6t_NjuT7zZ55cOzHuMsBDkr')"></div>
            </div>

            <div class="p-8 md:p-12">
                <div class="mb-8">
                    <h2 class="mb-2 text-3xl font-black text-[#111811]">إنشاء حساب جديد</h2>
                    <p class="text-[#638863]">انضم إلينا اليوم، العملية لن تستغرق أكثر من دقيقة.</p>
                </div>

                <x-auth-session-status class="mb-4 rounded-xl border border-[#dce5dc] bg-[#f6f8f6] px-4 py-3 text-sm text-[#638863]" :status="session('status')" />

                <form class="space-y-5" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-[#111811]">نوع الحساب</p>
                        <div class="flex h-12 w-full items-center justify-center rounded-xl bg-[#f0f4f0] p-1">
                            <label class="flex h-full grow cursor-pointer items-center justify-center overflow-hidden rounded-lg px-2 text-sm font-bold text-[#638863] transition-all has-[:checked]:bg-white has-[:checked]:text-[#0ea60e] has-[:checked]:shadow-md">
                                <span class="flex items-center gap-2 truncate">
                                    <span class="material-symbols-outlined text-lg">family_restroom</span>
                                    ولي أمر
                                </span>
                                <input @checked(old('role', 'guardian') === 'guardian') class="hidden" name="role" type="radio" value="guardian" />
                            </label>
                            <label class="flex h-full grow cursor-pointer items-center justify-center overflow-hidden rounded-lg px-2 text-sm font-bold text-[#638863] transition-all has-[:checked]:bg-white has-[:checked]:text-[#0ea60e] has-[:checked]:shadow-md">
                                <span class="flex items-center gap-2 truncate">
                                    <span class="material-symbols-outlined text-lg">school</span>
                                    معلم
                                </span>
                                <input @checked(old('role') === 'teacher') class="hidden" name="role" type="radio" value="teacher" />
                            </label>
                            <label class="flex h-full grow cursor-pointer items-center justify-center overflow-hidden rounded-lg px-2 text-sm font-bold text-[#638863] transition-all has-[:checked]:bg-white has-[:checked]:text-[#0ea60e] has-[:checked]:shadow-md">
                                <span class="flex items-center gap-2 truncate">
                                    <span class="material-symbols-outlined text-lg">face</span>
                                    طفل
                                </span>
                                <input @checked(old('role') === 'child') class="hidden" name="role" type="radio" value="child" />
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-1 text-sm font-semibold text-[#111811]">الاسم الكامل</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#638863]">person</span>
                            <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-3 pr-12 pl-4 text-[#111811] outline-none transition-all placeholder:text-gray-400 focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="name" name="name" placeholder="أدخل اسمك الثلاثي" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="text-sm text-red-600" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-semibold text-[#111811]">البريد الإلكتروني</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#638863]">mail</span>
                                <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-3 pr-12 pl-4 text-[#111811] outline-none transition-all focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="email" name="email" placeholder="example@mail.com" type="email" value="{{ old('email') }}" required autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="text-sm text-red-600" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-semibold text-[#111811]">رقم الهاتف</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#638863]">call</span>
                                <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-3 pr-12 pl-4 text-[#111811] outline-none transition-all focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="phone" name="phone" placeholder="01XXXXXXXX" type="tel" value="{{ old('phone') }}" autocomplete="tel" />
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="text-sm text-red-600" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#111811]">كلمة المرور</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#638863]">lock</span>
                            <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-3 pr-12 pl-12 text-[#111811] outline-none transition-all placeholder:text-gray-400 focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="password" name="password" placeholder="••••••••" type="password" required autocomplete="new-password" />
                            <button class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 cursor-pointer text-[#638863] hover:text-[#0ea60e]" type="button" data-toggle-password="password">visibility</button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="text-sm text-red-600" />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#111811]">تأكيد كلمة المرور</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#638863]">lock</span>
                            <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-3 pr-12 pl-12 text-[#111811] outline-none transition-all placeholder:text-gray-400 focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" required autocomplete="new-password" />
                            <button class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 cursor-pointer text-[#638863] hover:text-[#0ea60e]" type="button" data-toggle-password="password_confirmation">visibility</button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-red-600" />
                    </div>

                    <label class="group flex cursor-pointer items-center gap-3">
                        <input class="h-5 w-5 cursor-pointer rounded border-[#dce5dc] text-[#0ea60e] focus:ring-[#0ea60e]" type="checkbox" required />
                        <span class="text-sm text-[#4a5f4a]">أوافق على <a class="font-bold text-[#0ea60e] hover:underline" href="#">الشروط والأحكام</a> وسياسة الخصوصية.</span>
                    </label>

                    <button class="mt-4 flex h-14 w-full items-center justify-center gap-2 rounded-xl bg-[#0ea60e] text-lg font-black text-[#111811] shadow-lg shadow-[#0ea60e]/20 transition-all hover:scale-[1.01] active:scale-95" type="submit">
                        إنشاء الحساب
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-[#638863]">
                            لديك حساب بالفعل؟
                            <a class="px-1 font-bold text-[#0ea60e] hover:underline" href="{{ route('login') }}">تسجيل الدخول</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-[#638863]">
        <p>© 2026 نظام إدارة الحضانة. جميع الحقوق محفوظة.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-toggle-password]').forEach(function (toggleButton) {
                toggleButton.addEventListener('click', function () {
                    const input = document.getElementById(toggleButton.dataset.togglePassword);

                    if (!input) {
                        return;
                    }

                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    toggleButton.textContent = isPassword ? 'visibility_off' : 'visibility';
                });
            });
        });
    </script>
</body>
</html>
