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
                        <p class="text-[#638863] dark:text-[#a3c2a3] text-lg">نظرة عامة على حالة أطفالك اليوم</p>
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
                        <div class="flex items-center gap-3 rounded-xl bg-primary/10 px-4 py-3 text-primary">
                            <span class="material-symbols-outlined">notifications</span>
                            <div>
                                <p class="font-bold">أحدث تحديثات أطفالك</p>
                                <p class="text-sm opacity-80">ستجد كل جديد في بطاقات الأطفال بالأسفل</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <span class="w-2 h-8 bg-primary rounded-full"></span>
                        أطفالي المسجلين
                    </h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2d402d] shadow-md flex">
                        <div class="w-1/3 bg-cover bg-center min-h-[220px]" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3F1cn_Lj-NAEWTmKaldBWztRMkempBo3FecUCHyOEqSzVwsxkI44tf0XxTfzqRmOfQTXLIPBtkIz0Qvu-9SAlR1WeqCwFcVKwgaEbcFKbdAwlHW6Octap_T4G6kbDwffRYApFpJHa4YaUcYnpNUW52MCJ3lvhNtOdQoqFozlI_E9jd5cvMrwRXz3Tfda9RQNUB0tW3-u-omTcS7roUGNFp1dywEO2JtD0qRvasEagNkrVG7XiiNVlmJuSvzTa3ZhstqOc9hPNrznh')"></div>
                        <div class="w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h4 class="text-xl font-bold">ليلى أحمد</h4>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">في الفصل</span>
                                </div>
                                <p class="text-[#638863] dark:text-[#a3c2a3] text-sm mb-4">المستوى: تمهيدي أول (أ)</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-primary text-lg">restaurant</span>
                                        <span>الوجبة: تناول غداءه بالكامل</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-primary text-lg">draw</span>
                                        <span>النشاط: رسم بالألوان المائية</span>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full py-2 bg-background-light dark:bg-[#112111] text-xs font-bold rounded-lg hover:bg-gray-200 transition-colors">عرض التقرير اليومي</button>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl overflow-hidden border border-[#dce5dc] dark:border-[#2d402d] shadow-md flex">
                        <div class="w-1/3 bg-cover bg-center min-h-[220px]" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDqIszTnJL1xxOpYnBoZA5MvMw3GAKt9E0Xxskj_rQLrt1Or4RXkvHJnf9iumqRX6tvVbVy4K2qZf7WrzsOz8AVRWlFsmLD-pklEaF6yYc6xlEgrHyjpUcw_FpZyMp-cwDsKMKpn-mqGdJ2s0d3bjPoB5S33sEQvcTwjiULoyUsxTH4jyoM9f-2NWERNv18zfGno7vtz1Uxbqkt9QFd2VBVmi2pRqHeKtaxmLTADE2UJygrmQqkFQ4grC2QdnmfbGIGbKgTGe0z7nBl')"></div>
                        <div class="w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h4 class="text-xl font-bold">عمر أحمد</h4>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">في الفصل</span>
                                </div>
                                <p class="text-[#638863] dark:text-[#a3c2a3] text-sm mb-4">المستوى: حضانة (ب)</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-primary text-lg">bedtime</span>
                                        <span>القيلولة: نام لمدة ٤٥ دقيقة</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-primary text-lg">mood</span>
                                        <span>المزاج: سعيد ومتفاعل</span>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full py-2 bg-background-light dark:bg-[#112111] text-xs font-bold rounded-lg hover:bg-gray-200 transition-colors">عرض التقرير اليومي</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden">
                    <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                        <h3 class="text-lg font-bold">آخر التحديثات والأنشطة</h3>
                        <span class="text-xs text-[#638863]">اليوم، ٢٤ أكتوبر</span>
                    </div>
                    <div class="p-6">
                        <div class="relative space-y-8 before:absolute before:right-4 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100 dark:before:bg-[#2d402d]">
                            <div class="relative flex gap-6 items-start pr-10">
                                <div class="absolute right-2 top-1 w-4 h-4 rounded-full bg-primary border-4 border-white dark:border-[#1a2e1a] z-10"></div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <p class="font-bold text-sm">ليلى أحمد - نشاط فني</p>
                                        <span class="text-[10px] text-[#638863]">منذ ٣٠ دقيقة</span>
                                    </div>
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mb-3">شاركت ليلى في صنع زهور من الورق الملون وأظهرت مهارة رائعة في استخدام المقص الآمن.</p>
                                    <div class="flex gap-2">
                                        <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuByufOVs7TgM8TZAo-ile37dmmCDy9Q9457iyeiUZNlC-TEM8lBh7llUzU8ileO_Ggk68QWxa7yLf4goNkWyPXTF6SSULq6mhaN3mnalQ9zIdol3PS17gRzlTDhUI5I1pasHwY-G0ySAKTrNf9euBg-q4v80uzhL9F5ayHxLEW6eS2BUgmLXY25YYOZDsn-jtzF6HkGzMKZbYtd7EcEA-xWPik2UwXZRjJoHyY6AlqaPoyO1tNur7hMjjEqp0LDeFGcbIxd6MysLD61')"></div>
                                        <div class="w-20 h-20 rounded-lg bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB3MUXutIQ3CMVkAgZkwnLBQIDCk-LjBh7bMq8UqUhS1Ti07Oa9pnYFnXYhYEYQF5G7MvFsgcW5FAbl5eHiw1yjrLihZ1HE4ovd4J-yna-ojgXg-bkwOTCtT4erjFecQ9mX0_deZaVCrHKxTAh3gm5xHcClG8QE6jZ_uUgUo5Plq2-AA8qrRpXzUaZ1UmougrBoNbDPI-9sNByVjL-_BTS3yLCFdYmXZswpNxXwUtASvvk3GDRcdIUILyaPJ5SuwJEGRFQpHcfgwXNH')"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex gap-6 items-start pr-10">
                                <div class="absolute right-2 top-1 w-4 h-4 rounded-full bg-primary border-4 border-white dark:border-[#1a2e1a] z-10"></div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <p class="font-bold text-sm">ملاحظة سلوكية - عمر أحمد</p>
                                        <span class="text-[10px] text-[#638863]">منذ ساعتين</span>
                                    </div>
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">عمر كان متعاوناً جداً اليوم في ترتيب الألعاب مع أصدقائه بعد وقت اللعب الحر.</p>
                                </div>
                            </div>
                        </div>
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
