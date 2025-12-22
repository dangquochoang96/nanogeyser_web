@extends('watch.layout.master')
@section('content')
<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <h1>Thông tin giỏ hàng</h1>
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
        @if(count($datas) > 0)
        <div class="col-md-9 col-sm-12 col-xs-12">            
           <!--  <div class="choise">
                <input type="checkbox" class="check-all" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Chọn tất cả ({{ count($datas) }} sản phẩm)</label>
                <button type="button" class="btn clear-cart" id="clear-all"><i class="far fa-trash-alt"></i> Xóa</button>
            </div> -->
            <div class="table-cart ">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Hình ảnh sản phẩm</th>
                    <th scope="col" class="col-name">Tên sản phẩm</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $count_cart = 0;
                    $total_price = 0;
                ?> 
                @foreach ($datas as $item)
                  <tr>
                    <td>
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                      </div>
                    </td>
                    <td><img src="{{ $item['image'] }}" alt="" class="img-responsive"></td>
                    <td><h3>{{ $item['name'] }}</h3></td>
                    <td>
                        @if ($item['sale_price'])                        
                        <div class="price-t">{{number_format($item['sale_price'],0,".",",")}} đ</div>
                        <div class="price-s">{{number_format($item['price'],0,".",",")}} đ</div>
                            <?php $tmp_price=$item['sale_price']; ?>
                        @else
                            <?php $tmp_price=$item['price']; ?>
                        <div class="price-t">{{number_format($item['price'],0,".",",")}} đ</div>
                        @endif
                        <button type="button" class="btn clear-cart clear-sp" data-product="{{ $item['id'] }}"><i class="far fa-trash-alt"></i></button>
                    </td>
                    <td>
                        <div class="input-group count-sp"> 
                            <span class="input-group-btn">    
                                <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[{{ $item['id'] }}]"> <span class="glyphicon glyphicon-minus"></span> </button>    
                            </span> 
                            <input name="quant[{{ $item['id'] }}]" data-price="{{$tmp_price}}" class="form-control input-number" value="{{ $item['buy'] }}" type="text"> 
                            <span class="input-group-btn">    
                                <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[{{ $item['id'] }}]"> <span class="glyphicon glyphicon-plus"></span> </button>    
                            </span> 
                        </div>
                    </td>
                    @if ($item['sale_price'])   
                    <td><span class="price-t thanh-tien">{{number_format($item['buy']*$item['sale_price'],0,".",",")}} đ</span></td>
                    @else
                    <td><span class="price-t thanh-tien">{{number_format($item['buy']*$item['price'],0,".",",")}} đ</span></td>
                    @endif
                  </tr>

                    <?php
                        $buy = (int) $item['buy'];
                        $sale_price = (int) $item['sale_price'];
                        $price = (int) $item['price'];
                        
                        $count_cart += $buy;
                        if($item['sale_price']){
                            $total_price += $buy*$sale_price;
                        }else{
                            $total_price += $buy*$price;

                        }
                    ?>
                @endforeach
                <?php
                        $total_price = number_format($total_price,0,".",",");
                ?>
                </tbody>
              </table>
            </div>            
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-cart">
               <!--  <div class="add-cart">
                    <h4>Địa chỉ</h4>
                    <p>609 vũ Tông Phan, Khương Đình, Thanh Xuân , Hà Nội</p>
                </div> -->
                <div class="sum-cart">
                    <h4>Thông tin đơn hàng</h4>
                    <div class="sum-cart-1">
                        Tạm tính (<span class="total_product_nk">{{$count_cart}}</span> sản phẩm) <span class="total_price_nk">{{$total_price}} đ</span>
                        <div class="clear"></div>
                    </div>
                    <a href="{{ URL::action("Front\OrderController@address")}}" class="xacnhan-cart">Xác nhận giỏ hàng</a>
                </div>
            </div>
        </div>
        @else
        <div>Không có sản phẩm nào trong giỏ hàng</div>
        @endif
    </div>
</div>  
@stop
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
        $('.btn-number').click(function(e){
            e.preventDefault();            
            var fieldName = $(this).attr('data-field');
            var type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    // var minValue = parseInt(input.attr('min')); 
                    var minValue = 1; 
                    if(!minValue) minValue = 1;
                    if(currentVal > minValue) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == minValue) {
                        $(this).attr('disabled', true);
                    }
        
                } else if(type == 'plus') {
                    var maxValue = parseInt(input.attr('max'));
                    if(!maxValue) maxValue = 9999999999999;
                    if(currentVal < maxValue) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == maxValue) {
                        $(this).attr('disabled', true);
                    }
        
                }
                calPrice();
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
           $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            
            // var minValue =  parseInt($(this).attr('min'));
            var minValue =  1;
            var maxValue =  parseInt($(this).attr('max'));
            if(!minValue) minValue = 1;
            if(!maxValue) maxValue = 9999999999999;
            var valueCurrent = parseInt($(this).val());
            
            var name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Phải chọn tối thiểu 1 sản phẩm');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Phải chọn tối thiểu 1 sản phẩm');
                $(this).val($(this).data('oldValue'));
            }
            calPrice();
        });
        $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                     // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
        });
    });
</script>
@stop