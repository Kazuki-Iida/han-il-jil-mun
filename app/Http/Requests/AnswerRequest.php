<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answer.body' => 'required|string|max:1000',
            'images_array.*.image' => 'image|mimes:jpeg,bmp,png,jpg',
        ];
    }
    
    public function messages()
    {
        return [
            'answer.body.required' => '質問内容を入力してください',
            'answer.body.string' => '質問内容は文字列で入力してください',
            'answer.body.max' => '質問内容は1000文字以内で入力してください',
        ];
    }
}
