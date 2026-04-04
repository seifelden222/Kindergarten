<?php

namespace App\Http\Requests;

use App\Models\Level;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherReportRequest extends FormRequest
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
            'report_type' => ['required', Rule::in(['daily', 'weekly', 'monthly', 'activity'])],
            'level_id' => [
                'required',
                'integer',
                Rule::exists(Level::class, 'id')->where(fn ($query) => $query->where('user_id', $this->user()?->id)),
            ],
            'report_date' => ['required', 'date'],
            'content' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'report_type.required' => 'نوع التقرير مطلوب.',
            'report_type.in' => 'نوع التقرير غير صحيح.',
            'level_id.required' => 'الفصل مطلوب.',
            'level_id.exists' => 'الفصل المختار غير متاح لك.',
            'report_date.required' => 'تاريخ التقرير مطلوب.',
            'report_date.date' => 'تاريخ التقرير غير صحيح.',
            'content.required' => 'محتوى التقرير مطلوب.',
            'content.max' => 'محتوى التقرير طويل جداً.',
        ];
    }
}
