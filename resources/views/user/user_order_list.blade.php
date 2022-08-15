@extends('user.layout_user')
@section('Content')
<div class="user_order_container">
    <div class="left_menu">
      @include('user.menuleft_infor')
    </div>
    <div class="box_infor">
        <div class="box_inforx">
            <div class="order_list_box">
                <div class="home-tabs">
                    <div class="home-tab-title orderlistTab">
                    <div class="home-tab-item active">
                            <div class="icon_order">
                                <img src="{{url('template/user/image/icon/order.png')}}" alt="">
                          
                        </div>
                            <div class="status_order">
                                <span>Đặt hàng</span>
                            </div>
                        </div>
                        <div class="home-tab-item">

                            <div class="icon_order">
                                <img src="{{url('template/user/image/icon/pack.png')}}" alt="">
                          
                        </div>
                            <div class="status_order">
                                <span>Chuẩn bị hàng</span>
                            </div>

                        </div>
                        <div class="home-tab-item">
                            <div class="icon_order">
                                <img src="{{url('template/user/image/icon/delivery.png')}}" alt="">
                          
                        </div>
                            <div class="status_order">
                                <span>Đang giao</span>
                            </div>
                        </div>
                        <div class="home-tab-item">
                            <div class="icon_order">
                                <img src="{{url('template/user/image/icon/delivery_success.png')}}" alt="">
                          
                        </div>
                            <div class="status_order">
                                <span>Giao hàng thành công</span>
                            </div>
                        </div>
                        <div class="home-tab-item">
                            <div class="icon_order">
                                <img src="{{url('template/user/image/icon/order.png')}}" alt="">
                          
                        </div>
                            <div class="status_order">
                                <span>Đã hủy</span>
                            </div>
                        </div>
                        <div class="line">
                        </div>
                    </div>
                    <div class="home-tab-content">
                        <div class="home-tab-pane active">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                  

                                </tr>
                                @if ($orderList0->count() != null)
                                    @foreach ($orderList0 as $item) 
                               
                                    <tr class="br">
                                        
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->order_date}}</td>
                                        <td> {{ number_format($item->total_money)}}đ </td>
                                        <td style="width:50px;"><a href="{{route('user.order.orderDetail',['id'=>$item->id])}}"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr>
                                     @endforeach
                                     @endif
                            </table>
                        </div>
                        <div class="home-tab-pane">

                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                    
                                </tr>
                                @if ($orderList1->count() != null)
                                    @foreach ($orderList1 as $item) 
                               
                                    <tr class="br">
                                        
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->order_date}}</td>
                                        <td> {{ number_format($item->total_money)}}đ </td>
                                        <td style="width:50px;"><a href="{{route('user.order.orderDetail',['id'=>$item->id])}}"><button class="btn">Xem chi tiết</button></a></td>

                                    </tr>
                                     @endforeach
                                     @endif
                            </table>

                        </div>
                        <div class="home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                @if ($orderList2->count() != null)
                                    @foreach ($orderList2 as $item) 
                               
                                    <tr class="br">
                                        
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->order_date}}</td>
                                        <td> {{ number_format($item->total_money) }}đ</td>
                                        <td style="width:50px;"><a href="{{route('user.order.orderDetail',['id'=>$item->id])}}"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr>
                                     @endforeach
                                     @endif
                            </table>
                        </div>
                        <div class="home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                @if ($orderList3->count() != null)
                                    @foreach ($orderList3 as $item) 
                               
                                    <tr class="br">
                                        
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->order_date}}</td>
                                        <td> {{ number_format($item->total_money) }}đ</td>
                                        <td style="width:50px;"><a href="{{route('user.order.orderDetail',['id'=>$item->id])}}"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr>
                                     @endforeach
                                     @endif
                            </table>
                        </div>
                        <div class="home-tab-pane">
                            <table id="tb1">
                                <form>
                                    <tr class="br">
                                        <th>Đơn hàng</th>
                                        <th>Người nhận</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                    @if ($orderList4->count() != null)
                                    @foreach ($orderList4 as $item) 
                               
                                    <tr class="br">
                                        
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->name}}</td>
                                        <td> {{$item->order_date}}</td>
                                        <td> {{ number_format($item->total_money) }}đ </td>
                                        <td style="width:50px;"><a href="{{route('user.order.orderDetail',['id'=>$item->id])}}"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr>
                                     @endforeach
                                     @endif
                                    <form>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('template/user/js/home_tab.js')}}"></script>


@endsection