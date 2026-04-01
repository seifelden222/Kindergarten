<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female'],
            'birth_date' => ['required', 'date', 'after_or_equal:'.now()->subYears(12)->toDateString(), 'before:today'],
            'level_name' => ['required', 'string', 'max:255'],
            'classroom_name' => ['required', 'string', 'max:255'],
            'allergies' => ['nullable', 'string', 'max:1000'],
            'chronic_diseases' => ['nullable', 'string', 'max:255'],
            'medications' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'يرجى إدخال الاسم الأول للطفل.',
            'last_name.required' => 'يرجى إدخال اسم العائلة للطفل.',
            'gender.required' => 'يرجى اختيار الجنس.',
            'birth_date.required' => 'يرجى إدخال تاريخ الميلاد.',
            'birth_date.after_or_equal' => 'تاريخ الميلاد غير مناسب لطفل في مرحلة الحضانة.',
            'birth_date.before' => 'تاريخ الميلاد يجب أن يكون قبل اليوم.',
            'level_name.required' => 'يرجى اختيار المستوى الدراسي.',
            'classroom_name.required' => 'يرجى اختيار الفصل.',
        ];
    }
}
