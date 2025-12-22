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
                <a href="{{ URL::action('Admin\SettingController@index') }}">Cài đặt chung</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Chỉnh sửa</a>
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
                <span class="caption-subject bold uppercase"> Chỉnh sửa Page </span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{ URL::action('Admin\SettingController@index') }}" accept-charset="UTF-8"
                  id="add-form" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_general" data-toggle="tab">
                                            General </a>
                                    </li>
                                    <li>
                                        <a href="#tab_meta" data-toggle="tab">
                                            Meta </a>
                                    </li>
                                    <li>
                                        <a href="#tab_socical" data-toggle="tab">
                                            Mạng xã hội </a>
                                    </li>
                                </ul>
                                <div class="tab-content no-space">
                                    <div class="tab-pane active" id="tab_general">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="txt-name"
                                                           value="{{ old('txt-name', $setting->name) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Logo</label>
                                                <div class="col-md-10">
                                                    <div>
                                                        <a role="button" data-toggle="modal" data-target="#img-modal">
                                                            <img style="width: 200px;height: auto; max-width: 100%"
                                                                 id="img-img" class="img-thumbnail"
                                                                 src="{{ url('/').$setting->logo }}">
                                                        </a>
                                                    </div>
                                                    <div id="img-modal" class="modal fade" tabindex="-1"
                                                         data-keyboard="false"
                                                         style="margin-top: 5%">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true"></button>
                                                                    <h4 class="modal-title text-uppercase">Chọn ảnh đại
                                                                        diện</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" class="txt-img-type"
                                                                           name="txt-img-type" value="url">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select from
                                                                            files</label>
                                                                        <input type="file" class="form-control nk-image"
                                                                               name="file-img" accept="image/*">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Image URL</label>
                                                                        <input type="text" class="form-control"
                                                                               name="txt-img">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" id="btn-img"
                                                                            class="btn blue text-uppercase">Xác
                                                                        nhận
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Email</label>
                                                <div class="col-md-10">
                                                    <input type="email" class="form-control" name="txt-email"
                                                           value="{{ old('txt-email', $setting->email) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Phone</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="txt-phone"
                                                           value="{{ old('txt-phone', $setting->phone) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Fanpage Facebook</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="txt-fb"
                                                           value="{{ old('txt-fb', $setting->fb) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Header</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control ckeditor"
                                                              name="txt-header">{{ old('txt-header', $setting->header) }}</textarea>
                                                </div>
                                            </div>
                                          <!--   <div class="form-group">
                                                <label class="col-md-2 control-label">Nội dung(Giữa trang chủ)</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control ckeditor" name="txt-middle">{{ old('txt-middle', $setting->middle) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">About us</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control ckeditor"
                                                              name="txt-about_us">{!!  old('txt-about_us', $setting->about_us) !!}</textarea>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Footer</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control ckeditor"
                                                              name="txt-footer">{!!  old('txt-footer', $setting->footer) !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_meta">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Meta Title:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="txt-metatitle" maxlength="100"
                                                           value="{{ old('txt-metatitle', $setting->title) }}">
                                                    <span class="help-block"> max 100 ký tự </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Meta Keywords:</label>
                                                <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8"
                                                          name="txt-keywords" maxlength="1000">
                                                    {{ old('txt-keywords', $setting->keywords) }}
                                                </textarea>
                                                    <span class="help-block"> max 500 ký tự </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Meta Description:</label>
                                                <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8"
                                                          name="txt-metades" maxlength="255">
                                                    {{ old('txt-metades', $setting->metades) }}
                                                </textarea>
                                                    <span class="help-block"> max 255 ký tự </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_socical">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Facebook:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="facebook" maxlength="100"
                                                           value="{{ old('facebook', $setting->facebook) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Youtube:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="youtube" maxlength="100"
                                                           value="{{ old('youtube', $setting->youtube) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Twitter:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="twitter" maxlength="100"
                                                           value="{{ old('twitter', $setting->twitter) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Pinterest:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="pinterest" maxlength="100"
                                                           value="{{ old('pinterest', $setting->pinterest) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Address:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="address" maxlength="100"
                                                           value="{{ old('address', $setting->address) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">SDT CSKH:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="cskh" maxlength="100"
                                                           value="{{ old('cskh', $setting->cskh) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Thời gian mở cửa:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control maxlength-handler"
                                                           name="open_time" maxlength="100"
                                                           value="{{ old('open_time', $setting->open_time) }}">
                                                    <span class="help-block">  </span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-actions">
                    <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                    <a href="{{ URL::action('Admin\SettingController@index') }}" class="btn red-soft uppercase">Hủy
                        bỏ</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('quantri/ckeditor/ckeditor.js') }}"></script>
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
                    rules: {
                        'txt-name': {
                            required: true,
                            minlength: 3
                        },
                        'txt-order': {
                            number: true
                        },
                        'txt-des': {
                            required: true,
                            minlength: 20
                        },
                        'nk-imag': {
                            accept: "image/*"
                        }
                    },
                    messages: {
                        'txt-name': {
                            required: "Tên không được để trống",
                            minlength: "Tên quá ngắn"
                        },
                        'txt-des': {
                            required: "Mô tả không được để trống",
                            minlength: "Mô tả quá ngắn"
                        },
                        'txt-order': {
                            number: "Thứ tự phải là số"
                        },
                        'nk-imag': {
                            accept: "Ảnh đại diện không hợp lệ"
                        }
                    },
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
    </script>
@endsection