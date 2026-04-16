<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Known legitimate email domains.
     *
     * @var array<int, string>
     */
    protected array $allowedDomains = [
        'gmail.com', 'yahoo.com', 'yahoo.co.uk', 'yahoo.fr', 'yahoo.de',
        'outlook.com', 'hotmail.com', 'hotmail.co.uk', 'live.com', 'msn.com',
        'icloud.com', 'me.com', 'mac.com',
        'protonmail.com', 'proton.me',
        'aol.com', 'zoho.com',
        'edu.eg', 'gov.eg',
    ];

    protected function prepareForValidation(): void
    {
        if (! $this->filled('phone')) {
            return;
        }

        $phone = preg_replace('/[\s\-\(\)]/', '', (string) $this->input('phone'));

        $this->merge([
            'phone' => $phone,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class, function (string $attribute, mixed $value, \Closure $fail): void {
                $domain = strtolower(substr(strrchr($value, '@'), 1));
                if (! in_array($domain, $this->allowedDomains, true)) {
                    $fail('يرجى استخدام بريد إلكتروني من نطاق معروف مثل gmail.com أو outlook.com.');
                }
            }],
            'phone' => ['nullable', 'string', 'regex:/^\+?\d{10,15}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'الاسم يجب أن يحتوي على حروف فقط بدون أرقام أو رموز.',
            'phone.regex' => 'رقم الهاتف غير صالح. استخدم 10 إلى 15 رقمًا (يمكنك كتابة + في البداية).',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',
            'password.confirmed' => 'كلمة المرور وتأكيدها غير متطابقتين.',
        ];
    }
}
