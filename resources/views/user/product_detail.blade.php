@extends('user.layout_user')
@section('Content')
<?php  $quantity=$product->product_quantity ?>

<script>
    function submit(){
        var btn=document.getElementById('quantity');
        return btn.value;
    }
    function checksubtract(){
        var result = document.getElementById('quantity'); var qty = result.value; 
             if( !isNaN(qty)&&(qty > 1 )) result.value--;return false;
    }
    function checkadd(){
        var result = document.getElementById('quantity'); var qty = result.value;
            if(!isNaN(qty)&&(qty< quantity)) result.value++;return false;
    }
    
</script>
    <div class="container">
        <div class="wapper">
        <div class="column-xs-12 column-md-7">
          <div class="product-gallery">
            <div class="product-image">
              <img class="active" src="{{ url('template/image/product/pk_sofa1_2.jpg') }}">
            </div>
            <ul class="image-list">
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li>
              <!-- <li class="image-item"><img src="{{ url('template/image/product/pk_sofa1_2.jpg') }}"></li> -->
            </ul>
          </div>
        </div>
            <div class="product_infor">
                <div class="product_name">
                    <h2>{{$product->product_name}}</h2>

                </div>
                <div class="price">
                    <span>{{number_format($product->product_price) }}đ</span>
                    <del>{{number_format($product->product_price_pre) }}đ</del>
                </div>
                <div class="procduct_detial">
                    <div class="tbl">
                        <div class="row1">
                            <strong>Kích thước:</strong>
                        </div>
                        <div class="row1">
                            <strong>Màu sắc:</strong>
                            <span>{{$supplier->supplier_name}}</span>
                        </div>
                        <div class="row100">
                            <strong>Chất liệu<strong>
                                    <span style="font-weight: 300;">{{$product->product_year}}</span>
                        </div>
                        
                        <div class="row100">
                            <!-- <strong>Kích cỡ<strong>
                            <span style="font-weight: 300;">20x25</span> -->
                        </div>
                    </div>
                   

                    <div class="summary">
                        <strong>Mô tả sản phẩm:</strong>
                        <div>
                            <p style="font-weight: 300;">{{$product->product_detail}}</p>

                        </div>
                    </div>
                    <div class="box">
                        <form action="{{route('user.cart.add')}}" method="post"> 
                            @csrf
                            <div class="boxwapp">
                                <div class="box2">
                                    <div class="select_quantity">
                                        <input type="hidden" value="{{$product->id}}" name="id">
                                        <input onclick="checksubtract();" type='button' value='-' name="subtract" />
                                        <input  min='1' id='quantity' type='text' value='1' name="numproduct" />
                                        <input onclick="checkadd();" type='button' value='+' name="add" />
                                    </div>
                                    <div class="quantity">
                                        <span style="font-weight: 300;">{{$product->product_quantity}}sản phẩm có sẵn</span>
                                    </div>
                                </div>
                                <div class="btnsubmit">
                                 
                                    <input type="submit" id="ipt1" value="Thêm vào giỏ hàng" name="addcart"></a> 

                                    <input type="submit" id="ipt2" value="Mua ngay" name="ordernow"></a>

                                </div>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const activeImage = document.querySelector(".product-image .active");
const productImages = document.querySelectorAll(".image-list img");
const navItem = document.querySelector('a.toggle-nav');

function changeImage(e) {
  activeImage.src = e.target.src;
}

function toggleNavigation(){
  this.nextElementSibling.classList.toggle('active');
}

productImages.forEach(image => image.addEventListener("click", changeImage));
navItem.addEventListener('click', toggleNavigation);
    </script>
@endsection