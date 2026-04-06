<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>لوحة تحكم المعلم - نظام إدارة الحضانة</title>
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
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111811] dark:text-white min-h-screen">
    <div class="flex h-screen">
        <x-teacher-sidebar active="dashboard" />

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-y-auto py-8 px-6 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-8">
                    @if (session('status'))
                        <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex min-w-72 flex-col gap-2">
                            <h1 class="text-4xl font-black leading-tight tracking-tight">لوحة تحكم المعلم</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">مرحباً بك مجدداً، تدير اليوم <span class="text-primary font-bold">{{ $className }}</span></p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('teacher.levels.index') }}" class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary/10 text-primary border border-primary/20 text-sm font-bold shadow-sm hover:bg-primary/20 transition-all">
                                <span class="material-symbols-outlined ml-2 text-xl">groups</span>
                                صفحة الفصول
                            </a>
                            <button type="button" onclick="editProfile()" class="flex items-center justify-center rounded-xl h-11 px-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
                                <span class="material-symbols-outlined ml-2 text-xl">edit</span>
                                تعديل الملف الشخصي
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863]">إجمالي الأطفال</p>
                                <span class="material-symbols-outlined text-primary">groups</span>
                            </div>
                            <p class="text-3xl font-bold mt-3">{{ $totalChildren }}</p>
                        </div>
                        <div class="rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm border-r-4 border-r-primary">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863]">الحضور اليوم</p>
                                <span class="material-symbols-outlined text-primary">how_to_reg</span>
                            </div>
                            <p class="text-3xl font-bold mt-3">{{ $presentToday }} <span class="text-sm font-normal text-[#638863]">/ {{ $totalChildren }}</span></p>
                        </div>
                        <div class="rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863]">تقارير معلقة</p>
                                <span class="material-symbols-outlined text-orange-400">pending_actions</span>
                            </div>
                            <p class="text-3xl font-bold mt-3">{{ $pendingReportsCount }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-8 flex flex-col gap-6">
                            <h3 class="text-xl font-bold">قائمة الفصل</h3>

                            <form method="POST" action="{{ route('teacher.attendance.store') }}" class="contents">
                                @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @forelse ($studentsForDashboard as $student)
                                    <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-4 border border-[#dce5dc] dark:border-[#2a3a2a] flex flex-col items-center text-center gap-3">
                                        <input type="hidden" name="attendance[{{ $loop->index }}][user_id]" value="{{ $student['id'] }}">
                                        <input type="hidden" name="attendance[{{ $loop->index }}][status]" value="{{ $student['is_present'] ? 'present' : 'absent' }}" data-status-input>
                                        <div class="relative">
                                            <div class="size-16 rounded-full bg-zinc-200 border-2 {{ $student['is_present'] ? 'border-primary' : 'border-zinc-300' }}"></div>
                                            <div class="absolute bottom-0 right-0 size-4 {{ $student['is_present'] ? 'bg-primary' : 'bg-zinc-300' }} border-2 border-white dark:border-[#1a2a1a] rounded-full"></div>
                                        </div>
                                        <div>
                                            <p class="font-bold">{{ $student['name'] }}</p>
                                            <p class="text-xs text-[#638863]">{{ $student['level_name'] ?: 'غير محدد' }}</p>
                                        </div>
                                        <div class="flex w-full gap-2 mt-2" data-attendance-buttons>
                                            <button type="button" data-status-value="present" class="flex-1 text-xs font-bold py-2 rounded-lg {{ $student['is_present'] ? 'bg-primary text-white' : 'bg-primary/10 text-primary' }}">حاضر</button>
                                            <button type="button" data-status-value="absent" class="flex-1 text-xs font-bold py-2 rounded-lg {{ $student['is_present'] ? 'bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863]' : 'bg-red-500 text-white' }}">غائب</button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full rounded-xl border border-dashed border-[#dce5dc] dark:border-[#2a3a2a] p-8 text-center text-sm text-[#638863]">
                                        لا يوجد أطفال لعرضهم حاليا.
                                    </div>
                                @endforelse
                            </div>

                            <div class="flex flex-wrap gap-4 py-4">
                                <button type="submit" class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-primary text-white text-base font-bold shadow-lg shadow-primary/20">
                                    <span class="material-symbols-outlined ml-2">check_circle</span>
                                    تسجيل الحضور
                                </button>
                                <button type="button" onclick="addDailyActivity()" class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-white dark:bg-[#1a2a1a] border-2 border-primary text-primary text-base font-bold">
                                    <span class="material-symbols-outlined ml-2">draw</span>
                                    إضافة نشاط يومي
                                </button>
                                <button type="button" onclick="addBehaviorNote()" class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-base font-bold">
                                    <span class="material-symbols-outlined ml-2">add_comment</span>
                                    ملاحظة سلوكية
                                </button>
                            </div>
                            </form>

                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold">آخر الأنشطة</h3>
                                    <button id="teacher-view-all-photos" onclick="viewAllPhotos()" class="text-primary text-sm font-bold">مشاهدة الكل</button>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($recentPhotos as $photo)
                                        <div class="aspect-square rounded-xl bg-zinc-100 dark:bg-zinc-800 border border-[#dce5dc] dark:border-[#2a3a2a] p-3 flex flex-col justify-between overflow-hidden">
                                            @if ($photo->image_path)
                                                <div class="h-20 rounded-lg overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                                    <img src="{{ asset('storage/'.$photo->image_path) }}" alt="{{ $photo->name }}" class="h-full w-full object-cover">
                                                </div>
                                            @else
                                                <div class="h-20 rounded-lg border border-dashed border-[#dce5dc] dark:border-[#2a3a2a] flex items-center justify-center text-[#638863] dark:text-[#a0b0a0] text-xs">
                                                    بدون صورة
                                                </div>
                                            @endif
                                            <div class="pt-2">
                                                <p class="text-sm font-bold line-clamp-2">{{ $photo->name }}</p>
                                                <p class="text-xs text-[#638863]">{{ optional($photo->activity_date)->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div onclick="addPhotos()" class="aspect-square rounded-xl bg-[#f0f4f0] dark:bg-[#2a3a2a] flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#dce5dc] dark:border-[#3a4a3a] cursor-pointer hover:bg-primary/10 group transition-colors">
                                        <span class="material-symbols-outlined text-3xl text-primary">add_a_photo</span>
                                        <span class="text-xs font-bold">إضافة صور</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-4 flex flex-col gap-6">
                            <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                                <div class="flex items-center gap-2 mb-6">
                                    <span class="material-symbols-outlined text-primary">calendar_today</span>
                                    <h3 class="text-lg font-bold">جدول اليوم</h3>
                                </div>
                                <div class="flex flex-col gap-4">
                                    @forelse ($todaySchedule as $item)
                                        <div class="rounded-lg border border-[#dce5dc] dark:border-[#2a3a2a] p-3 {{ $loop->first ? 'bg-primary/5 border-primary/20' : '' }}">
                                            <p class="font-bold text-sm {{ $loop->first ? 'text-primary' : '' }}">{{ $item->morning_subject }}</p>
                                            <p class="text-xs text-[#638863] mt-1">{{ $item->second_subject }}</p>
                                            <p class="text-xs text-[#638863]">{{ $item->daily_activity }}</p>
                                        </div>
                                    @empty
                                        <p class="text-sm text-[#638863]">لا يوجد جدول مسجل لهذا اليوم.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="material-symbols-outlined text-primary">priority_high</span>
                                    <h3 class="text-lg font-bold">تنبيهات هامة</h3>
                                </div>
                                <ul class="flex flex-col gap-3">
                                    @forelse ($alerts as $alert)
                                        <li class="flex items-center gap-3 p-3 bg-red-50 dark:bg-red-900/10 rounded-lg text-red-600 dark:text-red-400 text-sm border border-red-100 dark:border-red-900/20">
                                            <span class="material-symbols-outlined text-base">{{ $alert['type'] }}</span>
                                            <span>{{ $alert['message'] }}</span>
                                        </li>
                                    @empty
                                        <li class="p-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg text-sm text-[#638863]">لا توجد تنبيهات هامة حالياً.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <button type="button" onclick="sendDailyReport()" class="w-full flex items-center justify-between p-4 bg-primary text-white rounded-xl font-bold shadow-lg">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined">description</span>
                                    <span>إرسال التقرير اليومي</span>
                                </div>
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <template id="teacher-profile-form-template">
        <form method="POST" action="{{ route('teacher.profile.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">الاسم الأول</label>
                    <input name="first_name" type="text" required value="{{ old('first_name', $teacherFirstName) }}" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl">
                    @error('first_name')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">اسم العائلة</label>
                    <input name="last_name" type="text" required value="{{ old('last_name', $teacherLastName) }}" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl">
                    @error('last_name')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">البريد الإلكتروني</label>
                <input name="email" type="email" required value="{{ old('email', $teacher->email) }}" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl">
                @error('email')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">رقم الجوال</label>
                <input name="phone" type="tel" value="{{ old('phone', $teacher->phone) }}" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl">
                @error('phone')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a]">إلغاء</button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl">حفظ التغييرات</button>
            </div>
        </form>
    </template>

    <script>
        window.teacherActivityStoreUrl = @json(route('teacher.activities.store'));
    </script>
    <script src="{{ asset('js/teacher-functions.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-attendance-buttons]').forEach(function (group) {
                const statusInput = group.closest('div').querySelector('[data-status-input]');
                const presentButton = group.querySelector('[data-status-value="present"]');
                const absentButton = group.querySelector('[data-status-value="absent"]');

                function applyStatus(status) {
                    statusInput.value = status;

                    if (status === 'present') {
                        presentButton.className = 'flex-1 text-xs font-bold py-2 rounded-lg bg-primary text-white';
                        absentButton.className = 'flex-1 text-xs font-bold py-2 rounded-lg bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863]';
                    } else {
                        presentButton.className = 'flex-1 text-xs font-bold py-2 rounded-lg bg-primary/10 text-primary';
                        absentButton.className = 'flex-1 text-xs font-bold py-2 rounded-lg bg-red-500 text-white';
                    }
                }

                presentButton.addEventListener('click', function () {
                    applyStatus('present');
                });

                absentButton.addEventListener('click', function () {
                    applyStatus('absent');
                });
            });
        });
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                editProfile();
            });
        </script>
    @endif
</body>

</html>
