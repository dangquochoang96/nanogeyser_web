@extends('watch.layout.master')
@section('title', 'Hệ thống đại lý')
@section('keywords', 'Hệ thống đại lý')
@section('description', 'Hệ thống đại lý')
@section('content')
<!--Body-->
<div class="bg-cate mg-0">   
    <img src="/front/image/bg-dmsp.jpg">
    <div class="tit-page">  
        <div class="container">
            <p class="heading-h1-text">Hệ thống đại lý</p>   
        </div> 
        <div class="breadcumb">
            <div class="container"> 
                <ul class="ul-bread ul-none">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                    <li><a href="{{URL::current()}}">Hệ thống đại lý</a></li>
                    <li><img src="/front/image/right.png" alt=""></li>
                </ul>
            </div>  
        </div>  
    </div>   
</div>

<div class="dealer-page">
    <!-- Banner Section -->
    <div class="dealer-banner">
        <div class="banner-placeholder">
            <!-- Để trống, thêm ảnh sau -->
        </div>
    </div>

    <!-- Dealer Slider Section -->
    <div class="dealer-slider-section">
        <div class="container">
            <h2 class="section-title">DANH SÁCH ĐẠI LÝ TRÊN TOÀN QUỐC</h2>
            <div class="dealer-slider-wrapper">
                <div class="dealer-slider" id="dealer-slider">
                    @foreach($partners as $partner)
                    <div class="dealer-slide-item">
                        <div class="dealer-card">
                            <div class="dealer-logo">
                                @if($partner->image)
                                <img src="{{ asset($partner->image) }}" alt="{{ $partner->name }}">
                                @else
                                <div class="logo-placeholder">
                                    <i class="fa fa-building"></i>
                                </div>
                                @endif
                            </div>
                            <div class="dealer-info">
                                <h4 class="dealer-card-name">{{ $partner->name }}</h4>
                                @if($partner->phone)
                                <p class="dealer-card-phone"><i class="fa fa-phone"></i> {{ $partner->phone }}</p>
                                @endif
                                <p class="dealer-card-address">{{ $partner->address }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="slider-dots" id="slider-dots"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Search Section -->
        <div class="dealer-search-section">
            <div class="search-header">
                <span class="search-label">Tìm kiếm cửa hàng</span>
                <div class="search-filters">
                    <select id="province-select" class="filter-select">
                        <option value="">Chọn tỉnh, thành phố</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->province_code }}" {{ $selectedProvince == $province->province_code ? 'selected' : '' }}>{{ $province->province_name }}</option>
                        @endforeach
                    </select>
                    <select id="district-select" class="filter-select">
                        <option value="">Chọn quận, huyện</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->district_code }}" data-province="{{ $location->province_code }}" {{ $selectedDistrict == $location->district_code ? 'selected' : '' }}>{{ $location->district_name }}</option>
                        @endforeach
                    </select>
                    <button id="search-btn" class="search-btn">TÌM KIẾM</button>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="dealer-results">
            <div class="row">
                <!-- Dealer List -->
                <div class="col-md-5 col-sm-12">
                    <div class="dealer-count">
                        Tìm thấy <strong>{{ count($dealers) }}</strong> cửa hàng
                    </div>
                    <div class="dealer-list">
                        @forelse($dealers as $dealer)
                        <div class="dealer-item" data-address="{{ $dealer->address }}">
                            <h4 class="dealer-name">{{ $dealer->name }}</h4>
                            <p class="dealer-address">{{ $dealer->address }}</p>
                            @if($dealer->phone)
                            <p class="dealer-phone"><i class="fa fa-phone"></i> {{ $dealer->phone }}</p>
                            @endif
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($dealer->address) }}" target="_blank" class="get-directions">Get Directions</a>
                        </div>
                        @empty
                        <div class="no-dealers">
                            <p>Không tìm thấy cửa hàng nào.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Map -->
                <div class="col-md-7 col-sm-12">
                    <div id="dealer-map">
                        @if(count($dealers) > 0)
                        <iframe 
                            src="https://maps.google.com/maps?q={{ urlencode($dealers->first()->address) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="550" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                        @else
                        <iframe 
                            src="https://maps.google.com/maps?q=Máy+lọc+nước+Nano+Geyser&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="550" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
/* Banner Section */
.dealer-banner {
    width: 100%;
    background: #f5f5f5;
}

.banner-placeholder {
    width: 100%;
    min-height: 400px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.banner-placeholder img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

/* Dealer Slider Section */
.dealer-slider-section {
    padding: 40px 0;
    background: #fff;
}

.section-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
    text-transform: uppercase;
}

.dealer-slider-wrapper {
    position: relative;
    overflow: hidden;
}

.dealer-slider {
    display: flex;
    transition: transform 0.5s ease;
}

.dealer-slide-item {
    flex: 0 0 20%;
    padding: 0 10px;
    box-sizing: border-box;
}

.dealer-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    height: 100%;
    min-height: 280px;
}

.dealer-logo {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.dealer-logo img {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
}

.logo-placeholder {
    width: 80px;
    height: 80px;
    background: #f0f0f0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-placeholder i {
    font-size: 32px;
    color: #999;
}

.dealer-card-name {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
    min-height: 40px;
}

.dealer-card-phone {
    font-size: 14px;
    color: #e74c3c;
    font-weight: bold;
    margin-bottom: 8px;
}

.dealer-card-phone i {
    margin-right: 5px;
}

.dealer-card-address {
    font-size: 12px;
    color: #666;
    line-height: 1.4;
}

.slider-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.slider-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #ddd;
    cursor: pointer;
    transition: background 0.3s;
}

