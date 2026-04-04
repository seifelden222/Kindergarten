<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>التواصل - نظام إدارة الحضانة</title>
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
        <x-parent-sidebar active="messages" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-6xl mx-auto p-8">

                <header class="flex flex-wrap justify-between items-center gap-6 mb-10">
                    <h2 class="text-3xl font-black tracking-tight">التواصل</h2>
                    <div class="flex gap-3">
                        <button class="px-5 py-2 bg-primary text-[#111811] rounded-xl text-sm font-bold hover:brightness-110 transition-colors shadow-lg shadow-primary/20 flex items-center gap-2">
                            <span class="material-symbols-outlined">edit</span>
                            <span>رسالة جديدة</span>
                        </button>
                    </div>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-1 bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md h-fit">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3 class="font-bold text-lg">المحادثات</h3>
                        </div>
                        <div class="divide-y divide-[#dce5dc] dark:divide-[#2d402d] max-h-[70vh] overflow-y-auto">
                            <a href="#" onclick="event.preventDefault(); switchChat('أ. سارة محمد', 'معلمة الصف التمهيدي أ', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80')" class="block p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors bg-primary/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80')"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium truncate">أ. سارة محمد</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] truncate">صباح الخير، بخصوص نشاط الرسم...</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-[#638863] dark:text-[#a3c2a3] block">منذ ٢٣ د</span>
                                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-primary text-white text-[10px] font-bold">٢</span>
                                    </div>
                                </div>
                            </a>

                            <a href="#" onclick="event.preventDefault(); switchChat('إدارة الحضانة', 'قسم الإدارة', 'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=800&auto=format&fit=crop&q=80')" class="block p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1552058544-f2b08422138a?w=800&auto=format&fit=crop&q=80')"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium truncate">إدارة الحضانة</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] truncate">تم تحديث جدول الأنشطة الشهري</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-[#638863] dark:text-[#a3c2a3] block">أمس</span>
                                    </div>
                                </div>
                            </a>

                            <a href="#" onclick="event.preventDefault(); switchChat('أ. نورا علي', 'معلمة النشاط', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&auto=format&fit=crop&q=80')" class="block p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&auto=format&fit=crop&q=80')"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium truncate">أ. نورا علي</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] truncate">عمر كان متعاوناً جداً اليوم</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-[#638863] dark:text-[#a3c2a3] block">الأحد</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-2 bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md flex flex-col h-[calc(100vh-12rem)]">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80')"></div>
                                <div>
                                    <p class="font-bold">أ. سارة محمد</p>
                                    <p class="text-xs text-[#638863] dark:text-[#a3c2a3]">معلمة الصف التمهيدي أ</p>
                                </div>
                            </div>
                            <button class="text-[#638863] dark:text-[#a3c2a3] hover:text-primary transition-colors">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </div>

                        <div class="flex-1 p-6 overflow-y-auto space-y-6">
                            <div class="flex items-start gap-4 max-w-3xl">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80')"></div>
                                <div class="flex-1">
                                    <div class="bg-gray-100 dark:bg-[#112111] rounded-2xl rounded-tr-none p-4">
                                        <p>صباح الخير أستاذ أحمد</p>
                                        <p class="mt-2">بخصوص رسم ليلى بالألوان المائية أمس، أريد أن أشاركك بعض الصور لعملها الرائع</p>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a3c2a3] mt-1 block">١٠:٤٢ ص</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 max-w-3xl flex-row-reverse">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCoNKPpXzXYSEFlvxulodXggbSdsxj0jHDD6aVOTiDJQRBElKwveAMc7giiWmqSnxi-S-OfILt2hkFl-eKa6MTGgvznUfckgigR_vu-XKy_8EP8IVi7EcyVofU1aOxwoSPuTjAsbu-SnPMxr4x6JloEp9utClJEQqqiRcGMxr_VZGM_k2RLIdCpWPGjzyCTUesuurXg6AsSZJb8OOmLDF1p4JHg_hPE7Ay0BxOtczfN42O9_JIZ37cKc29jM6Y5Sp11mv-pLaYmpkOW')"></div>
                                <div class="flex-1">
                                    <div class="bg-primary/10 rounded-2xl rounded-tl-none p-4">
                                        <p>صباح النور أستاذة سارة</p>
                                        <p class="mt-2">بالتأكيد، أنا متحمس لرؤية إبداعها 😊</p>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a3c2a3] mt-1 block text-right">١٠:٤٥ ص</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 max-w-3xl">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center flex-shrink-0" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&auto=format&fit=crop&q=80')"></div>
                                <div class="flex-1">
                                    <div class="bg-gray-100 dark:bg-[#112111] rounded-2xl rounded-tr-none p-4">
                                        <p>ها هي الصور:</p>
                                        <div class="flex gap-3 mt-3">
                                            <div class="w-24 h-24 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuByufOVs7TgM8TZAo-ile37dmmCDy9Q9457iyeiUZNlC-TEM8lBh7llUzU8ileO_Ggk68QWxa7yLf4goNkWyPXTF6SSULq6mhaN3mnalQ9zIdol3PS17gRzlTDhUI5I1pasHwY-G0ySAKTrNf9euBg-q4v80uzhL9F5ayHxLEW6eS2BUgmLXY25YYOZDsn-jtzF6HkGzMKZbYtd7EcEA-xWPik2UwXZRjJoHyY6AlqaPoyO1tNur7hMjjEqp0LDeFGcbIxd6MysLD61')"></div>
                                            <div class="w-24 h-24 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB3MUXutIQ3CMVkAgZkwnLBQIDCk-LjBh7bMq8UqUhS1Ti07Oa9pnYFnXYhYEYQF5G7MvFsgcW5FAbl5eHiw1yjrLihZ1HE4ovd4J-yna-ojgXg-bkwOTCtT4erjFecQ9mX0_deZaVCrHKxTAh3gm5xHcClG8QE6jZ_uUgUo5Plq2-AA8qrRpXzUaZ1UmougrBoNbDPI-9sNByVjL-_BTS3yLCFdYmXZswpNxXwUtASvvk3GDRcdIUILyaPJ5SuwJEGRFQpHcfgwXNH')"></div>
                                        </div>
                                    </div>
                                    <span class="text-xs text-[#638863] dark:text-[#a3c2a3] mt-1 block">١٠:٤٨ ص</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 border-t border-[#dce5dc] dark:border-[#2d402d] bg-gray-50/50 dark:bg-black/20">
                            <div class="flex items-center gap-3">
                                <button class="p-3 rounded-full hover:bg-gray-200 dark:hover:bg-white/10 transition-colors">
                                    <span class="material-symbols-outlined">attach_file</span>
                                </button>
                                <input type="text" placeholder="اكتب رسالتك هنا..." class="flex-1 px-4 py-3 bg-white dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <button class="p-3 bg-primary text-[#111811] rounded-full hover:brightness-110 transition-colors">
                                    <span class="material-symbols-outlined">send</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/parent-functions.js') }}"></script>
</body>

</html>