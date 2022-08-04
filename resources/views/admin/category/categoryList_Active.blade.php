
@extends('admin.category.categoryLayout')
@section('ContentCategory')

                    <!-- Tất cả danh mục -->
                    <div class="layout-list-row">
                        <table>
                            <tr class="title_order">
                                <td>
                                    <input type="checkbox" name="" id="checkall" onclick="selects(this)">
                                </td>
                                <td>Mã danh mục</td>
                                <td>Tên danh mục</td>
                                <td>Số sản phẩm</td>
                                <td>Ngày tạo</td>
                                <td colspan="2"></td>
                            </tr>
                            @foreach ($categoryList_active as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="{{$item->id}}" class="check" id=""
                                        onclick="check(this)">
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->category_name}}</td>
                                <td></td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="category_id" value="">
                                        <button type="submit" name="category_delete">Ẩn</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach


                        </table>
                    </div>
          
                <div class="home-tab-pane">
                    <table>

                        <tr class="title_order">
                            <td>Mã danh mục</td>
                            <td>Tên danh mục</td>
                            <td>Số sản phẩm</td>

                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="category_id" value="">
                                    <button type="submit" name="category_delete">Ẩn</button>
                                </form>
                            </td>
                        </tr>


                    </table>

                </div>
                <div class="home-tab-pane">
                    <table>

                        <tr class="title_order">
                            <td>Mã danh mục</td>
                            <td>Tên danh mục</td>
                            <td>Số sản phẩm</td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="category_id" value="">
                                    <button type="submit" name="category_restore">Hiển thị</button>
                                </form>
                            </td>
                        </tr>


                    </table>

                </div>

    </form>
    <div>
        {{$categoryList_active->links()}}
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

</script>
@endsection
