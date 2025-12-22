<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Quản trị | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('quantri/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{ asset('quantri/theme/assets/admin/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('quantri/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.css') }}"/>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('quantri/theme/assets/global/plugins/select2/select2.css') }}"/> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('quantri/select2/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('quantri/theme/assets/global/plugins/jquery-multi-select/css/multi-select.css') }}"/>
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('quantri/theme/assets/global/css/components-md.css') }}" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/global/css/plugins-md.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('quantri/theme/assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet"
          type="text/css" id="style_color"/>
    <link href="{{ asset('quantri/theme/assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
@yield('head')
<!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="/public/uploads/images/2021/04/16/21618588745-logo.png"" alt="logo"
                     class="logo-default"/ style="width: 150px; margin: 0px 0 0 0;">
            </a>
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar3_small.jpg"/>
                        <span class="username username-hide-on-mobile">
					{{ Auth::user()->email}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                       <!--  <li>
                            <a href="extra_profile.html">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li class="divider">
                        </li> -->
                        <li>
                            <a href="/logout">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                   <!--  <form class="sidebar-search " action="extra_search.html" method="POST">
                        <a href="javascript:;" class="remove">
                            <i class="icon-close"></i>
                        </a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
                        </div>
                    </form> -->
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="nav-item {{ Request::is('quan-tri') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\IndexController@index') }}" role="button"
                       class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/product*') ? 'active open' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-handbag"></i>
                        <span class="title">Sản phẩm</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('product-categories.index') }}">
                                Danh mục</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}">
                                Sản phẩm</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/bo-loc') ? 'active open' : '' }}">
                    <a href="{{ route('product-filter.index') }}" role="button"
                       class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Bộ lọc</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/blog*') ? 'active open' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-pencil"></i>
                        <span class="title">Blog</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ URL::action('Admin\BlogController@listBlogs') }}">
                                Bài viết</a>
                        </li>
                        <li class="active">
                            <a href="{{ URL::action('Admin\BlogCategoryController@listCategory') }}">
                                Danh mục</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/page*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\PageController@listPage') }}" role="button"
                       class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">Pages</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/orders*') ? 'active open' : '' }}">
                    <a href="{{ route('orders.index') }}" role="button"
                       class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                        <span class="title">Đơn đặt hàng</span>
                    </a>
                </li>
                 <li class="nav-item {{ Request::is('quan-tri/contact*') ? 'active open' : '' }}">
                    <a href="{{ route('contact.index') }}" role="button"
                       class="nav-link nav-toggle">
                                <i class="icon-bulb"></i>
                        <span class="title">Liên hệ</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/nguoi-dung*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\UserController@listUsers') }}" role="button"
                       class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Người dùng</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/danh-muc*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\MenuController@listMenu') }}" role="button"
                       class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">Menu</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/video*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\VideoController@listVideo') }}" role="button" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">Video</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/gallery*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\GalleryController@index') }}" role="button" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">Gallery</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/certification*') ? 'active open' : '' }}">
                    <a href="{{ URL::action('Admin\CertificationController@index') }}" role="button" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">Chứng Nhận</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('quan-tri/cai-dat*') ? 'active open' : '' }}">
                    <a href="javascript:;">
                        <i class="icon-wrench"></i>
                        <span class="title">Settings</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ URL::action('Admin\SettingController@index') }}">
                                Cài đặt chung</a>
                        </li>
                        <li>
                            <a href="{{ route('sliders.index') }}">
                                Slider</a>
                        </li>
                        <li>
                            <a href="{{ URL::action('Admin\ReviewController@list') }}">
                                Cảm nhận khách hàng</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('popups.index') }}">
                                <i class="icon-settings"></i>
                                Popup</a>
                        </li> -->
                    </ul>
                </li>
                <!-- BEGIN ANGULARJS LINK -->
                <!-- <li class="tooltips" data-container="body" data-placement="right" data-html="true"
                    data-original-title="AngularJS version demo">
                    <a href="angularjs" target="_blank">
                        <i class="icon-paper-plane"></i>
                        <span class="title">
					AngularJS Version </span>
                    </a>
                </li> -->
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN STYLE CUSTOMIZER -->
            <div class="theme-panel hidden-xs hidden-sm">
                <div class="toggler">
                </div>
                <div class="toggler-close">
                </div>
                <div class="theme-options">
                    <div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
                        <ul>
                            <li class="color-default current tooltips" data-style="default" data-container="body"
                                data-original-title="Default">
                            </li>
                            <li class="color-darkblue tooltips" data-style="darkblue" data-container="body"
                                data-original-title="Dark Blue">
                            </li>
                            <li class="color-blue tooltips" data-style="blue" data-container="body"
                                data-original-title="Blue">
                            </li>
                            <li class="color-grey tooltips" data-style="grey" data-container="body"
                                data-original-title="Grey">
                            </li>
                            <li class="color-light tooltips" data-style="light" data-container="body"
                                data-original-title="Light">
                            </li>
                            <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true"
                                data-original-title="Light 2">
                            </li>
                        </ul>
                    </div>
                    <div class="theme-option">
						<span>
						Layout </span>
                        <select class="layout-option form-control input-sm">
                            <option value="fluid" selected="selected">Fluid</option>
                            <option value="boxed">Boxed</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Header </span>
                        <select class="page-header-option form-control input-sm">
                            <option value="fixed" selected="selected">Fixed</option>
                            <option value="default">Default</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Top Menu Dropdown</span>
                        <select class="page-header-top-dropdown-style-option form-control input-sm">
                            <option value="light" selected="selected">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Sidebar Mode</span>
                        <select class="sidebar-option form-control input-sm">
                            <option value="fixed">Fixed</option>
                            <option value="default" selected="selected">Default</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Sidebar Menu </span>
                        <select class="sidebar-menu-option form-control input-sm">
                            <option value="accordion" selected="selected">Accordion</option>
                            <option value="hover">Hover</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Sidebar Style </span>
                        <select class="sidebar-style-option form-control input-sm">
                            <option value="default" selected="selected">Default</option>
                            <option value="light">Light</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Sidebar Position </span>
                        <select class="sidebar-pos-option form-control input-sm">
                            <option value="left" selected="selected">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="theme-option">
						<span>
						Footer </span>
                        <select class="page-footer-option form-control input-sm">
                            <option value="fixed">Fixed</option>
                            <option value="default" selected="selected">Default</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS -->
            @yield('content')
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
    <div class="page-quick-sidebar-wrapper">
        <div class="page-quick-sidebar">
            <div class="nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#quick_sidebar_tab_1" data-toggle="tab">
                            Users <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                    <li>
                        <a href="#quick_sidebar_tab_2" data-toggle="tab">
                            Alerts <span class="badge badge-success">7</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            More<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-bell"></i> Alerts </a>
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-info"></i> Notifications </a>
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-speech"></i> Activities </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-settings"></i> Settings </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        {{date('Y')}} © NK
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/uniform/jquery.uniform.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('quantri/theme/assets/global/plugins/flot/jquery.flot.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/flot/jquery.flot.resize.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/flot/jquery.flot.categories.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"
        type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="{{ asset('quantri/theme/assets/global/plugins/fullcalendar/fullcalendar.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/global/plugins/jquery.sparkline.min.js') }}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript"
        src="{{ asset('quantri/theme/assets/global/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('quantri/theme/assets/global/plugins/select2/select2.min.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('quantri/select2/select2.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
<script type="text/javascript"
        src="{{ asset('quantri/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('quantri/theme/assets/admin/pages/scripts/components-dropdowns.js') }}"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('quantri/theme/assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/admin/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/admin/pages/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/theme/assets/admin/pages/scripts/tasks.js') }}" type="text/javascript"></script>
<script src="{{ asset('quantri/script.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Index.init();
        Index.initDashboardDaterange();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        Tasks.initDashboardWidget();
    });
</script>
@yield('script')
<script>
    Laravel = {
        base: '{{url('/')}}',
        token: '{{csrf_token()}}'
    };

</script>
@if(Session::has('error'))
    <script type="text/javascript">

        jQuery(document).ready(function () {
            $('#alerts').html('{!! Session::get("error") !!}');
            $('#alerts').css('display', 'block');
            $('#alerts').removeClass('note-success').addClass('note-danger');
        });</script>
@elseif(Session::has('success'))
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('#alerts').html('{!! Session::get("success") !!}');
            $('#alerts').css('display', 'block');
            $('#alerts').removeClass('note-danger').addClass('note-success');

        });
    </script>
@endif
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
