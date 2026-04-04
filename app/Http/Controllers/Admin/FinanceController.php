<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminPaymentRequest;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FinanceController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));

        $payments = Payment::query()
            ->with(['guardian:id,name', 'child:id,name'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('reference', 'like', "%{$search}%")
                        ->orWhere('payment_method', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhereHas('guardian', function ($guardianQuery) use ($search) {
                            $guardianQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('child', function ($childQuery) use ($search) {
                            $childQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('paid_at')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $monthlyRevenue = Payment::query()
            ->where('status', 'paid')
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $currentBalance = Payment::query()
            ->where('status', 'paid')
            ->sum('amount');

        $pendingPayments = Payment::query()
            ->where('status', 'pending')
            ->sum('amount');

        $overdueDebts = Payment::query()
            ->where('status', 'overdue')
            ->sum('amount');

        $guardians = User::query()
            ->where('role', 'guardian')
            ->orderBy('name')
            ->get(['id', 'name']);

        $children = User::query()
            ->where('role', 'child')
            ->orderBy('name')
            ->get(['id', 'name', 'guardian_id']);

        return view('admin.payment', [
            'payments' => $payments,
            'search' => $search,
            'monthlyRevenue' => $monthlyRevenue,
            'currentBalance' => $currentBalance,
            'pendingPayments' => $pendingPayments,
            'overdueDebts' => $overdueDebts,
            'guardians' => $guardians,
            'children' => $children,
        ]);
    }

    public function store(StoreAdminPaymentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $guardian = User::query()
            ->whereKey($validated['guardian_id'])
            ->where('role', 'guardian')
            ->first();

        if (! $guardian) {
            throw ValidationException::withMessages([
                'guardian_id' => 'المستخدم المختار ليس ولي أمر.',
            ]);
        }

        $childId = $validated['child_id'] ?? null;

        if ($childId !== null && ! $guardian->children()->whereKey($childId)->exists()) {
            throw ValidationException::withMessages([
                'child_id' => 'الطفل المختار لا يتبع ولي الأمر المحدد.',
            ]);
        }

        $status = $validated['status'];
        $paidAt = $validated['paid_at'] ?? null;

        Payment::create([
            'guardian_id' => $guardian->id,
            'child_id' => $childId,
            'amount' => $validated['amount'],
            'status' => $status,
            'payment_method' => $validated['payment_method'],
            'reference' => 'PAY-'.strtoupper((string) str()->random(10)),
            'notes' => $validated['notes'] ?: null,
            'paid_at' => $status === 'paid' ? ($paidAt ?: now()) : $paidAt,
        ]);

        return redirect()
            ->route('admin.payment', array_filter([
                'q' => $request->query('q'),
            ]))
            ->with('status', 'تمت إضافة عملية الدفع بنجاح.');
    }

    public function destroy(Request $request, Payment $payment): RedirectResponse
    {
        $paymentReference = $payment->reference;
        $payment->delete();

        return redirect()
            ->route('admin.payment', array_filter([
                'q' => $request->query('q'),
            ]))
            ->with('status', "تم حذف عملية الدفع {$paymentReference} بنجاح.");
    }
}
