<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'guardian';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'child_id' => ['nullable', 'integer', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => ['required', 'string', 'in:card,bank_transfer,fawry'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'قيمة الدفع مطلوبة.',
            'amount.min' => 'قيمة الدفع يجب أن تكون أكبر من صفر.',
            'payment_method.required' => 'يرجى اختيار طريقة الدفع.',
            'payment_method.in' => 'طريقة الدفع المختارة غير مدعومة.',
        ];
    }
}
