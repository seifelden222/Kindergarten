<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLevelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'teacher';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'children_count' => ['required', 'integer', 'min:0', 'max:99'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'accent_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'اسم الفصل مطلوب.',
            'children_count.required' => 'عدد الأطفال مطلوب.',
            'children_count.integer' => 'عدد الأطفال يجب أن يكون رقمًا صحيحًا.',
            'children_count.min' => 'عدد الأطفال لا يمكن أن يكون أقل من صفر.',
            'status.required' => 'حالة الفصل مطلوبة.',
            'accent_color.required' => 'لون الفصل مطلوب.',
            'accent_color.regex' => 'لون الفصل غير صالح.',
            'notes.max' => 'الوصف يجب ألا يزيد عن 1000 حرف.',
        ];
    }
}
