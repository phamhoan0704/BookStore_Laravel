<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>':attribute bắt buộc nhập',
            'phone.required'=>':attribute bắt buộc nhập',
            'email.required'=>':attribute bắt buộc nhập',
            'email.regex'=>':attribute không đúng định dạng',
            'address.required'=>':attribute bắt buộc nhập',
        ];
    }
    public function attributes(){
        return [
        'name'=>'Tên người nhận',
        'phone'=>'Số điện thoại',
        'email'=>'Email',
        'address'=>'Địa chỉ',
        ];
    }
    
}
