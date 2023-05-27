<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
            'ticket_id' => 'required',
            'payment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ticket_id.required' => '申し込むチケットを選択してください',
            'start_date.required' => '決済方法を選択してください',
        ];
    }
}
