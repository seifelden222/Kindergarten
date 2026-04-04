<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إدارة المستخدمين - نظام إدارة الحضانة</title>
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
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-6 flex-1">
                    <h2 class="text-xl font-bold">إدارة المستخدمين</h2>
                    <form method="GET" action="{{ route('admin.users') }}" class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input name="q" value="{{ $search }}" class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="ابحث بالاسم أو الإيميل أو الهاتف..." type="text" />
                    </form>
                </div>
            </header>

            <div class="p-8 space-y-6">
                @if (session('status'))
                    <div class="rounded-xl bg-green-100 text-green-800 px-4 py-3 text-sm">{{ session('status') }}</div>
                @endif

                @if (session('error'))
                    <div class="rounded-xl bg-red-100 text-red-800 px-4 py-3 text-sm">{{ session('error') }}</div>
                @endif

                @if ($editingUser)
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm p-6">
                        <h3 class="text-lg font-bold mb-4">تعديل المستخدم: {{ $editingUser->name }}</h3>
                        <form method="POST" action="{{ route('admin.users.update', ['user' => $editingUser, 'q' => $search]) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="block text-sm mb-1">الاسم</label>
                                <input name="name" type="text" value="{{ old('name', $editingUser->name) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm mb-1">البريد الإلكتروني</label>
                                <input name="email" type="email" value="{{ old('email', $editingUser->email) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm mb-1">رقم الجوال</label>
                                <input name="phone" type="text" value="{{ old('phone', $editingUser->phone) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm mb-1">النوع</label>
                                <select name="role" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                    @foreach (['admin', 'doctor', 'specialist', 'teacher', 'guardian', 'child'] as $role)
                                        <option value="{{ $role }}" @selected(old('role', $editingUser->role) === $role)>{{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm mb-1">الحالة</label>
                                <select name="status" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                    <option value="active" @selected(old('status', $editingUser->email_verified_at ? 'active' : 'unverified') === 'active')>نشط</option>
                                    <option value="unverified" @selected(old('status', $editingUser->email_verified_at ? 'active' : 'unverified') === 'unverified')>غير موثق</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm mb-1">العنوان</label>
                                <input name="address" type="text" value="{{ old('address', $editingUser->address) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2 flex items-center gap-3">
                                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-white">حفظ التعديلات</button>
                                <a href="{{ route('admin.users', array_filter(['q' => $search])) }}" class="px-5 py-2.5 rounded-xl bg-zinc-200 text-zinc-700">إلغاء</a>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الاسم</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النوع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">البريد الإلكتروني</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">رقم الجوال</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">تاريخ التسجيل</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الحالة</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @forelse ($users as $listedUser)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium">{{ $listedUser->name }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300">{{ $listedUser->role }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ $listedUser->email }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ $listedUser->phone ?: '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ optional($listedUser->registration_date)->format('Y-m-d') ?: optional($listedUser->created_at)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4">
                                            @if ($listedUser->email_verified_at)
                                                <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700">نشط</span>
                                            @else
                                                <span class="px-2 py-1 text-[10px] font-bold rounded-full bg-yellow-100 text-yellow-700">غير موثق</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                                            <a class="text-primary hover:underline ml-2" href="{{ route('admin.users', array_filter(['q' => $search, 'edit' => $listedUser->id])) }}">تعديل</a>
                                            <form method="POST" action="{{ route('admin.users.destroy', ['user' => $listedUser, 'q' => $search]) }}" class="inline" onsubmit="return confirm('متأكد من حذف المستخدم؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 hover:underline" type="submit">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-zinc-500">لا يوجد مستخدمون مطابقون للبحث.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
