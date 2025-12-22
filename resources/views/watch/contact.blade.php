@extends('watch.layout.master')
@section('title', 'Liên hệ')
@section('keywords', 'Liên hệ')
@section('description', 'Liên hệ')
@section('content')

<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <p class="heading-h1-text">Liên Hệ</p>   
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="/">Liên hệ</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 info-lh">
            <h4 class="lienhe-tit">Gửi yêu cầu tư vấn</h4>
            <h5>CÔNG TY CP CÔNG NGHỆ VÀ DỊCH VỤ S-HOME</h5>
            <p>Địa Chỉ: CTT1 - 03, Khu Biệt Thự Liền kề Kiến Hưng Luxury, P. Phúc La, Hà Đông, Hà Nội, Việt Nam</p>
            <!--<p>Hotline: 0932 399 920 - 0963 456 911</p>-->
            <p> Hotline: <a href="tel:0386902668">038 690 2668 </a></p>
            <!--<p>Website: https://geysereco.com </p>-->
            <h5>Gửi thông tin tư vấn</h5>
            <form action="" id="create_contact_form" class="lienhe-form" novalidate="novalidate">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <input class="form-control" name="phone" id="phone" type="text" placeholder="Điện thoại(*)">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <input class="form-control" name="full_name" id="full_name" type="hidden" placeholder="Họ và tên(*)">
                    </div>
                </div>
                
                <input class="form-control form-group" name="email" id="email" type="hidden" placeholder="Email(*)">   
                {{ csrf_field() }}
                <div class="loading-image" style="display:none; padding-top: 10px;color: #21a52d;"><img src="{{asset('assets/img/loading.gif')}}"></div>
                <textarea rows="5" name="note" id="note" class="form-control form-group" placeholder="Nội dung"></textarea>
                <div class="div_success" style="display:none; padding-top: 10px;color: #21a52d;">Gửi yêu cầu thành công</div>
                <button type="submit" class="lienhe-s" id="lienhe-s">Gửi liên hệ</button>
                <button type="reset" class="lienhe-clear" id="lienhe-c">Xóa nội dung</button>
            </form>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="map-lh">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d553.8541605335554!2d105.8038191487455!3d20.957661865052497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad99484c57a5%3A0xc996799ee65d65b7!2zTcOheSBs4buNYyBuxrDhu5tjIE5hbm8gR2V5c2Vy!5e0!3m2!1sen!2sus!4v1704508894231!5m2!1sen!2sus" width="700" height="515" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>        
        </div>
    </div>
</div> 
<style type="text/css">
    .error{
        float: left;
        color: red;
    }
    .loading-image img{
        width: 40px;
        color: #65A63A;
        padding-bottom: 12px;
    }
</style> 
@stop
@section('script')
<script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.buttom-clear').click(function(){
            $('#create_contact_form').trigger("reset");
        });
        $('#create_contact_form').validate({
            rules: {
                full_name: {
                    "required": true,
                },
                phone: {
                    "required": true,
                },
                email: {
                    "required": true,
                    'email': true,
                }
            },
            messages: {
                full_name: {
                    "required": "Vui lòng nhập họ tên",
                },
                email: {
                    "required": "Email không đúng định dạng",
                },
                phone: {
                    "required": "Số điện thoại không được để trống",
                },
                note: {
                    // "required": true,
                }
            },
            errorPlacement: function(error, element) {         
               error.insertBefore(element);
            },
            submitHandler: function (form) {
                $.ajax({
                    url: '{{ URL::action("Front\ContactController@contactMe")}}',
                    type: 'post',
                    data: $(form).serialize(),
                    beforeSend : function(){
                        $('#loading-image').show();
                    },
                    success: function (response) {
                        $('#loading-image').hide();
                        if(response.code == 200){
                            $('.div_success').css('display','block');
                        }
                    }
                });
            }
        });
    });
</script>
@stop