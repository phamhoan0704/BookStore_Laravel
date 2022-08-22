@extends('admin.layout_admin')
@section('head')
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('Content')
<form action="{{route('admin.account.postAdd')}}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="user_add_main">
    <div class="add_form">
      <div class="form_row">
        <h3 class="" style="font-size: 16px;font-weight:bold">Nhập thông tin tài khoản</h3>
      </div>
      @if ($errors->any())
      <span  style="color: red; padding-left:20px;line-height:40px">Dữ liệu không hợp lệ. Vui lòng nhập lại !</span>
      @endif 
      <div class="form_row">
        <label for="">Tên người dùng</label>
        <input type="" name="name" class="ipn_add" id="" placeholder="Tên người dùng" value="{{old('name')}}">
      </div>
      @error('name')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Mật khẩu</label>
        <input type="" name="pass" class="ipn_add" id="" placeholder="Mật khẩu" value="">
      </div>
      @error('pass')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Email</label>
        <input type="" name="email" class="ipn_add" id="" placeholder="Email" value="{{old('email')}}">
      </div>
      @error('email')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Số điện thoại</label>
        <input type="" name="phone" class="ipn_add" id="" placeholder="Số điện thoại" value="{{old('phone')}}">
      </div>
      @error('phone')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Kiểu tài khoản</label>
      </div>
      <div class="form-group detail_form">
      <select name="user_type">
          <option value="1"{{"selected=\"selected\""}}>Admin</option>
          <option value="0"{{"selected=\"selected\""}}>Khách hàng</option>
      </select>
      </div>
      <div class="form_row">
        <button class="btn btn-success" type="submit" class="deleteCategoryBtn">Thêm mới</button>
      </div>
    </div>
</form>
</div>
@endsection
@section('footer')
<script>
  // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
        CKEDITOR.replace('content');
</script>
@endsection