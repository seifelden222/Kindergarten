<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الجداول الدراسية - نظام إدارة الحضانة</title>
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
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav { background-color: #0ea60e; color: white !important; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-admin-slider />

        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4">
                <h2 class="text-xl font-bold">الجداول الدراسية</h2>
            </header>

            <div class="p-8 space-y-6">
                <form method="GET" action="{{ route('admin.tables') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <input name="q" value="{{ $search }}" type="text" placeholder="ابحث في المواد أو المعلمين" class="rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />

                    <select name="semester" class="rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                        <option value="">كل الفصول الدراسية</option>
                        @foreach ($semesters as $item)
                            <option value="{{ $item }}" @selected($semester === $item)>{{ $item }}</option>
                        @endforeach
                    </select>

                    <select name="group" class="rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                        <option value="">كل المجموعات</option>
                        @foreach ($groups as $item)
                            <option value="{{ $item }}" @selected($group === $item)>{{ $item }}</option>
                        @endforeach
                    </select>


                </form>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">جدول {{ $group ?: 'كل المجموعات' }}</h4>
                        <span class="text-sm text-zinc-500">{{ $semester ?: 'كل الفصول الدراسية' }}</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse min-w-[900px]">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-24">اليوم</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الفترة الصباحية</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الفترة الثانية</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">بعد الظهر</th>
                                    <th class="px-4 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">النشاط اليومي</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @forelse ($schedules as $row)
                                    <tr>
                                        <td class="px-6 py-5 font-medium bg-zinc-50/50 dark:bg-zinc-800/30">{{ $row->day_name }}</td>
                                        <td class="px-4 py-5">
                                            <span>{{ $row->morning_subject }}</span><br>
                                            <span class="text-xs text-zinc-500">{{ $row->morning_teacher }}</span>
                                        </td>
                                        <td class="px-4 py-5">
                                            <span>{{ $row->second_subject }}</span><br>
                                            <span class="text-xs text-zinc-500">{{ $row->second_teacher }}</span>
                                        </td>
                                        <td class="px-4 py-5 bg-green-50/40 dark:bg-green-950/20">{{ $row->afternoon_period }}</td>
                                        <td class="px-4 py-5">
                                            <span>{{ $row->daily_activity }}</span><br>
                                            <span class="text-xs text-zinc-500">{{ $row->activity_location }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-zinc-500">لا توجد بيانات جدول دراسي مطابقة.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
