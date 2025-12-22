@extends('layouts.front')
@section('head')
@endsection

@section('content')
	<ul class="breadcrumb">
        <li><a href="index9328.html?route=common/home"><i class="fa fa-home"></i></a></li>
        <li><a href="omega-deville.html">Tin tức</a></li>
     </ul>
     <div class="tit-pagesp">
        <h1 class="tit-page"><span>Tin tức</span></h1>
     </div>
     <div class="list-sp">
        <div class="listcat">
           <ul class="dmsp-slide ul-no owl-carousel owl-theme">
           	@foreach ($category as $cate)
              <li  class="item">
                 <h2><a href="#">{{$cate->name}}</a></h2>
              </li>
            @endforeach
           </ul>
        </div>
     </div>
     <div class="pagesp">
     	@if(count($blogs) > 0)
        <ul class="row ul-none list-pagesp">
        	@foreach ($blogs as $key => $blog)
            <li class="col-md-6 col-sm-4 col-xs-12<?php if($key == 0){ echo ' big-news';} ?>">
              <div class="box-news">
                 <a href="" title="" class="img-news">
                 <img src="{{$blog->image}}" alt="{{$blog->name}}" class="img-responsive">
                 </a>
                 <div class="tt-news">
                    <h3><a href="">{{$blog->name}}</a></h3>
                    <div class="dis-news">{!! $blog->shortdes !!}</div>
                 </div>
              </div>
            </li>
           @endforeach
        </ul>
        <div class="phantrang">
	        {!!  $blogs->appends(Request::all())->links() !!}
        </div>
        @else
        Không có dữ liệu
        @endif
     </div>
     <div class="dm-des">
        <p style="margin-bottom: 10px; padding: 0px; color: rgb(64, 64, 64); font-family: Arial, sans-serif; font-size: 13px; line-height: 21px;"><span style="margin: 0px; padding: 0px; font-size: 14px;">Thuật ngữ&nbsp;<strong style="margin: 0px; padding: 0px;">Omega De Ville</strong>&nbsp;đã được đưa ra lần đầu tiên bởi Omega vào tháng Mười năm 1960 , khi mà mô hình mới của series Seamaster đã được tung ra; từ năm 1963, dòng chữ "Seamaster De Ville" bắt đầu xuất hiện trên mặt đồng hồ, thể hiện niềm tự hào về dòng sản phẩm này.</span></p>
        <p style="margin-bottom: 10px; padding: 0px; color: rgb(64, 64, 64); font-family: Arial, sans-serif; font-size: 13px; line-height: 21px;"><span style="margin: 0px; padding: 0px; font-size: 14px;">Từ những năm 1960,&nbsp;</span><strong style="margin: 0px; padding: 0px; font-size: 14px;">Omega De Ville</strong><span style="margin: 0px; padding: 0px; font-size: 14px;">&nbsp;đại diện cho các mô hình đơn giản nhưng cực kỳ lịch lãm của đồng hồ Omega, trái ngược với các dòng đồng hồ thể thao&nbsp;<strong style="margin: 0px; padding: 0px;"><a href="http://mrtienwatch.com/seamaster-2-1-2040066.html" style="margin: 0px; padding: 0px; color: rgb(64, 64, 64);">Omega Seamaster</a></strong>hoặc&nbsp;<a href="http://mrtienwatch.com/speedmaster-2-1-2040067.html" style="margin: 0px; padding: 0px; color: rgb(64, 64, 64);">Omega&nbsp;Speedmaster</a>&nbsp;. Vì vậy không có gì ngạc nhiên khi tính năng chronometer (đồng hồ có độ chính xác rất cao) được mặc định cho dòng sản phẩm này.</span></p>
     </div>
     <div class="group-tabs row box-dmcon">
     </div>
@endsection

@section('script')
@endsection