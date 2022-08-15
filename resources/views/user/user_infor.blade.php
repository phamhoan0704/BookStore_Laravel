@extends('user.layout_user')
@section('Content')

<div class="infor_container">
        <div class="infor_left_menu">
           @include('user.menuleft_infor')
        </div>
        <div class="infor_box_infor">
            <div class="infor_box_inforx">
                <div class="infor_top-box">
                    <h1>Hồ sơ của tôi<h1>
                            <div class="infor_borderbox">
                               Quản lí thông tin hồ sơ bảo mật tài khoản
                            </div>
                </div>
                <div class="infor_mainbox">
                    <div class="infor_leftboxinfor">
                        <form action="" method="post">
                            @csrf
                       
                            <div class="infor_box">
                                <div class="infor_inp">
                                    <div class="infor_label">
                                        <label for="">Tên đăng nhập</label>
                                    </div>
                                    <div class="infor_inpuif">
                                        <div class="infor_input">
                                            <input type="text" name="username" value="{{$data->user_name}}" readonly>

                                        </div>

                                        <div class="infor_btn">
                                            <button></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="infor_box">
                                <div class="infor_inp">
                                    <div class="infor_label">
                                        <label for="">Họ và tên</label>
                                    </div>
                                    <div class="infor_inpuif">
                                        <div class="infor_input">
                                            <input type="text" name="fullname" value="{{$data->name}}">
                                            <span>
                                                <?php  ?>
                                            </span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="infor_box">
                                <div class="infor_inp">
                                    <div class="infor_label">
                                        <label for="">Số điện thoại</label>
                                    </div>
                                    <div class="infor_inpuif">
                                        <div class="infor_input">
                                            <input type="text" name="phone" value="{{$data->user_phone}}">
                                            <span>
                                                <?php  ?>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="infor_box">
                                <div class="infor_inp">
                                    <div class="infor_label">
                                        <label for="">Email</label>
                                    </div>
                                    <div class="infor_inpuif">
                                        <div class="infor_input">
                                            <input type="text" name="email" value="{{$data->email}}" readonly>
                                            <span>
                                               </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="infor_box">
                                <div class="infor_inp boxbtn">
                                    <div class="infor_label"><label for=""></label></div>
                                    <div class="infor_btnsave">
                                        <button name="btnsubmit" formaction="{{route('user.changeProfile')}}">Lưu</button>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="infor_imgbox2">
                        <div class="infor_avatarbox">
                            <a href="" class="infor_avatar">
                                <div class="infor_frame-avatar2">
                                    <div class="infor_avatar-img2">
                                        <i class="infor_fa fa-regular fa-user">
                                            <img src="../img/user/<?php  ?>" alt="">
                                        </i>
                                    </div>
                                </div>
                            </a>
                            <div class="infor_btn2">
                                <input type="file" value="Chọn Ảnh" name="avataruser">
                                <div class="infor_fileimg">
                                    <span>Dung lượng file tối đa 1MB</span>
                                    <span>Định đạng:.JPG,.PNG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection