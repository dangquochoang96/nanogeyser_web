@extends('watch.layout.master')
@section('title', 'Về chúng tôi')
@section('keywords', 'Về chúng tôi')
@section('description', 'Về chúng tôi')
@section('content')
<!--Body-->
<div class="about-us-page">
    <div class="about-image-container">
        <div class="about-image-wrapper">
            <img src="/front/image/about-us.jpg" alt="Về chúng tôi - NanoGeyser" class="about-main-image">
            
            {{-- Hotspots trên ảnh --}}
            @if(isset($hotspots) && count($hotspots) > 0)
            @foreach($hotspots as $hotspot)
            @if(($hotspot['type'] ?? 'link') === 'scroll')
            <a href="javascript:void(0)" 
               class="hotspot-area hotspot-scroll" 
               data-target="{{ $hotspot['target'] }}"
               style="top: {{ $hotspot['top'] }}%; left: {{ $hotspot['left'] }}%; width: {{ $hotspot['width'] }}%; height: {{ $hotspot['height'] }}%;"
               title="{{ $hotspot['name'] }}">
            </a>
            @else
            <a href="{{ $hotspot['link'] }}" 
               class="hotspot-area" 
               style="top: {{ $hotspot['top'] }}%; left: {{ $hotspot['left'] }}%; width: {{ $hotspot['width'] }}%; height: {{ $hotspot['height'] }}%;"
               title="{{ $hotspot['name'] }}">
            </a>
            @endif
            @endforeach
            @endif
        </div>
        
        <div id="button-section" class="about-button-container">
            <a href="{{ url('https://nanogeyser.com/certification') }}" class="btn-view-more">Xem Thêm Chứng Nhận</a>
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
    max-width: 1250px;
    width: 100%;
}

.about-image-wrapper {
    position: relative;
    display: block;
    width: 100%;
}

.about-main-image {
    width: 100%;
    height: auto;
    display: block;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    border-radius: 8px;
}

/* Hotspot styles */
.hotspot-area {
    position: absolute;
    cursor: pointer;
    z-index: 10;
    border: none;
    background: transparent;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.hotspot-area:hover {
    background: rgba(101, 163, 106, 0.3);
    border: 3px solid rgba(101, 163, 106, 0.8);
    box-shadow: 0 0 20px rgba(101, 163, 106, 0.6);
}

.about-button-container {
    text-align: center;
    margin-top: 30px;
}

.btn-view-more {
    display: inline-block;
    padding: 12px 40px;
    background: #65A36A;
    color: #fff;
    text-decoration: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.btn-view-more:hover {
    background: #65A36A;
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
<script>
document.querySelectorAll('.hotspot-scroll').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        var target = document.getElementById(this.dataset.target);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});
</script>
@stop
