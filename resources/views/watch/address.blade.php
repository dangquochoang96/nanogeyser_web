@extends('watch.layout.master')
@section('content')
<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <h1>Thông tin khách hàng</h1>
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
    <form method="POST" action="{{ URL::action("Front\OrderController@saveAddress")}}">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="ttkh">
                <h5>Thông tin giao hàng</h5>
                <div class="form-ttkh">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail4">Họ và tên</label>
                                <input type="text" class="form-control" id="nameid" placeholder="Họ và tên" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail4">Số điện thoại</label>
                                <input type="number" class="form-control" id="nameid" placeholder="Số điện thoại" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail4">Địa chỉ người nhận</label>
                                <input type="text" class="form-control" id="diachiid" placeholder="Địa chỉ người nhận" name="address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPassword4">Tỉnh/Thành Phố</label>
                                <select class="form-control" id="tinhid" name="province" placeholder="Vui lòng chọn Tỉnh/Thành Phố">
                                    @foreach ($provinces as $province)
                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4">Quận/Huyện</label>
                                <select class="form-control" id="quanid" name="district" placeholder="Vui lòng chọn Quận/Huyện">
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="inputPassword4">Phường/Xã</label>
                                <select class="form-control" id="phuongid" name="ward" placeholder="Vui lòng chọn Phường/Xã">
                                </select>
                            </div> 
                        </div>
                      </div>
                      {{ csrf_field() }}
                </div>
            </div>
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
                            @else
                            <div class="price-t">{{number_format($item['price'],0,".",",")}} đ</div>
                            @endif
                            <button type="button" class="btn clear-cart clear-sp" data-product="{{ $item['id'] }}"><i class="far fa-trash-alt"></i></button>
                        </td>
                        <td>
                            <div class="input-group count-sp"> 
                                <span class="input-group-btn">    
                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[{{ $item['id'] }}]"> <span class="glyphicon glyphicon-minus"></span> </button>    
                                </span> 
                                <input name="quant[{{ $item['id'] }}]" class="form-control input-number" value="{{ $item['buy'] }}" type="text"> 
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
                            $count_cart += $item['buy'];
                            if($item['sale_price']){
                                $total_price += $item['buy']*$item['sale_price'];
                            }else{
                                $total_price += $item['buy']*$item['price'];

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
                <!-- <div class="add-cart">
                    <h4>Địa chỉ</h4>
                    <p>Hà Nội</p>
                </div> -->
                <div class="sum-cart">
                    <h4>Thông tin đơn hàng</h4>
                    <div class="sum-cart-1">
                        Tạm tính (<span class="total_product_nk">{{$count_cart}}</span> sản phẩm) <span class="total_price_nk">{{$total_price}} đ</span>
                        <div class="clear"></div>
                    </div>
                    <button type="submit" class="btn btn-success xacnhan-cart">Thanh toán</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>  
<style type="text/css">
    #tinhid,
    #quanid,
    #phuongid,
    .form-ttkh input{
        font-size: 14px !important;
    }
</style>
@stop
@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
        district();
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

        $('#tinhid').change(function(){
            district();
        });
        $('#quanid').change(function(){
            ward();
        });
    });
    function district(){   
        var province_code = $('#tinhid').val();
        $.ajax({
            url: '{{ URL::action("Front\OrderController@district")}}',
            type: 'get',
            data: {
                'province_code': province_code,
                '_token': '{{ csrf_token() }}',
            },
            success: function (response) {
                if(response.code == 200){
                    $.each(response.data, function (i, item) {
                        $('#quanid').append($('<option>', { 
                            value: item.code,
                            text : item.name 
                        }));
                    });
                    ward();
                }
            }
        });
    } 
    function ward(){   
        var district_code = $('#quanid').val();
        $.ajax({
            url: '{{ URL::action("Front\OrderController@ward")}}',
            type: 'get',
            data: {
                'district_code': district_code,
                '_token': '{{ csrf_token() }}',
            },
            success: function (response) {
                if(response.code == 200){
                    $.each(response.data, function (i, item) {
                        $('#phuongid').append($('<option>', { 
                            value: item.code,
                            text : item.name 
                        }));
                    });
                }
            }
        });
    } 
</script>
@stop