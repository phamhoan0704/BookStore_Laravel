<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            
            'category_name'=>'required|min:2|unique:categories,category_name,'.$id,
            
            // 'category_name'=>[
            //     'required',
            //     Rule::unique('categories','category_name')->ignore($this->post)
            //  ],
        ];
    }
    public function messages()
    {
        return [
            'category_name.required'=>':attribute bắt buộc nhập',
            'category_name.min'=>':attribute phải từ :min kí tự trở lên',
            'category_name.unique'=>':attribute không được trùng lặp',
        ];
    }
    public function attributes(){
        return [
        'category_name'=>'Tên danh mục',
        ];
    }
    
}
