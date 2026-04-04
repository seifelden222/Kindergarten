<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>المالية - نظام إدارة الحضانة</title>
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
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav { background-color: #0ea60e; color: white !important; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <x-admin-slider />

        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark">
            <header class="sticky top-0 z-10 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-6 flex-1">
                    <h2 class="text-xl font-bold">المالية</h2>
                    <form method="GET" action="{{ route('admin.payment') }}" class="relative w-full max-w-md">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input name="q" value="{{ $search }}" class="w-full bg-zinc-100 dark:bg-zinc-800 border-none rounded-xl pr-10 pl-4 focus:ring-2 focus:ring-primary/50 text-sm py-2.5" placeholder="ابحث برقم المرجع أو الاسم..." type="text" />
                    </form>
                </div>
            </header>

            <div class="p-8 space-y-8">
                @if (session('status'))
                    <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                        <p class="font-bold">تعذر حفظ عملية الدفع.</p>
                        <ul class="mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm">
                        <p class="text-zinc-500 text-sm">إجمالي الإيرادات الشهرية</p>
                        <h3 class="text-3xl font-bold mt-2 text-primary">{{ number_format((float) $monthlyRevenue, 2) }} <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm">
                        <p class="text-zinc-500 text-sm">الرصيد الحالي</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format((float) $currentBalance, 2) }} <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm">
                        <p class="text-zinc-500 text-sm">المدفوعات المعلقة</p>
                        <h3 class="text-3xl font-bold mt-2 text-amber-600">{{ number_format((float) $pendingPayments, 2) }} <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm">
                        <p class="text-zinc-500 text-sm">الديون المتأخرة</p>
                        <h3 class="text-3xl font-bold mt-2 text-red-600">{{ number_format((float) $overdueDebts, 2) }} <span class="text-xl font-normal text-zinc-400">ج.م</span></h3>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-bold">إضافة عملية دفع</h4>
                            <p class="text-sm text-zinc-500 mt-1">يمكنك تسجيل دفعة جديدة مباشرة من لوحة الإدارة.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.payment.store', array_filter(['q' => $search])) }}" class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @csrf

                        <div>
                            <label class="block text-sm mb-1">ولي الأمر</label>
                            <select id="guardian_id" name="guardian_id" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                <option value="">اختر ولي الأمر</option>
                                @foreach ($guardians as $guardian)
                                    <option value="{{ $guardian->id }}" @selected(old('guardian_id') == $guardian->id)>{{ $guardian->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">الطفل</label>
                            <select id="child_id" name="child_id" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                <option value="">بدون طفل محدد</option>
                                @foreach ($children as $child)
                                    <option value="{{ $child->id }}" data-guardian-id="{{ $child->guardian_id }}" @selected(old('child_id') == $child->id)>{{ $child->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">المبلغ</label>
                            <input name="amount" type="number" min="1" step="0.01" value="{{ old('amount') }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                        </div>

                        <div>
                            <label class="block text-sm mb-1">طريقة الدفع</label>
                            <select name="payment_method" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                <option value="card" @selected(old('payment_method') === 'card')>بطاقة ائتمان / خصم</option>
                                <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>تحويل بنكي</option>
                                <option value="fawry" @selected(old('payment_method', 'fawry') === 'fawry')>فوري</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">نوع الحالة المالية</label>
                            <select id="payment_status" name="status" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                <option value="paid" @selected(old('status', 'paid') === 'paid')>مدفوع بالكامل</option>
                                <option value="pending" @selected(old('status') === 'pending')>معلق ولم يُسدَّد بعد</option>
                                <option value="overdue" @selected(old('status') === 'overdue')>متأخر وتجاوز موعد السداد</option>
                            </select>
                            <p id="payment-status-hint" class="mt-2 rounded-xl bg-zinc-50 px-3 py-2 text-xs text-zinc-600 dark:bg-zinc-800/60 dark:text-zinc-300"></p>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">تاريخ الدفع</label>
                            <input name="paid_at" type="date" value="{{ old('paid_at', now()->toDateString()) }}" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800" />
                        </div>

                        <div class="md:col-span-2 xl:col-span-3">
                            <label class="block text-sm mb-1">ملاحظات</label>
                            <textarea name="notes" rows="3" class="w-full rounded-xl border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">{{ old('notes') }}</textarea>
                        </div>

                        <div class="md:col-span-2 xl:col-span-3 flex justify-end">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:brightness-110">
                                <span class="material-symbols-outlined text-base">add_card</span>
                                <span>إضافة عملية الدفع</span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <h4 class="text-lg font-bold">جدول العمليات المالية</h4>
                        <span class="text-sm text-zinc-500">{{ $payments->total() }} عملية</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse">
                            <thead>
                                <tr class="bg-zinc-50 dark:bg-zinc-800/50">
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الطفل</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">ولي الأمر</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">طريقة الدفع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">المبلغ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">المرجع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">التاريخ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">الحالة</th>
                                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @forelse ($payments as $payment)
                                    @php
                                        $paymentMethodLabel = match ($payment->payment_method) {
                                            'card' => 'بطاقة ائتمان / خصم',
                                            'bank_transfer' => 'تحويل بنكي',
                                            'fawry' => 'فوري',
                                            default => $payment->payment_method,
                                        };

                                        $statusLabel = match ($payment->status) {
                                            'paid' => 'مدفوع',
                                            'pending' => 'معلق',
                                            'overdue' => 'متأخر',
                                            default => $payment->status,
                                        };

                                        $statusClasses = match ($payment->status) {
                                            'paid' => 'bg-green-100 text-green-700',
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'overdue' => 'bg-red-100 text-red-700',
                                            default => 'bg-zinc-100 text-zinc-700',
                                        };

                                        $amountClasses = match ($payment->status) {
                                            'paid' => 'text-green-600',
                                            'overdue' => 'text-red-600',
                                            default => 'text-amber-600',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium">{{ $payment->child?->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $payment->guardian?->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $paymentMethodLabel }}</td>
                                        <td class="px-6 py-4 text-sm font-bold {{ $amountClasses }}">{{ number_format((float) $payment->amount, 2) }} ج.م</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ $payment->reference }}</td>
                                        <td class="px-6 py-4 text-sm text-zinc-500">{{ optional($payment->paid_at)->format('Y-m-d') ?? optional($payment->created_at)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusClasses }}">{{ $statusLabel }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('admin.payment.destroy', ['payment' => $payment, 'q' => $search]) }}" onsubmit="return confirm('هل أنت متأكد من حذف عملية الدفع؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-700 hover:underline">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-8 text-center text-zinc-500">لا توجد بيانات مالية متاحة.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const guardianSelect = document.getElementById('guardian_id');
            const childSelect = document.getElementById('child_id');
            const paymentStatusSelect = document.getElementById('payment_status');
            const paymentStatusHint = document.getElementById('payment-status-hint');

            if (!guardianSelect || !childSelect) {
                return;
            }

            const childOptions = Array.from(childSelect.querySelectorAll('option[data-guardian-id]'));
            const statusDescriptions = {
                paid: 'مدفوع بالكامل: استخدمه عندما تكون العملية مسددة فعلاً وتم استلام المبلغ.',
                pending: 'معلق: استخدمه عندما تكون العملية مسجلة لكن السداد لم يتم بعد أو ما زال بانتظار التأكيد.',
                overdue: 'متأخر: استخدمه عندما انتهى موعد السداد وما زالت العملية غير مدفوعة.',
            };

            function filterChildrenByGuardian() {
                const guardianId = guardianSelect.value;

                childOptions.forEach(function (option) {
                    const isVisible = guardianId === '' || option.dataset.guardianId === guardianId;
                    option.hidden = !isVisible;

                    if (!isVisible && option.selected) {
                        childSelect.value = '';
                    }
                });
            }

            function updatePaymentStatusHint() {
                if (!paymentStatusSelect || !paymentStatusHint) {
                    return;
                }

                paymentStatusHint.textContent = statusDescriptions[paymentStatusSelect.value] ?? '';
            }

            guardianSelect.addEventListener('change', filterChildrenByGuardian);
            paymentStatusSelect?.addEventListener('change', updatePaymentStatusHint);
            filterChildrenByGuardian();
            updatePaymentStatusHint();
        });
    </script>
</body>

</html>
