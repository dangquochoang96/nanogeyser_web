@extends('watch.layout.master')
@section('content')
<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <h1>Phương thức thanh toán</h1>
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
    <div class="row">
    <form method="POST" action="{{ URL::action("Front\OrderController@saveOrder")}}">
       {{ csrf_field() }}
        <input type="hidden" class="input-payment" name="payment" value="Nhận tại cửa hàng">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="pttt-box">
                <h5>Chọn phương thức thanh toán</h5>
                <ul class="nav nav-tabs row ul-pttt">
                    <li class="col-md-3 col-sm-3 col-xs-12 active" data-value="Nhận tại cửa hàng">
                        <div class="choise-pttt">
                            <a data-toggle="tab" href="#home">
                                <i class="fas fa-university"></i>
                                <span>Nhận tại cửa hàng</span>
                            </a>
                        </div>
                    </li>
                    <li class="col-md-3 col-sm-3 col-xs-12" data-value="Giao hàng và thu tiền tận nơi (COD)">
                        <div class="choise-pttt">
                            <a data-toggle="tab" href="#cod">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Giao hàng và thu tiền tận nơi (COD)</span>
                            </a>
                        </div>
                    </li>
                    <li class="col-md-3 col-sm-3 col-xs-12" data-value="Thanh toán chuyển khoản">
                        <div class="choise-pttt">
                            <a data-toggle="tab" href="#atm">
                                <i class="far fa-credit-card"></i>
                                <span>Thanh toán chuyển khoản</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <div class="tab-content tab-pttt">
                    <div id="home" class="tab-pane fade in active">
                        <p>Địa chỉ: CTT1 - 03, Khu Biệt Thự Liền kề Kiến Hưng Luxury, P. Phúc La, Hà Đông, Hà Nội.</p>
                        <p>Điện thoại: 0343 640 668</p>
                        <p>Email: nanogeyser29@gmail.com</p>
                        <p>Website: https://geysereco.com</p>  
                    </div>
                    <div id="cod" class="tab-pane fade">
                        <p>Đơn hàng sẽ được giao theo địa chỉ của bạn</p>
                        <p>Quý khách vui lòng tham khảo thêm các chính sách bán hàng của Geyser:</p>
                        <ul>
                            <li><a href="/chinh-sach-van-chuyen" target="_blank">Chính sách vận chuyển</a></li>
                            <li><a href="/chinh-sach-doi-tra" target="_blank">Chính sách đổi - trả hàng</a></li>
                            <li><a href="/quy-dinh-va-hinh-thuc-thanh-toan" target="_blank">Quy định và hình thức thanh toán</a></li>
                        </ul>
                    </div>
                    <div id="atm" class="tab-pane fade">
                        <ul class="ul-none list-tk">
                            <li>
                                <p>Ngân Hàng Quân Đội (MB)</p>
                                <p>Số TK: 6668668866666</p>
                                <p>Tên TK: Trần Văn Huynh</p>
                                <p>Nội dung chuyển khoản: Thanh toán đơn hàng 696969</p>
                                <p>Số tiền: <span class="red">30.000.000đ</span></p>
                            </li>
                            <li>
                                <p>Ngân Hàng Vietcombank</p>
                                <p>Số TK: 0011002237319</p>
                                <p>Tên TK: Trần Văn Huynh</p>
                                <p>Nội dung chuyển khoản: Thanh toán đơn hàng 696969</p>
                                <p>Số tiền: <span class="red">30.000.000đ</span></p>
                            </li>
                            <li>
                                <p>Ngân Hàng Tiền Phong</p>
                                <p>Số TK: 00024987001</p>
                                <p>Tên TK: Trần Văn Huynh</p>
                                <p>Nội dung chuyển khoản: Thanh toán đơn hàng 696969</p>
                                <p>Số tiền: <span class="red">30.000.000đ</span></p>
                            </li>
                        </ul>
                    </div>
                </div>  
            </div>       
        </div>
        <?php            
          $count_cart = 0;
          $total_price = 0;
          foreach ($datas as $item){
            $count_cart += $item['buy'];
            if($item['sale_price']){
                $total_price += $item['buy']*$item['sale_price'];
            }else{
                $total_price += $item['buy']*$item['price'];

            }
          }
          $total_price = number_format($total_price,0,".",",");
        ?>                
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-cart">
                <div class="add-cart">
                    <h4>Địa chỉ</h4>
                    <p>{{$address['address']}}</p>
                </div>
                <div class="sum-cart">
                    <h4>Thông tin đơn hàng</h4>
                    <div class="sum-cart-1">
                        Tạm tính ({{$count_cart}} sản phẩm) <span>{{$total_price}} đ</span>
                        <div class="clear"></div>
                    </div>
                    <button type="submit" class="btn btn-success xacnhan-cart">Xác nhận giỏ hàng</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>  
@stop
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
      $('.ul-pttt li').click(function(){
        var tmp = $(this).attr('data-value');
        $('.input-payment').val(tmp);
      });
    });
</script>
@stop