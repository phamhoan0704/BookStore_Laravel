@extends('admin.layout_admin')
@section('Content')
{{-- Model --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="supplier_id">
                    <h5>Bạn có chắc chắn xóa tài khoản người dùng này không? </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="management_main">
    {{-- <form method="POST" action=""> --}}
        <div class="home-tabs">
            <div class="home-tab-title">
                <div class="home-tab-item" id="home-tab-item-all">
                    <a id="home-tab-item-all-link" href="{{route('admin.account.index')}}" style="padding:18px">Tất
                        cả</a>
                    <span>{{$count[0]}}</span>
                </div>
                <div class="home-tab-item" id="home-tab-item-active">
                    <a id="home-tab-item-active-link" href="{{route('admin.account.index',['name'=>'active'])}}"
                        style="padding:18px">Đang hoạt
                        động</a>
                    <span>{{$count[1]}}</span>
                </div>
                <div class="home-tab-item" id="home-tab-item-hide">
                    <a id="home-tab-item-hide-link" href="{{route('admin.account.index',['name'=>'hide'])}} "
                        style="padding:18px">Đã khóa</a>
                    <span>{{$count[2]}}</span>
                </div>
            </div>
            <div class="layout-list-row layout-list-btn-wrap">
                <form method="Get" action="">
                    {{-- <label for="" class="label_search">Tìm kiếm</label> --}}
                    <input placeholder="Nhập tên người dùng" class="ipn_search" type="search" name="search_txt"
                        value="{{request()->search_txt}}">
                    <button type="submit" class="btn btn-success" value="" name="">Tìm kiếm</button>
                </form>

                <form method="POST" action="">
                    @csrf
                    {{-- Ẩn /Hien tất cả --}}
                    <button type="submit" name="" value="" class="btn btn-success btn_hidden"
                        formaction="{{route('admin.account.active-account',['name'=>'hidden'])}}">Khóa tài khoản</button>

                    <button type="submit" name="" class="btn btn-success btn_hidden"
                        formaction="{{route('admin.account.active-account',['name'=>'show'])}}">Hiện</button>


                    <!-- thêm danh mục -->
                    <button class="btn_add">
                        <a class="btn btn-success" href="{{route('admin.account.create')}}">Thêm tài khoản</a>
                    </button>

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
                    <td>
                        <input type="checkbox" name="" id="checkall2" onclick="selects2(this)">
                        </td>
                        <td>Mã tài khoản</td>
                        <td>Tên người dùng</td>
                        <td>Email</td>
                        <td>Đã mua</td>
                        <td>Ngày tạo</td>
                        <td>Ẩn/Hiện</td>
                    
                    </tr>
                    @endif
                    @endif
                    {{-- Danh sách kết quả tìm kiếm --}}
                    @foreach ($resultSearch['listSearch']??[] as $item)
                    <tr>
                    <td>
                                <input type="checkbox" value="{{$item->id}}" class="check2" name="ids[{{$item->id}}]"
                                    onclick="check2(this)">
                            </td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->email}}</td>
                     
                     
                            <td>{{date('d-m-Y', strtotime($item->updated_at))}}</td>
                            <td>@if ($item->active==0)
                                <button class="btn btn-success" type="submit" name=""
                                    formaction="{{route('admin.account.active-account',['name'=>'show','id'=>$item->id])}}">Hiện</button>
                                @else
                                <button class="btn btn-success" type="submit" name=""
                                    formaction="{{route('admin.account.active-account',['name'=>'hidden','id'=>$item->id])}}">Ẩn</button>
                                @endif
                            </td>
                          
                           
                        </tr>
                        @endforeach
                </table>
            </div>
            <div class="home-tab-content">
                <!-- Danh sách index -->
                <div class="layout-list-row">
                    <table>
                        {{-- Tiêu đề --}}
                        <tr class="title_order">
                            <td>
                                <input type="checkbox" name="" id="checkall2" onclick="selects2(this)">
                            </td>
                            <td>Mã tài khoản</td>
                            <td>Tên người dùng</td>
                            <td>Email</td>
                            <td>Đã mua</td>
                            <td>Ngày tạo</td>
                            <td>Ẩn/Hiện</td>
     
                        </tr>
                        {{-- Danh sách --}}

                        @foreach ($list as $item)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{$item->id}}" class="check2" name="ids[{{$item->id}}]"
                                    onclick="check2(this)">
                            </td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->total }}</td>
                     
                     
                            <td>{{date('d-m-Y', strtotime($item->updated_at))}}</td>
                            <td>@if ($item->active==0)
                                <button class="btn btn-success" type="submit" name=""
                                    formaction="{{route('admin.account.active-account',['name'=>'show','id'=>$item->id])}}">Hiện</button>
                                @else
                                <button class="btn btn-success" type="submit" name=""
                                    formaction="{{route('admin.account.active-account',['name'=>'hidden','id'=>$item->id])}}">Ẩn</button>
                                @endif
                            </td>
                          
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
    </form>
</div>
</div>
{{-- Số trang --}}
<div>
    {{$list->links()}}
</div>

<script>
    var chk=document.getElementsByClassName('check');  
        var checkall=document.getElementById('checkall'); 
        function selects(x) { 
            for(var i=0; i<chk.length; i++){   
                    chk[i].checked = x.checked ? true:false
            } 
        }  
        function check(x) {
            var dem = 0 
            for(var i=0; i<chk.length; i++){   
                if(chk[i].checked == false) {
                    checkall.checked = false;
                } else dem++;
            } 
            if(dem == chk.length) checkall.checked = true;
        }
</script>
<script>
    var chk2=document.getElementsByClassName('check2');  
    var checkall2=document.getElementById('checkall2'); 
    function selects2(x) { 
        for(var i=0; i<chk2.length; i++){   
                chk2[i].checked = x.checked ? true:false
        } 
    }  
    function check2(x) {
        var dem = 0 
        for(var i=0; i<chk2.length; i++){   
            if(chk2[i].checked == false) {
                checkall2.checked = false;
            } else dem++;
        } 
        if(dem == chk2.length) checkall2.checked = true;
    }

</script>

@endsection
@section('Scripts')
<script>
    $(document).ready(function() {
          $('.deleteBtn').click(function(){   
                var id=this.value;
                $('#supplier_id').val(id);
                $('#deleteModal').modal();
            });
         });
</script>


{{-- <script>
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