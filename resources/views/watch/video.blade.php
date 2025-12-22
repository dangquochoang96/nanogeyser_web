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
    <div class="dm-child dm-news">
        <div class="tit-child">
            <h1>Video sản phẩm</h1>
        </div>
        @if(count($video)>0)
        <div class="row"> 
         @foreach ($video as $k => $item)
            <div class="col-md-4 col-sm-4 col-xs-6">
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
        <div class="phantrang">
            {!!  $video->appends(Request::all())->links() !!}
        </div>
        @else
            <div>Không có dữ liệu nào!</div>
        @endif
    </div>
    
</div>  

@stop