<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الأنشطة - نظام إدارة الحضانة</title>
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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-parent-sidebar active-page="activities" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8">
                <header class="flex flex-wrap justify-between items-center gap-6 mb-10">
                    <h2 class="text-3xl font-black tracking-tight">الأنشطة</h2>

                </header>

                @php
                    $children = auth()->user()?->children()->where('role', 'child')
                        ->with(['activities' => fn($q) => $q->latest()->take(5)])
                        ->get() ?? collect();
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 mb-12">
                    @forelse($children as $child)
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <h3 class="font-bold text-lg">{{ $child->name }}</h3>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">الأسبوع الحالي</span>
                        </div>
                        <div class="divide-y divide-[#dce5dc] dark:divide-[#2d402d]">
                            @forelse($child->activities as $activity)
                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">{{ $activity->name }}</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">
                                            {{ $activity->activity_date?->translatedFormat('l j F') ?? '' }}
                                            {{ $activity->activity_time ? '• ' . $activity->activity_time : '' }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                                </div>
                                @if($activity->description)
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">{{ $activity->description }}</p>
                                @endif
                                @if($activity->image_path)
                                    <div class="mt-3">
                                        <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $activity->image_path) }}')"></div>
                                    </div>
                                @endif
                            </div>
                            @empty
                            <div class="p-8 text-center text-[#638863]">
                                <span class="material-symbols-outlined text-3xl block mb-2">auto_stories</span>
                                <p class="text-sm">لا توجد أنشطة مسجلة بعد.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-16 text-center text-[#638863]">
                        <span class="material-symbols-outlined text-5xl block mb-3">child_care</span>
                        <p class="text-lg font-bold">لا يوجد أطفال مسجلون بعد.</p>
                        <p class="text-sm mt-1">يمكنك إضافة طفل من لوحة التحكم.</p>
                    </div>
                    @endforelse
                </div>



            </div>
        </main>
    </div>

    <script src="{{ asset('js/parent-functions.js') }}"></script>
</body>

</html>
