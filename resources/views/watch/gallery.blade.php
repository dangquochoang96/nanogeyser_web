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
        <div class="tit-child">
            <h1>Hình ảnh sản phẩm</h1>
        </div>
        @if(count($gallery)>0)
        <div class="row">
            @foreach ($gallery as $k => $item)
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="ha-list">
                    <a href="{{route('gallery-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="ha-img"><img src="{{(sizeof($item->galleryImages)) ? asset($item->galleryImages->first()->link) : '' }}" alt="" class="img-responsive"><i class="far fa-image"></i></a>
                    <h3><a href="{{route('gallery-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
        <div class="phantrang">
           <!--  <ul class="pagination" role="navigation">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                        <span class="page-link" aria-hidden="true">‹ Trang trước</span>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="">2</a></li>
                <li class="page-item"><a class="page-link" href="">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="" rel="next" aria-label="Next »">Trang tiếp ›</a>
                </li>
            </ul> -->
            {!!  $gallery->appends(Request::all())->links() !!}
        </div> 
        @else
            <div>Không có dữ liệu nào!</div>
        @endif
    </div>
    
</div>  

@include('watch.layout.map')
@stop