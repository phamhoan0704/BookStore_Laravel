@extends('admin.category.categoryLayout')
@section('ContentCategory')
<form method="POST" action="{{route('admin.category.hide')}}">
    @csrf
    <div class="layout-list-row">
        <table>
            <tr>
                <td colspan="7">
                    <button type="submit" name="add" class="btn_hidden">Ẩn tất cả</button>
                </td>
            </tr>
        </table>
    </div>
    <!-- Tất cả danh mục -->
    <div class="layout-list-row">
        <table>
            <tr>
            </tr>
            <tr class="title_order">
                <td>
                    <input type="checkbox" name="" id="checkall" onclick="selects(this)" style="width: 20px">
                </td>
                <td>Mã danh mục</td>
                <td>Tên danh mục</td>
                <td>Số sản phẩm</td>
                <td>Ngày tạo</td>
                <td>Ngày cập nhật</td>

                <td colspan="2"></td>
            </tr>
            @foreach ($categoryList as $item)
            <tr>
                <td>
                    <input type="checkbox" value="{{$item->id}}" class="check" name="ids[{{$item->id}}]"
                        onclick="check(this)">
                </td>
                <td>{{$item->id}}</td>
                <td>{{$item->category_name}}</td>
                <td></td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td>
                    <form method="POST" action="{{route('admin.category.hide')}}">
                        @csrf
                        <input type="hidden" name="id[{{$item->id}}]" value="{{$item->id}}">
                        <button type="submit" name="category_delete">Ẩn</button>
                    </form>
                </td>
                <td>
                    <a href="{{route('admin.category.edit',['id'=>$item->id])}}">Sửa</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</form>
<div>
    {{$categoryList->links()}}
</div>


<script>
    var chk=document.getElementsByClassName('check');  
        var checkall=document.getElementById('checkall'); 
        function selects(x) { 
            for(var i=0; i<chk.length; i++){   
                    chk[i].checked = x.checked ? true:false
            } 
        }  
        function check(x) {
            var dem = 0 
            for(var i=0; i<chk.length; i++){   
                if(chk[i].checked == false) {
                    checkall.checked = false;
                } else dem++;
            } 
            if(dem == chk.length) checkall.checked = true;
        }
      
        document.getElementById("all_Categories").style.background = "rgb(1 161 75)";
</script>
@endsection