@extends('watch.layout.master')
@section('title', 'Hệ thống đại lý')
@section('keywords', 'Hệ thống đại lý')
@section('description', 'Hệ thống đại lý')
@section('content')

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

    <!-- Main Content Wrapper - Centered -->
    <div class="dealer-content-wrapper">
        <div class="dealer-main-container">
            <!-- Left Sidebar -->
            <div class="dealer-sidebar">
                <!-- Search Box -->
                <div class="dealer-search-box">
                    <input type="text" id="search-input" class="search-input" placeholder="Tìm kiếm theo tên đại lý, tỉnh/Tp, quận/huyện">
                    <button id="search-submit-btn" class="search-submit-btn">
                        <i class="fa fa-search"></i>
                    </button>
                    <button id="filter-toggle-btn" class="filter-toggle-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>
                    </button>
                </div>

                <!-- Dealer List -->
                <div class="dealer-list-wrapper">
                    <div class="dealer-count">
                        Tìm thấy <strong>{{ count($dealers) }}</strong> cửa hàng
                    </div>
                    <div class="dealer-list">
                        @forelse($dealers as $dealer)
                        <div class="dealer-item" data-address="{{ $dealer->address }}">
                            <h4 class="dealer-name">{{ $dealer->name }}</h4>
                            <p class="dealer-address">
                                <i class="fa fa-map-marker"></i> {{ $dealer->address }}
                            </p>
                            @if($dealer->phone)
                            <p class="dealer-phone">
                                <i class="fa fa-phone"></i> {{ $dealer->phone }}
                            </p>
                            @endif
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($dealer->address) }}" target="_blank" class="get-directions">
                                <i class="fa fa-location-arrow"></i>
                            </a>
                        </div>
                        @empty
                        <div class="no-dealers">
                            <p>Không tìm thấy cửa hàng nào.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Map -->
            <div class="dealer-map-container">
                <div id="dealer-map">
                <iframe 
                    src="https://maps.google.com/maps?q=Máy+lọc+nước+Nano+Geyser&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filter-modal" class="filter-modal">
        <div class="filter-modal-content">
            <div class="filter-modal-header">
                <h3>Bộ lọc</h3>
                <button class="filter-close-btn">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="filter-modal-body">
                <div class="filter-section">
                    <label class="filter-label">VỊ TRÍ</label>
                    
                    <div class="filter-group">
                        <label class="filter-group-label">Tỉnh/Thành phố</label>
                        <select id="province-select" class="filter-select">
                            <option value="">Chọn tỉnh/thành phố</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->province_code }}" {{ $selectedProvince == $province->province_code ? 'selected' : '' }}>{{ $province->province_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-group-label">Quận/Huyện</label>
                        <select id="district-select" class="filter-select">
                            <option value="">Chọn quận/huyện</option>
                            @foreach($locations as $location)
                            <option value="{{ $location->district_code }}" data-province="{{ $location->province_code }}" {{ $selectedDistrict == $location->district_code ? 'selected' : '' }}>{{ $location->district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="filter-section">
                    <label class="filter-label">KÊNH BÁN HÀNG</label>
                    <div class="filter-checkbox-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" id="dealer-type" value="dealer">
                            <span>Đại lý</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" id="distributor-type" value="distributor">
                            <span>Nhà phân phối</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="filter-modal-footer">
                <button id="clear-filter-btn" class="clear-filter-btn">XÓA BỘ LỌC</button>
                <button id="apply-filter-btn" class="apply-filter-btn">XÁC NHẬN</button>
            </div>
        </div>
    </div>
</div>


<style>
/* Reset and Base */
.dealer-page {
    margin: 0;
    padding: 0;
    background: #f5f5f5;
}

/* Header with Blue Background */
.dealer-header {
    background: linear-gradient(135deg, #1e88e5 0%, #00acc1 100%);
    padding: 30px 0;
}

.dealer-header-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.dealer-title {
    color: #fff;
    font-size: 28px;
    font-weight: bold;
    margin: 0;
}

/* Content Wrapper - Centered Container */
.dealer-content-wrapper {
    max-width: 1400px;
    margin: 30px auto;
    padding: 0 20px;
}

/* Main Container */
.dealer-main-container {
    display: flex;
    height: 700px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: hidden;
}

/* Left Sidebar */
.dealer-sidebar {
    width: 380px;
    background: #fff;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #e0e0e0;
}

/* Search Box */
.dealer-search-box {
    padding: 20px;
    background: #fff;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    gap: 0;
}

.dealer-search-box .search-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-right: none;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
}

.dealer-search-box .search-input::placeholder {
    color: #999;
}

.search-submit-btn {
    background: #00d447ff;
    color: #fff;
    border: none;
    border: 1px solid #00d447ff;
    padding: 12px 20px;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-submit-btn:hover {
    background: #1fab4eff;
}

.search-submit-btn i {
    font-size: 16px;
}

.filter-toggle-btn {
    background: #fff;
    color: #00d447ff;
    border: 1px solid #ddd;
    border-left: none;
    padding: 12px 20px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.filter-toggle-btn:hover {
    background: #f5f5f5;
}

.filter-toggle-btn i {
    font-size: 16px;
}

/* Dealer List Wrapper */
.dealer-list-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.dealer-count {
    padding: 15px 20px;
    background: #f9f9f9;
    border-bottom: 1px solid #e0e0e0;
    font-size: 14px;
    color: #666;
}

.dealer-list {
    flex: 1;
    overflow-y: auto;
    background: #fff;
}

/* Dealer Item */
.dealer-item {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
}

.dealer-item:hover {
    background: #f9f9f9;
}

.dealer-item.active {
    background: #e3f2fd;
    border-left: 4px solid #00d447ff;
}

.dealer-name {
    font-size: 15px;
    font-weight: bold;
    color: #333;
    margin: 0 0 10px 0;
}

.dealer-address {
    font-size: 13px;
    color: #666;
    margin: 0 0 8px 0;
    line-height: 1.6;
    padding-right: 30px;
}

.dealer-address i {
    color: #00d447ff;
    margin-right: 6px;
    font-size: 13px;
}

.dealer-phone {
    font-size: 13px;
    color: #666;
    margin: 0;
}

.dealer-phone i {
    color: #00d447ff;
    margin-right: 6px;
}

.get-directions {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #00d447ff;
    font-size: 18px;
    text-decoration: none;
}

.get-directions:hover {
    color: #00a73dff;
}

.no-dealers {
    padding: 40px 20px;
    text-align: center;
    color: #999;
}

/* Right Map Container */
.dealer-map-container {
    flex: 1;
    position: relative;
    background: #f5f5f5;
}

#dealer-map {
    width: 100%;
    height: 100%;
}

#dealer-map iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

/* Filter Modal */
.filter-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.filter-modal.active {
    display: flex;
}

.filter-modal-content {
    background: #fff;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

.filter-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.filter-modal-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

.filter-close-btn {
    background: none;
    border: none;
    font-size: 24px;
    color: #999;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
}

.filter-modal-body {
    padding: 20px;
}

.filter-section {
    margin-bottom: 30px;
}

.filter-label {
    display: block;
    font-size: 12px;
    color: #999;
    font-weight: bold;
    margin-bottom: 15px;
    letter-spacing: 0.5px;
}

.filter-group {
    margin-bottom: 20px;
}

.filter-group-label {
    display: block;
    font-size: 14px;
    color: #333;
    font-weight: 600;
    margin-bottom: 8px;
}

.filter-select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    font-size: 14px;
    background: #fff;
    color: #999;
    outline: none;
}

.filter-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.filter-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 14px;
    color: #333;
}

.filter-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    cursor: pointer;
}

.filter-checkbox span {
    user-select: none;
}

.filter-modal-footer {
    display: flex;
    gap: 10px;
    padding: 20px;
    border-top: 1px solid #eee;
}

.clear-filter-btn {
    flex: 1;
    padding: 12px 20px;
    background: #fff;
    color: #00d447ff;
    border: 1px solid #00d447ff;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
}

.clear-filter-btn:hover {
    background: #f5f5f5;
}

.apply-filter-btn {
    flex: 1;
    padding: 12px 20px;
    background: #00d447ff;
    color: #fff;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

.apply-filter-btn:hover {
    background: #00c11dff;
}

/* Results Section - Full Width Layout */
.dealer-results-wrapper {
    height: calc(100vh - 200px);
    min-height: 600px;
}

.dealer-results-container {
    display: flex;
    height: 100%;
}

.dealer-list-column {
    width: 35%;
    background: #fff;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #e0e0e0;
}

.dealer-map-column {
    width: 65%;
    position: relative;
}

.dealer-count {
    padding: 20px;
    border-bottom: 1px solid #eee;
    font-size: 15px;
    color: #666;
    background: #fafafa;
}

.dealer-list {
    flex: 1;
    overflow-y: auto;
    background: #fff;
}

.dealer-item {
    padding: 20px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: all 0.3s;
}

.dealer-item:hover {
    background: #f9f9f9;
}

.dealer-item.active {
    background: #e8f5e9;
    border-left: 4px solid #00d447ff;
}

.dealer-name {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin: 0 0 10px 0;
}

.dealer-address {
    font-size: 14px;
    color: #666;
    margin: 0 0 8px 0;
    line-height: 1.5;
}

.dealer-address i {
    color: #00d447ff;
    margin-right: 8px;
    font-size: 14px;
}

.dealer-phone {
    font-size: 14px;
    color: #666;
    margin: 0 0 10px 0;
}

.dealer-phone i {
    color: #00d447ff;
    margin-right: 8px;
}

.get-directions {
    color: #00d447ff;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    font-weight: 500;
}

.get-directions:hover {
    text-decoration: underline;
}

.get-directions i {
    margin-right: 5px;
}

#dealer-map {
    width: 100%;
    height: 100%;
    position: relative;
}

#dealer-map iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

.no-dealers {
    padding: 40px 20px;
    text-align: center;
    color: #999;
}

@media (max-width: 992px) {
    .dealer-content-wrapper {
        margin: 20px auto;
        padding: 0 15px;
    }
    
    .dealer-main-container {
        flex-direction: column;
        height: auto;
        min-height: 600px;
    }
    
    .dealer-sidebar {
        width: 100%;
        height: 400px;
        border-right: none;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .dealer-map-container {
        height: 400px;
    }
}

@media (max-width: 768px) {
    .dealer-header {
        padding: 20px 0;
    }
    
    .dealer-title {
        font-size: 22px;
    }
    
    .dealer-content-wrapper {
        margin: 15px auto;
        padding: 0 10px;
    }
    
    .dealer-main-container {
        height: auto;
    }
    
    .dealer-sidebar {
        height: 350px;
    }
    
    .dealer-map-container {
        height: 350px;
    }
    
    .dealer-search-box .search-input {
        font-size: 13px;
        padding: 10px 70px 10px 12px;
    }
    
    .search-submit-btn,
    .filter-toggle-btn {
        padding: 10px 15px;
    }
    
    .filter-modal-content {
        width: 95%;
        max-height: 95vh;
    }
    
    .dealer-item {
        padding: 15px;
    }
    
    .dealer-name {
        font-size: 14px;
    }
    
    .dealer-address,
    .dealer-phone {
        font-size: 12px;
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
    
    // Filter Modal Toggle
    $('#filter-toggle-btn').click(function() {
        $('#filter-modal').addClass('active');
        $('body').css('overflow', 'hidden');
    });
    
    $('.filter-close-btn').click(function() {
        $('#filter-modal').removeClass('active');
        $('body').css('overflow', 'auto');
    });
    
    // Close modal when clicking outside
    $('#filter-modal').click(function(e) {
        if ($(e.target).is('#filter-modal')) {
            $('#filter-modal').removeClass('active');
            $('body').css('overflow', 'auto');
        }
    });
    
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
    
    // Clear filter button
    $('#clear-filter-btn').click(function() {
        $('#province-select').val('');
        $('#district-select').val('');
        $('#dealer-type').prop('checked', false);
        $('#distributor-type').prop('checked', false);
        $('#search-input').val('');
    });
    
    // Apply filter button
    $('#apply-filter-btn').click(function() {
        performSearch();
        $('#filter-modal').removeClass('active');
        $('body').css('overflow', 'auto');
    });
    
    // Search submit button
    $('#search-submit-btn').click(function() {
        performSearch();
    });
    
    // Search on Enter key
    $('#search-input').keypress(function(e) {
        if (e.which === 13) {
            performSearch();
        }
    });
    
    // Perform search function
    function performSearch() {
        var province = $('#province-select').val();
        var district = $('#district-select').val();
        var searchText = $('#search-input').val();
        var url = '{{ route("he-thong-dai-ly") }}';
        var params = [];
        
        if (province) params.push('province=' + province);
        if (district) params.push('district=' + district);
        if (searchText) params.push('search=' + encodeURIComponent(searchText));
        
        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        
        window.location.href = url;
    }
    
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
