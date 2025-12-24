@extends('watch.layout.master')
@section('title', 'Giải pháp lọc nước')
@section('keywords', 'Giải pháp lọc nước')
@section('description', 'Giải pháp lọc nước')
@section('content')
<!--Body-->
<div class="bg-cate mg-0">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <p class="heading-h1-text">Giải pháp lọc nước</p>   
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="{{URL::current()}}">Giải pháp lọc nước</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>

<!-- Slide ảnh từ controller -->
@if(isset($images) && count($images) > 0)
<div class="solution-images-section">
    <div class="container">
        @foreach($images as $index => $image)
        <div class="solution-image-item">
            <img src="/front/image/{{ $image }}" alt="Giải pháp lọc nước {{ $index + 1 }}" class="img-responsive">
        </div>
        @endforeach
    </div>
</div>

<style>
.solution-images-section {
    padding: 40px 0;
    background: #f8f9fa;
}

.solution-image-item {
    margin-bottom: 30px;
    text-align: center;
}

.solution-image-item img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .solution-images-section {
        padding: 20px 0;
    }
    
    .solution-image-item {
        margin-bottom: 20px;
    }
}
</style>
@endif

@include('watch.layout.map')
@endsection

@section('script')
@endsection