<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')

<body>
    @yield('Scripts')
    {{-- Model Thông báo--}}
    {{-- {{dd(request()->segment(2))}} --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if (session()->has('success'))
                    <h5> {{session('success')}}</h5>
                    @else
                    <h5> {{session('error')}}</h5>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    {{-- <button type="submit" class="btn btn-danger">Xóa</button> --}}
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main_header">
        <a href="homepage.php">
            <img src="" alt="" style="margin: 0 50px">
        </a>
        <h1 style="padding-left: 16px;">NHÀ SÁCH IPM</h1>
    </div>
    <div class="main_content">
        <div class="main_menu">
            <ul>
                <li><a href="" style="font-weight:bold;font-size:20px;color:white">
                        Danh mục quản lí</a></li>
                <li><a id="homepage" href="{{route('admin.homepage')}}">Trang Chủ</a></li>
                <li><a id="header-category" href="{{route('admin.category.index')}}">Quản lí danh mục</a></li>
                <li><a id="header-product" href="{{route('admin.product.index')}}">Quản lí sản phẩm</a></li>
                <li><a id="header-author" href="{{route('admin.author.index')}}">Quản lí tác giả</a></li>
                <li><a id="header-supply" href="{{route('admin.supplier.index')}}">Quản lí nhà cung cấp</a></li>
                <li><a id="header-user" href="../admin/user_management_ad.php">Quản lí tài khoản</a></li>
                <li><a id="header-order" href="../admin/order_management_ad.php">Quản lí đơn hàng</a></li>
                <li><a id="header-report" href="{{route('admin.report')}}">Quản lí doanh thu</a></li>
            </ul>
        </div>

        <div class="content">
            {{-- @include('backend.alert')--}}
            @yield('Content')
        </div>
    </div>

    @if(session()->has('success'))
    <script>
        $(document).ready(function() {
                $('#addModal').modal();
         });
    </script>
    @else
    @endif

    @if(request()->name == 'active')
    <script>
        document.getElementById("home-tab-item-active").style.background = "#5cb85c";
        document.getElementById("home-tab-item-active-link").style.color = "white";
    </script>
    @elseif(request()->name=='hide') {
    <script>
        document.getElementById("home-tab-item-hide").style.background = "#5cb85c";
        document.getElementById("home-tab-item-hide-link").style.color = "white";
    </script>
    @else
    <script>
        document.getElementById("home-tab-item-all").style.background = "#5cb85c";
        document.getElementById("home-tab-item-all-link").style.color = "white";
    </script>
    @endif

    <script>
        function setColorForMenu(menuItem) {
                document.getElementById(menuItem).style.background = "#5cb85c";
                document.getElementById(menuItem).style.color = "white";
            }
    </script>

    @switch(request()->segment(2))
    @case('category')
    <script>
        setColorForMenu('header-category');
    </script>
    @break
    @case('product')
    <script>
        setColorForMenu('header-product');
    </script>
    @break
    @case('author')
    <script>
        setColorForMenu('header-author');
    </script>
    @break
    @case('supplier')
    <script>
        setColorForMenu('header-supply');
    </script>
    @break

    @case('report')
    <script>
        setColorForMenu('header-report');
    </script>
    @break

    @case('homepage')
    <script>
        setColorForMenu('homepage');
    </script>
    @break

    @default

    @endswitch

    @include('admin.footer')



</body>

</html>