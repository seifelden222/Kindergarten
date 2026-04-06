<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherActivityRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'activity_type' => ['required', Rule::in(['art', 'sport', 'music', 'reading', 'science'])],
            'description' => ['required', 'string', 'max:2000'],
            'activity_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:480'],
            'activity_image' => ['nullable', 'image', 'max:4096'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'عنوان النشاط مطلوب.',
            'name.max' => 'عنوان النشاط طويل جداً.',
            'activity_type.required' => 'نوع النشاط مطلوب.',
            'activity_type.in' => 'نوع النشاط غير صحيح.',
            'description.required' => 'وصف النشاط مطلوب.',
            'description.max' => 'وصف النشاط طويل جداً.',
            'activity_time.required' => 'وقت النشاط مطلوب.',
            'activity_time.date_format' => 'وقت النشاط غير صحيح.',
            'duration_minutes.required' => 'مدة النشاط مطلوبة.',
            'duration_minutes.integer' => 'مدة النشاط يجب أن تكون رقماً.',
            'duration_minutes.min' => 'مدة النشاط يجب أن تكون دقيقة واحدة على الأقل.',
            'duration_minutes.max' => 'مدة النشاط كبيرة جداً.',
            'activity_image.image' => 'الصورة المرفقة غير صالحة.',
            'activity_image.max' => 'حجم الصورة كبير جداً.',
        ];
    }
}
