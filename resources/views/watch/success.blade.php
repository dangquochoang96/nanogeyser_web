@extends('watch.layout.master')
@section('content')
<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <h1>Đặt hàng thành công</h1>
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="/">Giỏ hàng</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>
<div class="container">
    <div class="cart-done">
        <span class="icon-done"></span>
        <h4>Gửi đơn hàng thành công!</h4>
        <p>Cảm ơn quý khách hàng đã đặt mua <b>sản phẩm tại Geyser</b></p>
        <p>Chúng tôi sẽ liên hệ với bạn trong 24h. Nếu Quý khách hàng cần tư vấn trực tiếp hiểu hơn về các dịch vụ sản phẩm xin vui lòng lại cho chúng tôi vào số hotline: <span class="red">0243.256.258</span></p>
    </div>
</div>  
@stop