<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>استعادة كلمة المرور - نظام إدارة الحضانة</title>
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
    <header class="sticky top-0 z-50 flex items-center justify-between border border-[#dce5dc] bg-white px-6 py-3 md:px-40">
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
        <div class="grid w-full max-w-[960px] grid-cols-1 overflow-hidden rounded-xl bg-white shadow-2xl lg:grid-cols-2">
            <div class="relative hidden flex-col justify-center overflow-hidden bg-[#eef7ee] p-12 lg:flex">
                <div class="relative z-10 text-center">
                    <div class="mb-8 inline-flex rounded-full bg-white p-6 shadow-xl">
                        <span class="material-symbols-outlined text-[72px] text-[#0ea60e]">lock_reset</span>
                    </div>
                    <h1 class="mb-6 text-4xl font-black text-[#111811]">استعادة كلمة المرور</h1>
                    <p class="mx-auto max-w-md text-lg text-[#4a5f4a]">لا تقلق، يمكننا مساعدتك في استعادة الوصول إلى حسابك بسرعة وأمان.</p>
                    <div class="mt-10 flex flex-col gap-6">
                        <div class="flex items-center justify-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-[#0ea60e]">mail</span>
                            <p class="font-medium text-[#111811]">سنرسل رابط إعادة تعيين إلى بريدك الإلكتروني</p>
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <span class="material-symbols-outlined text-3xl text-[#0ea60e]">security</span>
                            <p class="font-medium text-[#111811]">عملية آمنة ومشفرة بالكامل</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-10 -right-10 h-64 w-64 rounded-full bg-[#0ea60e]/10 blur-3xl"></div>
                <div class="absolute -left-10 top-10 h-48 w-48 rounded-full bg-[#0ea60e]/20 blur-2xl"></div>
            </div>

            <div class="flex flex-col justify-center p-8 md:p-12">
                <div class="mb-10 text-center lg:text-right">
                    <h2 class="mb-3 text-3xl font-black text-[#111811]">نسيت كلمة المرور؟</h2>
                    <p class="text-lg text-[#638863]">أدخل بريدك الإلكتروني وسيتم إرسال رابط إعادة تعيين كلمة المرور إليك.</p>
                </div>

                <x-auth-session-status class="mb-4 rounded-xl border border-[#dce5dc] bg-[#f6f8f6] px-4 py-3 text-sm text-[#638863]" :status="session('status')" />

                <form class="space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#111811]">البريد الإلكتروني</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-xl text-[#638863]">mail</span>
                            <input class="w-full rounded-xl border border-[#dce5dc] bg-white px-4 py-4 pr-14 pl-4 text-base text-[#111811] outline-none transition-all placeholder:text-gray-400 focus:border-[#0ea60e] focus:ring-1 focus:ring-[#0ea60e]" id="email" name="email" placeholder="example@mail.com" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="text-sm text-red-600" />
                    </div>

                    <button class="mt-4 h-14 w-full rounded-xl bg-[#0ea60e] text-lg font-black text-[#111811] shadow-lg shadow-[#0ea60e]/20 transition-all hover:scale-[1.01] active:scale-95" type="submit">
                        إرسال رابط إعادة التعيين
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-[#638863]">
                        تذكرت كلمة المرور؟
                        <a class="px-1 font-bold text-[#0ea60e] hover:underline" href="{{ route('login') }}">عودة لتسجيل الدخول</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-[#dce5dc] py-6 text-center text-sm text-[#638863]">
        <p>© 2026 نظام إدارة الحضانة. جميع الحقوق محفوظة.</p>
    </footer>
</body>
</html>
