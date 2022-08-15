@extends('user.layout_user')
@section('Content')
<?php  $quantity=$product->product_quantity ?>

<script>
    function submit(){
        var btn=document.getElementById('quantity');
    }
    function checksubtract(){
        var result = document.getElementById('quantity'); var qty = result.value; 
                                            if( !isNaN(qty)&&(qty > 1 )) result.value--;return false;
    }
    function checkadd(){
        var result = document.getElementById('quantity'); var qty = result.value;
                                        if(!isNaN(qty)&&(qty< quantity)) result.value++;return false;
    }
</script>
    <div class="container">
        <div class="wapper">
            <div class="product_img">
                <div class="box_img">
                    <img src="{{ url('template/image/product/'.$product->product_image) }}" alt="">
                    
                </div>
            </div>
            <div class="product_infor">
                <div class="product_name">
                    <h2>{{$product->product_name}}</h2>

                </div>
                <div class="price">
                    <span>{{number_format($product->product_price) }}đ</span>
                    <del>{{number_format($product->product_price_pre) }}đ</del>
                </div>
                <div class="procduct_detial">
                    <div class="tbl">
                        <div class="row1">
                            <strong>Tác Giả</strong>
                            <span>{{$author->author_name}}</span>
                        </div>
                        <div class="row1">
                            <strong>Nhà Xuất Bản</strong>
                            <span>{{$supplier->supplier_name}}</span>
                        </div>
                        <div class="row1">
                            <strong>Năm Xuất Bản<strong>
                                    <span style="font-weight: 300;">{{$product->product_year}}</span>
                        </div>
                        
                        <div class="row1">
                            <strong>Kích cỡ<strong>
                            <span style="font-weight: 300;">20x25</span>
                        </div>
                    </div>
                   

                    <div class="summary">
                        <strong>Nội dung:</strong>
                        <div>
                            <p style="font-weight: 300;">{{$product->product_detail}}</p>

                        </div>
                    </div>
                    <div class="box">
                        <form method="post">
                            <div class="boxwapp">
                                <div class="box2">
                                    <div class="select_quantity">

                                        <input onclick="checksubtract();" type='button' value='-' name="subtract" />
                                        <input  min='1' id='quantity' type='text' value='1' name="numproduct" />
                                        <input onclick="checkadd();" type='button' value='+' name="add" />
                                    </div>
                                    <div class="quantity">
                                        <span style="font-weight: 300;">{{$product->product_quantity}}sản phẩm có sẵn</span>
                                    </div>
                                </div>
                                <div class="btnsubmit">
                                   <a href="{route('user.cart.add,['id'=>$product->id]"><input type="button" id="ipt1" value="Thêm vào giỏ hàng" name="addcart"></a> 

                                    <a href=""><input type="button" id="ipt2" value="Mua ngay" name="ordernow"></a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection