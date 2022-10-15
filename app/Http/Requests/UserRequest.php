<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'user.name' => 'required|string|max:50',
            'user.profile' => 'max:200',
            'user.*.profile_image' => 'image|mimes:jpeg,bmp,png,jpg|max:10240',
        ];
    }
    
    
    public function messages()
    {
        return [
            'user.name.required' => 'ユーザーネームを入力してください',
            'user.name.max' => 'ユーザーネームは50文字以内で入力してください',
            'user.profile.string' => 'プロフィールは文字列で入力してください',
            'user.profile.max' => 'プロフィールは200文字以内で入力してください',
        ];
    }
}
