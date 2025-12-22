@extends('watch.layout.master')
@section('content')
 <div class="body-breadcumb video-detail-breadcumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('/video')}}">Tin tức</a></li>
                <li class="breadcum-title"><a href="{{URL::current()}}">{{$video->name}}</a></li>
            </ul>
        </div>
    </div>
    <div class="container1 video-detail">
        <form method="get" id="idf" class="dt-hide" action="/video/search">
                                <input class="searh-b" type="text" placeholder="Từ khóa" name="search"
                                       value="{{(isset($key) ? $key : '')}}"/>
                                <button class="nut_b" onclick="">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12 block-l">
                <div class="box-block">
                    <div class="search-news bg-block">
                        <div class="tit-sea">tìm kiếm bài viết</div>
                        <form method="get" id="idf" action="/video/search">
                                <input class="top_input" type="text" placeholder="Tìm kiếm nội dung bài viết" name="search"
                                       value="{{(isset($key) ? $key : '')}}"/>
                                <button class="nut_searh" onclick="">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                    </div>
                    <!--Danh muc tin tuc con-->
                    <div class="dm-con bg-block">
                        <div class="tit-block"><span>Danh mục Tin tức</span></div>
                        <ul class="ul-bl">
                            @foreach($category as $item)
                                <li>
                                    <h2><a href="{{route('videocate', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                           title="">{{$item->name}}</a></h2>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Danh muc tin tuc con-->
                    <!--Tin tuc random-->
                    <div class="news-bl bg-block">
                        <div class="tit-block"><span>Tin tức nổi bật</span></div>
                        <ul class="ul-bl ul-news">
                            @foreach($videos as $item)
                                <li>
                                    <div class="w-30">
                                        <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                           title="{{$item->name}}">
                                            <img src="{{$item->image}}" class="img-responsive"></a>
                                    </div>
                                    <div class="w-70">
                                        <h3>
                                            <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                               title="{{$item->name}}">
                                                {{$item->name}} </a>
                                        </h3>
                                        <span class="post-dateb"><i class="fa fa-calendar"></i> {{$item->time_view}}</span>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Tin tuc random-->
                    <!--Tin tuc liên quan-->
                    <div class="news-bl bg-block">
                        <div class="tit-block"><span>Tin tức liên quan</span></div>
                        <ul class="ul-bl ul-news">
                            @foreach($videos as $item)
                                <li>
                                    <div class="w-30">
                                        <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                           title="{{$item->name}}">
                                            <img src="{{$item->image}}" class="img-responsive"></a>
                                    </div>
                                    <div class="w-70">
                                        <h3>
                                            <a href="{{route('video-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                               title="{{$item->name}}">
                                                {{$item->name}} </a>
                                        </h3>
                                        <span class="post-dateb"><i class="fa fa-calendar"></i> {{$item->time_view}}</span>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Tin tuc liên quan-->
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

                <h1 class="tit-newsv">{{$video->name}}</h1>
                <div class="post_date">
                                <span class="box-date"><i class="fa fa-calendar"></i>{{$video->time_view}}</span>
                                <span class="box-view"><i class="fa fa-eye"></i>{{$video->view}} views</span>
                            </div>
                <div class="main-post">
                    {!! $video->des !!}
                </div>
                <div class="video-linhtinh">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-5">
                            <a href="" onclick="window.history.go(-1); return false;" class="linhtinh-l"><i class="fa fa-angle-left"></i>Về trang trước</a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-7">
                            <div class="socials-share">
                            <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{route('video-detail', ['slug' => str_slug($video->name.'-'.$video->id)])}}" target="_blank"><span class="fa fa-facebook"></span> Share</a>
                            <a class="bg-twitter" href="https://twitter.com/share?text=&url={{route('video-detail', ['slug' => str_slug($video->name.'-'.$video->id)])}}" target="_blank"><span class="fa fa-twitter"></span> Tweet</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop