@extends('watch.layout.master')

@section('content')



<div class="bg-cate">   

    <img src="/front/image/bg-dmsp.jpg">

    <div class="tit-page">  

        <div class="breadcumb">

            <div class="container"> 

                <ul class="ul-bread ul-none">

                    <li><a href="/">Trang chủ</a></li>

                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>

                    <li><a href="/">Đăng ký nhận quà miễn phí</a></li>

                    <li><img src="/front/image/right.png" alt=""></li>

                </ul>

            </div>  

        </div>  

    </div>   

</div>

<div class="container">

    <div class="row" style="margin-top: 10px; margin-bottom: 50px;">

        <div class="col-md-3">
            <div class="banner-l"><img style="width: 180%;" src="/front/image/banner-left.jpg"></div>
        
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12 info-lh" style="margin: 0 auto;text-align: center;margin-bottom: 50px;">

            <h4 class="lienhe-tit" style="text-transform: uppercase;">

                <p>Đăng ký ngay</p>

                <p>Để nhận quà tặng miễn phí</p>

            </h4>

            <form action="" id="create_contact_form" class="lienhe-form" novalidate="novalidate">

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                      <input class="form-control" name="phone" id="phone" type="text" placeholder="Điện thoại(*)">

                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                      <input class="form-control" name="full_name" id="full_name" type="text" placeholder="Họ và tên">

                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                      <input class="form-control" name="address" id="address" type="text" placeholder="Địa chỉ">

                      <input class="form-control" name="type"  type="hidden" value="2">

                    </div>

                </div>                  

                {{ csrf_field() }}

                <div class="loading-image" style="display:none; padding-top: 10px;color: #21a52d;"><img src="{{asset('assets/img/loading.gif')}}"></div>

                <div class="div_success" style="display:none; padding-top: 10px;color: #21a52d;">Gửi yêu cầu thành công</div>

                <button type="submit" class="lienhe-s" id="lienhe-s">Gửi yêu cầu</button>

                <button type="reset" class="lienhe-clear" id="lienhe-c">Xóa nội dung</button>

            </form>

            <div>

                <h1 class="" style="margin-top: 50px;margin-bottom: 50px;text-decoration: none;color: #efa61e;text-align: center;font-size: 28px;
    font-family: 'sarabun-b';">{{$data->name}}</h1>

                <div class="main-post" style="text-align: justify;">

                    {!! $data->des !!}

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="banner-r"><img src="/front/image/banner-right1.jpg"></div>

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

                    // "required": true,

                },

                phone: {

                    "required": true,

                },

                email: {

                    // "required": true,

                    // 'email': true,

                }

            },

            messages: {

                full_name: {

                    "required": "Vui lòng nhập họ tên",

                },

                email: {

                    // "required": "Email không đúng định dạng",

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