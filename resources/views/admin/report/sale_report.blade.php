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
                        <input class="date" type="date" value="" name="dateStart">
                        <label for="">Đến ngày</label>
                        <input class="date" type="date" value="" name="dateEnd">
                        <button type="submit">Lọc</button>
                    </form>
                </div>
                <div class="sale_management-option">
                    <select id="selectBox" class="sale_management__select" name="order_management__select" onchange="dropdownOption(value, '<?php echo $dateStart ?>','<?php echo $dateEnd ?>')">
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
                        <?php
                            // for($i=0;$i<count($product);$i++)
                            //     echo '
                            //         <tr>
                            //             <td>'.$product[$i]['product_id'].'</td>
                            //             <td>'.$product[$i]['product_name'].'</td>
                            //             <td style="text-align: right;">'.$product[$i]['product_price'].'</td>
                            //             <td style="text-align: right;">'.$product[$i]['sale_amount'].'</td>
                            //             <td style="text-align: right;">'.$product[$i]['total'].'</td>
                            //         </tr>
                            //     ';

                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

@endsection