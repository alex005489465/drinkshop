<?php

namespace App\Shop\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
{
    /**
     * 判斷用戶是否有權限發起此請求
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 定義驗證規則
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'birthdate' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'id_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'user_email' => 'required|email|max:255',
            'backup_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'residential_address' => 'nullable|string|max:255',
            'mailing_address' => 'nullable|string|max:255'
        ];
    }

    /**
     * 定義錯誤訊息
     */
    public function messages(): array
    {
        return [
            'user_name.required' => '用戶名稱為必填項',
            'user_name.max' => '用戶名稱不能超過255個字符',
            'gender.in' => '性別必須是male或female',
            'birthdate.date' => '生日格式不正確',
            'user_email.required' => '電子郵件為必填項',
            'user_email.email' => '電子郵件格式不正確',
            'backup_email.email' => '備用電子郵件格式不正確'
        ];
    }
}