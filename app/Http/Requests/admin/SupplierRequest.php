<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        $id=$this->segment(4);
        return [
            'supplier_name'=>'required|min:2|unique:categories,category_name,'.$id,
            // 'supplier_phone'=>'required',
            // 'supplier_address'=>'required',     
        ];
    }
    
    public function messages()
    {
        return [
            'supplier_name.required'=>':attribute bắt buộc nhập',
            'supplier_name.min'=>':attribute phải từ :min kí tự trở lên',
            'supplier_name.unique'=>':attribute không được trùng lặp',
            'supplier_phone.required'=>':attribute bắt buộc nhập',
            'supplier_address.required'=>':attribute bắt buộc nhập',

        ];
    }
    public function attributes(){
        return [
        'supplier_name'=>'Tên nhà cung cấp',
        'supplier_phone'=>'Số điện thoại',
        'supplier_address'=>'Địa chỉ',
        ];
    }
}
