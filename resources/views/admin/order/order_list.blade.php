@extends('admin.layout_admin')
@section('Content')
<div class="management_main">
    {{-- <form method="POST" action=""> --}}
        <div class="home-tabs">
            <div class="home-tab-title">


                <div class="home-tab-item" 
                     @if($status=='6') style="background: rgb(92, 184, 92)" @endif
                style="padding:0px 12px " id="home-tab-item">
                <a style="font-size:14px" @if($status=='6') style="color:white" @endif
                    id="home-tab-item-all-link" href="{{route('admin.order.index',['status'=>'6'])}}" >Tất cả</a>
                    <span>{{$count[0]}}</span>
                </div>


                <div class="home-tab-item"
                 @if($status=='0') 
                style="background: rgb(92, 184, 92)"
                @endif
                style="padding:0px 12px" id="home-tab-item-active">
                    <a style="font-size:14px"
                    @if($status=='0') 
                style="color:white" 
                @endif
                    id="home-tab-item-active-link" href="{{route('admin.order.index',['status'=>'0'])}}">Đặt hàng</a>
                    <span>{{$count[1]}}</span>
                </div>


                <div class="home-tab-item"
                @if($status=='1') 
                style="background: rgb(92, 184, 92)"
                @endif
                 style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px"
                    @if($status=='1') 
                style="color:white" 
                @endif
                    id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'1'])}} ">Đang chuẩn bị</a>
                    <span>{{$count[2]}}</span>
                </div>


                <div class="home-tab-item"
                @if($status=='2') 
                style="background: rgb(92, 184, 92)"
                @endif
                 style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px"
                    @if($status=='2') 
                style="color:white" 
                @endif
                    id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'2'])}} ">Vận chuyển</a>
                    <span>{{$count[3]}}</span>
                </div>


                <div class="home-tab-item"
                @if($status=='3') 
                style="background: rgb(92, 184, 92)"
                @endif
                 style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px"
                    @if($status=='3') 
                style="color:white" 
                @endif
                    id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'3'])}} ">Đã giao</a>
                    <span>{{$count[4]}}</span>
                </div>


                <div class="home-tab-item"
                @if($status=='4') 
                style="background: rgb(92, 184, 92)"
                @endif
                 style="padding:0px 12px" id="home-tab-item-hide">
                    <a style="font-size:14px"
                    @if($status=='4') 
                style="color:white" 
                @endif
                    id="home-tab-item-hide-link" href="{{route('admin.order.index',['status'=>'4'])}} ">Đã hủy</a>
                    <span>{{$count[5]}}</span>
                </div>
            </div>
            <div class="layout-list-row layout-list-btn-wrap">
                <form method="Get" action="">
                    {{-- <label for="" class="label_search">Tìm kiếm</label> --}}
                    <input placeholder="Nhập tên sản phẩm" class="ipn_search" type="search" name="search_txt"
                        value="{{request()->search_txt}}">
                    <button type="submit" class="btn btn-success" value="" name="">Tìm kiếm</button>
                </form>

                
            </div>
            <div class="layout-list-row">
                <table>
                    @if (isset($resultSearch['titleSearch']))
                    <tr>
                        <td colspan="7"> Kết quả tìm kiếm :<span
                                style="color: red; font-size: 16px;padding-left:10px">{{$resultSearch['titleSearch']}}</span>
                        </td>
                    </tr>
                    {{-- Tiêu đề kết quả --}}
                    @if (isset($resultSearch['titleSearch'])&&$resultSearch['titleSearch']>0)
                    <tr class="title_order">
                        <td><input type="checkbox" name="" id="checkall" onclick="selects(this)"></td>
                        <td>Mã sản phẩm</td>
                        <td>Tên sản phẩm</td>
                        <td>Hình ảnh</td>
                        <td>Số lượng</td>
                        <td>Ngày cập nhật</td>
                        <td>Ẩn/Hiện</td>
                        <td>Cập nhật</td>
                        <td>Xóa</td>
                    </tr>
                    @endif
                    @endif
                    {{-- Danh sách kết quả tìm kiếm --}}
                    @foreach ($resultSearch['listSearch']??[] as $item)
                    <tr>
                       
                        <td>{{$item->id}}</td>
                        <td>{{$item->product_name}}</td>
                        <td><img src="{{ url('template/image/product_image/'.$item->product_image) }}"
                            style="height: 50px; width: 50px;"></td>
                        <td>{{$item->product_quantity}}</td>
                        <td>{{ date('d-m-Y', strtotime($item->updated_at))}}</td>
                        <td>@if ($item->active==0)
                            <button class="btn btn-success" type="submit" name=""
                                formaction="{{route('admin.product.active-product',['name'=>'show','id'=>$item->id])}}">Hiện</button>
                            @else
                            <button class="btn btn-success" type="submit" name=""
                                formaction="{{route('admin.product.active-product',['name'=>'hidden','id'=>$item->id])}}">Ẩn</button>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary"
                                href="{{route('admin.product.edit',['id'=>$item->id])}}">Cập
                                nhật</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger deleteCategoryBtn "
                                value="{{$item->id}}">Xóa</button>
                        </td>
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
                                    <a class="btn btn-primary"
                                        href="{{route('admin.product.edit',['id'=>$item->id])}}">Xem chi tiết</a>
                                </td>
                               
                                @if(($status==0&& $status!=null)||($status==1&& $status!=null))
                                 <td>
                                    <button type="button" class="btn btn-danger deleteCategoryBtn "
                                        value="{{$item->id}}">Xóa</button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
   
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