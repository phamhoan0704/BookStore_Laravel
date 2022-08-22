@extends('admin.layout_admin')
@section('Content')
<div class="management_main">
    <form method="get" action="">
        @csrf
        <div class="home-tabs">
            <div class="home-tab-title">


                <div class="home-tab-item" @if($status=='6' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px " id="home-tab-item">
                    <a style="font-size:14px" @if($status=='6' ) style="color:white" @endif id="home-tab-item-all-link" href="{{route('admin.order.index',['status'=>'6'])}}">Tất cả</a>
                    <span>{{$count[0]}}</span>
                </div>


                <div class="home-tab-item" @if($status=='0' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px" id="home-tab-item-active">
                    <a style="font-size:14px" @if($status=='0' ) style="color:white" @endif id="home-tab-item-active-link" href="{{route('admin.order.index',['status'=>'0'])}}">Đặt hàng</a>
                    <span>{{$count[1]}}</span>
                </div>


                <div class="home-tab-item" @if($status=='1' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px" @if($status=='1' ) style="color:white" @endif id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'1'])}} ">Đang chuẩn bị</a>
                    <span>{{$count[2]}}</span>
                </div>


                <div class="home-tab-item" @if($status=='2' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px" @if($status=='2' ) style="color:white" @endif id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'2'])}} ">Vận chuyển</a>
                    <span>{{$count[3]}}</span>
                </div>


                <div class="home-tab-item" @if($status=='3' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px" @if($status=='3' ) style="color:white" @endif id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'3'])}} ">Đã giao</a>
                    <span>{{$count[4]}}</span>
                </div>


                <div class="home-tab-item" @if($status=='4' ) style="background: rgb(92, 184, 92)" @endif style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px" @if($status=='4' ) style="color:white" @endif id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'4'])}} ">Đã hủy</a>
                    <span>{{$count[5]}}</span>
                </div>
            </div>
            <div class="layout-list-row layout-list-btn-wrap">
                <form method="post" action="">
                    @csrf
                    {{-- <label for="" class="label_search">Tìm kiếm</label> --}}
                    <input placeholder="Nhập mã đơn hàng" class="ipn_search" type="search" name="search_txt" value="{{request()->search_txt}}">
                    <button type="submit" class="btn btn-success" value="" name="">Tìm kiếm</button>
                    <input type="hidden" value="">
                    <div> 
                        <span>Sắp xếp theo:</span>
                        <select name="sort">
                        <option value="1" @if('1==1') {{"selected=\"selected\""}} @endif>Tiền hàng lớn nhất</option>
                        <option value="2" @if('1==1') {{"selected=\"selected\""}} @endif>Tiền hàng nhỏ nhất</option>
                        <option value="3" @if('1==1') {{"selected=\"selected\""}} @endif>Ngày mua gần nhất</option>
                    </select></div>
                </form>


            </div>
            <div class="layout-list-row">
                <table>
                    @if (isset($resultSearch['titleSearch']))
                    <tr>
                        <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 16px;padding-left:10px">{{$resultSearch['titleSearch']}}</span>
                        </td>
                    </tr>
                    {{-- Tiêu đề kết quả --}}
                    @if (isset($resultSearch['titleSearch'])&&$resultSearch['titleSearch']>0)
                    
                        <td>Mã hóa đơn</td>
                        <td>Mã khách hàng</td>
                        <td>Tổng tiền</td>
                        <td>Trạng thái đơn hàng</td>
                        <td>Ngày đặt hàng</td>
                        <td>Xem chi tiết</td>
                        <td>Xóa</td>
                    </tr>
                    @endif
                    @endif
                    {{-- Danh sách kết quả tìm kiếm --}}
                    @foreach ($resultSearch['listSearch']??[] as $item)
                    <tr>
                        
                    <td>{{$item->id}}</td>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->total_money}}</td>
                                <td>
                                    @if($item->order_status==0)
                                    {{'Đặt hàng'}}
                                    @endif
                                    @if($item->order_status==1)
                                    {{'Đang chuẩn bị hàng'}}
                                    @endif
                                    @if($item->order_status==2)
                                    {{'Đang vận chuyển'}}
                                    @endif
                                    @if($item->order_status==3)
                                    {{'Giao hàng thành công'}}
                                    @endif
                                    @if($item->order_status==4)
                                    {{'Đã hủy'}}
                                    @endif

                                </td>
                                <td>{{$item->order_date}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.order.detail',['id'=>$item->id])}}">Xem chi tiết</a>
                                </td>

                                @if(($item->order_status==0&& $item->order_status!=null)||($item->order_status==1&& $item->order_status!=null))
                                <td>
                               <form method="post" action="{{route('admin.order.destroy',['id'=>$item->id])}}">
                                @csrf
                                    <button type="submit" class="btn btn-danger deleteCategoryBtn " value="{{$item->id}}">Xóa</button>
                                </form>
                                </td>
                                @endif
                       
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="home-tab-content">
                <div class="home-tab-pane active">
                    <!-- Danh sách index -->
                    <div class="layout-list-row">
                        <table>
                            {{-- Tiêu đề --}}
                            <tr class="title_order">

                                <td>Mã hóa đơn</td>
                                <td>Mã khách hàng</td>
                                <td>Tổng tiền</td>
                                <td>Trạng thái đơn hàng</td>
                                <td>Ngày đặt hàng</td>
                                <td>Xem chi tiết</td>
                            

                                @if(($status==0&& $status!=null)||($status==1&& $status!=null))
                                <td>Xóa</td>
                                @endif

                            </tr>
                            {{-- Danh sách --}}
                            @foreach ($orderList as $item)
                            <tr>

                                <td>{{$item->id}}</td>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->total_money}}</td>
                                <td>
                                    @if($item->order_status==0)
                                    {{'Đặt hàng'}}
                                    @endif
                                    @if($item->order_status==1)
                                    {{'Đang chuẩn bị hàng'}}
                                    @endif
                                    @if($item->order_status==2)
                                    {{'Đang vận chuyển'}}
                                    @endif
                                    @if($item->order_status==3)
                                    {{'Giao hàng thành công'}}
                                    @endif
                                    @if($item->order_status==4)
                                    {{'Đã hủy'}}
                                    @endif

                                </td>
                                <td>{{$item->order_date}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.order.detail',['id'=>$item->id])}}">Xem chi tiết</a>
                                </td>

                                @if(($status==0&& $status!=null)||($status==1&& $status!=null))
                                <td>
                               <form method="post" action="{{route('admin.order.destroy',['id'=>$item->id])}}">
                                @csrf
                                    <button type="submit" class="btn btn-danger deleteCategoryBtn " value="{{$item->id}}">Xóa</button>
                                </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
    </form>
</div>
</div>
{{-- Số trang --}}
<div>
    {{-- {{$productList->links()}} --}}
</div>

@endsection
@section('Scripts')
{{--<script>
    $(document).ready(function() {
          $('.deleteCategoryBtn').click(function(){   
                var category_id=this.value;
                $('#category_id').val(category_id);
                $('#deleteModal').modal();
            });
         });
</script>
<script>
    $(document).ready(function() {
          $('.btn_hidden').click(function(){   
            console.log("aaaa");
            
            var val = [];
            $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
            });
            console.log(val);
            $('[name="ids[]"]').val(val);
            $('.btn_hidden').val(val);
            console.log(val);
            
            });
         });
</script> --}}

@endsection