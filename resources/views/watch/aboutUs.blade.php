@extends('watch.layout.master')
@section('title', 'Về chúng tôi')
@section('keywords', 'Về chúng tôi')
@section('description', 'Về chúng tôi')
@section('content')
<!--Body-->
<div class="about-us-page">
    <div class="about-image-container">
        <img src="/front/image/about-us.jpg" alt="Về chúng tôi - NanoGeyser" class="about-main-image">
        <div class="about-button-container">
            <a href="{{ url('/') }}" class="btn-view-more">Xem Thêm</a>
        </div>
    </div>
</div>

<style>
.about-us-page {
    display: flex;
    justify-content: center;
    padding: 40px 20px;
    background: #f5f5f5;
}

.about-image-container {
    position: relative;
    display: inline-block;
    max-width: 1250px;
    width: 100%;
}

.about-main-image {
    width: 100%;
    height: auto;
    display: block;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    border-radius: 8px;
}

.about-button-container {
    text-align: center;
    margin-top: 30px;
}

.btn-view-more {
    display: inline-block;
    padding: 12px 40px;
    background: #0f6633ff;
    color: #fff;
    text-decoration: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.btn-view-more:hover {
    background: #0f6633ff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    color: #fff;
}

@media (max-width: 768px) {
    .about-us-page { padding: 20px 10px; }
    .about-button-container { margin-top: 20px; }
    .btn-view-more { padding: 10px 30px; font-size: 14px; }
}
</style>
<!--EndBody-->
@stop

@section('script')
@stop
