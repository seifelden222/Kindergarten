<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guardian_id' => ['required', 'integer', 'exists:users,id'],
            'child_id' => ['nullable', 'integer', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => ['required', 'string', 'in:card,bank_transfer,fawry'],
            'status' => ['required', 'string', 'in:paid,pending,overdue'],
            'paid_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'guardian_id.required' => 'يرجى اختيار ولي الأمر.',
            'guardian_id.exists' => 'ولي الأمر المختار غير موجود.',
            'child_id.exists' => 'الطفل المختار غير موجود.',
            'amount.required' => 'قيمة الدفع مطلوبة.',
            'amount.min' => 'قيمة الدفع يجب أن تكون أكبر من صفر.',
            'payment_method.required' => 'يرجى اختيار طريقة الدفع.',
            'payment_method.in' => 'طريقة الدفع المختارة غير مدعومة.',
            'status.required' => 'حالة الدفعة مطلوبة.',
            'status.in' => 'حالة الدفعة غير صحيحة.',
            'paid_at.date' => 'تاريخ الدفع غير صحيح.',
        ];
    }
}
