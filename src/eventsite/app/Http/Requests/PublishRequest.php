<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'nullable|image',
            'body' => 'nullable',
            'start_date' => ['required', 'date', 'after:today', 'before_or_equal:'.now()->addYear()],
            'finish_date' => 'nullable|date|after:start_date',
            'situation' => 'required',
            'address' => 'required',
            'venue' => 'nullable',
            'category' => 'required',
            'tickets_name' => 'required',
            'tickets_name.*' => 'required',
            'tickets_fee.*' => 'required|integer|between:0,1000000',
            'tickets_amount.*' => 'required|integer|between:0,1000000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'イベント名称は必須です',
            'start_date.required' => '開始日時は必須です',
            'start_date.after' => '今日以降の日付を指定してください',
            'start_date.before_or_equal' => '1年以内の期間を指定してください',
            'finish_date.after:start_date' => '開始日時以降の日付を指定してください',
            'situation.required' => '開催方法は必須です',
            'address.required' => '開催場所は必須です',
            'category.required' => 'カテゴリーは必須です',
            'tickets_name.required' => '最低1つはチケットを設定してください',
            'tickets_name.*.required' => 'チケット名は必須です',
            'tickets_fee.*.required' => '金額は必須です',
            'tickets_fee.*.integer' => '金額は数値で指定してください',
            'tickets_fee.*.between' => '金額は0～1,000,000の間で指定してください',
            'tickets_amount.*.required' => '数量は必須です',
            'tickets_amount.*.integer' => '数量は数値で指定してください',
            'tickets_amount.*.between' => '金額は0～1,000,000の間で指定してください',
        ];
    }

}
