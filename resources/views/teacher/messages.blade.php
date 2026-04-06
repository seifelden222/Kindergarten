<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>الرسائل - نظام إدارة الحضانة</title>
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

        <x-teacher-sidebar active="messages" />
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-y-auto py-8 px-6 md:px-10">
                <div class="max-w-[1200px] mx-auto flex flex-col gap-8">

                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex min-w-72 flex-col gap-2">
                            <h1 class="text-4xl font-black leading-tight tracking-tight">الرسائل</h1>
                            <p class="text-lg text-[#638863] dark:text-[#a0b0a0]">التواصل مع أولياء الأمور والإدارة</p>
                        </div>
                        {{-- <button type="button" onclick="composeNewMessage()" class="flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-sm hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined ml-2 text-xl">edit</span>
                            رسالة جديدة
                        </button> --}}
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-4 bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm overflow-hidden">
                            <div class="p-5 border-b border-[#dce5dc] dark:border-[#2a3a2a] flex items-center justify-between">
                                <h3 class="font-bold text-lg">المحادثات</h3>
                                <button class="text-primary">
                                    <span class="material-symbols-outlined">filter_list</span>
                                </button>
                            </div>
                            <div class="divide-y divide-[#dce5dc] dark:divide-[#2a3a2a]">
                                <div class="p-4 hover:bg-[#f0f4f0] dark:hover:bg-[#2a3a2a] cursor-pointer bg-primary/5">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="size-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=987&q=80');"></div>
                                            <div class="absolute bottom-0 right-0 size-3 bg-green-500 rounded-full border-2 border-white dark:border-[#1a2a1a]"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-baseline">
                                                <p class="font-medium truncate">أم أحمد علي</p>
                                                <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">10:32 ص</span>
                                            </div>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0] truncate">شكراً على التقرير اليومي، هل يمكن...</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-[#f0f4f0] dark:hover:bg-[#2a3a2a] cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="size-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=987&q=80');"></div>
                                            <div class="absolute bottom-0 right-0 size-3 bg-gray-400 rounded-full border-2 border-white dark:border-[#1a2a1a]"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-baseline">
                                                <p class="font-medium truncate">أبو ليلى محمود</p>
                                                <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">أمس</span>
                                            </div>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0] truncate">موعد الاستلام المبكر غداً ممكن؟</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 hover:bg-[#f0f4f0] dark:hover:bg-[#2a3a2a] cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="size-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=987&q=80');"></div>
                                            <div class="absolute bottom-0 right-0 size-3 bg-gray-400 rounded-full border-2 border-white dark:border-[#1a2a1a]"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-baseline">
                                                <p class="font-medium truncate">إدارة الحضانة</p>
                                                <span class="text-xs text-[#638863] dark:text-[#a0b0a0]">الأحد</span>
                                            </div>
                                            <p class="text-sm text-[#638863] dark:text-[#a0b0a0] truncate">تذكير: اجتماع المعلمات غداً الساعة 4 م</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 bg-white dark:bg-[#1a2a1a] rounded-xl border border-[#dce5dc] dark:border-[#2a3a2a] shadow-sm flex flex-col h-[70vh] lg:h-auto">
                            <div class="p-5 border-b border-[#dce5dc] dark:border-[#2a3a2a] flex items-center gap-3">
                                <div class="size-10 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=987&q=80');"></div>
                                <div>
                                    <p class="font-bold">أم أحمد علي</p>
                                    <p class="text-xs text-[#638863] dark:text-[#a0b0a0]">أم / ولي أمر - أحمد علي</p>
                                </div>
                            </div>

                            <div class="flex-1 p-6 overflow-y-auto space-y-6">
                                <div class="flex justify-start">
                                    <div class="max-w-[70%] bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-2xl rounded-tr-none px-5 py-3">
                                        <p>مرحبا أستاذة سارة، شكراً على التقرير اليومي الجميل</p>
                                        <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">10:15 ص</p>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <div class="max-w-[70%] bg-primary text-white rounded-2xl rounded-tl-none px-5 py-3">
                                        <p>العفو، سعيدة إن التقرير عجبك</p>
                                        <p class="text-xs text-white/80 mt-1">10:18 ص</p>
                                    </div>
                                </div>
                                <div class="flex justify-start">
                                    <div class="max-w-[70%] bg-[#f0f4f0] dark:bg-[#2a3a2a] rounded-2xl rounded-tr-none px-5 py-3">
                                        <p>هل ممكن نعرف موعد النشاط الفني القادم بالتفصيل؟</p>
                                        <p class="text-xs text-[#638863] dark:text-[#a0b0a0] mt-1">10:20 ص</p>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <div class="max-w-[70%] bg-primary text-white rounded-2xl rounded-tl-none px-5 py-3">
                                        <p>بالطبع، النشاط الفني القادم يوم الأربعاء الساعة 10 صباحاً</p>
                                        <p class="text-xs text-white/80 mt-1">10:32 ص</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5 border-t border-[#dce5dc] dark:border-[#2a3a2a] flex items-center gap-3">
                                <button type="button" onclick="attachFileToMessage()" class="text-[#638863] dark:text-[#a0b0a0] hover:text-primary">
                                    <span class="material-symbols-outlined text-2xl">attach_file</span>
                                </button>
                                <input type="text" class="flex-1 bg-[#f0f4f0] dark:bg-[#2a3a2a] border-none rounded-xl px-5 py-3 focus:ring-0 placeholder:text-[#638863]" placeholder="اكتب رسالتك هنا..." />
                                <button type="button" onclick="sendChatMessage()" class="bg-primary text-white rounded-xl px-6 py-3 hover:brightness-105 transition-all">
                                    <span class="material-symbols-outlined">send</span>
                                </button>
                            </div>
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
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">groups</span>
            <span class="text-[10px]">الفصول</span>
        </button>
        <button class="size-12 rounded-full bg-primary text-white flex items-center justify-center -mt-8 border-4 border-[#f6f8f6] dark:border-background-dark shadow-lg">
            <span class="material-symbols-outlined">add</span>
        </button>
        <button class="flex flex-col items-center text-primary">
            <span class="material-symbols-outlined">chat_bubble</span>
            <span class="text-[10px]">الرسائل</span>
        </button>
        <button class="flex flex-col items-center text-[#638863]">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="text-[10px]">حسابي</span>
        </button>
    </div>

    <script src="{{ asset('js/teacher-functions.js') }}"></script>
</body>

</html>
