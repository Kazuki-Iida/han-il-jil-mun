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
        ];
    }
}
