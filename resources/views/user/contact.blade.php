@extends('user.layout_user')
@section('Content')
    <div class="contact-sec">
        <div class="container-contact">
            <h2> Liên hệ</h2>
            <div class="row-contact">
                <div class="location">
                    <h3>Vị trí</h3>
                    <div class="map-box">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.087203259437!2d105.78957931398344!3d21.1090892859549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313500064e8a5959%3A0x85c77a9cfdb7235e!2zWMOzbSAyIHRow7RuIEPhu5UgxJBp4buDbiwgQ-G7lSDEkGnhu4NuLCBI4bqjaSBC4buRaSwgxJDDtG5nIEFuaCwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1679668726330!5m2!1svi!2s"
                            width="600" height="510" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="info-mess-contact">
                    <h4>Hãy để lại thông tin, bộ phận CSKH của MP sẽ liên hệ tư vấn sản phẩm nội thất phù hợp với ngôi
                        nhà của bạn trong thời gian gần nhất !!!</h4>
                    <div class="form-info">
                        <div class="contact-info-group">
                            <p>Họ</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        <div class="contact-info-group">
                            <p>Tên</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        <div class="contact-info-group">
                            <p>Số điện thoại</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        <div class="contact-info-group">
                            <p>Email</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        <div class="contact-info-group">
                            <p>Khu vực</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        <div class="contact-info-group">
                            <p>Sản phẩm quan tâm</p>
                            <span class="control-info-input">
                                <input type="text" class="info-input">
                            </span>
                        </div>
                        
                        <div class="contact-info-textarea-grp">
                            <p>Nội dung</p>
                            <span class="control-info-input">
                                <textarea type="text" class="info-input">
                                </textarea>
                            </span>
                        </div>
                        <div class="btn-submit-contact">
                           <button class="submit-contact-info">Gửi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection