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
                <a href="{{ URL::action('Admin\CategoryController@listCategory') }}">Danh sách Danh mục</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Sửa</a>
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
                <span class="caption-subject bold uppercase">Sửa ảnh</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{route('popups.update', ['id' => $popup->id])}}" accept-charset="UTF-8"
                  id="add-form"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ảnh<span class="required"> * </span></label>
                                <input type="file" name="image" class="form-control" value="{{ old('image') }}"/>
                                <img src="{{$popup->image_link}}" width="400px">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Link</label>
                                <input type="text" name="link" class="form-control" value="{{ old('link',$popup->link) }}"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mobile</label>
                                <div class="input-group m-t-5 p-b-5">
                                    <div class="icheck-inline">
                                        <label class="control-label font-green" role="button">
                                            <input type="radio" name="type" value="1" class="icheck" data-radio="iradio_minimal-green"{{ $popup->type == 1 ? ' checked' : '' }}/>
                                            website
                                        </label>
                                        <label class="control-label font-red-soft" role="button">
                                            <input type="radio" name="type" value="2" class="icheck"
                                                   data-radio="iradio_minimal-green"{{ $popup->type == 2 ? ' checked' : '' }}/>
                                            mobile
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                    <a href="{{ URL::previous() }}" class="btn red-soft uppercase">Hủy bỏ</a>
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