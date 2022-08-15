@extends('user.layout_user')
@section('Content')


<div class="order_detail_container">
    <div class="order_detail_customer">
        <h1>Thông tin người nhận</h1>
        <table>
            <tr>
                <td class="">Họ tên:</td>
                <td class="">
                    <p>
                        {{$orderDetail->name}}
                    </p>
                </td>
            </tr>
            <tr>
                <td class="">Email:</td>
                <td class="">
                    <p>
                        {{$orderDetail->email}}
                        
                    </p>
                </td>
            </tr>
            <tr>
                <td class="">Số điện thoại:</td>
                <td class="">
                    <p>
                        {{$orderDetail->phone}}
                       
                    </p>
                </td>
            </tr>
            <tr>
                <td class="">Địa chỉ:</td>
                <td class="">
                    <p>
                        {{$orderDetail->address}}
                    </p>
                </td>
            </tr>
            <tr>
                <td class="">Ghi chú:</td>
                <td class="">
                    <p>
                        {{$orderDetail->order_note}}
                        
                    </p>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="order_status">
        <h1>Chi tiết đơn hàng </h1>
        <table>
            <tr>
                <td class=""><img src="{{ url('template/user/image/icon/shopping-bag.png') }}" alt=""></td>
                <td>Ngày đặt hàng:</td>
                <td>
                    {{$orderDetail->order_date}}
                </td>
            </tr>
            <tr>
                <td class=""><img src="{{ url('template/user/image/icon/money.png') }}" alt=""></td>
                <td>Thanh toán:</td>
                <td>
                    
                    @if($orderDetail->payment_method==0)
                    Thanh toán qua tài khoản
                    @endif
                     
                     @if($orderDetail->payment_method==1)
                    Thanh toán khi nhận hàng
                    @endif
                     
                </td>
            </tr>
            <tr>
                <td><img src="{{ url('template/user/image/icon/accept.png') }}" alt=""></td>
                <td>Tình trạng thanh toán:</td>
                <td>
                    
                    @if($orderDetail->payment_status==0)
                    Chưa thanh toán
                    @endif
                    @if($orderDetail->payment_status==1)
                    Đã thanh toán
                    @endif
                </td>
            </tr>
            <tr>
                <!-- <td class=""><img src="../img/icon/shopping-bag.png" alt=""></td> -->
                <td> @if($orderDetail->order_status==0)
                    <img src="{{ url('template/user/image/icon/order.png') }}" alt="">
                    @endif

                    @if($orderDetail->order_status==1)
                    <img src="{{ url('template/user/image/icon/pack.png') }}" alt="">
                    @endif

                    @if($orderDetail->order_status==2)
                    <img src="{{ url('template/user/image/icon/delivery.png') }}" alt="">
                    @endif

                    @if($orderDetail->order_status==3)
                    <img src="{{ url('template/user/image/icon/delivery_success.png') }}" alt="">
                    @endif
                </td>
                <td>Tình trạng đơn hàng:</td>
                <td>
                    @if($orderDetail->order_status==0)
                    Đặt hàng thành công
                    @endif
                    @if($orderDetail->order_status==1)
                    Đang chuẩn bị hàng
                    @endif
                    @if($orderDetail->order_status==2)
                    Đơn hàng đang được vận chuyển
                    @endif
                    @if($orderDetail->order_status==3)
                    Giao hàng thành công
                    @endif
                </td>
            </tr>
        </table>

    </div>
    <div class="order_pdt">
        <div class="order_list_pdt">
            <table>
                @foreach($orderProductDetail as $item)
                <tr>
                    <td><a href="" class="order_pdt_img"><img
                                src="{{ url('template/image/product/'.$item->product_image) }}" alt=""></a></td>
                    <td><a href="">{{$item->product_name }} </a> </td>
                    <td>{{$item->product_amount }}</td>
                    <td>
                        <p>{{ number_format($item->product_price)}}đ</p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Phí vận chuyển</td>
                    <td>
                        <p>{{ number_format($orderDetail->delivery_money)}} </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Tổng cộng</td>
                    <td>
                        <p style="font-weight:700;font-size: 16px;">{{ number_format($orderDetail->total_money)}}đ </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection