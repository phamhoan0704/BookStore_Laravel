@extends('admin.layout_admin')
@section('head')
<script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
@endsection
@section('Content')
<div class="notice homepage__box">
    <h1>Thông báo</h1>
    <form action="{{route('admin.sendMail')}}" method="post">
        @csrf
    <div class="notice_title">
        <label  class="notice_label" for=""> Tiêu đề</label>
        <input type="text" value="" name='title'>
    </div>
    
    <div class="notice_title">
        <label  class="notice_label" for=""> Nội dung</label>
        <textarea type=""  class="form-control detail_txt" name="content" placeholder="Mô tả" ></textarea>
      </div>
    <button class="btn btn-success notice_btn" type="submit"> Gửi</button>
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