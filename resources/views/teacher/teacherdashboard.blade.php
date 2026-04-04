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

        <x-teacher-sidebar active="dashboard" />

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-y-auto py-8 px-6 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-8">

                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex min-w-72 flex-col gap-2">
                            <h1 class="text-4xl font-black leading-tight tracking-tight">لوحة تحكم المعلم</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">مرحباً بك مجدداً، تدير اليوم <span class="text-primary font-bold">فصل الزهور (أ)</span></p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('teacher.levels.index') }}" class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary/10 text-primary border border-primary/20 text-sm font-bold shadow-sm hover:bg-primary/20 transition-all">
                                <span class="material-symbols-outlined ml-2 text-xl">groups</span>
                                صفحة الفصول
                            </a>
                            <button class="flex items-center justify-center rounded-xl h-11 px-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] text-sm font-bold shadow-sm hover:bg-gray-50 transition-all">
                                <span class="material-symbols-outlined ml-2 text-xl">edit</span>
                                تعديل الملف الشخصي
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863] dark:text-[#a0b0a0]">إجمالي الأطفال</p>
                                <span class="material-symbols-outlined text-primary">groups</span>
                            </div>
                            <p class="text-3xl font-bold">25</p>
                        </div>
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm border-r-4 border-r-primary">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863] dark:text-[#a0b0a0]">الحضور اليوم</p>
                                <span class="material-symbols-outlined text-primary">how_to_reg</span>
                            </div>
                            <p class="text-3xl font-bold">22 <span class="text-sm font-normal text-[#638863]">/ 25</span></p>
                        </div>
                        <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-[#638863] dark:text-[#a0b0a0]">تقارير معلقة</p>
                                <span class="material-symbols-outlined text-orange-400">pending_actions</span>
                            </div>
                            <p class="text-3xl font-bold">5</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-8 flex flex-col gap-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold">قائمة الفصل</h3>
                                <div class="flex gap-2">
                                    <button class="p-2 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-lg">
                                        <span class="material-symbols-outlined text-lg">filter_alt</span>
                                    </button>
                                    <button class="p-2 bg-white dark:bg-[#1a2a1a] border border-[#dce5dc] dark:border-[#2a3a2a] rounded-lg">
                                        <span class="material-symbols-outlined text-lg">sort_by_alpha</span>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-4 border border-[#dce5dc] dark:border-[#2a3a2a] flex flex-col items-center text-center gap-3 hover:shadow-md transition-shadow">
                                    <div class="relative">
                                        <div class="size-16 rounded-full bg-cover bg-center border-2 border-primary" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuALILidZCT-C0fln1X__Zfi9D3HCsKP_0FE02cLFU9NS8DCKFVyiGmD9mAmmV8_HNzejzv2FMXOcO6Dl6jsJSxy8ZgbKLcn20IWQrgy4B9rIIWlQ3bWqAXjgGi4-womFJiIQ-9CoQFHrtbt41rSLuBbxfWXvLXYOfM2ueAqGsLvVqJSe2z19B_9bIPKaDLb0dGS7Z0WS6C6mCgjIq4_cLHQCfVngLnp-Iuoy1VN01_yr9TUuMtJUvVxxAN6b4O9gg7EmofJyTF6GO4Z');"></div>
                                        <div class="absolute bottom-0 right-0 size-4 bg-primary border-2 border-white dark:border-[#1a2a1a] rounded-full"></div>
                                    </div>
                                    <div>
                                        <p class="font-bold">أحمد علي</p>
                                        <p class="text-xs text-[#638863]">مستوى أول</p>
                                    </div>
                                    <div class="flex w-full gap-2 mt-2">
                                        <button class="flex-1 bg-primary/10 text-primary text-xs font-bold py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">حاضر</button>
                                        <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] text-xs font-bold py-2 rounded-lg hover:bg-red-500 hover:text-white transition-colors">غائب</button>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-4 border border-[#dce5dc] dark:border-[#2a3a2a] flex flex-col items-center text-center gap-3 hover:shadow-md transition-shadow">
                                    <div class="relative">
                                        <div class="size-16 rounded-full bg-cover bg-center border-2 border-gray-200" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAQGmA6iW4dPT8XiHKeoX38ajJCN421UY3CDd03rCqzBkD5nuY410IOzc5xknMvjlFyGtvb_J_6xR8wgn4q5EodzXKVI9f1UpaoqGqzjj5KvkSJgxQcmtHC6gj13wApjFMuJFxZYGnZO8RwLKcISK4pj0yJndDpqHGNqKMIj75Fh3HoI77g4-DTa0XAy7wAp1hoDO0YI49bI8Q_K7jOP-f4dr0Evw1RdnTSxHmnliSCv8yMX7_MdjKOopcl4IlsxzNcihGqqKA02NF5');"></div>
                                        <div class="absolute bottom-0 right-0 size-4 bg-gray-300 border-2 border-white dark:border-[#1a2a1a] rounded-full"></div>
                                    </div>
                                    <div>
                                        <p class="font-bold">ليلى محمود</p>
                                        <p class="text-xs text-[#638863]">مستوى أول</p>
                                    </div>
                                    <div class="flex w-full gap-2 mt-2">
                                        <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] text-xs font-bold py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">حاضر</button>
                                        <button class="flex-1 bg-red-500 text-white text-xs font-bold py-2 rounded-lg">غائب</button>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-4 border border-[#dce5dc] dark:border-[#2a3a2a] flex flex-col items-center text-center gap-3 hover:shadow-md transition-shadow">
                                    <div class="relative">
                                        <div class="size-16 rounded-full bg-cover bg-center border-2 border-primary" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC_y2AjPoSn-oD0o0B5KRR7BsvhqdHunGziILgmTzmYAHuF1LI4-DgcRtr6QG3xqguLw8gZKiN189zL54wyo5AqtveFc6GuGPdOKya7PhnhO_lvff1xeYdWTKiJLepqdDmTH1wH6WhLpitY1ZuherdB_mrNBfJHv9s70VtttbP0nYSYalnrPsPN1ulrhX5XJaKpgbuABNRJCEJpXnuVjyl325wDDcgpqMXneVcL1iOAD1_wzSQ6GLCDqClwCWIEn9O3i8talp8ts1M7');"></div>
                                        <div class="absolute bottom-0 right-0 size-4 bg-primary border-2 border-white dark:border-[#1a2a1a] rounded-full"></div>
                                    </div>
                                    <div>
                                        <p class="font-bold">ياسين عمر</p>
                                        <p class="text-xs text-[#638863]">مستوى أول</p>
                                    </div>
                                    <div class="flex w-full gap-2 mt-2">
                                        <button class="flex-1 bg-primary text-white text-xs font-bold py-2 rounded-lg">حاضر</button>
                                        <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] text-xs font-bold py-2 rounded-lg hover:bg-red-500 hover:text-white transition-colors">غائب</button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-4 py-6">
                                <button class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-primary text-white text-base font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">
                                    <span class="material-symbols-outlined ml-2">check_circle</span>
                                    تسجيل الحضور
                                </button>
                                <button class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-white dark:bg-[#1a2a1a] border-2 border-primary text-primary text-base font-bold hover:bg-primary/5 transition-colors">
                                    <span class="material-symbols-outlined ml-2">draw</span>
                                    إضافة نشاط يومي
                                </button>
                                <button class="flex min-w-[140px] flex-1 items-center justify-center rounded-xl h-14 px-6 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#111811] dark:text-white text-base font-bold hover:bg-[#e0e4e0] transition-colors">
                                    <span class="material-symbols-outlined ml-2">add_comment</span>
                                    ملاحظة سلوكية
                                </button>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold">آخر الصور المضافة</h3>
                                    <button id="teacher-view-all-photos" onclick="viewAllPhotos()" class="text-primary text-sm font-bold">مشاهدة الكل</button>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="aspect-square rounded-xl bg-cover bg-center border border-[#dce5dc] dark:border-[#2a3a2a]" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDdhplbP3H82o9tEb9D0XLjLv3e1XX5SsR-FK99wrAcicty2ECPmJwIGrkZqEjnjTSoR2yImla3FV669ZIi9cAeaqe2a6yi4i7qWbztcf9kgS6JPV5Xh5MjMZojR_MdW01lliEr5FNm2QDhx1a0qwrw1R4NGa20FNtJRqfzUugADZ2vvhG4Bu3oXEngcq-wMTE_-8IzDDuBWIpssenetbL308QpG8AKHmzCen0XTGp-Na38kO2lpmR1WmUMdN2f2_BIzIb1LinGhGBI');"></div>
                                    <div class="aspect-square rounded-xl bg-cover bg-center border border-[#dce5dc] dark:border-[#2a3a2a]" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuALdWpXUijdTqTuku3D3WsLRVrnDsZ0NSqzHG2e3T13eklGSTvo-zCSJ6yThJUTA7iTahCCp0bqkVSDlch_qo0ONCGGRzgE4s59Joa8BZSEWd3P8Wk_vKPBH0Dh3x6JzAMqUtjsD-YFXyEQ0jBa_xXF1znheYBUDD1_2yF1rECDkkQRVvv00nSX7WHYFoth4-CYKhK3t1bxTsDrepWrti7PEkG9Z84SjbmNkW2qhwBxH2mQYnD41v6VhmOzS10q8U-y367BuRpsCvsq');"></div>
                                    <div class="aspect-square rounded-xl bg-cover bg-center border border-[#dce5dc] dark:border-[#2a3a2a]" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA-qcip3O8MklKeBV1IFIl8fwHN6kjzxjwkcdB1E1-u7WN2S4qfmFbDc-xeMBWG3yM3h2mN4M2lN5O0ocYodrXLJxOMY8nyUZORE5eUQfK2m3F6vaAj-0H5CTFR1o1QZxT45K6kUlVqBoVVX2u_kxWmaTcvXwKHEG1Ryw_Lt8eYCcW53k0A-_H_LAlOdKrvlFlm7fuyuwvOQahwpnABSMqfLkl-KXprr4hgYLnX45jxjS_Hy2s7psBWg57z4rFrYheHN0KnQ58fxxDs');"></div>
                                    <div onclick="addPhotos()" class="aspect-square rounded-xl bg-[#f0f4f0] dark:bg-[#2a3a2a] flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#dce5dc] dark:border-[#3a4a3a] cursor-pointer hover:bg-primary/10 group transition-colors">
                                        <span class="material-symbols-outlined text-3xl text-primary group-hover:scale-110 transition-transform">add_a_photo</span>
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
                                <div class="flex flex-col gap-6 relative">
                                    <div class="absolute right-3 top-0 bottom-0 w-0.5 bg-[#f0f4f0] dark:bg-[#2a3a2a]"></div>
                                    <div class="flex items-start gap-4 pr-8 relative">
                                        <div class="absolute right-[10px] top-1 size-3 rounded-full bg-primary border-4 border-white dark:border-[#1a2a1a] z-10"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-bold text-sm">وقت الاستقبال</p>
                                                <span class="text-xs text-[#638863]">08:00 ص</span>
                                            </div>
                                            <p class="text-xs text-[#638863] leading-relaxed">ترحيب بالأطفال وأنشطة حرة هادئة.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4 pr-8 relative">
                                        <div class="absolute right-[10px] top-1 size-3 rounded-full bg-primary border-4 border-white dark:border-[#1a2a1a] z-10"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-bold text-sm">حلقة الصباح</p>
                                                <span class="text-xs text-[#638863]">09:30 ص</span>
                                            </div>
                                            <p class="text-xs text-[#638863] leading-relaxed">الأناشيد الصباحية ومراجعة أيام الأسبوع.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4 pr-8 relative">
                                        <div class="absolute right-[10px] top-1 size-3 rounded-full bg-orange-400 border-4 border-white dark:border-[#1a2a1a] animate-pulse z-10"></div>
                                        <div class="flex-1 bg-primary/5 p-3 rounded-lg border border-primary/20">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-bold text-sm text-primary">النشاط الفني</p>
                                                <span class="text-xs font-bold text-primary">الآن</span>
                                            </div>
                                            <p class="text-xs text-[#638863] leading-relaxed">التلوين بالأصابع لموضوع فصل الربيع.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4 pr-8 relative opacity-50">
                                        <div class="absolute right-[10px] top-1 size-3 rounded-full bg-[#dce5dc] border-4 border-white dark:border-[#1a2a1a] z-10"></div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center mb-1">
                                                <p class="font-bold text-sm">وجبة الغداء</p>
                                                <span class="text-xs text-[#638863]">12:00 م</span>
                                            </div>
                                            <p class="text-xs text-[#638863] leading-relaxed">وجبة صحية جماعية.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-[#1a2a1a] rounded-xl p-6 border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="material-symbols-outlined text-primary">priority_high</span>
                                    <h3 class="text-lg font-bold">تنبيهات هامة</h3>
                                </div>
                                <ul class="flex flex-col gap-3">
                                    <li class="flex items-center gap-3 p-3 bg-red-50 dark:bg-red-900/10 rounded-lg text-red-600 dark:text-red-400 text-sm border border-red-100 dark:border-red-900/20">
                                        <span class="material-symbols-outlined text-base">emergency</span>
                                        <span>أحمد علي لديه حساسية من الفول السوداني.</span>
                                    </li>
                                    <li class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/10 rounded-lg text-blue-600 dark:text-blue-400 text-sm border border-blue-100 dark:border-blue-900/20">
                                        <span class="material-symbols-outlined text-base">info</span>
                                        <span>موعد استلام ليلى اليوم مبكراً (1:30 م).</span>
                                    </li>
                                </ul>
                            </div>

                            <button class="w-full flex items-center justify-between p-4 bg-primary text-white rounded-xl font-bold shadow-lg hover:brightness-105 transition-all">
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

            <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a2a1a] border-t border-[#dce5dc] dark:border-[#2a3a2a] px-6 py-2 flex justify-between items-center z-50">
                <button class="flex flex-col items-center text-primary">
                    <span class="material-symbols-outlined">home</span>
                    <span class="text-[10px]">الرئيسية</span>
                </button>
                <a href="{{ route('teacher.levels.index') }}" class="flex flex-col items-center text-[#638863]">
                    <span class="material-symbols-outlined">groups</span>
                    <span class="text-[10px]">الفصول</span>
                </a>
                <button class="size-12 rounded-full bg-primary text-white flex items-center justify-center -mt-8 border-4 border-[#f6f8f6] dark:border-background-dark shadow-lg">
                    <span class="material-symbols-outlined">add</span>
                </button>
                <a href="{{ route('teacher.messages') }}" class="flex flex-col items-center text-[#638863]">
                    <span class="material-symbols-outlined">chat_bubble</span>
                    <span class="text-[10px]">الرسائل</span>
                </a>
                <button class="flex flex-col items-center text-[#638863]">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="text-[10px]">حسابي</span>
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/teacher-functions.js') }}"></script>

</body>

</html>
