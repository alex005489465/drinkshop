<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'name.required' => '請輸入姓名',
            'name.max' => '姓名不能超過255個字元',
            'email.required' => '請輸入電子郵件',
            'email.email' => '請輸入有效的電子郵件格式',
            'email.unique' => '此電子郵件已被使用',
            'password.required' => '請輸入密碼',
            'password.min' => '密碼至少需要8個字元',
            'password.confirmed' => '密碼確認不符',
        ];
    }
}
