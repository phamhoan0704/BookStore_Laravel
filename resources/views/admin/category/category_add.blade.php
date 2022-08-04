@extends('admin.layout_admin')
@section('Content')

<div class="user_add_main">
   
     <form method="POST">
        <table class="table_user">
            <tr>
                @if ($errors->any())
                    <p>Du lieu khong hop le</p> 
                @endif 
            </tr>
                  <tr><td style="font-size: 16px;font-weight:bold">Nhập thông tin danh mục</td> </tr>
                 <tr>
                     <td >Tên danh mục: <input type="" name="name" class="ipn_add"></td>
                        @error('category_name')
                            <span style="color: red">{{$message}}</span>
                        @enderror 
                 </tr>
                 <tr>
                     
                 </tr>
                 <tr>
                     <td><button type="submit" name="">Thêm mới</button></td>      
                               
                 </tr>
        </table>
        @csrf
      </form>
 </div> 


@endsection