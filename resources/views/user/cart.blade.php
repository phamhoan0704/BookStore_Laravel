@extends('user.layout_user')
@section('Content')

<div class="cart_container">

    <h1>Giỏ hàng</h1>
    <div class="cart_detail">
        <div class="cart_title">
            <div class="cart_title_item cart_img">
            </div>
            <div class="cart_title_item cart_name">
                <p>Tên sản phẩm</p>
            </div>
            <div class="cart_title_item cart_qty">
                <p>Số lượng</p>
            </div>
            <div class="cart_title_item cart_price">
                <p>Giá tiền</p>
            </div>
            <div class="cart_title_item cart_remove">
            </div>
        </div>
        <div class="cart_list">
            <form action="" method="post" >
            
                @csrf
                @foreach($cartList as $item)
                <div class="cart_item">
                    <div class="cart_img">
                        <a href=""><img src="{{ url('template/image/product/'.$item->product_image) }}" alt=""></a>
                    </div>
                    <div class="cart_name">
                        <a href="">{{$item->product_name}}</a>
                    </div>
                    <div class="cart_qty">
                        <!-- <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php?> -->
                        <p><input type="number" name="amount[{{$item->id}}]" value="{{$item->product_amount}}" min=1> </p>
                    </div>
                    <div class="cart_price">
                        <p>{{number_format($item->product_price)}} đ</p>
                    </div>

                    <div class="cart_remove">
                        <a href="{{route('user.cart.delete',['id'=>$item->product_id])}}">Xóa</a>
                    </div>
                </div>
                @endforeach
                
                <!-- <div class="cart_item">
                <div class="cart_img">
                    <a href=""><img src="../Image/product_image/pdt2.png" alt=""></a>
                </div>
                <div class="cart_name">
                    <a href="">Re: Zero - Bắt Đầu Lại Ở Thế Giới Khác - 12</a>
                </div>
                <div class="cart_qty">
                    <p><input type="number" value="1" min=1></p>   
                </div>
                <div class="cart_price">
                    <p>VND 102.000</p>
                </div>
                <div class="cart_remove">
                    <a href="">Xóa</a>
                </div>
            </div> -->
        </div>
        <div class="cart_total">
            <div class="cart_img"></div>
            <div class="cart_name"></div>
            <div class="cart_qty">
                <p>Tổng cộng</p>
            </div>
            <div class="cart_price">
                <p>{{number_format(\App\Helpers\User\CartHelper::totalMoney($cartList))}} đ</p>
            </div>
        </div>
        <div class="cart_btn">
            <div class="cart_return">
                <a href="{{route('user.homepage')}}">
                    <i class="fa fa-solid fa-reply"></i>
                    <p>Tiếp tục mua hàng</p>
                </a>
            </div>
            <button type="submit" onclick="" name="action" value=""  formaction="{{route('user.cart.update')}}">
                Cập nhật
                <i class="fa fa-solid fa-angles-right"></i>
            </button>
        </form>
        <form action="" method="get">

            <button formaction="{{route('user.order.index')}}">
                Thanh toán<i class="fa fa-solid fa-angles-right"></i>
            </button>
        </form>
        </div>
    </div>
</div>
@endsection