

<div class="left_menu">
            <div class="profile">
                <div class="imgbox">
                    <a href="..img/prod/" class="avatar">
                        <div class="frame-avatar">
                           
                            <div class="avatar-img">
                           <img src="{{url('template/user/img/avata/'.$data->user_image)}}" alt="">
                                <i class="fa fa-regular fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div classs="namebox">
                    <div class="nameuser">
                        <!-- <?php ?> -->
                    </div>
                    <div class="altterInfor">
                        <a href="{{route('user.infor')}}" class="altter">
                            <i class="fa fa-solid fa-pen"></i> Sửa hồ sơ
                        </a>
                    </div>
                </div>
            </div>
            <div class="list_e">
                <div class="stardust-dropdown stardust-dropdown-open">
                    <div class="stardust-dropdown-header">
                        <a href="">
                            <div class="imgPurchase">
                                <img src="{{url('template/user/image/icon/user.png')}}" alt="">
                            </div>
                            <div>
                                <span>Tài khoản của tôi</span>
                            </div>
                        </a>
                    </div>
                    <div class="stardust-dropdown-itembody stardust-dropdown-itembody-open">
                        <div class="frame_box">
                            <a href="{{route('user.infor')}}">Hồ sơ</a>
                            <a href="">Ngân Hàng</a>
                            <a href="">Địa chỉ</a>
                            <a href="{{route('user.changepass')}}">Đổi mật khẩu</a>

                        </div>
                    </div>

                </div>
                <div class="stardust-dropdown">
                    <div class="stardust-dropdown-header">
                        <a href="{{route('user.order.orderList')}}">
                            <div class="imgPurchase">
                                <img src="{{url('template/user/image/icon/purchase.png')}}" alt="">
                            </div>
                            <div>
                                <span>Đơn mua</span>
                            </div>
                        </a>
                    </div>
                    <div class="stardust-dropdown-itembody">

                    </div>
                </div>


            </div>
            <div class="stadust-dropdown">
                <div class="stardust-dropdown-header">
                    <a href="">Thông báo</a>
                </div>
                <div class="stardust-dropdown-itembody">

                </div>
            </div>
            <div class="stadust-dropdown">
                <div class="stardust-dropdown-header">
                    <a href="">Kho voucher</a>
                </div>
                <div class="stardust-dropdown-itembody">

                </div>
            </div>

        </div>
