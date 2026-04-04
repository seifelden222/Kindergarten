<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>دفع الرسوم - نظام إدارة الحضانة</title>
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
<x-parent-sidebar active="payment" />
        <main class="flex-1 overflow-y-auto scroll-smooth">
            <div class="max-w-5xl mx-auto p-8">
                @php
                    $children = auth()->user()?->children()->where('role', 'child')->orderBy('name')->get() ?? collect();
                @endphp

                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                <header class="flex flex-wrap justify-between items-center gap-6 mb-12">
                    <h2 class="text-3xl font-black tracking-tight">دفع الرسوم</h2>
                    <div class="flex gap-3">
                        <button id="payment-history-button" type="button" class="px-5 py-2 bg-white dark:bg-[#1a2e1a] border border-[#dce5dc] dark:border-[#2d402d] rounded-xl text-sm font-bold hover:bg-gray-50 dark:hover:bg-white/10 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined">history</span>
                            سجل الدفعات
                        </button>
                    </div>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-7 mb-12">

                    <div class="lg:col-span-2 space-y-8">

                        <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                            <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d] flex items-center justify-between">
                                <h3 class="text-xl font-bold">الفاتورة الحالية - الفصل الدراسي الثاني</h3>
                                <span class="text-sm font-medium text-[#638863] dark:text-[#a3c2a3]">يناير - يونيو 2026</span>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-sm text-[#638863] dark:text-[#a3c2a3]">الرسوم الشهرية</p>
                                        <p class="text-2xl font-black">1,850 ج.م</p>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-[#dce5dc] dark:border-[#2d402d]">
                                    <div class="flex justify-between text-lg mb-2">
                                        <span>إجمالي الرسوم الشهرية</span>
                                        <span class="font-bold">3,700 ج.م</span>
                                    </div>
                                    <div class="flex justify-between text-lg mb-2">
                                        <span>خصم الدفع المبكر (10%)</span>
                                        <span class="text-green-600 dark:text-green-400 font-bold">-370 ج.م</span>
                                    </div>
                                    <div class="flex justify-between text-xl pt-3 border-t border-[#dce5dc] dark:border-[#2d402d]">
                                        <span class="font-bold">المبلغ المستحق</span>
                                        <span class="text-2xl font-black text-primary">3,330 ج.م</span>
                                    </div>
                                </div>

                                <div class="pt-6">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 text-2xl">schedule</span>
                                        <p class="text-lg font-medium text-amber-700 dark:text-amber-300">آخر موعد للدفع بدون غرامة: ١٥ أبريل ٢٠٢٦</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md">
                            <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                                <h3 class="text-xl font-bold">طرق الدفع المتاحة</h3>
                            </div>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="border border-[#dce5dc] dark:border-[#2d402d] rounded-xl p-5 text-center hover:border-primary transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-3xl text-primary mb-3">credit_card</span>
                                    <p class="font-bold">بطاقة ائتمان / خصم</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-1">فيزا - ماستركارد</p>
                                </div>
                                <div class="border border-[#dce5dc] dark:border-[#2d402d] rounded-xl p-5 text-center hover:border-primary transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-3xl text-primary mb-3">account_balance</span>
                                    <p class="font-bold">تحويل بنكي</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-1">بنك مصر / البنك الأهلي</p>
                                </div>
                                <div class="border border-[#dce5dc] dark:border-[#2d402d] rounded-xl p-5 text-center hover:border-primary transition-colors cursor-pointer bg-primary/5">
                                    <span class="material-symbols-outlined text-3xl text-primary mb-3">qr_code_2</span>
                                    <p class="font-bold">فوري / كروت الدفع</p>
                                    <p class="text-sm text-[#638863] dark:text-[#a3c2a3] mt-1">الأكثر استخداماً</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="bg-white dark:bg-[#1a2e1a] rounded-2xl border border-[#dce5dc] dark:border-[#2d402d] overflow-hidden shadow-md h-fit">
                        <div class="p-6 border-b border-[#dce5dc] dark:border-[#2d402d]">
                            <h3 class="text-xl font-bold">ملخص الحساب</h3>
                        </div>
                        <form class="p-6 space-y-6" method="POST" action="{{ route('parent.payment.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#638863] dark:text-[#a3c2a3]">رصيد المحفظة</span>
                                    <span class="font-bold text-green-600 dark:text-green-400">٢٨٠ ج.م</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-[#638863] dark:text-[#a3c2a3]">المستحق السابق</span>
                                    <span class="font-bold">0 ج.م</span>
                                </div>
                                <div class="flex justify-between text-sm pt-3 border-t border-[#dce5dc] dark:border-[#2d402d]">
                                    <span class="font-medium">المبلغ المطلوب الدفع الآن</span>
                                    <span class="text-xl font-black text-primary">3,050 ج.م</span>
                                </div>
                            </div>

                            <div class="space-y-4 pt-2">
                                <div>
                                    <label class="mb-2 block text-sm font-medium">الطفل المرتبط بالدفع</label>
                                    <select name="child_id" class="w-full rounded-xl border border-[#dce5dc] bg-background-light px-4 py-3 dark:border-[#2d402d] dark:bg-[#112111] focus:outline-none focus:ring-2 focus:ring-primary/50">
                                        <option value="">الدفع لكل الأطفال / الفاتورة العامة</option>
                                        @foreach ($children as $child)
                                            <option value="{{ $child->id }}" @selected(old('child_id') == $child->id)>{{ $child->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('child_id')" class="mt-2 text-sm text-red-600" />
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium">المبلغ المدفوع</label>
                                    <input type="number" name="amount" min="1" step="0.01" value="{{ old('amount', '3050') }}" class="w-full rounded-xl border border-[#dce5dc] bg-background-light px-4 py-3 dark:border-[#2d402d] dark:bg-[#112111] focus:outline-none focus:ring-2 focus:ring-primary/50">
                                    <x-input-error :messages="$errors->get('amount')" class="mt-2 text-sm text-red-600" />
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium">طريقة الدفع</label>
                                    <select name="payment_method" class="w-full rounded-xl border border-[#dce5dc] bg-background-light px-4 py-3 dark:border-[#2d402d] dark:bg-[#112111] focus:outline-none focus:ring-2 focus:ring-primary/50">
                                        <option value="card" @selected(old('payment_method') === 'card')>بطاقة ائتمان / خصم</option>
                                        <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>تحويل بنكي</option>
                                        <option value="fawry" @selected(old('payment_method', 'fawry') === 'fawry')>فوري / كروت الدفع</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('payment_method')" class="mt-2 text-sm text-red-600" />
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-medium">ملاحظات إضافية</label>
                                    <textarea name="notes" rows="3" class="w-full rounded-xl border border-[#dce5dc] bg-background-light px-4 py-3 dark:border-[#2d402d] dark:bg-[#112111] focus:outline-none focus:ring-2 focus:ring-primary/50">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full py-4 bg-primary text-[#111811] font-bold text-lg rounded-xl hover:brightness-110 transition-colors shadow-lg shadow-primary/30">
                                    دفع ٣,٠٥٠ ج.م الآن
                                </button>
                            </div>

                        </form>
                    </div>

                </div>

                <div class="text-center py-8 text-[#638863] dark:text-[#a3c2a3] text-sm">
                    جميع عمليات الدفع محمية بتشفير SSL • تدعم البطاقات المحلية والدولية
                </div>

            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const historyButton = document.getElementById('payment-history-button');

            if (historyButton) {
                historyButton.addEventListener('click', showPaymentHistory);
            }
        });
    </script>
    <script src="{{ asset('js/parent-functions.js') }}"></script>

</body>

</html>
