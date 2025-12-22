<!DOCTYPE html>
<html dir="ltr" lang="en1">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', $_setting->name)</title>
    <meta name="keywords" content="@yield('keywords', $_setting->keywords)">
    <meta property="og:title" content="@yield('title', $_setting->title)">
    <meta property="og:image" content="@yield('fb_image', 'https://geysereco.com/public/uploads/images/2021/06/07/91623057705-fea8f64f440eb050e91f.jpg')">
    <meta property="og:site_name" content="{!! $_setting->name !!}">
    <meta name="description"  property="og:description"
          content="@yield('description', $_setting->metades)">
    <link href="{{asset('front/image/favicon.png')}}" rel="icon"/>
    <meta property="fb:admins" content="A1DA1qeOJkLosqfOrAvg35h"/>
    <meta property="fb:app_id" content="&#123;445850863127921&#125;" />
    <meta name="facebook-domain-verification" content="vchxqrqoeks6a53txa7mu2p6lyl3dv" />
    
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5NQVRCXX');</script>
<!-- End Google Tag Manager -->

    <script>
        Laravel = {
            base: '{{url('/')}}',
            token: '{{csrf_token()}}'
        };
    </script>
    
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8FSM8BVW8F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8FSM8BVW8F');
</script>
    <script src="{{asset('front/javascript/jquery.min.js')}}"></script>
   <link href="{{asset('front/javascript/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" media="screen">
    <script src="{{asset('front/javascript/owlcarousel/owl.carousel.min.js')}}"></script>
    <link href="{{asset('front/javascript/bootstrap/css/bootstrap.minf9e3.css?v=1.1')}}" rel="stylesheet" media="screen"/>
    <script src="{{asset('front/javascript/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <link href="{{asset('front/javascript/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('front/stylesheet/stylesheetf9e3.css?v=6')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front/stylesheet/jquery.numbox-1.2.0.css')}}" media="screen"/>
    {{-- <link rel="stylesheet" type="text/css"  href="js/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css"> --}}
    <link href="{{asset('front/stylesheet/main.css?v=16.1')}}" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" href="{{"/assets/scss/style.css?v=1"}}">
    <script type="text/javascript">
        $(document).ready(function(){
            $('.cart1').on('click', function () {
                var cart_buy = $(this).attr('data-buy');
                $.ajax({
                    url: '{{ URL::action("Front\OrderController@addToCart")}}',
                    type: 'post',
                    data: {
                        'id': $(this).attr('data-product'),
                        'number': cart_buy,
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend : function(){
                        $('#loading-image').show();
                    },
                    success: function (response) {
                        $('#loading-image').hide();
                        if(response.code == 200){
                            $('.div_success').css('display','block');
                            var number_cart = parseInt($('.number_cart').attr('data-total'));
                            number_cart += parseInt(cart_buy);
                            $('.number_cart').attr('data-total',number_cart);
                            $('.number_cart').html('('+number_cart+')');
                        }
                        return true;
                    },
                });
            });
            $('.clear-sp').on('click', function () {
                var tr_del = $(this).parents('tr');
                $.ajax({
                    url: '{{ URL::action("Front\OrderController@deleteToCart")}}',
                    type: 'post',
                    data: {
                        'id': $(this).attr('data-product'),
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend : function(){
                        $('#loading-image').show();
                    },
                    success: function (response) {
                        $('#loading-image').hide();
                        $(tr_del).remove();
                        return true;
                    },
                });
            });
        });
        function calPrice(){
            var total_thanh_tien = 0;
            var total_product = 0;
            $('.table-cart table tbody tr').each(function(item, value){
                var tr_number = parseInt($(this).find('.input-number').val());
                var tr_price = parseInt($(this).find('.input-number').attr('data-price'));
                thanh_tien = tr_number*tr_price;
                total_thanh_tien += thanh_tien;
                total_product += tr_number;
                $(this).find('.thanh-tien').html(formatCurrency(String(thanh_tien)));
            });
            $('.total_price_nk').html(formatCurrency(String(total_thanh_tien)));
            $('.total_product_nk').html(total_product);
            $('.number_cart').html('('+total_product+')');
        }
        function formatCurrency(value){
            var result = '';
            var valueArray = value.split('');
            var resultArray = [];
            var counter = 0;
            var temp = '';
            for (var i = valueArray.length - 1; i >= 0; i--) {
                temp += valueArray[i];
                counter++
                if(counter == 3){
                    resultArray.push(temp);
                    counter = 0;
                    temp = '';
                }
            };
            if(counter > 0){
                resultArray.push(temp);
            }
            for (var i = resultArray.length - 1; i >= 0; i--) {
                var resTemp = resultArray[i].split('');
                for (var j = resTemp.length - 1; j >= 0; j--) {
                    result += resTemp[j];
                };
                if(i > 0){
                    result += ','
                }
            };
            return result+' đ';
        }
    </script>
    <style type="text/css">
        .total_product_nk{
            float: none !important;
            color: #000 !important;
            font-size: 16px !important;
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NQVRCXX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

@include('watch.layout.header')
@yield('content')
@include('watch.layout.contact')
@include('watch.layout.footer')
<!--End Header-->
<!--Body-->
@include('watch.layout.script')
<!--End Body-->
</body>
</html>
