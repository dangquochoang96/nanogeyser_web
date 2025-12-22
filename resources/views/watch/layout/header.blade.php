<!--Header-->
<div class="header">
    <div class="top-head">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-7">
                    <div class="logo">
                        <h1 class="hide"></h1>
                        <a href="{{ url('/') }}"><img src="{!! $_setting->logo !!}" class="img-responsive" /></a>
                    </div>
                </div>

                <div class="col-md-9 col-sm-8 col-xs-5 head-right">
                    <div class="menu-mobile hide-dt"><i class="fa fa-bars"></i></div>
                    <a href="{{ route('gio-hang') }}" class="cart">Giỏ hàng
                        <?php
                        $count_cart = 0;
                        if (isset($_SESSION['cart'])) {
                            $tmp = json_decode($_SESSION['cart'], true);
                            foreach ($tmp as $key => $value) {
                                $count_cart += $value;
                            }
                        }
                        ?>
                        <span class="number_cart" data-total="{{ $count_cart }}">
                            ({{ $count_cart }})
                        </span>
                    </a>
                    <a href="tell:{!! $_setting->phone !!}" class="hotline-top">Hotline:
                        <span>{!! $_setting->phone !!}</span></a>
                    <div class="box-search">
                        <i class="fa fa-search icon-search" aria-hidden="true"></i>
                        <div class="search" id="search">
                            <form method="get" id="idf" action="/search">
                                <input class="top_input" type="text" placeholder="Tìm theo mã sản phẩm..."
                                    name="search" value="{{ isset($key_serch) ? $key_serch : '' }}" />
                                <button class="nut_searh" onclick=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <span class="close-menu hide-dt"><i class="fas fa-times"></i></span>
        <div class="hide-menu"></div>
        <div class="container menu-mb1">
            {!! showMenu($_menu) !!}
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php

function showMenu($menu, $parentId = 0, $level = 0)
{
    $string = '';
    foreach ($menu as $item) {
        if ($item->parent_id == $parentId) {
            // Kiểm tra xem menu item này có con không
            $hasChildren = false;
            foreach ($menu as $child) {
                if ($child->parent_id == $item->id) {
                    $hasChildren = true;
                    break;
                }
            }
            
            if ($level == 0 && $hasChildren) {
                // Nếu là menu cấp 1 và có con, không đặt href
                $string .= '<li class="menu-lv1 has-children"><p><a title="' . $item->name . '" href="javascript:void(0);" class="parent-link">' . $item->name . '</a></p>' . showMenu($menu, $item->id, $level + 1) . '</li>';
            } else {
                // Các trường hợp khác giữ nguyên
                $string .= '<li class="menu-lv1"><p><a title="' . $item->name . '" href="' . $item->url . '">' . $item->name . '</a></p>' . showMenu($menu, $item->id, $level + 1) . '</li>';
            }
        }
    }

    if ($string != '') {
        if ($level == 0) {
            $string = '<ul class="ul-menu ul-none">' . $string . '</ul>';
        } else {
            $string = '<ul class="ul-none">' . $string . '</ul>';
        }
    }
    return $string;
} ?>

<script type="text/javascript">
    $(document).ready(function() {
        var owl = $("#owl-vdmenu");
        owl.owlCarousel({
            items: 4,
            itemsCustom: false,
            autoPlay: 5000,
            pagination: false,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 3],
            itemsTablet: [768, 2],
            itemsMobile: [479, 2]
        });
        // Custom Navigation Events
        $(".next-vd").click(function() {
            owl.trigger('owl.next');
        })
        $(".prev-vd").click(function() {
            owl.trigger('owl.prev');
        })
    });
    if (jQuery().fancybox) {
        $(".various").fancybox({
            'transitionIn': 'none',
            'transitionOut': 'none'
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".menu-mobile").click(function() {
            $(".menu").toggle(300);
        });
        $(".close-menu").click(function() {
            $(".menu").hide(300);
        });
        $(".hide-menu").click(function() {
            $(".menu").hide(300);
        });
        
        // Xử lý click menu cha có con
        $('.parent-link').click(function(e) {
            e.preventDefault();
            e.stopPropagation(); // Ngăn chặn sự kiện lan truyền
            
            // Kiểm tra nếu đang ở chế độ mobile
            var isMobile = $(window).width() <= 991;
            
            if (isMobile) {
                // Trên mobile, toggle class active để hiển thị/ẩn menu con
                $(this).closest('li').toggleClass('active');
            } else {
                // Trên desktop, đóng tất cả các menu con khác và toggle menu hiện tại
                $('.has-children').not($(this).closest('li')).removeClass('active');
                $(this).closest('li').toggleClass('active');
            }
        });
        
        // Đóng menu con khi click bên ngoài
        $(document).click(function(e) {
            // Chỉ áp dụng trên desktop
            if ($(window).width() > 991) {
                if (!$(e.target).closest('.has-children').length) {
                    $('.has-children').removeClass('active');
                }
            }
        });
        
        // Ngăn chặn đóng menu khi click vào menu con
        $('.has-children > ul').click(function(e) {
            e.stopPropagation();
        });
        
        // Đóng tất cả menu con khi đóng menu mobile
        $(".close-menu, .hide-menu").click(function() {
            $('.has-children').removeClass('active');
        });
    });
</script>
