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
        <h3 class="" style="font-size: 16px;font-weight:bold">Nhập thông tin sản phẩm</h3>
      </div>
      @if ($errors->any())
      <span  style="color: red; padding-left:20px;line-height:40px">Dữ liệu không hợp lệ. Vui lòng nhập lại</span>
      @endif 
      <div class="form_row">
        <label for="">Tên sản phẩm</label>
        <input type="" name="product_name" class="ipn_add" id="" placeholder="Tên sản phẩm" value="{{old('product_name')}}">
      </div>
      @error('product_name')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Giá gốc</label>
        <input type="" name="product_price_pre" class="ipn_add" id="" placeholder="Giá gốc" value="{{old('product_price_pre')}}">
      </div>
      @error('product_price_pre')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Giá giảm</label>
        <input type="" name="product_price" class="ipn_add" id="" placeholder="Giá giảm" value="{{old('product_price')}}">
      </div>
      @error('product_price')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Số lượng</label>
        <input type="" name="product_quantity" class="ipn_add" id="" placeholder="Số lượng" value="{{old('product_quantity')}}">
      </div>
      @error('product_quantity')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Hình ảnh</label>
        <input type="file" name="product_image" class="ipn_add" id="" value="">
      </div>
      @error('product_image')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Năm sản xuất</label>
        <input type="date" name="product_year" class="ipn_add" value="{{old('product_year')}}">
      </div>
      @error('product_year')
      <div class="form_row">
          <span style="color: red">{{$message}}</span>
      </div>
      @enderror
      <div class="form_row">
        <label for="">Tác giả</label>
        <select name="author_id" class="ipn_add">
          @if (!empty($author))
          @foreach ($author as $item)
          <option value="{{$item->id??old('author_id')}}" @if(old('author_id') == $item->id) selected @endif>{{$item->author_name}}</option>
          @endforeach
          @endif
        </select>
      </div>
      
      <div class="form_row">
        <label for="">Nhà cung cấp</label>
        <select name="supplier" class="ipn_add">
          @if (!empty($supplier))
          @foreach ($supplier as $item)
          <option value="{{$item->id}}" @if(old('supplier') == $item->id) selected @endif>{{$item->supplier_name}}</option>
          @endforeach
          @endif
        </select>
      </div>
      <div class="form_row">
        <label for="">Danh mục</label>
        <select name="category" class="ipn_add">
          @if (!empty($category))
          @foreach ($category as $item)
          <option value="{{$item->id}}"  @if(old('category') == $item->id) selected @endif>{{$item->category_name}}</option>
          @endforeach
          @endif
        </select>
      </div>
      <div class="form_row">
        <label for="">Mô tả</label>
      </div>
      <div class="form-group detail_form">
        <textarea type="" name="detail" class="form-control detail_txt" id="content" placeholder="Mô tả" ></textarea>
      </div>
      <div class="form_row">
        <button type="submit" class="deleteCategoryBtn">Thêm mới</button>
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