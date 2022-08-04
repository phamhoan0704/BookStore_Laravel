<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=>'required|min:2|unique:products,product_name,'.$id,
            'product_year'=>'required|date',
            'product_price'=>'numeric',
            'product_price_pre'=>'required|numeric',
            'product_image'=>'required|image',
            'product_quantity'=>'required|numeric',
            'product_detail'=>'',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required'=>':attribute bắt buộc nhập',
            'product_name.min'=>':attribute phải từ :min kí tự trở lên',
            'product_name.unique'=>':attribute không được trùng lặp',
            'product_year.required'=>':attribute bắt buộc nhập',
            'product_price_pre.required'=>':attribute bắt buộc nhập',
            'product_price.numeric'=>':attribute phải là số',
            'product_price_pre.numeric'=>':attribute phải là số',
            'product_image.required'=>':attribute bắt buộc chọn',
            'product_image.image'=>':attribute phải là file ảnh',
            'product_quantity.required'=>':attribute bắt buộc nhập',
            'product_quantity.numeric'=>':attribute phải là số',
        ];
    }
    public function attributes(){
        return [
            'product_name'=>'Tên sản phẩm',
            'product_price'=>'Giá giảm của sản phẩm',
            'product_price_pre'=>'Giá sản phẩm',
            'product_image'=>'Ảnh minh họa',
            'product_quantity'=>'Số lượng sản phẩm',
            'product_year'=>'Năm xuất bản',
        ];
    }
}
