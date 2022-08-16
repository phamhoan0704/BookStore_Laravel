<?php
    // include '../../database/connect.php';
    // $yearCurrent = date('y');
    // $monthCurrent = date('m');
    // $dayCurrent = date('d');
    // $sql = "SELECT month(tbl_order.order_date) as 'month', sum(tbl_product.product_price*tbl_order_detail.order_quantity) as 'total'
    //         FROM tbl_product INNER JOIN tbl_order_detail on tbl_product.product_id=tbl_order_detail.product_id
    //                          INNER JOIN tbl_order on tbl_order.order_id=tbl_order_detail.order_id
    //         WHERE year(tbl_order.order_date) = 2022
    //         GROUP BY month(tbl_order.order_date) 
    //         Order by month(tbl_order.order_date) 
    // ";
    // $result = mysqli_query($conn, $sql);
    // $product = array();
    // if(mysqli_num_rows($result) > 0)
    //     while($row = mysqli_fetch_array($result, 1))
    //     {
    //         $product[] = $row;
    //     }

    // $product_date = [];
    // $product_total = [];

    // for($i=0;$i<count($product);$i++)
    // {
    //     // $product_date[] = (float)(substr($product[$i]['order_date'], 8, 2));
    //     $product_date[] = (float)$product[$i]['month'];
    //     $product_total[] = (float)$product[$i]['total'];
    // }


    // // -------------------------------
    
    //     //Chờ xác nhận
    //     $sql_order_confirm="SELECT *FROM tbl_order WHERE order_status=1";
    //     $query_order_confirm=mysqli_query($conn,$sql_order_confirm);
    //     //$li_order=mysqli_fetch_array($query_order);
    //     $order_confirm=[];
    //     while ($row = mysqli_fetch_array($query_order_confirm)){
    //         $order_confirm[] = $row;
    //     }

    //     //Dang chuan bị hang
    //     $sql_order_prepare="SELECT *FROM tbl_order WHERE order_status=2";
    //     $query_order_prepare=mysqli_query($conn,$sql_order_prepare);
    //     //$li_order=mysqli_fetch_array($query_order);
    //     $order_prepare=[];
    //     while ($row = mysqli_fetch_array($query_order_prepare)){
    //         $order_prepare[] = $row;
    //     }
    //     //Dang van chuyen
    //     $sql_order_transport="SELECT *FROM tbl_order WHERE order_status=3";
    //     $query_order_transport=mysqli_query($conn,$sql_order_transport);
    //     //$li_order=mysqli_fetch_array($query_order);
    //     $order_transport=[];
    //     while ($row = mysqli_fetch_array($query_order_transport)){
    //         $order_transport[] = $row;
    //     }

    //     //San pham het hang
    //     $sql_order_delivered="SELECT *FROM tbl_product WHERE product_quantity=0";
    //     $query_order_delivered=mysqli_query($conn,$sql_order_delivered);
    //     //$li_order=mysqli_fetch_array($query_order);
    //     $order_delivered=[];
    //     while ($row = mysqli_fetch_array($query_order_delivered)){
    //         $order_delivered[]= $row;
    //     }

    //     //Don huy
    //     $sql_order_cancel="SELECT *FROM tbl_order WHERE order_status=5";
    //     $query_order_cancel=mysqli_query($conn,$sql_order_cancel);
    //     //$li_order=mysqli_fetch_array($query_order);
    //     $order_cancel=[];
    //     while ($row = mysqli_fetch_array($query_order_cancel)){
    //         $order_cancel[] = $row;
    //     }


?>
@extends('admin.layout_admin')
@section('Content')
{{-- Model --}}
    <div class="homepage_main">  
        <div class="homepage__box">
            <div class="title-box">Danh sách cần làm
                <p>Những việc bạn sẽ phải làm</p>
            </div>
            <div class="to-do-list">
                <a href="order_management_ad.php" class="to-do-item">
                    <p class="item-title">{{$orderStatus0->count()}}</p>
                    <p class="item-desc">Chờ xác nhận</p>
                </a>
                <a href="order_management_ad.php" class="to-do-item">
                    <p class="item-title">{{$orderStatus1->count()}}</p>
                    <p class="item-desc">Chờ lấy hàng</p>
                </a>
                <a href="order_management_ad.php" class="to-do-item">
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
            <div class="title-box">Sản Phẩm Bán Chạy</div>    
            
            <div class="sale_management-info">
                
                <table class="sale_management-table">
                    <thead>
                        <tr>
                            <td style="width: 15%">Mã sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá Bán</td>
                            <td>Số lượng đã bán</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="homepage__box sale-analysis">
            <div class="title-box">Phân Tích Bán Hàng
                <p style="margin-bottom: 0;">Tổng quan về doanh thu của cửa hàng trong năm</p>
            </div>
            <div id="linechart"></div>
        </div> -->
    </div>

    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Tháng');
            data.addColumn('number', 'Doanh Thu');

            data.addRows([
                @foreach ($homepageList as $item)
                    [{{$item->sale_amount}},{{$item->total}}],
                @endforeach

                // [1,2],
                // [3,9],
                // [4,6],
                // [5,8],
            ]);

            var options = {
                chart: {
                title: '',
                subtitle: ''
                }
            };

            var chart = new google.charts.Line(document.getElementById('linechart'));

            chart.draw(data, google.charts.Line.convertOptions(options));
            }
            
    </script>

@endsection
