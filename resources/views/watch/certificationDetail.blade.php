@extends('watch.layout.master')


@section('content')
    <div class="bg-cate">
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">
        <div class="container">
            <h2>Tin tức</h2>
        </div>
        <div class="breadcumb">
            <div class="container">
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="/">Hình ảnh</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="dm-child dm-news">
        <h1 class="tit-page-d">{{ $certification->name }}</h1>
        <div class="view-like">
            <span class="trafic"><i class="fa fa-eye"></i> Lượt xem: {{ $certification->view }}</span>
            <span><div class="fb-like" data-href="http://dev.chothuetatca.com/" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div></span>
            <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=200661134383203&autoLogAppEvents=1" nonce="YOY2pwKu"></script>
                        <div class="clear"></div>
            <div class="clear"></div>
        </div>
        <div class="row">
            @foreach($certification->certificationImages as $image)
            <div class="col-md-4 col-sm-4 col-xs-6 image-items" style="margin-top: 83px; height: 470px; overflow: hidden;">
                <a href="{{asset($image->link)}}" class="ha-show ha-fancy"  rel="galery1" data-fancybox="gallery" data-fancybox-group="dai-nq" data-thumb="{{asset($image->link)}}">
                    <img src="{{asset($image->link)}}" alt="" class="img-responsive">
                    <div class="ha-hover"><span><b>+</b></span></div>
                </a>
            </div>
            @endforeach
        </div>

    </div>
    <script type="text/javascript"

            src="http://dev.chothuetatca.com/front/javascript/fancybox/dist/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://dev.chothuetatca.com/front/javascript/fancybox/dist/jquery.fancybox.min.css" media="screen"/>
    <script type="text/javascript">
                $(document).ready(function () {
                    $(".ha-fancy").fancybox({
                        'transitionIn': 'none',
                        'transitionOut': 'none',

                        thumbs: {
                            autoStart: true, // Display thumbnails on opening
                            hideOnClose: true, // Hide thumbnail grid when closing animation starts
                            parentEl: ".fancybox-container", // Container is injected into this element
                            axis: "x" // Vertical (y) or horizontal (x) scrolling
                        },
                        image: {
                            preload: false
                        },
                        buttons: [
                            "zoom",
                            "share",
                            "slideShow",
                            "fullScreen",
                            "download",
                            "thumbs",
                            "close"
                        ],
                    });
                });
            </script>

    <div class="tit-child" style="padding-top: 80px;">
        <h2>Hình ảnh liên quan</h2>
    </div>
    <div class="bg-news-lq">
        <div class="ha-lq news-lq owl-carousel owl-theme">
            @foreach($certificationRelation as $item)
            <div class="item">
                <div class="news-list">
                    <a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="news-l-img"><img src="{{(sizeof($item->certificationImages)) ? asset($item->certificationImages->first()->link) : '' }}" alt="" class="img-responsive"></a>
                    <h3><a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                    <p>{{ substr(strip_tags($item->description), 0, 200) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
            $(document).ready(function () {
                var owl = $(".ha-lq");
                owl.owlCarousel({
                    items: 4,
                    autoPlay: 10000,
                    pagination: false,
                    navigation: true,
                    itemsDesktop      : [1199,4],
                    itemsDesktopSmall     : [979,3],
                    itemsTablet       : [768,2],
                    itemsMobile       : [479,2]

                });
            });
    </script>
</div>

@include('watch.layout.map')
@stop
