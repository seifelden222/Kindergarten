<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الفصول - نظام إدارة الحضانة</title>
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
    @php
        $formLevel = $editingLevel;
        $isEditing = $formLevel !== null;
        $statusLabels = [
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ];
    @endphp

    <div class="flex h-screen">

        <x-teacher-sidebar active="levels" />

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-y-auto py-8 px-6 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-8">

                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex min-w-72 flex-col gap-2">
                            <h1 class="text-4xl font-black leading-tight tracking-tight">الفصول</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">إدارة جميع فصول الحضانة</p>
                        </div>
                        <a href="{{ route('teacher.levels.index', ['create' => 1]) }}#level-form" class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-sm hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined ml-2 text-xl">add</span>
                            إضافة فصل جديد
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="rounded-2xl border border-primary/20 bg-primary/10 px-5 py-4 text-sm font-semibold text-primary">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                            <p class="mb-2 font-bold">يرجى مراجعة البيانات التالية:</p>
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($showCreateForm || $isEditing)
                        <section id="level-form" class="rounded-[2rem] border border-[#dce5dc] bg-white p-6 shadow-sm dark:border-[#2a3a2a] dark:bg-[#1a2a1a]">
                            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-2xl font-black">{{ $isEditing ? 'تعديل بيانات الفصل' : 'إضافة فصل جديد' }}</h2>
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">
                                        {{ $isEditing ? 'حدّث بيانات الفصل ثم احفظ التغييرات.' : 'أدخل بيانات الفصل ليظهر مباشرة في القائمة.' }}
                                    </p>
                                </div>
                                <a href="{{ route('teacher.levels.index') }}" class="rounded-xl bg-[#f0f4f0] px-4 py-2 text-sm font-bold text-[#638863] transition hover:bg-[#e4ece4] dark:bg-[#2a3a2a] dark:text-[#a0b0a0]">
                                    إلغاء
                                </a>
                            </div>

                            <form method="POST" action="{{ $isEditing ? route('teacher.levels.update', $formLevel) : route('teacher.levels.store') }}" class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                @csrf
                                @if ($isEditing)
                                    @method('PUT')
                                @endif

                                <input type="hidden" name="_form" value="{{ $isEditing ? 'edit' : 'create' }}">

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-bold">اسم الفصل</span>
                                    <input type="text" name="name" value="{{ old('name', $formLevel?->name) }}" class="rounded-xl border border-[#dce5dc] bg-[#f8fbf8] px-4 py-3 text-sm focus:border-primary focus:ring-primary dark:border-[#2a3a2a] dark:bg-[#112111]" placeholder="مثال: فصل البراعم" required>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-bold">عدد الأطفال</span>
                                    <input type="number" name="children_count" min="0" max="99" value="{{ old('children_count', $formLevel?->children_count ?? 0) }}" class="rounded-xl border border-[#dce5dc] bg-[#f8fbf8] px-4 py-3 text-sm focus:border-primary focus:ring-primary dark:border-[#2a3a2a] dark:bg-[#112111]" required>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-bold">الحالة</span>
                                    <select name="status" class="rounded-xl border border-[#dce5dc] bg-[#f8fbf8] px-4 py-3 text-sm focus:border-primary focus:ring-primary dark:border-[#2a3a2a] dark:bg-[#112111]" required>
                                        <option value="active" @selected(old('status', $formLevel?->status ?? 'active') === 'active')>نشط</option>
                                        <option value="inactive" @selected(old('status', $formLevel?->status) === 'inactive')>غير نشط</option>
                                    </select>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-bold">لون البطاقة</span>
                                    <div class="flex items-center gap-3 rounded-xl border border-[#dce5dc] bg-[#f8fbf8] px-4 py-3 dark:border-[#2a3a2a] dark:bg-[#112111]">
                                        <input type="color" name="accent_color" value="{{ old('accent_color', $formLevel?->accent_color ?? '#0ea60e') }}" class="h-10 w-16 cursor-pointer rounded border-none bg-transparent p-0">
                                        <span class="text-sm text-[#638863] dark:text-[#a0b0a0]">{{ old('accent_color', $formLevel?->accent_color ?? '#0ea60e') }}</span>
                                    </div>
                                </label>

                                <label class="flex flex-col gap-2 md:col-span-2">
                                    <span class="text-sm font-bold">ملاحظات</span>
                                    <textarea name="notes" rows="4" class="rounded-xl border border-[#dce5dc] bg-[#f8fbf8] px-4 py-3 text-sm focus:border-primary focus:ring-primary dark:border-[#2a3a2a] dark:bg-[#112111]" placeholder="أي ملاحظات إضافية عن الفصل">{{ old('notes', $formLevel?->notes) }}</textarea>
                                </label>

                                <div class="md:col-span-2 flex flex-wrap gap-3">
                                    <button type="submit" class="rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white transition hover:brightness-105">
                                        {{ $isEditing ? 'حفظ التعديلات' : 'إنشاء الفصل' }}
                                    </button>
                                    <a href="{{ route('teacher.levels.index') }}" class="rounded-xl bg-[#f0f4f0] px-6 py-3 text-sm font-bold text-[#638863] transition hover:bg-[#e4ece4] dark:bg-[#2a3a2a] dark:text-[#a0b0a0]">
                                        رجوع
                                    </a>
                                </div>
                            </form>
                        </section>
                    @endif

                    @if ($selectedLevel)
                        <section id="level-details" class="rounded-[2rem] border border-[#dce5dc] bg-white p-6 shadow-sm dark:border-[#2a3a2a] dark:bg-[#1a2a1a]">
                            <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <span class="size-5 rounded-full" style="background-color: {{ $selectedLevel->accent_color }}"></span>
                                    <div>
                                        <h2 class="text-2xl font-black">{{ $selectedLevel->name }}</h2>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">تفاصيل الفصل المحدد</p>
                                    </div>
                                </div>
                                <a href="{{ route('teacher.levels.index') }}" class="rounded-xl bg-[#f0f4f0] px-4 py-2 text-sm font-bold text-[#638863] transition hover:bg-[#e4ece4] dark:bg-[#2a3a2a] dark:text-[#a0b0a0]">
                                    إغلاق التفاصيل
                                </a>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div class="rounded-2xl bg-[#f8fbf8] p-4 dark:bg-[#112111]">
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">الحالة</p>
                                    <p class="mt-2 text-lg font-bold">{{ $statusLabels[$selectedLevel->status] ?? $selectedLevel->status }}</p>
                                </div>
                                <div class="rounded-2xl bg-[#f8fbf8] p-4 dark:bg-[#112111]">
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">عدد الأطفال</p>
                                    <p class="mt-2 text-lg font-bold">{{ $selectedLevel->children_count }}</p>
                                </div>
                                <div class="rounded-2xl bg-[#f8fbf8] p-4 dark:bg-[#112111]">
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة</p>
                                    <p class="mt-2 text-lg font-bold">{{ $selectedLevel->user->name }}</p>
                                </div>
                            </div>

                            <div class="mt-4 rounded-2xl bg-[#f8fbf8] p-4 dark:bg-[#112111]">
                                <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">ملاحظات</p>
                                <p class="mt-2 leading-7">{{ $selectedLevel->notes ?: 'لا توجد ملاحظات مضافة لهذا الفصل حتى الآن.' }}</p>
                            </div>
                        </section>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($levels as $level)
                            <div class="overflow-hidden rounded-xl border border-[#dce5dc] bg-white shadow-sm transition-shadow hover:shadow-md dark:border-[#2a3a2a] dark:bg-[#1a2a1a]">
                                <div class="h-3" style="background-color: {{ $level->accent_color }}"></div>
                                <div class="p-6">
                                    <div class="mb-4 flex items-center justify-between gap-3">
                                        <h3 class="text-xl font-bold">{{ $level->name }}</h3>
                                        <span class="font-medium {{ $level->status === 'active' ? 'text-primary' : 'text-amber-600 dark:text-amber-400' }}">
                                            {{ $statusLabels[$level->status] ?? $level->status }}
                                        </span>
                                    </div>
                                    <div class="mb-6 grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">عدد الأطفال</p>
                                            <p class="text-2xl font-bold">{{ $level->children_count }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة</p>
                                            <p class="text-lg font-medium">{{ $level->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('teacher.levels.show', $level) }}#level-details" class="flex-1 rounded-lg bg-primary/10 py-2 text-center text-primary transition-colors hover:bg-primary hover:text-white">
                                            عرض التفاصيل
                                        </a>
                                        <a href="{{ route('teacher.levels.edit', $level) }}#level-form" class="flex-1 rounded-lg bg-[#f0f4f0] py-2 text-center text-[#638863] transition-colors hover:bg-gray-200 dark:bg-[#2a3a2a] dark:text-[#a0b0a0] dark:hover:bg-[#3a4a3a]">
                                            تعديل
                                        </a>
                                        <form method="POST" action="{{ route('teacher.levels.destroy', $level) }}" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full rounded-lg bg-red-50 py-2 text-red-600 transition-colors hover:bg-red-100 dark:bg-red-500/10 dark:text-red-300" onclick="return confirm('هل أنت متأكدة من حذف هذا الفصل؟')">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full rounded-[2rem] border border-dashed border-[#cdd9cd] bg-white/70 p-10 text-center dark:border-[#2a3a2a] dark:bg-[#1a2a1a]">
                                <span class="material-symbols-outlined text-6xl text-[#638863]">add_circle</span>
                                <p class="mt-4 text-2xl font-black text-[#638863]">لا توجد فصول حتى الآن</p>
                                <p class="mt-2 text-sm text-[#638863]">ابدئي بإضافة أول فصل ليظهر هنا مباشرة.</p>
                                <a href="{{ route('teacher.levels.index', ['create' => 1]) }}#level-form" class="mt-6 inline-flex items-center rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white transition hover:brightness-105">
                                    إنشاء أول فصل
                                </a>
                            </div>
                        @endforelse
                    </div>

                </div>
            </main>
        </div>
    </div>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a2a1a] border-t border-[#dce5dc] dark:border-[#2a3a2a] px-6 py-2 flex justify-between items-center z-50">
        <a href="{{ route('teacher.teacherdashboard') }}" class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">home</span>
            <span class="text-[10px]">الرئيسية</span>
        </a>
        <a href="{{ route('teacher.levels.index') }}" class="flex flex-col items-center text-primary">
            <span class="material-symbols-outlined">groups</span>
            <span class="text-[10px]">الفصول</span>
        </a>
        <a href="{{ route('teacher.levels.index', ['create' => 1]) }}#level-form" class="flex size-12 items-center justify-center rounded-full border-4 border-[#f6f8f6] bg-primary text-white shadow-lg dark:border-background-dark -mt-8">
            <span class="material-symbols-outlined">add</span>
        </a>
        <a href="{{ route('teacher.messages') }}" class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">chat_bubble</span>
            <span class="text-[10px]">الرسائل</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="text-[10px]">حسابي</span>
        </a>
    </div>

</body>

</html>
