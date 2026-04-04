<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>التقارير - نظام إدارة الحضانة</title>
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

    <div class="flex h-screen">
        <x-teacher-sidebar active="reports" />

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
                            <h1 class="text-4xl font-black leading-tight tracking-tight">التقارير</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">عرض وإدارة التقارير اليومية والأسبوعية</p>
                        </div>
                        <button type="button" onclick="createNewReport()" class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-sm hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined ml-2 text-xl">add</span>
                            تقرير جديد
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold">التقارير الأخيرة</h3>
                                <span class="text-primary text-sm font-medium">عرض الكل</span>
                            </div>
                            <div class="space-y-4">
                                @forelse ($recentReports as $report)
                                    @php
                                        $statusText = match ($report->status) {
                                            'sent' => 'تم إرساله',
                                            'approved' => 'تمت الموافقة',
                                            'reviewed' => 'تمت المراجعة',
                                            default => 'في انتظار المراجعة',
                                        };
                                    @endphp
                                    <div class="flex items-center gap-4 rounded-lg bg-[#f0f4f0] p-4 dark:bg-[#2a3a2a]">
                                        <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">description</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium">{{ $report->title }}</p>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">{{ $statusText }}</p>
                                        </div>
                                        <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">{{ $report->report_date?->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <div class="rounded-lg border border-dashed border-[#dce5dc] p-6 text-center text-sm text-[#638863] dark:border-[#2a3a2a] dark:text-[#a0b0a0]">
                                        لا توجد تقارير محفوظة حتى الآن.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-bold">إحصائيات الحضور الأسبوعية</h3>
                                <span class="rounded-full border border-[#dce5dc] bg-[#f0f4f0] px-3 py-1.5 text-sm dark:border-[#2a3a2a] dark:bg-[#2a3a2a]">هذا الأسبوع</span>
                            </div>
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-primary">{{ $attendanceRate }}%</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">نسبة الحضور</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-orange-500">{{ $absenceDaysCount }}</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a0b0a0] mt-1">أيام غياب</p>
                                </div>
                            </div>
                            <div class="h-48 rounded-lg bg-[#f0f4f0] dark:bg-[#2a3a2a] flex items-center justify-center text-[#638863] dark:text-[#a0b0a0]">
                                <p>عدد التقارير هذا الأسبوع: {{ $weeklyReportsCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold">آخر التقارير المرسلة</h3>
                            <span class="text-primary text-sm font-medium">تصدير الكل</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead>
                                    <tr class="border-b border-[#dce5dc] dark:border-[#2a3a2a]">
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">التاريخ</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الفصل</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">المعلمة</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الحالة</th>
                                        <th class="pb-3 font-medium text-[#638863] dark:text-[#a0b0a0]">الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#dce5dc] dark:divide-[#2a3a2a]">
                                    @forelse ($reports as $report)
                                        @php
                                            $statusClasses = match ($report->status) {
                                                'sent' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                                'approved' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                'reviewed' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
                                                default => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            };
                                            $statusLabel = match ($report->status) {
                                                'sent' => 'مرسل',
                                                'approved' => 'تمت الموافقة',
                                                'reviewed' => 'تمت المراجعة',
                                                default => 'قيد المراجعة',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="py-4">{{ $report->report_date?->translatedFormat('l j F Y') }}</td>
                                            <td class="py-4">{{ $report->level?->name ?? '-' }}</td>
                                            <td class="py-4">{{ $report->teacher?->name ?? auth()->user()?->name }}</td>
                                            <td class="py-4"><span class="inline-block rounded-full px-3 py-1 text-xs {{ $statusClasses }}">{{ $statusLabel }}</span></td>
                                            <td class="py-4">
                                                <button type="button" class="text-primary hover:underline text-sm" onclick="viewReport(@js($report->title), @js($report->content), @js($report->level?->name ?? '-'), @js(optional($report->report_date)->format('Y-m-d')))">عرض</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8 text-center text-sm text-[#638863] dark:text-[#a0b0a0]">لا توجد تقارير محفوظة في قاعدة البيانات حتى الآن.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <template id="teacher-report-form-template">
        <form method="POST" action="{{ route('teacher.reports.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-2">نوع التقرير</label>
                <select name="report_type" required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر نوع التقرير</option>
                    <option value="daily" @selected(old('report_type') === 'daily')>تقرير يومي</option>
                    <option value="weekly" @selected(old('report_type') === 'weekly')>تقرير أسبوعي</option>
                    <option value="monthly" @selected(old('report_type') === 'monthly')>تقرير شهري</option>
                    <option value="activity" @selected(old('report_type') === 'activity')>تقرير نشاط</option>
                </select>
                @error('report_type')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">الفصل</label>
                <select name="level_id" required class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <option value="">اختر الفصل</option>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}" @selected((string) old('level_id') === (string) $level->id)>{{ $level->name }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">التاريخ</label>
                <input name="report_date" type="date" required value="{{ old('report_date', now()->toDateString()) }}" class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                @error('report_date')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">محتوى التقرير</label>
                <textarea name="content" required rows="6" placeholder="اكتب محتوى التقرير..." class="w-full px-4 py-3 bg-[#f0f4f0] dark:bg-[#2a3a2a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-[#dce5dc] dark:border-[#2a3a2a]">
                <button type="button" onclick="closeAllPopups()" class="px-6 py-2.5 rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] hover:bg-gray-100 dark:hover:bg-[#2a3a2a] transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl hover:brightness-110 transition-colors font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    إنشاء التقرير
                </button>
            </div>
        </form>
    </template>

    <script src="{{ asset('js/teacher-functions.js') }}"></script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                createNewReport();
            });
        </script>
    @endif

</body>

</html>
