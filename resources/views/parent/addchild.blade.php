<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إضافة طفل - نظام إدارة الحضانة</title>
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
        <x-parent-sidebar active-page="addchild" />

        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-4xl mx-auto p-8">

                <header class="mb-12">
                    <h2 class="text-3xl font-black tracking-tight mb-3">إضافة طفل جديد</h2>
                    <p class="text-[#638863] dark:text-[#a3c2a3] text-lg">أدخل بيانات الطفل لتسجيله في النظام</p>
                </header>

                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] shadow-md overflow-hidden">

                    <div class="p-8 border-b border-[#dce5dc] dark:border-[#2d402d] bg-gray-50/50 dark:bg-black/10">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary text-4xl">person_add</span>
                            <div>
                                <h3 class="text-2xl font-bold">معلومات الطفل الأساسية</h3>
                                <p class="text-[#638863] dark:text-[#a3c2a3]">البيانات المطلوبة لتسجيل الطفل</p>
                            </div>
                        </div>
                    </div>

                    <form class="p-8 space-y-10" method="POST" action="{{ route('parent.addchild.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-7">

                            <div>
                                <label class="block text-sm font-medium mb-2">الاسم الأول <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="مثال: ليلى" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">اسم العائلة <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="مثال: أحمد" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">البريد الإلكتروني للطفل <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="child@example.com" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">الجنس <span class="text-red-500">*</span></label>
                                <select name="gender" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    <option value="">اختر الجنس</option>
                                    <option value="female" @selected(old('gender') === 'female')>أنثى</option>
                                    <option value="male" @selected(old('gender') === 'male')>ذكر</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">تاريخ الميلاد <span class="text-red-500">*</span></label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <x-input-error :messages="$errors->get('birth_date')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">المستوى الدراسي <span class="text-red-500">*</span></label>
                                <select name="level_name" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    <option value="">اختر المستوى</option>
                                    <option value="حضانة (أ)" @selected(old('level_name') === 'حضانة (أ)')>حضانة (أ)</option>
                                    <option value="حضانة (ب)" @selected(old('level_name') === 'حضانة (ب)')>حضانة (ب)</option>
                                    <option value="تمهيدي أول (أ)" @selected(old('level_name') === 'تمهيدي أول (أ)')>تمهيدي أول (أ)</option>
                                    <option value="تمهيدي أول (ب)" @selected(old('level_name') === 'تمهيدي أول (ب)')>تمهيدي أول (ب)</option>
                                    <option value="تمهيدي ثاني" @selected(old('level_name') === 'تمهيدي ثاني')>تمهيدي ثاني</option>
                                </select>
                                <x-input-error :messages="$errors->get('level_name')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">الفصل <span class="text-red-500">*</span></label>
                                <select name="classroom_name" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    <option value="">اختر الفصل</option>
                                    <option value="الفصل أ" @selected(old('classroom_name') === 'الفصل أ')>الفصل أ</option>
                                    <option value="الفصل ب" @selected(old('classroom_name') === 'الفصل ب')>الفصل ب</option>
                                    <option value="الفصل ج" @selected(old('classroom_name') === 'الفصل ج')>الفصل ج</option>
                                </select>
                                <x-input-error :messages="$errors->get('classroom_name')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">كلمة المرور للطفل <span class="text-red-500">*</span></label>
                                <input type="password" name="password" placeholder="8 أحرف أو أكثر" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">تأكيد كلمة المرور <span class="text-red-500">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="أعد كتابة كلمة المرور" required class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                            </div>

                        </div>

                        <div class="pt-6 border-t border-[#dce5dc] dark:border-[#2d402d]">
                            <h4 class="text-lg font-bold mb-5 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">health_and_safety</span>
                                معلومات صحية مهمة
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-2">هل يعاني الطفل من أي حساسية غذائية أو دوائية؟</label>
                                    <textarea name="allergies" placeholder="اكتب التفاصيل إن وجدت (مثال: حساسية من الفول السوداني - حساسية من البنسلين)" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 min-h-[90px]">{{ old('allergies') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-2">هل يوجد أمراض مزمنة؟</label>
                                    <input type="text" name="chronic_diseases" value="{{ old('chronic_diseases') }}" placeholder="مثال: الربو، السكري..." class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-2">الأدوية الدورية (إن وجدت)</label>
                                    <input type="text" name="medications" value="{{ old('medications') }}" placeholder="مثال: بخاخ الربو مرتين يومياً" class="w-full px-4 py-3 bg-background-light dark:bg-[#112111] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                                </div>

                            </div>
                        </div>

                        <div class="pt-8 border-t border-[#dce5dc] dark:border-[#2d402d] flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('parent.parentdashboard') }}" class="px-8 py-3 bg-gray-200 dark:bg-[#2d402d] text-center text-[#111811] dark:text-white font-bold rounded-xl hover:bg-gray-300 dark:hover:bg-[#3a523a] transition-colors order-2 sm:order-1">
                                إلغاء
                            </a>
                            <button type="submit" class="px-10 py-3 bg-primary text-[#111811] font-bold rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/30 order-1 sm:order-2">
                                إضافة الطفل
                            </button>
                        </div>

                    </form>

                </div>

                <div class="mt-10 text-center text-sm text-[#638863] dark:text-[#a3c2a3]">
                    بعد إضافة الطفل سيتم مراجعة البيانات من قبل إدارة الحضانة خلال ٤٨ ساعة عمل
                </div>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/parent-functions.js') }}"></script>
</body>

</html>
