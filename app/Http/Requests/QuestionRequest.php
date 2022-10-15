<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question.title' => 'required|string|max:50',
            'question.body' => 'required|string|max:1000',
            'question.category_id' => 'required',
            'question.country_id' => 'required',
            'images_array.*.image' => 'image|mimes:jpeg,bmp,png,jpg|max:10240',
            'images_array' => 'array|max:4',
        ];
    }
    
    public function messages()
    {
        return [
            'question.title.required' => 'タイトルを入力してください',
            'question.title.string' => 'タイトルは文字列で入力してください',
            'question.title.max' => 'タイトルは50文字以内で入力してください',
            'question.body.required' => '質問内容を入力してください',
            'question.body.string' => '質問内容は文字列で入力してください',
            'question.body.max' => '質問内容は1000文字以内で入力してください',
            'question.category_id.required' => 'カテゴリーを選択してください',
            'question.country_id.required' => 'どちらの国に関する質問か選んでください',
            'images_array.max' => '画像は4つまで添付することができます',
        ];
    }
}
