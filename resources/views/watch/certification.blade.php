@extends('watch.layout.master')


@section('content')
<div class="bg-cate">
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">
        <div class="container">
            <h2>Chứng nhận</h2>
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
            <h1>Hình ảnh chứng nhận</h1>
        </div>
        @if(count($certification)>0)
        <div class="row">
            @foreach ($certification as $k => $item)
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="ha-list" style="margin: 15px">
                    <a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="ha-img"><img src="{{(sizeof($item->certificationImages)) ? asset($item->certificationImages->first()->link) : '' }}" alt="" class="img-responsive"><i class="far fa-image"></i></a>
                    <h3 class="text-center"><a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                </div>
            </div>
            @endforeach
        </div>
        <div class="phantrang">
            {!!  $certification->appends(Request::all())->links() !!}
        </div>
        @else
            <div>Không có dữ liệu nào!</div>
        @endif
    </div>

</div>

@include('watch.layout.map')
@stop
