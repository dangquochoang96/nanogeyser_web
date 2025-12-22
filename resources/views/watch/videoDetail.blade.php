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
                    <li><a href="{{URL::current()}}">Video</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>
<div class="container">
        <h1 class="tit-page-d">{{ $video->name }}</h1>
        <div class="view-like">
            <span class="trafic"><i class="fa fa-eye"></i> Lượt xem: {{ $video->view }}</span>
            <span><div class="fb-like" data-href="{{route('video-detail', ['slug' => str_slug($video->name.'-'.$video->id)])}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div></span>
            <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=200661134383203&autoLogAppEvents=1" nonce="YOY2pwKu"></script>
                        <div class="clear"></div>
            <div class="clear"></div>
        </div>
        <div class="nd-vd">
            <p>{!! $video->des !!}</p>
            <div class="vd-chitiet">
                <center>
                    <iframe width="700" height="400" src="{{ $video->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </center>
            </div>
        </div>

    <div class="tit-child">
        <h2>Video liên quan</h2>
    </div>
    <div class="bg-news-lq">
        <div class="news-lq video-lq owl-carousel owl-theme">
            @foreach($videoRelation as $item)
            <div class="item">
                <div class="vd-list">
                    <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="vd-img">
                        <img src="{{ $video->image }}" alt="" class="img-responsive">
                        <div class="bg-black"></div>
                    </a>
                    <h3><a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{ $video->name }}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
                $(document).ready(function () {
                    var owl = $(".video-lq");
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

@stop