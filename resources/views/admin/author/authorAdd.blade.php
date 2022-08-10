@extends('admin.layout_admin')
@section('head')
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('Content')
<form action="" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="user_add_main">
    <div class="add_form">
      <div class="form_row">
        <h3 class="" style="font-size: 16px;font-weight:bold">Nhập thông tin tác giả</h3>
      </div>
      @if ($errors->any())
      <span  style="color: red; padding-left:20px;line-height:40px">Dữ liệu không hợp lệ. Vui lòng nhập lại</span>
      @endif 
      <div class="form_row">
        <label for="">Tên tác giả</label>
        <input type="" name="author_name" class="ipn_add" id="" placeholder="Tên tác giả" value="{{old('author_name')}}">
      </div>
      @error('author_name')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Mô tả</label>
      </div>
      <div class="form-group detail_form">
        <textarea type="" name="detail" class="form-control detail_txt" id="content" placeholder="Mô tả" ></textarea>
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