<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // Chuẩn hóa dữ liệu trước khi validate
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => strtolower(trim($this->email)),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\pL\s]+$/u'
            ],

            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
                // 'regex:/^[^\s<>"]+@[^\s<>"]+\.[^\s<>"]+$/'
            ],

            'password' => [
                'required',
                'string',
                // 'min:8',
                'max:50',
                'regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=]*$/',
                'confirmed',
                Password::min(8)
                    ->numbers()
            ],
        ];
    }

    public function messages(): array
    {
        return [

            // Name
            'name.required' => 'Bạn chưa nhập tên.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.min' => 'Tên phải có ít nhất 2 ký tự.',
            'name.max' => 'Tên không được vượt quá 100 ký tự.',
            'name.regex' => 'Tên chỉ được chứa chữ và khoảng trắng.',

            // Email
            'email.required' => 'Bạn chưa nhập email.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã được sử dụng.',
            // 'email.regex' => 'Email chứa ký tự không hợp lệ.',

            // Password
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 50 ký tự.',
            'password.regex' => 'Mật khẩu chứa ký tự không hợp lệ.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ];
    }
}
