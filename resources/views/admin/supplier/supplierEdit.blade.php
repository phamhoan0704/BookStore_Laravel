@extends('admin.layout_admin')
@section('Content')


<div class="user_add_main">
    <form method="POST">
        <div class="add_form">
            <div class="form_row">
                <h3 style="font-size: 16px;font-weight:bold">Cập nhật thông tin nhà cung cấp</h3>
            </div>
            @if ($errors->any())
            <span  style="color: red; padding-left:20px;line-height:40px">Dữ liệu không hợp lệ. Vui lòng nhập lại</span>
            @endif 
            <div class="form_row">
                <label for=""> Tên nhà cung cấp:</label>
                <input type="" name="supplier_name" class="ipn_add" value="{{old('supplier_name')??$detail->supplier_name}}"><br>

            </div> 
            @error('supplier_name')
            <div class="form_row">
                <span style="color: red">{{$message}}</span>
            </div>
            @enderror

            <div class="form_row">
                <label for=""> Số điện thoại:</label>
                <input type="" name="supplier_phone" class="ipn_add" value="{{old('supplier_phone')??$detail->supplier_phone}}"><br>

            </div> 
            @error('supplier_phone')
            <div class="form_row">
                <span style="color: red">{{$message}}</span>
            </div>
            @enderror


            <div class="form_row">
                <label for=""> Địa chỉ:</label>
                <input type="" name="supplier_address" class="ipn_add" value="{{old('supplier_address')??$detail->supplier_address}}"><br>

            </div> 
            @error('supplier_address')
            <div class="form_row">
                <span style="color: red">{{$message}}</span>
            </div>
            @enderror
            <div class="form_row">
                <button class="btn btn-success" type="submit" name="" class="deleteCategoryBtn">Cập nhật</button>
            </div>
        </div>
</div>
@csrf
</form>
</div>


@endsection

