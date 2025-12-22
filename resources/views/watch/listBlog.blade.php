@extends('watch.layout.master')
@section('content')

<div class="bg-cate">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <h1>Tin tức</h1>   
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="{{route('blog')}}">Tin tức</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>

<div class="container">
    <div class="dm-child dm-news">
        <div class="tit-child">
            <h1>{{$category->name}}</h1>
        </div>
        <div class="row">
            @foreach ($blogs as $item)
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="news-list">
                    <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="news-l-img"><img src="{{$item->image}}" alt="" class="img-responsive"></a>
                    <h3><a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                    <p>{{$item->shortdes}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="phantrang">
            {!!  $blogs->appends(Request::all())->links() !!}
        </div>
    </div>
    
</div>  

@include('watch.layout.map')
@stop
@section('script')

@stop