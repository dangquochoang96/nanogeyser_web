@extends('watch.layout.master')
@section('title', $category->name)
@section('keywords', $category->keyword)
@section('description', $category->meta_description)
@section('fb_image', 'https://nghiafurniture.com' . $category->img)
@section('content')

    <div class="container">
        <!--Body-->
        <div class="bg-cate">
            <img src="@if ($category->img) {{ $category->img }} @else /front/image/bg-dmsp.jpg @endif">
            <div class="tit-page">
                <div class="container">
                    <p class="heading-h1-text">{{ $category->name }}</p>
                </div>
                <div class="breadcumb">
                    <div class="container">
                        <ul class="ul-bread ul-none">
                            <li><a href="/">Trang chủ</a></li>
                            <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                            <li><a href="/{{ $category->slug }}">{{ $category->name }}</a></li>
                            <li><img src="/front/image/right.png" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <p class="des-page"> {!! $category->description !!} </p>
            {{-- @dd($categories[0]->productsLimit) --}}
            @foreach ($categories as $cate)
            
                <div class="dm-child">
                    <div class="tit-child">
                        <p>{{ $cate->name }}</p>
                        <a href="/{{ $cate->slug }}" class="view-dm">Xem tất cả</a>
                    </div>
                    <div class="row">
                        {{-- @dd($cate->productsLimit) --}}
                        @foreach ($cate->productsLimit as $item)
                            
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="sp-dm">
                                        <div class="img-sp">
                                            <a href="{{ route('showBySlug', ['slug' => $item->slug]) }}">
                                                <img src="{{ sizeof($item->productImages) ? asset($item->productImages->first()->link) : '' }}"
                                                    alt="{{ $item->name }}" class="img-responsive">
                                                @if ($item->best_sell == 1)
                                                    <span class="hot-pr">Hot</span>
                                                @endif
                                            </a>
                                            <div class="hover-sp">
                                                <a href="{{ route('showBySlug', ['slug' => $item->slug]) }}"
                                                    class="view-sp">Xem chi tiết</a>
                                                <a href="" class="view-nhanh" data-type="1" data-title="xem nhanh"
                                                    data-toggle="modal" data-name="{{ $item->name }}"
                                                    data-price='{{ number_format($item->price, 0, '.', ',') }} đ'
                                                    data-link="{{ route('showBySlug', ['slug' => $item->slug]) }}"
                                                    data-id="{{ $item->id }}"
                                                    data-pricenew='{{ number_format($item->sale_price, 0, '.', ',') }} đ'
                                                    data-image="{{ sizeof($item->productImages) ? asset($item->productImages->first()->link) : '' }}"
                                                    data-model="{{ $item->model }}" data-weight="{{ $item->weight }}"
                                                    data-number_filter="{{ $item->number_filter }}"
                                                    data-filter_technology="{{ $item->filter_technology }}"
                                                    data-filter_capacity="{{ $item->filter_capacity }}"
                                                    data-producer="{{ $item->producer }}"
                                                    data-ability_clean="{{ $item->ability_clean }}"
                                                    data-target="#myModal">Xem nhanh</a>
                                            </div>
                                        </div>
                                        <h3><a
                                                href="{{ route('showBySlug', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                        </h3>
                                        @if ($item->sale_price)
                                            <p class="price-new">{{ number_format($item->sale_price, 0, '.', ',') }} đ</p>
                                            <p class="price-old">{{ number_format($item->price, 0, '.', ',') }} đ</p>
                                        @else
                                            <p class="price-new">{{ number_format($item->price, 0, '.', ',') }} đ</p>
                                        @endif
                                    </div>
                                </div>
                            
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.view-nhanh').click(function() {
                    $('.modal-content .img-product-h img').attr('src', $(this).attr('data-image'));
                    $('.modal-content .chitiet').attr('href', $(this).attr('data-link'));
                    $('.modal-content .cart1').attr('data-product', $(this).attr('data-id'));
                    $('.modal-content .product-name a').html($(this).attr('data-name'));
                    $('.modal-content .product-name a').attr('href', $(this).attr('data-link'));
                    $('.modal-content .product-name a').attr('data-product', $(this).attr('data-id'));
                    if ($(this).attr('data-pricenew') == '0 đ') {
                        $('.modal-content .price-km').html($(this).attr('data-price'));
                        $('.modal-content .price').css('display', 'none');
                    } else {
                        $('.modal-content .price').css('display', 'inline-block');
                        $('.modal-content .price-km').html($(this).attr('data-pricenew'));
                        $('.modal-content .price').html($(this).attr('data-price'));
                    }

                    $('.modal-content .item-model').html($(this).attr('data-model'));
                    $('.modal-content .item-weight').html($(this).attr('data-weight'));
                    $('.modal-content .item-number_filter').html($(this).attr('data-number_filter'));
                    $('.modal-content .item-filter_technology').html($(this).attr('data-filter_technology'));
                    $('.modal-content .item-filter_capacity').html($(this).attr('data-filter_capacity'));
                    $('.modal-content .item-producer').html($(this).attr('data-producer'));
                    $('.modal-content .item-ability_clean').html($(this).attr('data-ability_clean'));
                });
            });
        </script>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog container popup-sp" role="document">
                <div class="modal-header nk-modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 center-box">
                            <div class="img-product-h">
                                <img src="/front/image/dm1.png" class="img-responsive">
                            </div>
                            <a class="chitiet" href="">Xem chi tiết</a>
                            <a href="javascript:void();" data-buy="1" data-product="" class="cart1">Thêm vào giỏ hàng</a>
                            <div class="div_success" style="display: none;color: #65A63A;">Thêm vào giỏ hàng thành công
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <h2 class="product-name">
                                <a href=""></a>
                            </h2>
                            <p class="price-km"></p>
                            <p class="price"></p>
                            <ul class="ul-none product-inf">
                                <li>Model: <span class="item-model"></span></li>
                                <li>Trọng lượng: <span class="item-weight"></span></li>
                                <li>Số lõi lọc: <span class="item-number_filter"></span></li>
                                <li>Công nghệ lọc: <span class="item-filter_technology"></span></li>
                                <li>Công suất lọc: <span class="item-filter_capacity"></span></li>
                                <li>Nhà sản xuất: <span class="item-producer"></span></li>
                                <li>Khả năng lọc sạch: <span class="item-ability_clean"></span></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--EndBody-->

    </div>
    @include('watch.layout.map')
@stop
@section('script')

@stop
