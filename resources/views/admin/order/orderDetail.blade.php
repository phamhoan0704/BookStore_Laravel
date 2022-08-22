@extends('admin.layout_admin')
@section('Content')
<div class="order_detail_content">
    

     <div class="order_detail_main">
       <table class="table_user">
                 <tr><td style="font-size: 16px;font-weight:bold">Thông tin đơn hàng </td> </tr>
                 <tr>
                    <td class="" style="width:200px">Mã đơn hàng: 
                    </td>
                    <td>{{$orderDetail[0]->order_id}}
                    </td>
                </tr>
                <tr>
                    <td class=""  style="width:200px">Họ tên: </td>
                    <td>{{$orderDetail[0]->name}}</td>
                </tr>
                <tr>
                    <td class="" style="width:200px">Email: </td>
                    <td>{{$orderDetail[0]->email}}</td>
                    </td>
                </tr>
                <tr>
                    <td class=""  style="width:200px">Số điện thoại: </td>
                    <td>{{$orderDetail[0]->phone}}</td>
                   </td>
                </tr>
                <tr>
                    <td class="" style="width:200px">Địa chỉ: </td>
                    <td>{{$orderDetail[0]->address}}</td>
                   </td>
                </tr>
                <tr>
                    <td style="width:200px"> Ghi chú: </td>
                    @if(!empty($orderDetail[0]->order_note))
                    <td>{{$orderDetail[0]->order_note}}</td>
                    @endif
                </tr>

                <tr>
                    <td class=""  style="width:200px">Trạng thái đơn hàng:</td>
                    <td>
                           @if($orderDetail[0]->order_status==0)
                               {{'Đặt hàng'}} 
                            @elseif($orderDetail[0]->order_status==1)
                                {{'Đang chuẩn bị hàng'}}
                                @elseif($orderDetail[0]->order_status==2)
                                {{'đơn hàng đang được vận chuyển'}}
                                @elseif($orderDetail[0]->order_status==3)
                                {{'Giao hàng thành công '}}
                                @elseif($orderDetail[0]->order_status==4)
                                {{'Đã hủy'}}
                            @endif
                   </td>

                </tr>
                <tr>
                    <td class=""  style="width:200px">Hình thức thanh toán:</td>
                    <td> @if($orderDetail[0]->payment_method==1)
                                {{'Thanh toán online'}}
                                @elseif($orderDetail[0]->payment_method==2)
                                {{'Thanh toán khi nhận hàng'}}
                            @endif
                   </td>

                </tr>
                <tr>
                    <td class="" style="width:200px">Trạng thái thanh toán:</td>
                    <td>  @if($orderDetail[0]->payment_status==0)
                                {{'Chưa thanh toán'}}
                                @elseif($orderDetail[0]->payment_status==1)
                                {{'Đã thanh toán'}}
                            @endif
                   </td>

                </tr>
            </table>

       <table class="table_pdt">
           <tr class="title_order_detail">
               <td>Mã sản phẩm</td>
               <td>Tên sản phẩm</td>
               <td>Hình ảnh</td>
               <td>Số lượng</td>
               <td>Giá tiền</td>
           </tr>  
           @foreach($orderDetail as $value)
           <tr>
               <td>{{$value->product_id}}</td>
               <td style="width:500px">{{$value->product_name}}</td>
               <td><img src="{{ url('template/image/product/'.$value->product_image)}}" alt=""> </td>
               <td>{{$value->product_amount }}</td>
               <td>{{$value->product_price }}</td>
           </tr>
           @endforeach

       </table>
            <form method="POST" class="order_status_update" action="{{route('admin.order.post-edit',['id'=>$orderDetail[0]->order_id])}}">
                @csrf
               @if($orderDetail[0]->order_status==1||$orderDetail[0]->order_status==2||$orderDetail[0]->order_status==3||$orderDetail[0]->order_status==4) 
               @endif
                <div style="width:600px">
                    <div>
                        <label for="">Trạng thái đơn hàng: </label>
                    </div>
                    <select name="status">
                        <option value="0" @if($orderDetail[0]->order_status==0) {{"selected=\'selected\'"}} @endif >Đặt hàng</option>
                        <option value="1" @if($orderDetail[0]->order_status==1) {{"selected=\"selected\""}} @endif >Đang chuẩn bị hàng</option>
                        <option value="2" @if($orderDetail[0]->order_status==2) {{"selected=\"selected\""}} @endif >Đơn hàng đang được vận chuyển</option>
                        <option value="3" @if($orderDetail[0]->order_status==3) {{"selected=\"selected\""}} @endif >Giao hàng thành công</option> 
                        <option value="4" @if($orderDetail[0]->order_status==4) {{"selected=\"selected\""}} @endif >Đã hủy</option> 
                    
                    </select>
                </div>
               

                <div>
                <div style="width: 200px;">
                    <label for="">Trạng thái thanh toán: </label>
                </div>
                <div>
                    
           
                    <select name="payment_status">
                        <option value="0" @if($orderDetail[0]->payment_status==0) {{"selected=\"selected\""}} @endif>Chưa thanh toán</option>
                        <option value="1" @if($orderDetail[0]->payment_status==1) {{"selected=\"selected\""}} @endif>Đã thanh toán</option>
                    </select>
                </div>
            
                </div>
                <button type="submit">Cập nhật</button>
            </form>

     </div>
</div> 
@endsection