@extends('admin.layout_admin')
@section('Content')

<div class="user_add_main">
    <form method="POST">
        <div class="add_form">
            <div>
                <h3 style="font-size: 16px;font-weight:bold">Cập nhật thông tin danh mục</h3>
            </div>
            @if ($errors->any())
            <span  style="color: red; padding-left:20px;line-height:40px" >Dữ liệu không hợp lệ. Vui lòng nhập lại</span>
            @endif 
            <div class="form_row">
                <label for=""> Tên danh mục:</label>
                <input type="" name="category_name" class="ipn_add" value="{{old('category_name')?? $categoryDetail->category_name}}"><br>
                @error('category_name')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="form_row">
                <button type="submit" name="">Cập nhật</button>

            </div>
        </div>
</div>
@csrf
</form>
</div>

@endsection