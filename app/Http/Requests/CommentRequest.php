<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment.body' => 'required|string|max:1000',
            'images_array.*.image' => 'image|mimes:jpeg,bmp,png,jpg|max:10240',
            'images_array' => 'array|max:4',
        ];
    }
    
    public function messages()
    {
        return [
            'comment.body.required' => 'コメントを入力してください',
            'comment.body.string' => 'コメントは文字列で入力してください',
            'comment.body.max' => 'コメントは1000文字以内で入力してください',
            'images_array.max' => '画像は4つまで添付することができます',
        ];
    }
}
