<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'author_name'=>'required',   
        ];
    }
    public function messages()
    {
        return [
            'author_name.required'=>':attribute bắt buộc nhập',
        ];
    }
    public function attributes(){
        return [
        'author_name'=>'Tên tác giả',
        ];
    }
}
