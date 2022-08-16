@extends('admin.layout_admin')
@section('Content')
{{-- Model --}}
    <div class="sale_management_content">
        <div class="sale_management_main">  
            <h1>THỐNG KÊ DOANH THU</h1>
            <div class="sale_management-head">
                <div class="sale_management-filter">
                    <form action="" method="get">
                        <label for="">Từ ngày</label>
                        <input class="date" type="date" value="{{ $previousDate }}" name="previousDate">
                        <label for="">Đến ngày</label>
                        <input class="date" type="date" value="{{ $currentDate }}" name="currentDate">
                        <button type="submit" class="btn btn-success">Lọc</button>
                    </form>
                </div>
                <div class="sale_management-option">
                    <select id="selectBox" class="sale_management__select" name="order_management__select">
                        <option value="productID">Mã Sản Phẩm</option>

                        <option value="sale-amount-descending">Số Lượng: Giảm dần</option>
                        
                        <option value="sale-amount-ascending">Số Lượng: Tăng dần</option>

                        <option value="price-descending">Doanh Thu: Giảm dần</option>
                        <option value="price-ascending">Doanh Thu: Tăng dần</option>
                    </select>
                </div>
            </div>
            <div class="sale_management-info">
                <div class="float-right">
                    <!-- <form action="" method="post">
                        <input type="submit" name="export_excel" value="Export">
                    </form> -->
                    <div class="float-right">
                        <a href="" class="btn btn-success">Export</a>
                    </div>
                </div>
                <table class="sale_management-table">
                    <thead>
                        <tr>
                            <td style="width: 15%">Mã sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá Bán</td>
                            <td>Số lượng</td>
                            <td>Doanh Thu</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportList as $item)
                            <tr>
                                <td>{{$item->product_id}}</td>
                                <td>{{$item->product_name}}</td>
                                <td style="text-align: right;">{{number_format($item->product_price)}}</td>
                                <td style="text-align: right;">{{$item->sale_amount}}</td>
                                <td style="text-align: right;">{{number_format($item->product_price*$item->sale_amount)}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="sale_management-total"> 
                    <p>Tổng cộng          
                        <span>
                            {{number_format($total)}}
                        </span>
                    </p>
                </div>
            </div>
        </div>  
    </div>
    <div class="homepage__box sale-analysis">
        <div class="title-box">Phân Tích Bán Hàng
            <p style="margin-bottom: 0;">Tổng quan về doanh thu của cửa hàng trong năm</p>
        </div>
        <div id="linechart"></div>
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