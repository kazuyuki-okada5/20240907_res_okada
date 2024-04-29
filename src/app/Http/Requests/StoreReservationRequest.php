<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'store_id' => 'required|exists:stores,id',
            'date' => 'required|date',
            'time' => 'required',
            'num_people' => 'required|integer|min:1|max:20',
        ];
    }

    public function messages()
    {
        return[
            'store_id.exists' => '指定された店舗は存在しません',
            'date.required' => '日付は必須です',
            'date.date' => '日付の形式が不正です',
            'time.required' => '時間は必須です',
            'num_people.required' => '人数は必須です',
            'num_people.integer' => '人数は整数で入力してください',
            'num_people.min' => '人数は1以上で入力してください',
            'nau_people.max' => '人数は20以下で入力してください'
        ];
    }
}
