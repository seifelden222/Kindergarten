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
                        <button class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-sm hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined ml-2 text-xl">add</span>
                            إضافة فصل جديد
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="h-3 bg-primary"></div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">فصل الزهور (أ)</h3>
                                    <span class="text-primary font-medium">نشط</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">عدد الأطفال</p>
                                        <p class="text-2xl font-bold">25</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة</p>
                                        <p class="text-lg font-medium">أ. سارة أحمد</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button class="flex-1 bg-primary/10 text-primary py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">عرض التفاصيل</button>
                                    <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] dark:text-[#a0b0a0] py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-[#3a4a3a] transition-colors">تعديل</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="h-3 bg-blue-500"></div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">فصل الفراشات (ب)</h3>
                                    <span class="text-blue-600 dark:text-blue-400 font-medium">نشط</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">عدد الأطفال</p>
                                        <p class="text-2xl font-bold">22</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة</p>
                                        <p class="text-lg font-medium">أ. نورا محمد</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button class="flex-1 bg-primary/10 text-primary py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">عرض التفاصيل</button>
                                    <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] dark:text-[#a0b0a0] py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-[#3a4a3a] transition-colors">تعديل</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="h-3 bg-purple-500"></div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold">فصل النجوم (ج)</h3>
                                    <span class="text-purple-600 dark:text-purple-400 font-medium">نشط</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">عدد الأطفال</p>
                                        <p class="text-2xl font-bold">19</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a0b0a0]">المعلمة</p>
                                        <p class="text-lg font-medium">أ. لمى خالد</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button class="flex-1 bg-primary/10 text-primary py-2 rounded-lg hover:bg-primary hover:text-white transition-colors">عرض التفاصيل</button>
                                    <button class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] text-[#638863] dark:text-[#a0b0a0] py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-[#3a4a3a] transition-colors">تعديل</button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm overflow-hidden hover:shadow-md transition-shadow flex flex-col items-center justify-center gap-4 p-10 text-center opacity-70">
                            <span class="material-symbols-outlined text-6xl text-[#638863]">add_circle</span>
                            <p class="text-xl font-bold text-[#638863]">إضافة فصل جديد</p>
                            <p class="text-sm text-[#638863]">اضغط لإنشاء فصل جديد</p>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a2a1a] border-t border-[#dce5dc] dark:border-[#2a3a2a] px-6 py-2 flex justify-between items-center z-50">
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">home</span>
            <span class="text-[10px]">الرئيسية</span>
        </button>
        <button class="flex flex-col items-center text-primary">
            <span class="material-symbols-outlined">groups</span>
            <span class="text-[10px]">الفصول</span>
        </button>
        <button class="size-12 rounded-full bg-primary text-white flex items-center justify-center -mt-8 border-4 border-[#f6f8f6] dark:border-background-dark shadow-lg">
            <span class="material-symbols-outlined">add</span>
        </button>
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">chat_bubble</span>
            <span class="text-[10px]">الرسائل</span>
        </button>
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="text-[10px]">حسابي</span>
        </button>
    </div>

</body>

</html>