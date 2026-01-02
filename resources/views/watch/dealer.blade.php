@extends('watch.layout.master')

@section('content')
<div class="dealer-page">
    <div class="container">
        <!-- Search Section -->
        <div class="dealer-search-section">
            <div class="search-header">
                <span class="search-label">Tìm kiếm cửa hàng</span>
                <div class="search-filters">
                    <select id="province-select" class="filter-select">
                        <option value="">Tất cả tỉnh/thành phố</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->code }}" {{ $selectedProvince == $province->code ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                    <select id="district-select" class="filter-select">
                        <option value="">Tất cả quận/huyện</option>
                        @foreach($districts as $district)
                        <option value="{{ $district->code }}" data-province="{{ $district->province_code }}" {{ $selectedDistrict == $district->code ? 'selected' : '' }}>{{ $district->name }}</option>
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
.dealer-page {
    padding: 30px 0;
    background: #f5f5f5;
    min-height: 600px;
}

.dealer-search-section {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
    background: #65A63A;
}

.search-note {
    text-align: center;
    color: #666;
    font-size: 14px;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.dealer-results {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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

@media (max-width: 768px) {
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
</style>

<script>
$(document).ready(function() {
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