.slider-dot.active {
    background: #333;
}

/* Search Section */
.dealer-page .container {
    padding: 30px 15px;
}

.dealer-search-section {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #e0e0e0;
}

.search-header {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.search-label {
    font-weight: bold;
    font-size: 16px;
    color: #333;
}

.search-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    flex: 1;
}

.filter-select {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-width: 200px;
    font-size: 14px;
    background: #fff;
}

.search-btn {
    background: #65A63A;
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

.search-btn:hover {
    background: #5a9534;
}

/* Results Section */
.dealer-results {
    background: #fff;
    border: 1px solid #e0e0e0;
    overflow: hidden;
}

.dealer-count {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    color: #666;
}

.dealer-list {
    max-height: 500px;
    overflow-y: auto;
}

.dealer-item {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background 0.3s;
}

.dealer-item:hover {
    background: #f9f9f9;
}

.dealer-item.active {
    background: #e8f5e9;
    border-left: 3px solid #65A63A;
}

.dealer-name {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.dealer-address {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}

.dealer-phone {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}

.get-directions {
    color: #2196F3;
    font-size: 14px;
    text-decoration: none;
}

.get-directions:hover {
    text-decoration: underline;
}

#dealer-map {
    height: 550px;
    width: 100%;
}

#dealer-map iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

.no-dealers {
    padding: 30px;
    text-align: center;
    color: #666;
}

@media (max-width: 992px) {
    .dealer-slide-item {
        flex: 0 0 33.333%;
    }
}

@media (max-width: 768px) {
    .dealer-slide-item {
        flex: 0 0 50%;
    }
    
    .banner-placeholder {
        min-height: 200px;
    }
    
    .search-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .search-filters {
        width: 100%;
    }
    
    .filter-select {
        width: 100%;
        min-width: auto;
    }
    
    .search-btn {
        width: 100%;
    }
    
    #dealer-map {
        height: 400px;
        margin-top: 20px;
    }
    
    .dealer-list {
        max-height: 300px;
    }
}

@media (max-width: 480px) {
    .dealer-slide-item {
        flex: 0 0 100%;
    }
}
</style>

<script>
$(document).ready(function() {
    // Dealer Slider
    var slider = $('#dealer-slider');
    var slideItems = slider.find('.dealer-slide-item');
    var totalSlides = slideItems.length;
    var slidesPerView = 5;
    var currentSlide = 0;
    
    function updateSlidesPerView() {
        if (window.innerWidth <= 480) {
            slidesPerView = 1;
        } else if (window.innerWidth <= 768) {
            slidesPerView = 2;
        } else if (window.innerWidth <= 992) {
            slidesPerView = 3;
        } else {
            slidesPerView = 5;
        }
    }
    
    function createDots() {
        var dotsContainer = $('#slider-dots');
        dotsContainer.empty();
        var totalPages = Math.ceil(totalSlides / slidesPerView);
        
        for (var i = 0; i < totalPages; i++) {
            var dot = $('<span class="slider-dot"></span>');
            if (i === 0) dot.addClass('active');
            dot.data('index', i);
            dotsContainer.append(dot);
        }
    }
    
    function goToSlide(index) {
        var maxIndex = Math.ceil(totalSlides / slidesPerView) - 1;
        if (index < 0) index = maxIndex;
        if (index > maxIndex) index = 0;
        
        currentSlide = index;
        var translateX = -(index * slidesPerView * (100 / slidesPerView));
        slider.css('transform', 'translateX(' + translateX + '%)');
        
        $('.slider-dot').removeClass('active');
        $('.slider-dot').eq(index).addClass('active');
    }
    
    updateSlidesPerView();
    createDots();
    
    $(window).resize(function() {
        updateSlidesPerView();
        createDots();
        goToSlide(0);
    });
    
    $(document).on('click', '.slider-dot', function() {
        goToSlide($(this).data('index'));
    });
    
    // Auto slide
    setInterval(function() {
        goToSlide(currentSlide + 1);
    }, 5000);
    
    // Filter districts by province
    $('#province-select').change(function() {
        var provinceCode = $(this).val();
        $('#district-select option').each(function() {
            var districtProvince = $(this).data('province');
            if (provinceCode === '' || districtProvince == provinceCode || $(this).val() === '') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('#district-select').val('');
    });
    
    // Search button click
    $('#search-btn').click(function() {
        var province = $('#province-select').val();
        var district = $('#district-select').val();
        var url = '{{ route("he-thong-dai-ly") }}';
        var params = [];
        
        if (province) params.push('province=' + province);
        if (district) params.push('district=' + district);
        
        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        
        window.location.href = url;
    });
    
    // Click on dealer item to change map
    $('.dealer-item').click(function() {
        var address = $(this).data('address');
        if (address) {
            var mapUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(address) + '&t=&z=15&ie=UTF8&iwloc=&output=embed';
            $('#dealer-map iframe').attr('src', mapUrl);
        }
        
        // Highlight selected item
        $('.dealer-item').removeClass('active');
        $(this).addClass('active');
    });
    
    // Trigger province filter on page load
    $('#province-select').trigger('change');
});
</script>
@endsection
