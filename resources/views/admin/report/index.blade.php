@extends('admin.layout_admin')
@section('Content')
{{-- Model --}}
    <div class="homepage__box sale-analysis">
        <div class="title-box">Tổng Quan

            <p class="body-box" style="margin-bottom: 0;">Tổng quan về doanh thu của cửa hàng trong năm</p>

        </div>
        <div id="linechart"></div>
    </div>
    <div class="sale_management_content">
        <div class="sale_management_main">  
            <!-- <div class="title-box">Tổng quan</div> -->
            <div class="title-box">Chi Tiết</div>
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
                    <select id="selectBox" class="sale_management__select" name="order_management__select" onchange="dropdownOption(value,{{$previousDate}},{{$currentDate}})">
                        <option value="productID">Mã Sản Phẩm</option>

                        <option 
                            @if(str_contains(url()->full(),'sale-amount-desc')) 
                                {{'selected'}} 
                            @endif
                            value="sale-amount-desc">Số Lượng: Giảm dần</option>
                        
                        <option 
                            @if(str_contains(url()->full(),'sale-amount-asc')) 
                                {{'selected'}} 
                            @endif
                            value="sale-amount-asc">Số Lượng: Tăng dần</option>

                        <option 
                            @if(str_contains(url()->full(),'revenue-desc')) 
                                {{'selected'}} 
                            @endif
                            value="revenue-desc">Doanh Thu: Giảm dần</option>
                        <option 
                            @if(str_contains(url()->full(),'revenue-asc')) 
                                {{'selected'}} 
                            @endif
                            value="revenue-asc">Doanh Thu: Tăng dần</option>
                    </select>
                </div>
            </div>
            <div class="sale_management-info">
                <div class="float-right">
                    <form action="{{ route('admin.export') }}" method="get">
                        <input type="hidden" value="{{ $previousDate }}" name="previousDate">
                        <input type="hidden" value="{{ $currentDate }}" name="currentDate">
                        <input class="btn btn-success" type="submit" value="Export">
                    </form>
                    <!-- <div class="float-right">
                        <a href="http://127.0.0.1:8000/admin/report/export?previousDate={{ $previousDate }}&&currentDate={{ $currentDate }}" class="btn btn-success">Export</a>
                    </div> -->
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
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Tháng');
            data.addColumn('number', 'Doanh Thu');

            data.addRows([
                @foreach ($lineChart as $item)
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
             
        function dropdownOption(value,previousDate,currentDate)
        {
            @if( str_contains(url()->full(),'currentDate') )
                var url = "http://127.0.0.1:8000/admin/report/index?previousDate={{$previousDate}}&currentDate={{$currentDate}}&sort_by=" + value;
            @else
            var url = "http://127.0.0.1:8000/admin/report/index?sort_by=" + value;
            @endif
            window.location.href = url;
        }
            
    </script>

@endsection