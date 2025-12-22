@extends('watch.layout.master')
@section('title', $blog->name ?? '') 
@section('description', $blog->metades ?? '') 
@section('keywords', $blog->keyword ?? '') 
@section('fb_image', env('APP_URL').$blog->image ?? '') 
@section('content')
<!--Body-->
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
                    <li><a href="/blog">Tin tức</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>
<div class="container">
    <h1 class="tit-page-d">{{$blog->name}}</h1>
    <p class="des-short">{{$blog->shortdes}}</p>
    <div class="view-like">
        <span class="trafic"><i class="fa fa-eye"></i> Lượt xem: {{$blog->view}}</span>
        <span><div class="fb-like" data-href="{{route('blog-detail', ['slug' => str_slug($blog->name.'-'.$blog->id)])}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div></span>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=200661134383203&autoLogAppEvents=1" nonce="YOY2pwKu"></script>
                    <div class="clear"></div>
        <div class="clear"></div>
    </div>
        <div class="nDetail-content">                        
            {!! $blog->des !!}                  
    </div>
    
    <div class="tit-child">
        <h2>Tin tức liên quan</h2>
    </div>
    <div class="bg-news-lq">
        <div class="news-lq owl-carousel owl-theme">
            @foreach ($recentBlog as $k => $item)
            <div class="item">
                <div class="news-list">
                    <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="news-l-img"><img src="{{$item->image}}" alt="{{$item->name}}" class="img-responsive"></a>
                    <h3><a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                    <p>{{$item->shortdes}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
            $(document).ready(function () {
                var owl = $(".news-lq");
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
<!--EndBody-->
@include('watch.layout.map')
@stop
@section('script')

@stop