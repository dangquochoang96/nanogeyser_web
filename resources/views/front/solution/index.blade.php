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

<!-- Slide ảnh với hotspot overlay -->
@if(isset($images) && count($images) > 0)
<div class="solution-images-section">
    <div class="container">
        @foreach($images as $index => $item)
        <div class="solution-image-item">
            <div class="image-hotspot-container">
                <img src="/front/image/{{ $item['image'] }}" alt="Giải pháp lọc nước {{ $index + 1 }}" class="img-responsive">
                
                @if(!empty($item['hotspots']))
                    @foreach($item['hotspots'] as $hotspot)
                    <a href="{{ $hotspot['link'] }}" 
                       class="hotspot-link"
                       style="top: {{ $hotspot['top'] }}%; left: {{ $hotspot['left'] }}%; width: {{ $hotspot['width'] }}%; height: {{ $hotspot['height'] }}%;"
                       aria-label="{{ $hotspot['name'] }}"
                       title="{{ $hotspot['name'] }}"
                       data-product="{{ $hotspot['name'] }}"
                       onclick="trackProductClick('{{ $hotspot['name'] }}', '{{ $hotspot['link'] }}')">
                        <span class="hotspot-tooltip">{{ $hotspot['name'] }}</span>
                    </a>
                    @endforeach
                @endif
            </div>
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

/* Container cho ảnh và hotspot */
.image-hotspot-container {
    position: relative;
    display: inline-block;
    max-width: 100%;
}

.image-hotspot-container img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Hotspot link overlay */
.hotspot-link {
    position: absolute;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 8px;
    transition: all 0.3s ease;
    z-index: 10;
}

/* Hiệu ứng hover - sáng lên */
.hotspot-link:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: #28a745;
    box-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
}

/* Hiệu ứng click - sáng hơn */
.hotspot-link:active {
    background: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 30px rgba(40, 167, 69, 0.8);
}

/* Tooltip hiển thị tên sản phẩm */
.hotspot-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #28a745;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    pointer-events: none;
    margin-bottom: 8px;
}

.hotspot-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 6px solid transparent;
    border-top-color: #28a745;
}

.hotspot-link:hover .hotspot-tooltip {
    opacity: 1;
    visibility: visible;
}

@media (max-width: 768px) {
    .solution-images-section {
        padding: 20px 0;
    }
    
    .solution-image-item {
        margin-bottom: 20px;
    }
    
    .hotspot-tooltip {
        font-size: 11px;
        padding: 6px 10px;
    }
}
</style>
@endif

@include('watch.layout.map')
@endsection

@section('script')
<script>
// Tracking function cho GA và Meta Pixel
function trackProductClick(productName, productLink) {
    // Google Analytics 4
    if (typeof gtag !== 'undefined') {
        gtag('event', 'product_click', {
            'event_category': 'Solution Page',
            'event_label': productName,
            'product_link': productLink
        });
    }
    
    // Meta Pixel (Facebook)
    if (typeof fbq !== 'undefined') {
        fbq('track', 'ViewContent', {
            content_name: productName,
            content_type: 'product',
            content_ids: [productLink]
        });
    }
    
    console.log('Product clicked:', productName, productLink);
}
</script>
@endsection
