<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * 確定使用者是否有權限執行此請求
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 取得應用到此請求的驗證規則
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * 取得已定義驗證規則的錯誤訊息
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => '請輸入電子郵件',
            'email.email' => '請輸入有效的電子郵件格式',
            'password.required' => '請輸入密碼'
        ];
    }
}
