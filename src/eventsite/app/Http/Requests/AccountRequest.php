<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'nickname' => 'nullable|string',
            'image' => 'nullable|image',
            'email' => 'nullable|email',
            // 'password' => 'nullable|string|min:8|confirmed'
            //requestの中にpasswordがない場合、エラーになってしまう。
            //controllerの中に手でvalidationのコードを書く必要がありそう。
        ];
    }

    public function messages()
    {
        return [
            'nickname.string' => '文字列で入力してください',
            'email.email' => '正しいメールアドレスを入力してください',
            // 'password.min' => '8文字以上で設定してください',
            // 'password.confirmed' => 'パスワード確認と値が一致しません'
        ];
    }
}
