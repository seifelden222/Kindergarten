<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>لوحة تحكم ولي الأمر - نظام إدارة الحضانة</title>
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
        <x-parent-sidebar active-page="dashboard" />
        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8">
                <header class="flex flex-wrap justify-between items-end gap-6 mb-8">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-4xl font-black tracking-tight">أهلاً بك 👋</h2>
                    </div>
                    <div class="flex gap-3">
                        <button class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl font-bold text-sm hover:bg-gray-50 transition-colors">
                            <span class="material-symbols-outlined text-xl">person_add</span>
                            <a href="{{route('parent.addchild')}}"><span>إضافة طفل</span></a>
                        </button>
                        <button class="flex items-center gap-2 px-6 py-2 bg-primary text-[#111811] rounded-xl font-bold text-sm hover:brightness-110 transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-xl">payments</span>
                            <span><a href="{{route('parent.payment')}}">دفع الرسوم</a></span>
                        </button>
                    </div>
                </header>
                <div class="mb-10 rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] bg-white dark:bg-[#1a2e1a] p-6 shadow-sm">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الأطفال المسجلين</p>
                            <p class="text-4xl font-black mt-2">{{ auth()->user()?->children()->where('role', 'child')->count() ?? 0 }}</p>
                        </div>
                        <!-- Notification summary removed for new accounts -->
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <span class="w-2 h-8 bg-primary rounded-full"></span>
                        أطفالي المسجلين
                    </h3>
                </div>
                @php
                    $myChildren = auth()->user()?->children()->where('role', 'child')->with('levels')->get() ?? collect();
                @endphp
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                    @forelse($myChildren as $child)
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2d402d] shadow-md flex">
                        <div class="w-1/3 bg-cover bg-center min-h-[220px]" style="background-image: url('{{ asset('img/chiled.jpeg') }}')"></div>
                        <div class="w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h4 class="text-xl font-bold">{{ $child->name }}</h4>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مسجل</span>
                                </div>
                                <p class="text-[#638863] dark:text-[#a3c2a3] text-sm mb-4">المستوى: {{ $child->level?->name ?? 'غير محدد' }}</p>
                            </div>
                            <button class="mt-4 w-full py-2 bg-background-light dark:bg-[#112111] text-xs font-bold rounded-lg hover:bg-gray-200 transition-colors">عرض التقرير اليومي</button>
                        </div>
                    </div>
                    @empty
                    <div class="lg:col-span-2 py-16 text-center text-[#638863]">
                        <span class="material-symbols-outlined text-5xl block mb-3">child_care</span>
                        <p class="text-lg font-bold">لا يوجد أطفال مسجلين بعد</p>
                        <p class="text-sm mt-1">يمكنك إضافة طفلك من خلال زر "إضافة طفل" أعلاه.</p>
                    </div>
                    @endforelse
                </div>
                <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden">
                    <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                        <h3 class="text-lg font-bold">آخر التحديثات والأنشطة</h3>
                    </div>
                    <div class="py-14 text-center text-[#638863]">
                        <span class="material-symbols-outlined text-5xl block mb-3">notifications_none</span>
                        <p class="text-base font-bold">لا توجد تحديثات بعد</p>
                        <p class="text-sm mt-1">ستظهر هنا أنشطة وملاحظات أطفالك فور وصولها.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // ربط أزرار التقرير اليومي في الصفحة الرئيسية
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('عرض التقرير اليومي')) {
                button.onclick = function() {
                    const childCard = this.closest('.bg-white, .dark\\:bg-\\[\\#1a2e1a\\]');
                    const childName = childCard?.querySelector('h4')?.textContent || 'الطفل';
                    showDailyReport(childName);
                };
            }
        });
    </script>
    <script src="{{ asset('js/parent-functions.js') }}"></script>

</body>

</html>
