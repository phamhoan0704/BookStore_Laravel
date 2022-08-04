@extends('admin.layout_admin')
@section('Content')


<div class="user_add_main">
    <form method="POST">
        <div class="add_form">
            <div class="form_row">
                <h3 style="font-size: 16px;font-weight:bold">Nhập thông tin danh mục</h3>
            </div>
            @if ($errors->any())
            <span  style="color: red; padding-left:20px;line-height:40px">Dữ liệu không hợp lệ. Vui lòng nhập lại</span>
            @endif 
            <div class="form_row">
                <label for=""> Tên danh mục:</label>
                <input type="" name="category_name" class="ipn_add" value="{{old('category_name')}}"><br>

            </div> 
            @error('category_name')
            <div class="form_row">
                <span style="color: red">{{$message}}</span>
            </div>
            @enderror
            <div class="form_row">
                <button type="submit" name="" class="deleteCategoryBtn">Thêm mới</button>
            </div>
        </div>
</div>
@csrf
</form>
</div>


@endsection

