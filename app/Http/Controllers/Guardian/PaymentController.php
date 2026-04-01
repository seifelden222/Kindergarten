<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $guardian = $request->user();
        $childId = $validated['child_id'] ?? null;

        if ($childId !== null && ! $guardian->children()->whereKey($childId)->exists()) {
            throw ValidationException::withMessages([
                'child_id' => 'الطفل المختار لا يتبع حساب ولي الأمر الحالي.',
            ]);
        }

        Payment::create([
            'guardian_id' => $guardian->id,
            'child_id' => $childId,
            'amount' => $validated['amount'],
            'status' => 'paid',
            'payment_method' => $validated['payment_method'],
            'reference' => 'PAY-'.strtoupper((string) str()->random(10)),
            'notes' => $validated['notes'] ?: null,
            'paid_at' => now(),
        ]);

        return redirect()
            ->route('parent.payment')
            ->with('status', 'تم تسجيل عملية الدفع في قاعدة البيانات بنجاح.');
    }
}
