<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>الحضور والغياب - نظام إدارة الحضانة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
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



        .active-nav {
            background-color: #0ea60e;
            color: white !important;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-admin-slider />

        <main class="flex-1 overflow-y-auto px-6 py-8">
            <div class="max-w-[1280px] mx-auto">

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-8">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-4xl font-black leading-tight tracking-tight">سجل الحضور والغياب</h1>
                        <p class="text-[#638863] dark:text-gray-400 text-base font-normal">تتبع حضور وغياب الأطفال اليومي والأسبوعي بكل سهولة</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
           
                        <button onclick="openAddModal()" class="flex items-center justify-center gap-2 bg-primary text-white rounded-xl px-5 py-2.5 text-sm font-bold hover:bg-[#16cc16] transition-colors shadow-md">
                            <span class="material-symbols-outlined text-xl">add</span>
                            <span>تسجيل حضور جديد</span>
                        </button>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 relative flex items-center gap-3 animate-pulse">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span class="block sm:inline font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 relative shadow-lg">
                        <div class="flex items-center gap-3 mb-1">
                            <span class="material-symbols-outlined">error</span>
                            <span class="block sm:inline font-bold">حدث خطأ ما:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                    <div
                        class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">إجمالي الأطفال</p>
                            <span class="material-symbols-outlined text-primary">groups</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">{{ $totalChildren }}</p>
                        <p class="text-[#078823] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            <span>+5% عن الشهر الماضي</span>
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">الحضور اليوم</p>
                            <span class="material-symbols-outlined text-primary">check_circle</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">{{ $presentToday }}</p>
                        <p class="text-[#078823] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            <span>+2% اليوم</span>
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">الغياب اليوم</p>
                            <span class="material-symbols-outlined text-red-500">cancel</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">{{ $absentToday }}</p>
                        <p class="text-[#078823] text-sm font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-xs">trending_down</span>
                            <span>-3% غياب مبرر</span>
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-background-dark flex flex-col gap-2 rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm">
                        <div class="flex justify-between items-start">
                            <p class="text-[#638863] dark:text-gray-400 text-sm font-medium">نسبة الحضور الأسبوعية</p>
                            <span class="material-symbols-outlined text-primary">analytics</span>
                        </div>
                        <p class="text-3xl font-bold leading-tight">{{ $attendanceRate }}%</p>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 h-2.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-primary h-full w-[{{ $attendanceRate }}%] rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-background-dark rounded-xl border border-[#dce5dc] dark:border-[#2a4a2a] shadow-sm overflow-hidden">
                    <div class="flex flex-col">
                        <div
                            class="flex flex-wrap items-center justify-between gap-4 p-5 border-b border-[#f0f4f0] dark:border-[#2a4a2a]">
                            <form action="{{ route('admin.absense') }}" method="GET" id="filterForm"
                                class="flex flex-wrap gap-4">
                                <input type="hidden" name="status" value="{{ $selectedStatus }}" id="statusInput">

                                <div class="relative">
                                    <input type="date" name="date" value="{{ $selectedDate }}"
                                        onchange="this.form.submit()"
                                        class="text-sm font-medium px-5 py-2.5 rounded-lg bg-background-light dark:bg-[#2a4a2a] border-none text-[#111811] dark:text-white cursor-pointer focus:ring-1 focus:ring-primary">
                                </div>

                                <select name="class" onchange="this.form.submit()"
                                    class="text-sm font-medium px-5 py-2.5 rounded-lg border border-[#dce5dc] dark:border-[#2a4a2a] bg-transparent text-[#111811] dark:text-white focus:ring-1 focus:ring-primary min-w-[200px]">
                                    <option value="">كل الفصول</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level }}"
                                            {{ $selectedClass == $level ? 'selected' : '' }}>{{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            <div
                                class="flex items-center gap-1.5 bg-background-light dark:bg-[#2a4a2a] p-1.5 rounded-xl">
                                <a href="{{ route('admin.absense', ['status' => 'all', 'date' => $selectedDate, 'class' => $selectedClass]) }}"
                                    class="px-5 py-2 rounded-lg {{ $selectedStatus === 'all' ? 'bg-white dark:bg-background-dark shadow-sm text-primary font-bold' : 'text-[#638863] dark:text-gray-400 font-medium' }} text-sm transition-all">الكل</a>
                                <a href="{{ route('admin.absense', ['status' => 'present', 'date' => $selectedDate, 'class' => $selectedClass]) }}"
                                    class="px-5 py-2 rounded-lg {{ $selectedStatus === 'present' ? 'bg-white dark:bg-background-dark shadow-sm text-primary font-bold' : 'text-[#638863] dark:text-gray-400 font-medium' }} text-sm transition-all">حاضر</a>
                                <a href="{{ route('admin.absense', ['status' => 'absent', 'date' => $selectedDate, 'class' => $selectedClass]) }}"
                                    class="px-5 py-2 rounded-lg {{ $selectedStatus === 'absent' ? 'bg-white dark:bg-background-dark shadow-sm text-primary font-bold' : 'text-[#638863] dark:text-gray-400 font-medium' }} text-sm transition-all">غائب</a>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-right border-collapse">
                                <thead>
                                    <tr
                                        class="bg-background-light/60 dark:bg-[#1e331e] text-[#638863] dark:text-gray-400 text-sm uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold">اسم الطفل</th>
                                        <th class="px-6 py-4 font-semibold">التاريخ</th>
                                        <th class="px-6 py-4 font-semibold text-center">الحالة</th>
                                        <th class="px-6 py-4 font-semibold">وقت الدخول</th>
                                        <th class="px-6 py-4 font-semibold">وقت الخروج</th>
                                        <th class="px-6 py-4 font-semibold text-center">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#f0f4f0] dark:divide-[#2a4a2a]">
                                    @foreach ($children as $child)
                                        @php
                                            $attendance = $child->attendances->first();
                                            $isPresent = $attendance && $attendance->absence_count === 0;
                                        @endphp
                                        <tr class="hover:bg-gray-50 dark:hover:bg-[#233a23] transition-colors">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="size-11 rounded-full bg-blue-100 flex items-center justify-center border border-blue-200 overflow-hidden">
                                                        <img alt="{{ $child->name }}" class="size-full object-cover"
                                                            src="https://ui-avatars.com/api/?name={{ urlencode($child->name) }}&background=random" />
                                                    </div>
                                                    <div>
                                                        <span class="font-bold block">{{ $child->name }}</span>
                                                        <span
                                                            class="text-xs text-[#638863] dark:text-gray-400">{{ $child->level_name ?? 'بدون فصل' }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-sm font-medium">{{ $selectedDate }}</td>
                                            <td class="px-6 py-5 text-center">
                                                @if ($isPresent)
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#e8fbe8] dark:bg-[#0a3a0a] text-[#078823] text-xs font-bold">
                                                        <span class="size-2 rounded-full bg-[#078823]"></span>
                                                        حاضر
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#fde8e8] dark:bg-[#3a1a1a] text-[#e72208] text-xs font-bold">
                                                        <span class="size-2 rounded-full bg-[#e72208]"></span>
                                                        غائب
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 text-sm">
                                                {{ $isPresent ? $attendance->check_in?->format('h:i أ') : '-- : --' }}
                                            </td>
                                            <td class="px-6 py-5 text-sm">
                                                {{ $isPresent && $attendance->check_out ? $attendance->check_out->format('h:i أ') : ($isPresent ? 'لم يخرج بعد' : '-- : --') }}
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <button onclick="openEditModal({{ $child->id }}, '{{ $child->name }}', '{{ $isPresent ? 'present' : 'absent' }}', '{{ $isPresent ? $attendance->id : '' }}', '{{ $isPresent ? $attendance->check_in?->format('H:i') : '' }}', '{{ $isPresent ? $attendance->check_out?->format('H:i') : '' }}')"
                                                    class="p-2 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined">edit</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    onclick="openEditModal({{ $child->id }}, '{{ $child->name }}', '{{ $isPresent ? 'present' : 'absent' }}', '{{ $isPresent ? $attendance->id : '' }}', '{{ $isPresent ? $attendance->check_in?->format('H:i') : '' }}', '{{ $isPresent ? $attendance->check_out?->format('H:i') : '' }}')"
                                                    class="p-2 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined">more_vert</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="p-5 flex items-center justify-between border-t border-[#f0f4f0] dark:border-[#2a4a2a]">
                            <p class="text-sm text-[#638863] dark:text-gray-400">
                                عرض {{ $children->firstItem() }} إلى {{ $children->lastItem() }} من أصل
                                {{ $children->total() }} طفل
                            </p>
                            <div>
                                {{ $children->links() }}
                            </div>
                        </div>
                    </div>

                </div>
        </main>

        <button
            class="md:hidden fixed bottom-8 left-8 z-50 size-16 rounded-full bg-primary text-white flex items-center justify-center shadow-2xl shadow-primary/30 hover:scale-110 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-3xl">add</span>
        </button>

    </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white dark:bg-background-dark w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2a4a2a]">
            <div class="p-6 border-b border-[#f0f4f0] dark:border-[#2a4a2a] flex justify-between items-center">
                <h3 class="text-xl font-bold">تسجيل حضور جديد</h3>
                <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 transition-colors"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form action="{{ route('admin.absense.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-[#638863]">اختر الطفل</label>
                    <select name="user_id" required class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                        <option value="">-- اختر الطفل --</option>
                        @foreach($allChildren as $child)
                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">التاريخ</label>
                        <input type="date" name="date" value="{{ $selectedDate }}" required class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">الحالة</label>
                        <select name="status" id="addStatus" onchange="toggleTimeInputs('add')" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                            <option value="present">حاضر</option>
                            <option value="absent">غائب</option>
                        </select>
                    </div>
                </div>
                <div id="addTimeInputs" class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">وقت الدخول</label>
                        <input type="time" name="check_in" value="08:00" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">وقت الخروج</label>
                        <input type="time" name="check_out" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/20 hover:bg-[#16cc16] transition-all">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white dark:bg-background-dark w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2a4a2a]">
            <div class="p-6 border-b border-[#f0f4f0] dark:border-[#2a4a2a] flex justify-between items-center">
                <h3 class="text-xl font-bold">تعديل حالة: <span id="editChildName"></span></h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors"><span class="material-symbols-outlined">close</span></button>
            </div>
            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PATCH')
                <div id="editStoreFields">
                    <input type="hidden" name="user_id" id="editUserId">
                    <input type="hidden" name="date" id="editDate" value="{{ $selectedDate }}">
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-[#638863]">الحالة</label>
                    <select name="status" id="editStatus" onchange="toggleTimeInputs('edit')" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                        <option value="present">حاضر</option>
                        <option value="absent">غائب</option>
                    </select>
                </div>
                <div id="editTimeInputs" class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">وقت الدخول</label>
                        <input type="time" name="check_in" id="editCheckIn" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-[#638863]">وقت الخروج</label>
                        <input type="time" name="check_out" id="editCheckOut" class="w-full rounded-xl border-[#dce5dc] dark:border-[#2a4a2a] bg-gray-50 dark:bg-[#1e331e] focus:ring-primary focus:border-primary">
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/20 hover:bg-[#16cc16] transition-all">تحديث</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTimeInputs(type) {
            const status = document.getElementById(type + 'Status').value;
            const timeInputs = document.getElementById(type + 'TimeInputs');
            if (status === 'absent') {
                timeInputs.style.opacity = '0.4';
                timeInputs.querySelectorAll('input').forEach(i => i.disabled = true);
            } else {
                timeInputs.style.opacity = '1';
                timeInputs.querySelectorAll('input').forEach(i => i.disabled = false);
            }
        }

        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(userId, userName, status, attendanceId, checkIn, checkOut) {
            document.getElementById('editChildName').innerText = userName;
            document.getElementById('editUserId').value = userId;
            document.getElementById('editStatus').value = status;
            document.getElementById('editCheckIn').value = checkIn;
            document.getElementById('editCheckOut').value = checkOut;

            const form = document.getElementById('editForm');
            if (attendanceId) {
                form.action = `/admin/absense/${attendanceId}`;
                document.getElementById('editForm').querySelector('input[name="_method"]').value = 'PATCH';
                document.getElementById('editStoreFields').innerHTML = ''; // Not needed for update
            } else {
                form.action = `{{ route('admin.absense.store') }}`;
                document.getElementById('editForm').querySelector('input[name="_method"]').value = 'POST';
                document.getElementById('editStoreFields').innerHTML = `
                    <input type="hidden" name="user_id" value="${userId}">
                    <input type="hidden" name="date" value="{{ $selectedDate }}">
                `;
            }

            toggleTimeInputs('edit');
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close on escape
        window.onkeydown = function(event) {
            if (event.key === "Escape") {
                closeAddModal();
                closeEditModal();
            }
        };
    </script>
</body>

</html>
