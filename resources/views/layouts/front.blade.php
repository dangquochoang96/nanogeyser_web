<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="">
      <title>Trang chủ</title>
      <link rel="icon" href="favicon.html" type="image/x-icon">
      <link
         href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700%7CSource+Sans+Pro:300,400,600"
         rel="stylesheet">
      <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/noUiSlider/11.0.3/nouislider.min.css">
      <link href="themes/oitc-theme/assets/css/font-awesome.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/jquery-ui.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/owl.carousel.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/fakeLoader.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/jquery.timepicker.min.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/magnific-popup.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/style.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/responsive-style.css" rel="stylesheet">
      <link href="themes/oitc-theme/assets/css/colors/color-1.css" rel="stylesheet" id="changeColorScheme">
      <link href="themes/oitc-theme/assets/css/custom.css" rel="stylesheet">
      <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
      <link rel="stylesheet" href="themes/oitc-theme/assets/main.css">
      <script>
         window.dataLayer = window.dataLayer || [];
      </script>
      <script async defer>
         $(function () {
             $.subscribe('mall.cart.productAdded', function (e, data) {
                 dataLayer.push({
                     'event': 'addToCart',
                     'ecommerce': {
                         'currencyCode': data.currency.code,
                         'add': {
                             'products': [{
                                 'name': data.item.name,
                                 'id': data.item.id,
                                 'price': data.item.price,
                                 'brand': data.item.brand,
                                 'category': data.item.category,
                                 'variant': data.item.variant,
                                 'quantity': data.quantity
                             }]
                         }
                     }
                 })
             })
             $.subscribe('mall.cart.productRemoved', function (e, data) {
                 dataLayer.push({
                     'event': 'removeFromCart',
                     'ecommerce': {
                         'remove': {
                             'products': [{
                                 'name': data.item.name,
                                 'id': data.item.id,
                                 'price': data.item.price,
                                 'brand': data.item.brand,
                                 'category': data.item.category,
                                 'variant': data.item.variant,
                                 'quantity': data.quantity
                             }]
                         }
                     }
                 })
             })
         })
      </script>
      @yield('head')
   </head>
   <body>
      <div class="preloader bg--color-theme"></div>
      <div class="wrapper">
         <header class="header--section">
            <div class="header--topbar bg--color-dark">
               <div class="container">
                  <ul class="nav links float--left hidden-xxs">
                     <li><a href="#">FAQ</a></li>
                     <li><a href="#">Support</a></li>
                     <li>
                        <a href="en/login.html">
                        Login or signup
                        </a>
                     </li>
                  </ul>
                  <ul class="nav cart float--right">
                     <li>
                        <a href="en/cart.html" class="text-grey flex flex-col items-center justify-center no-underline">
                           <div class="mall-cart-count absolute bg-red text-white text-2xs rounded px-1 leading-normal ml-4 -mt-8 invisible">
                              0
                           </div>
                           <svg class="text-grey fill-current w-6 mb-2" viewBox="0 0 20 20" version="1.1"
                              xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink">
                              <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                 <g id="icon-shape">
                                    <path d="M3,5 L4.33333333,9 L4,9 C2.34314575,9 1,10.3431458 1,12 C1,13.6568542 2.34314575,15 4,15 L17,15 L17,13 L4.00684547,13 C3.45078007,13 3,12.5561352 3,12 C3,11.4477153 3.44748943,11 3.99850233,11 L10.5,11 L17,11 L20,2 L4,2 L4,0.997030139 C4,0.453036308 3.54809015,0 2.9906311,0 L0,0 L0,2 L2,2 L3,5 Z M5,20 C6.1045695,20 7,19.1045695 7,18 C7,16.8954305 6.1045695,16 5,16 C3.8954305,16 3,16.8954305 3,18 C3,19.1045695 3.8954305,20 5,20 Z M15,20 C16.1045695,20 17,19.1045695 17,18 C17,16.8954305 16.1045695,16 15,16 C13.8954305,16 13,16.8954305 13,18 C13,19.1045695 13.8954305,20 15,20 Z"></path>
                                 </g>
                              </g>
                           </svg>
                        </a>
                     </li>
                  </ul>
                  <ul class="nav social float--right">
                     <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                     <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                     <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="#"><i class="fa fa-rss"></i></a></li>
                  </ul>
               </div>
            </div>
            <div class="header--navbar-top">
               <div class="container">
                  <div class="logo float--left">
                     <div class="vc--parent">
                        <div class="vc--child"> <a href="index.html"><img src="themes/oitc-theme/assets/img/logo.png" alt="Oitc.com.vn" data-rjs="2"></a> </div>
                     </div>
                  </div>
                  <div class="float--right">
                     <div class="header--navbar-top-info float--left">
                        <div class="vc--parent">
                           <div class="vc--child">
                              <ul class="nav">
                                 <li>
                                    <div class="icon text--primary"> <i class="fa fa-vcard-o"></i> </div>
                                    <div class="content">
                                       <p><a href="tel:+055997766554412">+84 2439874599</a></p>
                                       <p><a href="#"><span class="__cf_email__">info@oitc.com.vn</span></a></p>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="icon text--primary"> <i class="fa fa-home"></i> </div>
                                    <div class="content">
                                       <p>651 Minh Khai,</p>
                                       <p>Hai Bà Trưng, Hà Nội.</p>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="icon text--primary"> <i class="fa fa-clock-o"></i> </div>
                                    <div class="content">
                                       <p>Mon - Sat (09 am to 08 pm)</p>
                                       <p class="text--primary">(Sunday Closed)</p>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <nav class="header--navbar navbar" data-trigger="sticky">
               <div class="container">
                  <div class="navbar-header"> <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerNav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> </div>
                  <div id="headerNav" class="navbar-collapse collapse float--left">
                     <ul class="header--nav-links nav navbar-nav font--secondary">
                        <li class="
                           active
                           ">
                           <a href="en.html" 
                              data-toggle="" 
                              class="
                              ">
                           Home
                           </a>
                        </li>
                        <li class="
                           ">
                           <a href="en/category/server.html" 
                              data-toggle="" 
                              class="
                              ">
                           Server
                           </a>
                        </li>
                        <span class="text-grey-dark no-underline hover:text-grey-darker">Máy chủ lưu trữ</span>
                        </li>
                        <li class="
                           ">
                           <a href="en/Dich-vu-ky-thuat.html" 
                              data-toggle="" 
                              class="
                              ">
                           Dịch vụ KT
                           </a>
                           <ul class="dropdown-menu font--primary">
                              <li class="
                                 ">
                                 <a href="en/dich-vu-ho-tro-ky-thuat.html" 
                                    data-toggle="" 
                                    class="
                                    ">
                                 Dịch vụ hỗ trợ kỹ thuật
                                 </a>
                              </li>
                              <li class="
                                 ">
                                 <a href="cac-goi-dich-vu-ho-tro-ky.html" 
                                    data-toggle="" 
                                    class="
                                    ">
                                 Các gói dịch vụ hỗ trợ kỹ thuật
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="
                           ">
                           <a href="en/cat/blogs.html" 
                              data-toggle="" 
                              class="
                              ">
                           Blogs
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="header--nav-search dropdown float--right">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a> 
                     <div class="dropdown-menu" data-form-validation="true">
                        <form action="http://sanpham.oitc.com.vn/en/suche" method="get"> <input type="search" name="q" placeholder="I’m Looking For..." class="form-control" required> </form>
                     </div>
                  </div>
               </div>
            </nav>
         </header>
         @yield('content')
         <div class="footer--section bg--color-dark">
            <div class="footer--copyright-border"></div>
            <div class="container bg--overlay">
               <div class="row reset--gutter">
                  <div class="col-md-3 bg--color-theme bg--overlay">
                     <div class="footer--about">
                        <div class="logo"> <img src="themes/oitc-theme/assets/img/logo.png" alt="" data-rjs="2"> </div>
                        <div class="content">
                           <p>Công ty OITC được đánh giá là đơn vị hàng đầu cung cấp giải pháp, dịch vụ công nghệ thông tin cho các Bộ, các Ngân hàng, các công ty Viễn thông và các doanh nghiệp lớn tại Việt nam</p>
                        </div>
                        <div class="info">
                           <ul class="nav">
                              <li class="fa-home">Số 3, Khu du lịch 12, 651 Minh Khai, quận Hai Bà Trưng, Hà Nội</li>
                              <li class="fa-envelope">
                                 <a href="#"><span class="__cf_email__">info@oitc.com.vn</span></a>
                              </li>
                              <li class="fa-phone-square"><a href="#">+84 2439874599</a></li>
                              <li class="fa-clock-o">Monday - Satarday (09 am to 08 pm) <span>(Sunday Closed)</span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="footer--widgets row">
                        <div class="footer--widget col-md-4">
                           <div class="widget--title">
                              <h2 class="h4">Our Website</h2>
                           </div>
                           <div class="links--widget">
                              <ul class="nav">
                                 <li><a href="#"><i class="fa fa-angle-double-right"></i>Home</a></li>
                                 <li><a href="#"><i class="fa fa-angle-double-right"></i>Server</a></li>
                                 <li><a href="#"><i class="fa fa-angle-double-right"></i>Storage</a></li>
                                 <li><a href="#"><i class="fa fa-angle-double-right"></i>Dịch vụ kỹ thuật</a></li>
                                 <li><a href="#"><i class="fa fa-angle-double-right"></i>Blogs</a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="footer--widget col-md-4">
                           <div class="widget--title">
                              <h2 class="h4">Recent Blogs</h2>
                           </div>
                           <div class="recent-posts--widget">
                              <ul class="nav">
                                 <li class="clearfix">
                                    <div class="content">
                                       <h3 class="h6"><a href="en/post/hyper-scale-dc-solution.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Hyper-Scale DC Solution</a></h3>
                                       <p>Aug 06, 2020</p>
                                    </div>
                                 </li>
                                 <li class="clearfix">
                                    <div class="content">
                                       <h3 class="h6"><a href="en/post/supermicro-hang-chuyen-san-xuat-phan-cung-may-chu.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Supermicro-Hãng chuyên sản xuất phần cứng máy chủ</a></h3>
                                       <p>Aug 04, 2020</p>
                                    </div>
                                 </li>
                                 <li class="clearfix">
                                    <div class="content">
                                       <h3 class="h6"><a href="en/post/tai-sao-chon-supermicro.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Tại sao chọn Supermicro</a></h3>
                                       <p>Aug 04, 2020</p>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="footer--widget col-md-4">
                           <div class="widget--title">
                              <h2 class="h4">Nhận tin tức và báo giá</h2>
                           </div>
                           <div class="subscribe--widget" data-form-validation="true">
                              <p>Đăng ký email để nhận báo giá thiết bị và các tin tức công nghệ</p>
                              <form action="https://themelooks.us12.list-manage.com/subscribe/post?u=50e1e21235cbd751ab4c1ebaa&amp;id=ac81d988e4" method="post" name="mc-embedded-subscribe-form" target="_blank">
                                 <div class="input-group"> <input type="email" name="EMAIL" class="form-control" placeholder="E-mail Address" required> <span class="input-group-btn"> <button type="submit" class="btn btn-default active"><i class="fa fa-send"></i></button> </span> </div>
                              </form>
                              <div class="social">
                                 <h3 class="h6">Liên hệ với chúng tôi</h3>
                                 <ul class="nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="footer--copyright font--secondary clearfix">
                        <p class="float--left">&copy; Copyright 2017 | All Rights Reserved</p>
                        <p class="float--right"><a href="#">Quick Fix</a> oitc.com.vn</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <script src="combine/479d7d494737532d8c60ecc53511e024-1595582052"></script>
         <script src="themes/oitc-theme/assets/js/jquery.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery-ui.min.js"></script>
         <script src="themes/oitc-theme/assets/js/bootstrap.min.js"></script>
         <script src="themes/oitc-theme/assets/js/owl.carousel.min.js"></script>
         <script src="themes/oitc-theme/assets/js/isotope.min.js"></script>
         <script src="themes/oitc-theme/assets/js/fakeLoader.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.sticky.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.timepicker.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.magnific-popup.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.directional-hover.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.validate.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.form.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.waypoints.min.js"></script>
         <script src="themes/oitc-theme/assets/js/jquery.counterup.min.js"></script>
         <script src="themes/oitc-theme/assets/js/retina.min.js"></script>
         <script src="themes/oitc-theme/assets/js/main.js"></script>
         <script src="themes/oitc-theme/assets/app.js"></script>
         <script src="modules/system/assets/js/framework.js"></script>
         <script src="modules/system/assets/js/framework.extras.js"></script>
         <link rel="stylesheet" property="stylesheet" href="modules/system/assets/css/framework.extras.css">
         <script src="plugins/offline/mall/assets/pubsub.js"></script>
         <script src="../cdnjs.cloudflare.com/ajax/libs/noUiSlider/11.0.3/nouislider.min.js"></script>
         <script src="plugins/kenshin/facebook/assets/js/chat.js"></script>
         <script>
            $(function () {
                $.subscribe('mall.products.load.start', function () {
                    $('.mall-products').find('.mall-loader').css({opacity: 1, visibility: 'visible'})
                });
            
                $.subscribe('mall.products.load.complete', function () {
                    $.request('productsSelling::onRun', {
                        update: {'productsSelling::entries': '.mall-products'},
                    });
                });
            
                $('body').on('click', '.mall-pagination--products a', function (e) {
                    e.preventDefault()
                    $.publish('mall.products.load.start')
            
                    history.replaceState(null, '', $(this).attr('href'))
                    $.publish('mall.products.load.complete')
            
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                })
            })
         </script>
         <script>
            $(function () {
                var $propertiesForm = $('.mall-products-filter');
                var $body = $('body');
            
                $body.on('click', '.js-mall-filter', function () {
                    var $input = $(this).find('input');
                    $(this).toggleClass('mall-filter__option--selected')
                    $input.prop('checked', ! $input.prop('checked'));
                    $propertiesForm.trigger('submit');
                });
                $body.on('click', '.js-mall-clear-filter', function () {
                    var $parent = $(this).closest('.mall-property');
                    if ($parent.length < 1) {
                        $parent = $(this).closest('.mall-property-group');
                    }
            
                    $parent.find(':input:not([type="checkbox"])').val('');
                    $parent.find('input[type="checkbox"]').prop('checked', false);
                    $parent.find('.mall-filter__option--selected').removeClass('mall-filter__option--selected')
            
                    var slider = $parent.find('.mall-slider-handles')[0]
                    if (slider) {
                        slider.noUiSlider.updateOptions({
                            start: [slider.dataset.min, slider.dataset.max]
                        });
                    }
                    $propertiesForm.trigger('submit');
                });
                $body.on('change', '.js-mall-select-filter', function () {
                    $propertiesForm.trigger('submit');
                });
            
                $propertiesForm.on('submit', function (e) {
                    e.preventDefault();
            
                    $.publish('mall.products.load.start')
                    $(this).request('productsFilterHome::onSetFilter', {
                        loading: $.oc.stripeLoadIndicator,
                        complete: function (response) {
                            $.oc.stripeLoadIndicator.hide()
                            if (response.responseJSON.hasOwnProperty('queryString')) {
                                history.replaceState(null, '', '?' + response.responseJSON.queryString)
                            }
                            $('[data-filter]').hide()
                            if (response.responseJSON.hasOwnProperty('filter')) {
                                for (var filter of Object.keys(response.responseJSON.filter)) {
                                    $('[data-filter="' + filter + '"]').show();
                                }
                            }
                            $.publish('mall.products.load.complete')
                        },
                        error: function () {
                            $.oc.stripeLoadIndicator.hide()
                            $.oc.flashMsg({text: 'Failed to perform search.', class: 'error'})
                            $.publish('mall.products.load.error')
                        }
                    });
                });
            
                $('.mall-slider-handles').each(function () {
                    var el = this;
                    noUiSlider.create(el, {
                        start: [el.dataset.start, el.dataset.end],
                        connect: true,
                        range: {
                            min: [parseFloat(el.dataset.min)],
                            max: [parseFloat(el.dataset.max)]
                        },
                        pips: {
                            mode: 'range',
                            density: 20
                        }
                    }).on('change', function (values) {
                        $('[data-min="' + el.dataset.target + '"]').val(values[0])
                        $('[data-max="' + el.dataset.target + '"]').val(values[1])
                        $propertiesForm.trigger('submit');
                    });
                })
            })
         </script>
         <script>
            $(function () {
                $.subscribe('mall.products.load.start', function () {
                    $('.mall-products').find('.mall-loader').css({opacity: 1, visibility: 'visible'})
                });
            
                $.subscribe('mall.products.load.complete', function () {
                    $.request('productsAll::onRun', {
                        update: {'productsAll::entries': '.mall-products'},
                    });
                });
            
                $('body').on('click', '.mall-pagination--products a', function (e) {
                    e.preventDefault()
                    $.publish('mall.products.load.start')
            
                    history.replaceState(null, '', $(this).attr('href'))
                    $.publish('mall.products.load.complete')
            
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                })
            })
         </script>
         <script>
            window.Mall = window.Mall || {}
            $(function () {
                window.Mall.Modal = $('<div class="mall-modal">')
                window.Mall.Modal.on('click', function(e) {
                    if (e.target.classList.contains('mall-modal')) {
                        window.Mall.Modal.removeClass('mall-modal--visible')
                    }
                })
                window.Mall.Modal.prependTo(document.body)
            })
         </script>
         <script>
            $(function () {
                var baseCount = '0';
                var $count = $('.mall-cart-count');
                $.subscribe('mall.cart.productAdded', function () {
                    $count.removeClass('invisible').text(++ baseCount).show();
                });
                $.subscribe('mall.cart.productRemoved', function () {
                    baseCount --;
                    if (baseCount < 0) baseCount = 0;
                    $count.text(baseCount);
                });
            });
         </script>
         <script>
            $(function () {
                $.subscribe('mall.wishlist.productAdded', function () {
                    $('.mall-wishlist-icon').css('color', 'hsl(1.7, 76.3%, 53.7%)')
                });
            });
         </script>
         <script>
            $(function () {
                var baseCount = '0';
                var $count = $('.mall-cart-count');
                $.subscribe('mall.cart.productAdded', function () {
                    $count.removeClass('invisible').text(++ baseCount).show();
                });
                $.subscribe('mall.cart.productRemoved', function () {
                    baseCount --;
                    if (baseCount < 0) baseCount = 0;
                    $count.text(baseCount);
                });
            });
         </script>     
         
         @yield('script')   
      </div>
      <div class="back-to-top-btn"> <a href="#" class="btn btn-default active"><i class="fa fa-angle-up"></i></a> </div>
   </body>
</html>