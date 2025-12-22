@extends('watch.layout.master')
@section('title', 'Về chúng tôi')
@section('keywords', 'Về chúng tôi')
@section('description', 'Về chúng tôi')
@section('content')
<!--Body-->
<div class="bg-cate mg-0">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <p class="heading-h1-text">Về chúng tôi</p>   
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="{{URL::current()}}">Về chúng tôi</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>

<div class="container">
    <!-- <h1 class="tit-home tit-l" style="margin-top: 0">{{$data->name}}</h1> -->
    <div class="main-post">
        {!! $data->des !!}
    </div>
</div>
<!--EndBody-->
@include('watch.layout.map')
@stop
@section('script')

@stop