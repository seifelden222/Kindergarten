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

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 mb-12">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <h3 class="font-bold text-lg">ليلى أحمد - تمهيدي أول (أ)</h3>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">الأسبوع الحالي</span>
                        </div>
                        <div class="divide-y divide-[#dce5dc] dark:divide-[#2d402d]">
                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">رسم بالألوان المائية</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الأحد ٢٤ أكتوبر • ١١:٣٠ ص</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                                </div>
                                <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-3">أظهرت مهارة ممتازة في المزج بين الألوان وإبداع تصميم زهور مختلفة.</p>
                                <div class="flex gap-3">
                                    <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuByufOVs7TgM8TZAo-ile37dmmCDy9Q9457iyeiUZNlC-TEM8lBh7llUzU8ileO_Ggk68QWxa7yLf4goNkWyPXTF6SSULq6mhaN3mnalQ9zIdol3PS17gRzlTDhUI5I1pasHwY-G0ySAKTrNf9euBg-q4v80uzhL9F5ayHxLEW6eS2BUgmLXY25YYOZDsn-jtzF6HkGzMKZbYtd7EcEA-xWPik2UwXZRjJoHyY6AlqaPoyO1tNur7hMjjEqp0LDeFGcbIxd6MysLD61')"></div>
                                    <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB3MUXutIQ3CMVkAgZkwnLBQIDCk-LjBh7bMq8UqUhS1Ti07Oa9pnYFnXYhYEYQF5G7MvFsgcW5FAbl5eHiw1yjrLihZ1HE4ovd4J-yna-ojgXg-bkwOTCtT4erjFecQ9mX0_deZaVCrHKxTAh3gm5xHcClG8QE6jZ_uUgUo5Plq2-AA8qrRpXzUaZ1UmougrBoNbDPI-9sNByVjL-_BTS3yLCFdYmXZswpNxXwUtASvvk3GDRcdIUILyaPJ5SuwJEGRFQpHcfgwXNH')"></div>
                                </div>
                            </div>

                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">قصة قبل النوم الجماعية</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الثلاثاء ٢٦ أكتوبر • ١:١٥ م</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                                </div>
                                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">شاركت بنشاط وأضافت تعليقات جميلة على أحداث القصة.</p>
                            </div>

                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">ألعاب حركية في الحديقة</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الأربعاء ٢٧ أكتوبر • ١٠:٤٥ ص</p>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-xs font-bold rounded-full">غائبة</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                        <div class="p-5 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                            <h3 class="font-bold text-lg">عمر أحمد - حضانة (ب)</h3>
                            <span class="text-xs text-[#638863] dark:text-[#a3c2a3]">الأسبوع الحالي</span>
                        </div>
                        <div class="divide-y divide-[#dce5dc] dark:divide-[#2d402d]">
                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">بناء أبراج بالمكعبات</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الإثنين ٢٥ أكتوبر • ٩:٣٠ ص</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                                </div>
                                <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-3">أبدع في بناء برج شاهق وشارك زملاءه في اللعب الجماعي.</p>
                                <div class="flex gap-3 mt-3">
                                    <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1587654780291-39c9404d746b?w=800&auto=format&fit=crop&q=80')"></div>
                                </div>
                            </div>

                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">أغنية وإيقاع جماعي</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الثلاثاء ٢٦ أكتوبر • ١١:٠٠ ص</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">مكتمل</span>
                                </div>
                                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">كان متحمساً جداً وردد الكلمات بصوت عالٍ.</p>
                            </div>

                            <div class="p-5 hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold">زراعة بذور الفاصوليا</p>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-0.5">الخميس ٢٨ أكتوبر • ١٠:١٥ ص</p>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 text-xs font-bold rounded-full">قيد التنفيذ</span>
                                </div>
                                <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">وضع البذور في التربة وسقاها بنفسه بحماس.</p>
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