@extends('layouts.admin')
@section('head')
    <link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Dashboard
        <small>reports & statistics</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ URL::action('Admin\IndexController@index') }}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{route('brands.index') }}">Thương hiệu</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Thêm mới</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\IndexController@index') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div id="alerts" class="note" style="display: none;"></div>
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold uppercase">Thêm mới thương hiệu</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{route('brands.store')}}" accept-charset="UTF-8" id="add-form"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ảnh<span class="required"> * </span></label>
                                <input type="file" name="image" class="form-control" value="{{ old('image') }}"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên<span class="required"> * </span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Link<span class="required"> * </span></label>
                                <input type="text" name="link" class="form-control" value="{{ old('link') }}"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Order<span class="required"> * </span></label>
                                <input type="text" name="order" class="form-control" value="{{ old('order') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                    <a href="{{ URL::previous() }}" class="btn red-soft uppercase">Hủy
                        bỏ</a>
                </div>
            </form>
        </div>
    </div>
    @include('admin.myVendor.uploadImage')
@endsection

@section('script')
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('quantri/theme/assets/global/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('js/my.js') }}"></script>
    <link href="{{asset('css/my.css')}}" rel="stylesheet" type="text/css"/>
    <script>

        $.validator.addMethod("regex", function (value, element, regexpr) {
            return regexpr.test(value);
        }, "Số điện thoại không hợp lệ");
        var Form_validate = function () {
            var handleValidate = function () {
                var form = $('#add-form');
                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {},
                    messages: {},
                    invalidHandler: function (event, validator) {
                    },
                    errorPlacement: function (error, element) {
                        $(element).closest('.form-group').append(error);
                    },
                    highlight: function (element) {
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    success: function (label) {
                        label.closest('.form-group').removeClass('has-error');
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
                form.find('input[class!="tt-input"]').keypress(function (e) {
                    if (e.which === 13) {
                        if (form.validate().form()) {
                            form.submit();
                        }
                        return false;
                    }
                });
            };
            return {
                init: function () {
                    handleValidate();
                }
            };
        }();
        jQuery(document).ready(function () {
            Form_validate.init();
        });

        MyUpload.init({
            listImages: [],
            divImage: $('#ImageDiv')
        });

    </script>
@endsection