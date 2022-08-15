@extends('user.layout_user')
@section('Content')
<div class="user_order_container">
    <div class="left_menu">
      @include('user.menuleft_infor')
    </div>
    <div class="box_infor">
        <div class="box_inforx">
            <div class="order_list_box">
                <div class="inherit_home-tabs">
                    <div class="inherit_home-tab-title">
                        <div class="inherit_home-tab-item active">
                            <div class="icon_order">
                                <img src="../img/icon/order.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đặt hàng</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">

                            <div class="icon_order">
                                <img src="../img/icon/pack.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Chuẩn bị hàng</span>
                            </div>

                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/delivery.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đang giao</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/delivery_success.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Giao hàng thành công</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/order.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đã hủy</span>
                            </div>
                        </div>
                        <div class="line">
                        </div>
                    </div>
                    <div class="inherit_home-tab-content">
                        <div class="inherit_home-tab-pane active">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <?php if (sizeof($order_list) != null)
                                    foreach ($order_list as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        {{$userOrderList->id}}
                                         {{$userOrderList->order_name}}
                                        {{$userOrderList->order_date}}
                                        {{}} number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">

                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <?php if (sizeof($order_list1) != null)
                                    foreach ($order_list1 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>
                                        <td style="width:50px">
                                            <form method="POST">
                                                <input type="hidden" name="order_del_id" value="<?php echo $item['order_id'] ?>">
                                                <button class="btnhuy" type="submit" name="order_delete">Hủy đơn</button>
                                            </form>
                                        </td>
                                    </tr><?php endforeach ?>
                            </table>

                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                <?php if (sizeof($order_list2) != null)
                                    foreach ($order_list2 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                <?php if (sizeof($order_list3) != null)
                                    foreach ($order_list3 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <form>
                                    <tr class="br">
                                        <th>Đơn hàng</th>
                                        <th>Người nhận</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                    <?php if (sizeof($order_list4) != null)
                                        foreach ($order_list4 as $item) : ?>

                                        <tr class="br">
                                            <?php
                                            // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                            //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                            //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                            //     $list_product_name[] = $row;
                                            // } 
                                            ?>
                                            <td><?php echo $item['order_id'] ?></td>
                                            <td><?php echo $item['order_name'] ?></td>
                                            <td><?php echo $item['order_date'] ?></td>
                                            <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                            <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>

                                        </tr><?php endforeach ?>
                                    <form>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/inherit_home-tab.js"></script>
</body>

@endsection