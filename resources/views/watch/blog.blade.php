@extends('watch.layout.master')
@section('content')

<div class="bg-cate">
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">
        <div class="container">
            <p class="heading-h1-text">Tin tức</p>
        </div>
        <div class="breadcumb">
            <div class="container">
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="{{URL::current()}}">Tin tức</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @foreach ($categories as $cate)
    <div class="dm-child dm-news">
        <div class="tit-child">
            <p class="heading-h2-text">{{$cate->name}}</p>
            <a href="{{route('blogcate', ['slug' => str_slug($cate->name.'-'.$cate->id)])}}" class="view-dm">Xem tất cả</a>
        </div>
        <div class="row">
            <div class="col-md-5 col-sm-5 col-xs-12">
                @foreach ($cate->blogLimit as $k => $item)
                @if ($k==0)
                <div class="news-b">
                    <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="news-b-img"><img src="{{$item->image}}" alt="{{$item->name}}" class="img-responsive"></a>
                    <h3><a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                    <p>{{$item->shortdes}}</p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <ul class="news-s ul-none">
                    @foreach ($cate->blogLimit as $k => $item)
                    @if ($k>0)
                    <li>
                        <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="news-s-img">
                            <img src="{{$item->image}}" alt="{{$item->name}}" class="img-responsive">
                        </a>
                        <h3>
                            <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a>
                        </h3>
                        <p>{{$item->shortdes}}</p>
                        <div class="clear"></div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    <!--Hình ảnh-->
    <div class="dm-child dm-ha">
        <div class="tit-child">
            <p class="heading-h2-text">Hình ảnh</p>
            <a href="{{route('gallery')}}" class="view-dm">Xem tất cả</a>
        </div>
        <div class="row">
            @foreach ($gallery as $k => $item)
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="ha-list">
                    <a href="{{route('gallery-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="ha-img"><img src="{{(sizeof($item->galleryImages)) ? asset($item->galleryImages->first()->link) : '' }}" alt="{{$item->name}}" class="img-responsive"><i class="far fa-image"></i></a>
                    <h3><a href="{{route('gallery-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--End Hình ảnh-->

    <!--Video-->
    <div class="dm-child dm-video">
        <div class="tit-child">
            <p class="heading-h2-text">Video</p>
            <a href="{{route('video')}}" class="view-dm">Xem tất cả</a>
        </div>
        <div class="row">
            @foreach ($videos as $k => $item)
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="vd-list">
                    <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="vd-img">
                        <img src="{{$item->image}}" alt="" class="img-responsive">
                        <div class="bg-black"></div>
                    </a>
                    <h3><a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--End Video-->
</div>

@include('watch.layout.map')
@stop
@section('script')

@stop
