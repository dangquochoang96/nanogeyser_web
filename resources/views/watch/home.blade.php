@extends('watch.layout.master')

@section('title', $_setting->title)

@section('description', $_setting->metades)

@section('content')
    <div class="div-slide">
        
        <div class="slider slider-for  owl-carousel">
            {{-- @foreach ($sliders as $slider) --}}
                <div class="item">
                    <a target="_blank" href="{{ $sliders[1]->link }}">
                        <img src="{{ $sliders[1]->image_link }}" class="img-responsive">
                    </a>
                </div>
            {{-- @endforeach --}}
        </div>
    </div>
    <!--Banner trang chu-->
    <!--Danh muc san pham-->
    <div class="cate-bg">
        <div class="cate-h">
            <div class="container">
                <div class="box-cate-h">
                    <p class="tit-cate-h"><a href="/ve-chung-toi" style="color:white">NANO GEYSER</a></p>
                    <p class="des-tit-h">Sau hơn 10 năm có mặt tại Việt Nam, Nano Geyser đã trở thành một trong những thương hiệu
                        hàng đầu tại Việt Nam về các dòng sản phẩm, dịch vụ máy lọc nước gia đình. Nguồn nước đầu ra máy
                        Nano Geyser hoàn toàn tinh khiết <b>ĐẠT CHUẨN QUỐC GIA NƯỚC UỐNG TRỰC TIẾP QCVN 6 - 1: 2010/BYT</b>
                    </p>
                    <ul class="list-cate-h ul-none  owl-carousel owl-theme">
                        <li>
                            <div class="mg-cate">
                                <span class="img-cate-h"><a href="/may-loc-nuoc"><img src="/front/image/may.png"
                                            class="img-responsive" alt=""></a></span>
                                <p class="heading-h2-text"><a href="/may-loc-nuoc">Máy lọc nước</a></p>
                            </div>
                        </li>
                        <li>
                            <div class="mg-cate">
                                <span class="img-cate-h"><a href="/loi-loc-nuoc"><img src="/front/image/loi.png"
                                            class="img-responsive" alt=""></a></span>
                                <p class="heading-h2-text"><a href="/loi-loc-nuoc">Lõi lọc nước</a></p>
                            </div>
                        </li>
                        <li>
                            <div class="mg-cate">
                                <span class="img-cate-h"><a href="/ion-kiem"><img
                                            src="/front/image/ion.png" class="img-responsive"
                                            alt=""></a></span>
                                <p class="heading-h2-text"><a href="/ion-kiem">MÁY ION KIỀM</a></p>
                            </div>
                        </li>
                    </ul>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var owl = $(".list-cate-h");
                            owl.owlCarousel({
                                items: 3,
                                autoPlay: 10000,
                                itemsDesktop: [1199, 3],
                                itemsDesktopSmall: [979, 2],
                                itemsTablet: [768, 2],
                                itemsMobile: [479, 1]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--End Danh muc san pham-->
    
    <!--Giai phap may loc nuoc-->
    <div class="container">
        <div class="sp-nb">
            <div class="title-home">GIẢI PHÁP MÁY LỌC NƯỚC</div>
            <div class="tab-content relative">
                <div id="solutions-tab" class="tab-pane fade in active">
                    <div id="owl-solutions" class="ul-spmoi owl-carousel">
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-nha-dan">
                                    <img src="/front/image/solution6.jpg" class="img-responsive" alt="GIẢI PHÁP Lọc Đầu Nguồn Cho Nhà Dân, Chung Cư, Biệt Thự">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-nha-dan">GIẢI PHÁP Lọc Đầu Nguồn Cho Nhà Dân</a>
                                </h3>
                                <p class="solution-des">GIẢI PHÁP Lọc Đầu Nguồn Cho Nhà Dân, Chung Cư, Biệt Thự</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-phong-bep">
                                    <img src="/front/image/solution5.jpg" class="img-responsive" alt="Giải pháp máy lọc nước công nghiệp">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-phong-bep">GIẢI PHÁP Lọc Phòng Bếp</a>
                                </h3>
                                <p class="solution-des">GIẢI PHÁP Lọc Phòng Bếp</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-phong-khach">
                                    <img src="/front/image/solution4.jpg" class="img-responsive" alt="GIẢI PHÁP Lọc Phòng Khách">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-phong-khach">GIẢI PHÁP Lọc Phòng Khách</a>
                                </h3>
                                <p class="solution-des">GIẢI PHÁP Lọc Phòng Khách</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-cao-cap">
                                    <img src="/front/image/solution3.jpg" class="img-responsive" alt="Giải pháp lọc dành cho khách hàng cao cấp - Máy điện phân Ion Kiềm">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-cao-cap">GIẢI PHÁP lọc Cao Cấp</a>
                                </h3>
                                <p class="solution-des">Giải pháp lọc dành cho khách hàng cao cấp - Máy điện phân Ion Kiềm</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-combo">
                                    <img src="/front/image/solution2.jpg" class="img-responsive" alt="Giải pháp combo dành cho nhà mới">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-combo">GIẢI PHÁP Combo Nhà Mới</a>
                                </h3>
                                <p class="solution-des">Giải pháp combo dành cho nhà mới</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box solution-box">
                                <a class="img-product-h" href="/giai-phap-tll">
                                    <img src="/front/image/solution1.jpg" class="img-responsive" alt="Giải pháp thay lõi lọc cho nhà đã có hệ thống lọc">
                                </a>
                                <h3 class="product-name">
                                    <a href="/giai-phap-tll">GIẢI PHÁP Thay Lõi Lọc</a>
                                </h3>
                                <p class="solution-des">Giải pháp thay lõi lọc cho nhà đã có hệ thống lọc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!--San pham noi bat-->
        <div class="sp-nb">
            <div class="title-home">SẢN PHẨM NỔI BẬT</div>
            <!--<p class="des-tit">Với lịch sử phát triển hơn 30 năm từ năm 1986 tới nay các sản phẩm thương hiệu Nano Geyser đã có-->
            <!--    mặt ở hơn 40 quốc gia trên thế giới. Tại Việt Nam Nano Geyser cung được rất nhiều gia đình tin tưởng sử dụng-->
            <!--    không chỉ bởi độ tương thích của máy lọc nước Nano Geyser với nguồn nước tại Việt Nam, mà còn bởi chất-->
            <!--    lượng, thiết kế nhỏ gọn, tinh tế sang trọng.-->
            <!--</p>-->
            <div class="tab-content relative">
                <div id="tab-1" class="tab-pane fade in active">
                    <div id="owl-demo1" class="ul-spmoi owl-carousel">
                        @foreach ($listProduct1 as $item)
                            <div class="item">
                                <div class="product-box">
                                    <a class="img-product-h"
                                        href="{{ route('showBySlug', ['slug' => $item->slug]) }}"><img
                                            src="{{ sizeof($item->productImages) ? asset($item->productImages->first()->link) : '' }}"
                                            class="img-responsive">
                                        <span class="icon-h">HOT</span>
                                    </a>
                                    <h3 class="product-name">
                                        <a
                                            href="{{ route('showBySlug', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </h3>
                                    @if ($item->sale_price)
                                        <p class="price-km">{{ number_format($item->sale_price, 0, '.', ',') }} đ</p>
                                        <p class="price">{{ number_format($item->price, 0, '.', ',') }} đ</p>
                                    @else
                                        <p class="price-km">{{ number_format($item->price, 0, '.', ',') }} đ</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $("#owl-demo1");
            owl.owlCarousel({
                items: 3,
                autoPlay: 10000,
                pagination: true,
                navigation: false,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1]
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $("#owl-solutions");
            owl.owlCarousel({
                items: 3,
                autoPlay: 10000,
                pagination: true,
                navigation: false,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1]
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $("#owl-demo2");
            owl.owlCarousel({
                items: 2,
                autoPlay: 10000,
                pagination: true,
                navigation: false,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1]
            });
        });
    </script>
    <!--End San noi bat-->
    <!--Tại sao chọn chúng tôi-->
    <div class="gt-banner">
        <div class="container">
            <div class="title-home">VÌ SAO NÊN CHỌN NANO GEYSER</div>
            <p class="des-tit">Tự hào là một trong những đơn vị nhập khẩu, lắp ráp và phân phối máy lọc nước Nano Geyser. Với hơn
                5 năm kinh nghiệm tư vấn, lắp đặt máy lọc nước Nano Geyser cho hàng triệu gia đình Việt. Với những giá trị cốt
                lõi <b> Đổi mới mỗi ngày - Lấy khách hàng làm trung tâm & luôn luôn tận tâm - Cam kết vượt trội</b>
            </p>
            <div class="box-gt">
                <div class="row">
                    <div class="slide-dctc owl-carousel owl-theme">
                        <div class="tab-gt">
                            <img src="../front/image/icon1.png" alt="">
                            <h3>Tư vấn chuẩn mực</h3>
                            <span class="mt-gt">100% các kỹ thuật viên tư vấn được đào tạo bài bản và chuyên nghiệp, chuẩn
                                mực.</span>
                        </div>
                        <div class="tab-gt">
                            <img src="../front/image/icon2.png" alt="">
                            <h3>Uy Tín & chất lượng</h3>
                            <span class="mt-gt">100% sản phẩm bán tại Nano Geyser là sản phẩm chính hãng, nhập khẩu, lắp
                                ráp và phân phối.</span>
                        </div>
                        <div class="tab-gt">
                            <img src="../front/image/icon3.png" alt="">
                            <h3>Tận tâm và chu đáo</h3>
                            <span class="mt-gt">Với giá trị cốt lõi lấy khách hàng làm trung tâm & luôn luôn tận tâm chúng
                                tôi luôn ưu tiên đặt quyền lợi khách hàng lên hàng đầu. </span>
                        </div>
                        <div class="tab-gt">
                            <img src="../front/image/icon4.png" alt="">
                            <h3>Bảo hành bảo trì tốt</h3>
                            <span class="mt-gt mt-4">100% sản phẩm được bảo hành, bảo trì tại nhà theo đúng tiêu chuẩn 5 năm
                                chính hãng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $(".slide-dctc");
            owl.owlCarousel({
                items: 4,
                autoPlay: 10000,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 3],
                itemsTablet: [768, 2],
                itemsMobile: [479, 2]
            });
        });
    </script>
    <!--End Tại sao chọn chúng tôi-->

    <!--Chứng nhận-->
    <div class="container">
        <div class="dm-child dm-ha">
            <div class="tit-child text-center">
                <p style="font-size: 30px">Chứng Nhận</p>
                <a href="{{ route('certification') }}" class="view-dm">Xem tất cả</a>
            </div>
            <div class="cer-slide owl-carousel owl-theme">
                @foreach ($certification as $k => $item)
                    <div class="item news-home">
                        <a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}" class="ha-img"><img src="{{(sizeof($item->certificationImages)) ? asset($item->certificationImages->first()->link) : '' }}" alt="{{$item->name}}" class="img-responsive"><i class="far fa-image"></i></a>
                        <h3 class="text-center"><a href="{{route('certification-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}">{{$item->name}}</a></h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $(".cer-slide");
            owl.owlCarousel({
                items: 4,
                autoPlay: 10000,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [979, 2],
                itemsTablet: [768, 2],
                itemsMobile: [479, 1]
            });
        });
    </script>
    <!--End Chứng nhận-->

    <!--Tin tức + video-->
    <div class="container">
        <!-- <div class="title-home">Tin tức hoạt động</div> -->
        <!-- <p class="des-tit">Chúng tôi tự hào là một trong những đơn vị hàng đầu phân phối máy lọc nước Geyser.</br>
                  Với 5 năm kinh nghiệm tư vấn và lắp đặt máy lọc nước cho hàng ngàn hộ gia đình, chúng tôi tự tin có đủ kinh nghiệm và chuyên môn, sự nhiệt tình khiến quý khách hàng tin tưởng và lựa chọn trong suốt những năm vừa qua
               </p> -->
        <div class="box-news-vd">
            <div class="news-l">
                <div class="tit-1">Tin tức nổi bật</div>
                <div class="news-slide owl-carousel owl-theme">
                    @foreach ($blogs as $item)
                        <div class="item news-home">
                            <a href="{{ route('blog-detail', ['slug' => str_slug($item->name . '-' . $item->id)]) }}"
                                class="img-news"><img src="{{ $item->image }}" alt=""
                                    class="img-responsive"></a>
                            <h3><a
                                    href="{{ route('blog-detail', ['slug' => str_slug($item->name . '-' . $item->id)]) }}">{{ $item->name }}</a>
                            </h3>
                            <!--<p>Trải qua hơn 30 năm phát triển, công nghệ lõi lọc của Aragon trong các sản phẩm của Geyser đã-->
                            <!--    chiếm được lượng khách hàng ở Châu Âu, Mỹ.</p>-->
                            <p>{{$item->shortdes}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    var owl = $(".news-slide");
                    owl.owlCarousel({
                        items: 2,
                        autoPlay: 10000,
                        itemsDesktop: [1199, 2],
                        itemsDesktopSmall: [979, 2],
                        itemsTablet: [768, 2],
                        itemsMobile: [479, 1]
                    });
                });
            </script>
            <div class="video-r">
                <div class="tit-1">video nổi bật</div>
                @foreach ($videos as $k => $item)
                    @if ($k == 0)
                        <div class="big-video">
                            <a href="{{ route('video-detail', ['slug' => str_slug($item->name . '-' . $item->id)]) }}">
                                <img src="{{ $item->image }}" alt="" class="img-responsive">
                                <div class="bg-black"></div>
                                <h3>{{ $item->name }}</h3>
                            </a>
                        </div>
                    @endif
                @endforeach
                <div class="row video-small">
                    @foreach ($videos as $k => $item)
                        @if ($k > 0)
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="list-vdh">
                                    <a
                                        href="{{ route('video-detail', ['slug' => str_slug($item->name . '-' . $item->id)]) }}">
                                        <img src="{{ $item->image }}" alt="" class="img-responsive">
                                        <div class="bg-black"></div>
                                    </a>
                                    <h3><a
                                            href="{{ route('video-detail', ['slug' => str_slug($item->name . '-' . $item->id)]) }}">{{ $item->name }}</a>
                                    </h3>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--End Tin tức + video-->
    <div class="yk">
        <div class="container">
            <div class="title-home">Cảm nhận khách hàng</div>
            <p class="des-tit">Trong sứ mệnh cung cấp sản phẩm đến hàng triệu khách hàng, chúng tôi hân hạnh nhận về những
                đánh giá tốt đẹp từ những khách hàng thân thiết</p>
            <div class="box-yk">
                <div class="yk-slide owl-carousel owl-theme">
                    @foreach ($reviews as $review)
                        <div class="item">
                            <div class="list-yk">
                                <div class="inf-kh"><img src="{{ $review->image }}" alt=""></div>
                                <div class="name-kh">{{ $review->name }}</div>
                                <p class="add-kh">{{ $review->address }}</p>
                                <div class="clear"></div>
                                <p class="nd-kh">{{ $review->des }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            var owl = $(".yk-slide");

            owl.owlCarousel({

                items: 3,

                autoPlay: 10000,

                itemsDesktop: [1199, 3],

                itemsDesktopSmall: [979, 2],

                itemsTablet: [768, 1],

                itemsMobile: [479, 1]



            });

        });
    </script>
    @include('watch.layout.map')
@stop

<!-- <script type="text/javascript">
    $(document).ready(function() {

        $('.left_poup').click(function() {

            var type = $(this).attr('data-type');

            if (type == 'location') {

                $('.left-find-showroom').css('display', 'inline-block');

                $('.left-inf-dat').css('display', 'none');

            } else {

                $('.left-inf-dat').css('display', 'inline-block');

                $('.left-find-showroom').css('display', 'none');

            }

        });

    });
</script> -->
