@extends('watch.layout.master')
@section('title', $product->name)
@section('keywords', $product->keyword)
@section('description', $product->meta_description)
@section('fb_image', sizeof($product->productImages) ? asset($product->productImages->first()->link) : '')
@section('fb_url', route('showBySlug', ['slug' => $product->slug]))
@section('content')
    <style type="text/css">
        .fb_iframe_widget_fluid_desktop,
        .fb_iframe_widget_fluid_desktop span,
        .fb_iframe_widget_fluid_desktop iframe {
            max-width: 100% !important;
            width: 100% !important;
        }
    </style>
    <div class="bg-cate">
        <img src="/front/image/bg-dmsp.jpg">
        <div class="tit-page">
            <div class="container">
                <p class="heading-h1-text">Máy lọc nước</p>
            </div>
            <div class="breadcumb">
                <div class="container">
                    <ul class="ul-bread ul-none">
                        <li><a href="/">Trang chủ</a></li>
                        <li class="br-right"><img src="/front/image/right.png" alt=""></li>
                        <?php
                        $last_cate = end($product->categories);
                        ?>
                        @if (isset($last_cate[0]))
                            <li>
                                <a href="/{{ $last_cate[0]->slug }}">
                                    {{ $last_cate[0]->name }}
                                </a>
                            </li>
                        @endif
                        <li><img src="/front/image/right.png" alt=""></li>
                        <li><a href="{{ URL::current() }}">{{ $product->name }}</a></li>
                        <li><img src="/front/image/right.png" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="pr-head1">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12 img-view">
                    <div class="slider-container">
                        <div id="sync1" class="owl-carousel">
                            @if ($product->video)
                                <div class="item">
                                    <div class="fx-video">
                                        <iframe src="{{ $product->video }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen=""></iframe>
                                        <a class="fx-a nd-fancy" rel="galery1" data-fancybox="gallery"
                                            data-fancybox-group="dai-nq" href="{{ $product->video }}"></a>
                                    </div>
                                </div>
                            @endif
                            @foreach ($product->productImages as $image)
                                <div class="item">
                                    <a class="ns-img nd-fancy"  onclick=""
                                        href="{{ asset($image->link) }}" rel="galery1" data-fancybox="gallery"
                                        data-fancybox-group="dai-nq" data-thumb="{{ asset($image->link) }}">
                                        <img src="{{ asset($image->link) }}" class="img-responsive" id="image_change">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="thumbnail-slider-container">
                            <div id="sync2" class="thumbnail-slider owl-carousel">
                                @if ($product->video)
                                    <div class="item">
                                        <div class="thum-box">
                                            <div class="fx-video">
                                                <iframe width="124" height="86" src="{{ $product->video }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen=""></iframe>
                                                <a class="fx-a nd-fancy" rel="galery1" data-fancybox="gallery"
                                                    data-fancybox-group="dai-nq" href="{{ $product->video }}"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @foreach ($product->productImages as $image)
                                    <div class="item">
                                        <div class="thum-box">
                                            <img src="{{ asset($image->link) }}" class="img-responsive">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var sync1 = $("#sync1");
                        var sync2 = $("#sync2");
                        sync1.owlCarousel({
                            singleItem: true,
                            autoPlay: false,
                            slideSpeed: 1000,
                            items: 1,
                            itemsDesktop: [1199, 1],
                            itemsDesktopSmall: [979, 1],
                            itemsTablet: [768, 1],
                            itemsMobile: [479, 1],
                            navigation: true,
                            pagination: false,
                            afterAction: syncPosition,
                            responsiveRefreshRate: 200,
                            autoHeight: true
                        });
                        sync2.owlCarousel({
                            items: 4,
                            margin: 10,
                            merge: true,
                            itemsDesktop: [1199, 4],
                            itemsDesktopSmall: [979, 4],
                            itemsTablet: [768, 4],
                            itemsMobile: [479, 4],
                            pagination: false,
                            responsiveRefreshRate: 100,
                            autoHeight: true,
                            afterInit: function(el) {
                                el.find(".owl-item").eq(0).addClass("synced");
                            }
                        });

                        function syncPosition(el) {
                            var current = this.currentItem;
                            $("#sync2")
                                .find(".owl-item")
                                .removeClass("synced")
                                .eq(current)
                                .addClass("synced")
                            if ($("#sync2").data("owlCarousel") !== undefined) {
                                center(current)
                            }
                        }
                        $("#sync2").on("click", ".owl-item", function(e) {
                            e.preventDefault();
                            var number = $(this).data("owlItem");
                            sync1.trigger("owl.goTo", number);
                        });

                        function center(number) {
                            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
                            var num = number;
                            var found = false;
                            for (var i in sync2visible) {
                                if (num === sync2visible[i]) {
                                    var found = true;
                                }
                            }
                            if (found === false) {
                                if (num > sync2visible[sync2visible.length - 1]) {
                                    sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                                } else {
                                    if (num - 1 === -1) {
                                        num = 0;
                                    }
                                    sync2.trigger("owl.goTo", num);
                                }
                            } else if (num === sync2visible[sync2visible.length - 1]) {
                                sync2.trigger("owl.goTo", sync2visible[1])
                            } else if (num === sync2visible[0]) {
                                sync2.trigger("owl.goTo", num - 1)
                            }
                        }
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".nd-fancy").fancybox({
                            'transitionIn': 'none',
                            'transitionOut': 'none',
                            thumbs: {
                                autoStart: true, // Display thumbnails on opening
                                hideOnClose: true, // Hide thumbnail grid when closing animation starts
                                parentEl: ".fancybox-container", // Container is injected into this element
                                axis: "x" // Vertical (y) or horizontal (x) scrolling
                            },
                            image: {
                                preload: false
                            },
                            buttons: [
                                "zoom",
                                "share",
                                "slideShow",
                                "fullScreen",
                                "download",
                                "thumbs",
                                "close"
                            ],
                        });
                    });
                </script>

                <div class="col-md-7 col-sm-12 col-xs-12">

                    <p class="name-spview">{{ $product->name }}</p>

                    <div class="time-page">
                        <span class="trafic"><i class="fa fa-eye"></i> Lượt xem: 34525</span>
                        <span class="danhgia">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i> (1 đánh giá)
                        </span>
                        <div class="clear"></div>
                    </div>

                    @php $options = json_decode($product->options, true); @endphp

                    {{-- Giao diện chọn biến thể --}}
                    @if ($options)
                        <style>
                            .variant-container {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 12px;
                            }

                            .variant-option {
                                border: 1px solid #ccc;
                                border-radius: 12px;
                                padding: 10px;
                                width: 250px;
                                cursor: pointer;
                                background-color: #fff;
                                transition: all 0.2s ease;
                                position: relative;
                            }

                            .variant-option.selected {
                                border: 2px solid #e60000;
                            }

                            .variant-content {
                                display: flex;
                                align-items: center;
                                gap: 10px;
                            }

                            .variant-option img {
                                width: 60px;
                                height: 60px;
                                object-fit: cover;
                                border-radius: 8px;
                            }

                            .variant-info {
                                flex: 1;
                            }

                            .variant-title {
                                font-size: 14px;
                                margin-bottom: 4px;
                            }

                            .variant-price {
                                font-size: 14px;
                                color: #333;
                            }

                            .checkmark {
                                display: none;
                                position: absolute;
                                top: 6px;
                                right: 10px;
                                color: #e60000;
                                font-size: 18px;
                                font-weight: bold;
                            }

                            .variant-option.selected .checkmark {
                                display: block;
                            }
                        </style>



                        <div class="form-group mb-3">
                            <label><strong>Chọn loại sản phẩm:</strong></label>
                            <div class="variant-container">
                                @foreach ($options as $index => $item)
                                    <div class="variant-option" data-price="{{ $item['price'] }}"
                                        data-pricesale="{{ $item['price_sale'] ?? 0 }}" data-image="{{ $item['image'] }}"
                                        data-index="{{ $index }}">
                                        <div class="variant-content">
                                            @if (!empty($item['image']))
                                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                                            @endif
                                            <div class="variant-info">
                                                <div class="variant-title"><strong
                                                        style="font-weight: bold">{{ $item['title'] }}</strong></div>
                                                @if ($item['price_sale'])
                                                    <div class="variant-price">
                                                        <span
                                                            class="price-before">{{ number_format($item['price'], 0, '.', ',') }}₫</span>
                                                        <br>
                                                        <span
                                                            style="font-weight: bold;font-size: 14px; color: red;">{{ number_format($item['price_sale'], 0, '.', ',') }}₫</span>
                                                    </div>
                                                @endif
                                                {{-- <div class="variant-price">
                                                    {{ number_format($item['price'], 0, '.', '.') }}₫</div> --}}
                                            </div>
                                        </div>
                                        <div class="checkmark">✔</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Giá sản phẩm --}}
                    <div class="price-v">
                        @if ($product->sale_price)
                            <span class="tit-pr">Giá thị trường</span>
                            <span class="price-before">{{ number_format($product->price, 0, '.', ',') }} đ</span>
                            <br>
                            <span class="tit-pr">Giá bán</span>
                            <span class="price-after">{{ number_format($product->sale_price, 0, '.', ',') }} đ</span>
                        @else
                            <span class="tit-pr">Giá bán</span>
                            <span class="price-after">{{ number_format($product->price, 0, '.', ',') }} đ</span>
                        @endif
                    </div>
                    {{-- Mô tả --}}
                    <div class="des-shot">
                        {!! $product->description !!}
                    </div>

                    {{-- Mua hàng --}}
                    <div class="mua-hang">
                        <div class="so-luong">
                            Số lượng <span class="pre-sp">-</span>
                            <input type="number" name="quantity" value="1" min="1">
                            <span class="next-sp">+</span>
                        </div>
                        <a href="javascript:void(0)" class="buy-pr cart1" data-product="{{ $product->id }}"
                            data-buy="1" style="margin-top: 0px">Mua hàng</a>
                        <div class="clear"></div>
                    </div>

                    <div class="div_success" style="display: none;color: #65A63A;">
                        Thêm vào giỏ hàng thành công
                    </div>

                    <div class="call">
                        Gọi hotline để có giá tốt <a href="tel:0386902668">038 690 2668</a>
                    </div>
                </div>

                {{-- JS xử lý chọn biến thể --}}
                <script>
                    $(document).ready(function() {
                        function updateVariantDisplay(el) {
                            $('.variant-option').removeClass('selected');
                            el.addClass('selected');

                            let price = el.data('price');
                            let price_sale = el.data('pricesale');
                            const image = el.data('image');


                            if (price_sale) {

                                let format = new Intl.NumberFormat('vi-VN').format(price) + ' đ';

                                let formattedPrice = new Intl.NumberFormat('vi-VN').format(price_sale) + ' đ';
                                $('.price-after').text(formattedPrice);
                                $('.price-before').text(format);
                            } else {
                                let formattedPrice = new Intl.NumberFormat('vi-VN').format(price) + ' đ';
                                $('.price-after').text(formattedPrice);
                            }



                            if (image) {
                                $('#variantImage').attr('src', image).show();
                            } else {
                                $('#variantImage').hide();
                            }

                            $('#image_change').attr('src', image).show();
                        }

                        $('.variant-option').on('click', function() {
                            updateVariantDisplay($(this));
                        });
                    });
                </script>



            </div>
        </div>


        <div class="content-sp">
            <div class="tab-inf">
                <span class="tong-quan tablinks active">Tổng quan</span>
                <span class="uu-diem tablinks">Ưu điểm nổi bật</span>
                <span class="thongso tablinks">Thông số kĩ thuật</span>
                <span class="intro_video tablinks">Video</span>
                <span class="comment-f tablinks">Đánh giá</span>
            </div>
            <div class="main-sp">
                <div id="tong-quan">
                    {!! $product->content !!}
                </div>
                <div id="uu-diem">
                    {!! $product->advantages !!}
                </div>
                <div id="thongso">
                    {!! $product->technical_special !!}
                </div>
                <div id="intro_video">
                    {!! $product->intro_video !!}
                </div>
                <div id="comment-f">
                    <h4>Đánh giá của khách hàng</h4>
                    <!--<div id="fb-root"></div>-->
                    <!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0"
                        nonce="78eH0nu3"></script>-->
                    <!--<div class="fb-comments" data-href="{{ URL::current() }}" data-width="100%" data-numposts="5"></div>-->
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous"
                        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0&appId=445850863127921" nonce="k690L44D">
                    </script>
                    <!--<div class="fb-comments" data-href="https://nanogeyservietnam.com.vn/" data-width="100%" data-numposts="5"></div>-->
                    <div class="fb-comments" data-href="<?php echo 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" data-width="100%" data-numposts="5"></div>


                </div>
            </div>
            <script type="text/javascript">
                $(".tong-quan").click(function() {
                    $('html, body').animate({
                        scrollTop: parseInt($("#tong-quan").offset().top)
                    }, 500);
                });
                $(".thongso").click(function() {
                    $('html, body').animate({
                        scrollTop: parseInt($("#thongso").offset().top)
                    }, 500);
                });
                $(".uu-diem").click(function() {
                    $('html, body').animate({
                        scrollTop: parseInt($("#uu-diem").offset().top)
                    }, 500);
                });
                $(".intro_video").click(function() {
                    $('html, body').animate({
                        scrollTop: parseInt($("#intro_video").offset().top)
                    }, 500);
                });
                $(".comment-f").click(function() {
                    $('html, body').animate({
                        scrollTop: parseInt($("#comment-f").offset().top)
                    }, 500);
                });
            </script>
            <div class="sp-banchay">
                <div class="tit-child">
                    <h2>Sản phẩm bán chạy nhất</h2>
                </div>
                <div class="row">
                    @foreach ($specialProducts as $item)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="sp-dm">
                                <div class="img-sp">
                                    <a href="{{ route('showBySlug', ['slug' => $item->slug . '-' . $item->id]) }}">
                                        <img src="{{ sizeof($item->productImages) ? asset($item->productImages->first()->link) : '' }}"
                                            alt="{{ $item->name }}" class="img-responsive">
                                    </a>
                                </div>
                                <h3><a
                                        href="{{ route('showBySlug', ['slug' => $item->slug . '-' . $item->id]) }}">{{ $item->name }}</a>
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
        </div>
        <script type="text/javascript">
            $(window).on('scroll', function() {
                var scrollTop = $(window).scrollTop(),
                    height = jQuery(window).height();
                header = $('.header').offset().top,
                    cate = $('.bg-cate').offset().top,
                    pro = $('.pr-head1').offset().top,
                    content = $('.content-sp').offset().top,
                    sum = (height + header + cate + pro),
                    finish = (sum + content + content);
                if ($(window).width() > 768) {
                    if (scrollTop > sum && scrollTop < finish) {
                        $(".tab-inf").addClass("fix-tab");
                    } else {
                        $(".tab-inf").removeClass("fix-tab");
                    }
                }
            });
        </script>

        <script type="text/javascript">
            var tabLinks = document.querySelectorAll(".tablinks");

            tabLinks.forEach(function(el) {
                el.addEventListener("click", openTabs);
            });

            function openTabs(el) {
                var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
                var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic

                tabLinks.forEach(function(el) {
                    el.classList.remove("active");
                }); //lặp qua các tab links để remove class active

                btn.classList.add("active");
                // các button mà chúng ta click vào sẽ được add class active
            }
        </script>
        <style type="text/css">
            .nk-modal {
                width: 80%;
                margin: 0 auto;
                padding-top: 40px;
            }

            .nk-modal-content {
                height: auto;
                min-height: 100%;
                border-radius: 0;
            }
        </style>
        <div class="clearfix"></div>
    </div>

    <script type="text/javascript" src="front/javascript/fancybox/dist/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="front/javascript/fancybox/dist/jquery.fancybox.min.css"
        media="screen" />
    </div>
    @include('watch.layout.map')
@stop

</body>


</html>
