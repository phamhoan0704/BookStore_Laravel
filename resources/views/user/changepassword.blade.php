 @extends('user.layout_user')
 @section('Content')
 {{-- Model --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.author.delete')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="supplier_id">
                    <h5>Đổi mật khẩu thành công </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
 <div class="changepass_container">
        <div class="changepass_left_menu">
            @include('user.menuleft_infor') 
        </div>
        <div class="changepass_box_infor">
            <div class="changepass_box_inforx">
                <div class="changepass_top-box">
                    <h1>Đổi mật khẩu<h1>
                            <div class="changepass_borderbox">
                                Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác
                            </div>
                </div>
                <div class="changepass_mainbox">
                    <div class="changepass_leftboxinfor">
                        <form action="{{Route('user.storeNewPass')}}" method="post">
                            @csrf
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Mật khẩu hiện tại</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="pass">
                                        <div class="changepass_btn">
                                            <span>
                                               @error('pass'){{$message}}@enderror
                                               @if(Session::has('fail1')) 
                                               {{Session::get('fail1')}}
                                               @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Mật khẩu mới</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="newpass" value="">
                                        <div class="changepass_btn">
                                            <span>
                                                @error('pass') {{$message}}@enderror
                                                @if(Session::has('fail2'))
                                                {{Session::get('fail2')}}
                                                 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp">
                                    <div class="changepass_label">
                                        <label for="">Xác nhận lại mật khẩu</label>
                                    </div>
                                    <div class="changepass_inpuif">
                                        <input type="password" name="newpassconfirm">

                                        <div class="changepass_btn">
                                            <span>
                                                 @error('pass') {{$message}}@enderror
                                                @if(Session::has('fail2'))
                                                {{Session::get('fail2')}}
                                                 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="changepass_box">
                                <div class="changepass_inp boxbtn">
                                    <div class="changepass_label"></div>
                                    <div class="changepass_btnsave">
                                        <button name="btnsubmit" id="#btnsubmit">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
    @if(Session::has('success'))
   {{script}}
    
     @endif
@endsection
@section('Scripts')
<script>
    $(document).ready(function() {
          $('.btnsubmit').click(function(){   
                var id=this.value;
                $('#supplier_id').val(id);
                $('#deleteModal').modal();
            });
         });
</script>


@endsection

@section('script') 
               <script type ='text/JavaScript'>
                alert('Đổi mật khẩu thành công!');
                </script>
                @endsection