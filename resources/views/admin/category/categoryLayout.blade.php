@extends('admin.layout_admin')
@section('Content')

<div class="management_main">
    <form method="POST" action="">
        <div class="home-tabs">
            <div class="home-tab-title">
                <div class="home-tab-item" id="all_Categories">
                    <span><a href="{{route('admin.category.index1',['name'=>'all'])}}">Tất cảa</a> </span>
                    <span></span>
                </div>
                <div class="home-tab-item">
                    <span><a href="{{route('admin.category.index1',['name'=>'active'])}}">Đang hoạt động</a> </span>
                    <span></span>
                </div>
                <div class="home-tab-item">
                    <span><a href="{{route('admin.category.index1',['name'=>'hide'])}}"> Đã ẩn</a></span>
                    <span></span>

                </div>
                <div class="line" id="line">
                </div>
            </div>
            <!-- thêm danh mục -->
            <div class="layout-list-row">
                <table>
                    <tr>
                        <td colspan="7">
                            <button class="btn_add"><a href="{{route('admin.category.create')}}">Thêm
                                    danh mục</a> </button>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- tìm kiếm danh mục -->
            <div class="layout-list-row">
                <table>
                    <tr>
                        <td colspan=7>
                            <form method="POST">
                                <label for="" class="label_search">Tìm kiếm</label>
                                <input placeholder="Nhập tên danh mục" class="ipn_search" type="" name="search_txt1"
                                    value="">
                                <button type="submit" value="search1" name="action">Tìm kiếm</button>
                            </form>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> </span>
                        </td>
                    </tr>
                    <tr class="title_order">
                        <td>Mã danh mục</td>
                        <td>Tên danh mục</td>
                        <td>Số sản phẩm</td>
                        <td>Ngày tạo</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p style="color: #000">Không có danh mục</p>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="layout-list-row">

            </div>
            <!-- Tất cả danh mục -->
            <div class="content2">
                {{-- @include('backend.alert') --}}
                @yield('ContentCategory')
            </div>

        </div>
</div>
</form>
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