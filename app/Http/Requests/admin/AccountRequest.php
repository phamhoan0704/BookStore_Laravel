<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
              
            'name' => 'required|unique:users',
            'pass' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:9|max:13'
            
        ];
    }
    public function messages()
    {
        return [ 
            'name.required'=>':attribute bắt buộc nhập',
            'name.required' => ':attribute không được để trống',
            'name.unique'=>':attribute đã tồn tại',
            'pass.required' => ':attribute không được để trống',
            'pass.min' => ':attribute tối thiểu phải có :min kí tự',
            'pass.max' => ':attribute tối đa :max kí tự',
            'pass.confirmed' => ':attribute không trùng khớp',
            'email.required' => ':attribute không được bỏ trống',
            'email.email' => ':attribute không hợp lệ',
            'email.unique'=>":attribute này đã tồn tại",
            'phone.required' => ':attribute không được bỏ trống',
            // 'phone.number'=>':attribute không hợp lệ',
            'phone.max' => ':attribute không hợp lệ',
            'phone.min' => ':attribute không hợp lệ'
        ];
    }
    public function attributes(){
        return [
        'name'=>'Tên đăng nhập',
        'pass'=>'Mật khẩu',
        'email'=>'Email',
        'phone'=>'Số điện thoại'
        ];
    }
}
