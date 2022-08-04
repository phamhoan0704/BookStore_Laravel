<head>

    @include('user.head')
</head>

<body>
    <i class="far fa-frown"></i>

    <div id="body" style="font-family: 'Open Sans', sans-serif!important;box-sizing: border-box;margin: 0; padding: 0;">
        <div id="header">
            <div class="site-topbar">
                <div class="site-topbar__container">
                    <div class="site-topbar__text">
                        Công ty cổ phần xuất bản và truyền thông Trí Tuệ
                    </div>
                    <div class="site-topbar__user">
                        <a href="information.php" class="site-topbar__user-name">Xin chào :

                        </a>
                        <span class="sep">|</span>
                        <a href="log_out.php" class="site-topbar__logout">Đăng xuất</a>
                    </div>
                    <div class="">
                        <a href="" class="site-topbar__user-name">Đăng nhập </a>
                        <span class="sep">|</span>
                        <a href="" class="site-topbar__logout"> Đăng kí</a>
                    </div>
                </div>
            </div>

            <div class="site-header-container">
                <div class="site-header">
                    <div class="site-header__logo">
                        <a href="home.php">
                            <img src="{{ url('template/user/image/icon/logo.jpg') }}" alt="" class="img-logo">
                        </a>
                    </div>
                    <div class="site-header__search-wrap">
                        <form action="search_page.php" method="get">
                            <div class="header__search">
                                <input type="text" class="header__search-input" placeholder="Tìm kiếm" name="search_pdt"
                                    id="header_search">
                                <button type="submit" class="header__search-btn">
                                    <svg class="header__search-icon" height="64px" id="SVGRoot" version="1.1"
                                        viewBox="0 0 64 64" width="56px" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:cc="http://creativecommons.org/ns#"
                                        xmlns:dc="http://purl.org/dc/elements/1.1/"
                                        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                        xmlns:svg="http://www.w3.org/2000/svg">
                                        <defs id="defs3848" />
                                        <g id="layer1">
                                            <g id="g5183" style="stroke:white" transform="translate(25.5,-27)">
                                                <circle class="fil0 str1" cx="0.73810571" cy="53.392174" id="circle15"
                                                    r="20.063322"
                                                    style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke:white;stroke-width:2.00005412;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision" />
                                                <line class="fil0 str2" id="line25"
                                                    style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke: white;stroke-width:3.99974346;stroke-linecap:round;stroke-linejoin:round;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision"
                                                    x1="15.617603" x2="30.305107" y1="68.559662" y2="83.151169" />
                                                <path class="fil0 str0"
                                                    d="m -12.701441,53.392174 c 0,-7.391751 6.047795,-13.439547 13.43954602,-13.439547"
                                                    id="path281"
                                                    style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke:white;stroke-width:2.00005412;stroke-linecap:round;stroke-linejoin:round;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision" />
                                            </g>
                                        </g>
                                    </svg>
                                    <!-- <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i> -->
                                </button>
                            </div>
                        </form>
                    </div>
                    <a href="" class="site-header__cart-container">
                        <div class="site-header__cart">
                            <div class="header__cart-wrap">
                                <i class="bi bi-cart-plus-fill" style="color: 009234;font-size:40px"></i>
                                {{-- <i class="header__cart-icon fa fa-solid fa-cart-plus"
                                    style="font-family:Font Awesome 6 Free !important;"></i> --}}
                                <span class="header__cart-notice">
                                </span>
                                <div class="header__cart-list">
                                    <div class="header__cart-list-heading">
                                        <span>Sản Phẩm Mới Thêm</span>
                                    </div>
                                    <ul class="header__cart-list-item">
                                        <!-- Cart item -->
                                    </ul>
                                    <div class="text-mini-cart">
                                        <span class="text-left">Tổng tiền</span>
                                    </div>
                                    <div class='cart-check-mini'>
                                        <a class='cart-button' href='order.php'>
                                            <span>Thanh toán
                                                <i class='fa fa-chevron-right'></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p class="header__cart-info">
                                <span class="top-cart">Giỏ hàng</span>
                                <span class="cart_quantity">
                                </span> sản phẩm
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="site-nav">
                <ul class="header__nav">
                    <li class="header__nav-item">
                        <a href="home.php" class="header__nav-item-link">Trang chủ</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="product_category.php?id=0" class="header__nav-item-link">Sản phẩm</a>
                        <ul class="header__secondary-nav">

                        </ul>
                    </li>
                    <li class="header__nav-item">
                        <a href="{{route('user.news')}}" class="header__nav-item-link">Tin tức</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="about.php" class="header__nav-item-link">About</a>
                    </li>
                    <li class="header__nav-item">
                        <a href="contact.php" class="header__nav-item-link">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="content">
            {{-- @include('backend.alert') --}}
            @yield('Content')
        </div>


        <div class="footer">
            <div class="footer-container">
                <div class="footer-contact">
                    <div class="footer-logo">
                        <a href="/">
                            <img src="{{ url('template/user/image/icon/footer_logo.jpg') }}" alt="CÔNG TY CỔ PHẦN XUẤT BẢN VÀ TRUYỀN THÔNG IPM" />
                        </a>
                    </div>
                    <p class="footer-contact-row">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{-- <i class="fa fa-map-marker"></i> --}}
                        <span>Số 110 Nguyễn Ngọc Nại, Khương Mai, Thanh Xuân, Hà Nội </span>
                    </p>
                    <p class="footer-contact-row">
                        {{-- <i class="fa fa-phone"></i> --}}
                        <i class="bi bi-telephone"></i>
                        <span>Hotline: 03 2838 3979</span>
                    </p>
                    <p class="footer-contact-row">
                        {{-- <i class="fa fa-solid fa-envelope"></i> --}}
                        <i class="bi bi-envelope"></i>
                        <span>Email: online.ipmvn@gmail.com</span>
                    </p>
                    <p class="footer-contact-row">
                        {{-- <i class="fa fa-shield" aria-hidden="true"></i> --}}
                        <i class="bi bi-shield" ></i>
                        <span>
                            Giấy phép DKKD số 0101507251, cấp lần thứ 6 năm 2019
                        </span>
                    </p>
                </div>

                <div class="footer-policy">
                    <h4 class="footer-static-title">Chính sách</h4>
                    <div class="block_content">
                        <ul class="bullet">

                            <li><a href="" title="Chính sách bảo mật">Chính sách bảo mật</a></li>

                            <li><a href="" title="Chính sách thanh toán">Chính sách thanh toán</a></li>

                            <li><a href="" title="Chính sách vận chuyển">Chính sách vận chuyển</a></li>

                            <li><a href="" title="Chính sách đổi trả">Chính sách đổi trả</a></li>

                        </ul>
                    </div>
                </div>

                <div class="footer-social">
                    <h4 class="footer-static-title">Kết nối với chúng tôi</h4>

                    <div id="footer-social-info">
                        <a class="footer-social-link" href="" target="_blank">
                            <i class="bi bi-facebook layout_icon"></i>
                            <span>Facebook</span>
                        </a>
                        <a class="footer-social-link" href="" target="_blank">
                            <i class="bi bi-twitter layout_icon"></i>
                            <span>Twitter</span>
                        </a>
                        <a class="footer-social-link" href="" target="_blank">
                            <i class="bi bi-youtube layout_icon"></i>
                            <span>Youtube</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('user.footer')
</body>

</html>