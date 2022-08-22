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
                    <div class="tabs-pane active">
                        <!-- Sách bán chạy -->
                        <table class="sale_management-table">
                            <thead>
                                <tr>
                                    <td style="width: 15%;">Mã sản phẩm</td>
                                    <td style="width: 30%;">Tên sản phẩm</td>
                                    <td style="text-align: right; width: 15%;">Giá Bán</td>
                                    <td style="text-align: right; width: 20%;">Số lượng đã bán</td>
                                    <td style="text-align: right; width: 20%;">Doanh Mục</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listProductBestSeller as $item)
                                    <tr>
                                        <td style="width: 15%;">{{$item->product_id}}</td>
                                        <td style="width: 30%;">{{$item->product_name}}</td>
                                        <td style="text-align: right; width: 15%;">{{number_format($item->product_price)}}</td>
                                        <td style="text-align: right; width: 20%;">{{$item->sale_amount}}</td>
                                        <td style="text-align: right; width: 20%;">{{$item->category_name}}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tabs-pane">
                        <!-- Thống kê theo danh mục -->
                        <table class="sale_management-table">
                            <thead>
                                <tr>
                                    <td style="width: 25%">Mã danh mục</td>
                                    <td style="width: 50%">Tên danh mục</td>
                                    <td style="width: 25%">Số lượng sản phẩm đã bán</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listCategoryBestSeller as $item)
                                    <tr>
                                        <td style="width: 25%">{{$item->id}}</td>
                                        <td style="width: 50%">{{$item->category_name}}</td>
                                        <td style="text-align: right; width: 25%">{{number_format($item->sale_amount)}}</td>
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
