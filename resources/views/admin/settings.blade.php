<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إعدادات النظام - نظام إدارة الحضانة</title>
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

        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4">
                <h2 class="text-xl font-bold">إعدادات النظام</h2>
            </header>

            <div class="p-8">
                <div class="max-w-3xl space-y-6">
                    @if (session('status'))
                        <div class="rounded-xl bg-green-100 text-green-800 px-4 py-3 text-sm">{{ session('status') }}</div>
                    @endif

                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm p-6">
                        <h3 class="text-lg font-bold mb-5">بيانات الحساب</h3>

                        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm mb-1">الاسم الكامل</label>
                                    <input name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm mb-1">رقم الجوال</label>
                                    <input name="phone" type="text" value="{{ old('phone', $user->phone) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm mb-1">البريد الإلكتروني</label>
                                <input name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm mb-1">العنوان</label>
                                <input name="address" type="text" value="{{ old('address', $user->address) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="border-t border-zinc-200 dark:border-zinc-700 pt-5 space-y-4">
                                <h4 class="font-semibold">تغيير كلمة المرور (اختياري)</h4>

                                <div>
                                    <label class="block text-sm mb-1">كلمة المرور الحالية</label>
                                    <input name="current_password" type="password" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                    @error('current_password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm mb-1">كلمة المرور الجديدة</label>
                                        <input name="new_password" type="password" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                        @error('new_password')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm mb-1">تأكيد كلمة المرور</label>
                                        <input name="new_password_confirmation" type="password" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:brightness-110 transition-colors">
                                حفظ التغييرات
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
