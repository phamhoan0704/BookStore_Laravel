@extends('admin.layout_admin')
@section('Content')
{{-- Model --}}
    <div class="homepage_main">  
        <div class="homepage__box">
            <div class="title-box">Danh sách cần làm
                <p>Những việc bạn sẽ phải làm</p>
            </div>
            <div class="to-do-list">
                <a href="{{route('admin.order.index',['status'=>'0'])}}" class="to-do-item">
                    <p class="item-title">{{$orderStatus0->count()}}</p>
                    <p class="item-desc">Chờ xác nhận</p>
                </a>
                <a href="{{route('admin.order.index',['status'=>'1'])}}" class="to-do-item">
                    <p class="item-title">{{$orderStatus1->count()}}</p>
                    <p class="item-desc">Chờ lấy hàng</p>
                </a>
                <a href="{{route('admin.order.index',['status'=>'2'])}}" class="to-do-item">
                    <p class="item-title">{{$orderStatus2->count()}}</p>
                    <p class="item-desc">Đã xử lý</p>
                </a>
                </a>
                <a href="product_management_ad.php" class="to-do-item">
                    <p class="item-title">{{$productSoldOut->count()}}</p>
                    <p class="item-desc">Sản Phẩm hết hàng</p>
                </a>
            </div>
        </div>
        <div class="homepage__box">
            <div class="title-box">Phân tích bán hàng</div>    
            
            <div class="sale_management-info">

            <div class="tabs">
                <div class="tabs-title">
                    <div class="tabs-item active">
                        <span>Sản phẩm bán chạy</span>
                    </div>
                    <div class="tabs-item">
                        <span>Danh mục bán chạy</span>
                    </div>
                    <div class="tab-line"></div>
                </div>


                <!-- Tab content -->
                <div class="tabs-content">
                    <!-- Sách mới -->
                    <div class="tabs-pane active">
                        <!-- Sách bán chạy -->
                        <table class="sale_management-table">
                                <thead>
                                    <tr>
                                        <td style="width: 15%">Mã sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá Bán</td>
                                        <td>Số lượng đã bán</td>
                                        <td>Danh mục</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    @foreach ($listProductBestSeller as $item)
                                        <tr>
                                            <td>{{$item->product_id}}</td>
                                            <td>{{$item->product_name}}</td>
                                            <td style="text-align: right;">{{number_format($item->product_price)}}</td>
                                            <td style="text-align: right;">{{$item->sale_amount}}</td>
                                            <td>{{$item->category_name}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                    </div>
                    <div class="tabs-pane">
                        <!-- Sách hot deal -->
                        <table class="sale_management-table">
                                <thead>
                                    <tr>
                                    <td style="width: 15%">Mã danh mục</td>
                                    <td style="width: 60%">Tên danh mục</td>
                                    <td>Số lượng sản phẩm đã bán</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    @foreach ($listCategoryBestSeller as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->category_name}}</td>
                                            <td style="text-align: right;">{{number_format($item->sale_amount)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        <!-- <div class="homepage__box sale-analysis">
            <div class="title-box">Phân Tích Bán Hàng
                <p style="margin-bottom: 0;">Tổng quan về doanh thu của cửa hàng trong năm</p>
            </div>
            <div id="linechart"></div>
        </div> -->
    </div>
    
    <script src="{{asset('template/admin/js/tabs.js')}}"></script>

@endsection
