@extends('watch.layout.master')

@section('content')
 <div class="body-breadcumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('/blog')}}">Tin tức</a></li>
            </ul>
        </div>
    </div>
    <div class="container1">
        <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12 block-l">
                <div class="box-block">
                    <div class="search-news bg-block">
                        <div class="tit-sea">tìm kiếm bài viết</div>
                        <form method="get" id="idf" action="/blog/search">
                                <input class="top_input" type="text" placeholder="Từ khóa" name="search"
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
                                    <h2>
                                        <a href="{{route('blogcate', ['slug' =>str_slug($item->name.'-'.$item->id)])}}" title="">{{$item->name}}</a>
                                    </h2>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Danh muc tin tuc con-->
                    <!--Tin tuc random-->
                    <div class="news-bl bg-block">
                        <div class="tit-block"><span>Tin tức nổi bật</span></div>
                        <ul class="ul-bl ul-news">
                            @foreach($blogs as $item)
                                <li>
                                    <div class="w-30">
                                        <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                           title="{{$item->name}}">
                                            <img src="{{$item->image}}" class="img-responsive"></a>
                                    </div>
                                    <div class="w-70">
                                        <h3>
                                            <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                               title="{{$item->name}}">
                                                {{$item->name}} </a>
                                        </h3>
                                        <span class="post-dateb"><i class="fa fa-calendar"></i> {{$item->created_at}}</span>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Tin tuc random-->
                    <!--San pham ban chay-->
                </div>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12">
                <!-- <ul class="breadcrumb">
                    <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{url('/search')}}">Tìm kiếm</a></li>
                </ul> -->
                <div class="tit-pagesp"><h1 class="tit-page"><span>Tìm kiếm: {{$key}}</span></h1></div>

                <ul class="list-news row">
                    @foreach($blogs as $item)
                        <li class="diff-news col-md-6 col-sm-12 col-xs-12">
                            <div class="img-news">
                                <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">
                                    <img src="{{$item->image}}" class="img-responsive" alt="{{$item->name}}">
                                </a>
                            </div>
                            <h3>
                                <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a>
                            </h3>
                            <div class="post_date">
                                <span class="box-date"><i class="fa fa-calendar"></i>{{$item->created_at}}</span>
                                <span class="box-view"><i class="fa fa-eye"></i>2450 views</span>
                            </div>
                            <div class="info-new">
                                {!! $item->shortdes !!}
                            </div>
                            <p class="more-news"><a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">Đọc tiếp</a></p>
                        </li>
                    @endforeach
                </ul>
            </div>
            
          
        </div>
    </div>
@stop