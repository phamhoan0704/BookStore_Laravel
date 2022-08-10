@extends('user.layout_user')
@section('Content')
{{Modal}}
<!-- tạo hộp thoại thông báo đăng ký thành công -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div>tôi là ai</div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="category_id">
                    <h5>Tạo tài khoản thành công </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">
                        <a href="{{ route('login')}}">Đăng nhập ngay</a></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  -->
<div class="register_container">
        <div class="register_wapper">
            <div class="register_tittler">
                <h2>Tạo tài khoản<h2>
            </div>
            <form class="register_form" action="{{ route('storeUser')}}" method="POST">
            @csrf
            <!-- box thông báo đăng ký thành công -->
                <div class="register_group userip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-regular fa fa-user"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="{{old('name')}}" name="name" placeholder="Tên đăng nhập">
                        </div>
                    </div>

                    <div class="register_messerror spName ">
                        <span> @error('name'){{$message}} @enderror</span>
                    </div>
                </div>
                <div class="register_group passwordip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-solid fa fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPassword" placeholder="Mật khẩu" name="password" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPassword" type="button">
                                <i class="register_fa-regular fa fa-eye" id="btnEye"></i>

                            </button>

                        </div>

                    </div>
                    <div class="register_messerror ">
                        <span >@error('password'){{$message}} @enderror</span>
                    </div>

                </div>
                <!-- <div class="register_group passwordipagain">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-solid fa fa-lock"></i>
                        </div>
                        <div id="pass">
                            <input type="password" id="ipnPasswordAgain" placeholder="Xác nhận mật khẩu" name="ipnPassAgain" value="">
                        </div>
                        <div id="showpass">
                            <button id="btnPasswordAgain" type="button">
                                <i class="register_fa-regular fa fa-eye" id="btnEye"></i>

                            </button>

                        </div>
                    </div>
                    <div class="register_messerror ">
                        <span> @error('password'){{$message}} @enderror</span>
                    </div>
                </div> -->
                <div class="register_group emailip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-regular fa fa-envelope"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="{{old('email')}}" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="register_messerror spName ">
                        <span>@error ('email'){{$message}} @enderror</span>
                    </div>
                </div>
                <div class="register_group phoneip">
                    <div class="register_loginf">
                        <div class="register_icon">
                            <i class="register_fa-solid fa fa-phone"></i>
                        </div>
                        <div id="user">
                            <input type="text" value="{{old('phone')}}" name="phone" placeholder="Số điện thoại">
                        </div>
                    </div>

                    <div class="register_messerror spName ">
                        <span>@error('phone'){{$message}} @enderror</span>
                    </div>
                </div>
                <div class="register_submit_btn">
                    <button name="submit_btn">Đăng ký</button>
                </div>
                <div class="register_sp1">
                    <span>Bạn đã có tài khoản? Đăng nhập <a href="{{ route('logIn')}}">Tại đây</a></span>
                </div>
                <!-- <span>hoặc</span><hr>
                <div class="register_separator">
                    <span>hoặc</span>
                </div> -->
                <div class="register_orthericon">

                        <div class="register_quick_login facebook">
                            <div class="register_logo">
                                <i class="register_fab fa fa-facebook-f"></i>
                            </div>
                            <div class="register_text">Đăng nhập bằng Facebook</div>


                        </div>
                        <div class="register_quick_login google">
                            <div class="register_logo">
                                <i class="register_fab fa fa-google-plus-g"></i>
                            </div>
                            <div class="register_text">Đăng nhập bằng Google</div>
                        </div>

                    </div>
              


        </div>

        </form>
    </div>
    </div>

    <script src="../js/register.js"></script>

<!-- @if(Session::has('success')) -->

<!-- 
@endif -->
@endsection
@section('Scripts')
<script>
    $(document).ready(function() {
          $('.submit_btn').click(function(){   
                var category_id=this.value;
                $('#category_id').val(category_id);
                $('#deleteModal').modal();
            });
         });
</script>
@endsection