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
                <a href="{{ route('product-categories.index') }}">Danh sách Danh mục</a>
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
                <span class="caption-subject bold uppercase">Thêm mới danh mục</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{route('product-categories.store')}}" accept-charset="UTF-8" id="add-form"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên danh mục <span class="required"> * </span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Danh mục cha <span class="required"> * </span></label>
                                <select name="parent_id" class="form-control select2me">
                                    <option value="0">Danh mục gốc</option>
                                    @foreach ($productCategories as $cate)
                                        <option value="{{$cate->id}}">
                                            {{$cate->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ảnh</label>
                                <div>
                                    <a role="button" data-toggle="modal" data-target="#img-modal">
                                        <img style="width: 200px;height: auto; max-width: 100%" id="img-img" class="img-thumbnail">
                                    </a>
                                </div>
                                <div id="img-modal" class="modal fade" tabindex="-1" data-keyboard="false"
                                     style="margin-top: 5%">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                <h4 class="modal-title text-uppercase">Chọn ảnh</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" class="txt-img-type" name="txt-img-type"
                                                       value="url">
                                                <div class="form-group">
                                                    <label class="control-label">Select from files</label>
                                                    <input type="file" class="form-control nk-image" name="file-img" accept="image/*">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Image URL</label>
                                                    <input type="text" class="form-control" name="txt-img">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btn-img" class="btn blue text-uppercase">Xác
                                                    nhận
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Seo URL</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Thứ tự</label>
                                <input type="text" name="order" class="form-control" value="{{ !old('order') ? '0' : '' }}"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mô tả ngắn</label>
                                <textarea class="form-control ckeditor" name="description">
                                    {{ old('description') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description">
                                {{ old('meta_description') }}
                            </textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">keywords</label>
                                <input type="text" name="keyword" class="form-control" value="{{ old('keyword') }}"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Trạng thái</label>
                                <div class="input-group m-t-5 p-b-5">
                                    <div class="icheck-inline">
                                        <label class="control-label font-green" role="button">
                                            <input type="radio" name="status" value="1" class="icheck"
                                                   data-radio="iradio_minimal-green" checked/>
                                            Kích hoạt
                                        </label>
                                        <label class="control-label font-red-soft" role="button">
                                            <input type="radio" name="status" value="2" class="icheck"
                                                   data-radio="iradio_minimal-green"/>
                                            Khóa
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label">Hiển thị trang chủ</label>
                                <div class="input-group m-t-5 p-b-5">
                                    <div class="icheck-inline">
                                        <label class="control-label font-green" role="button">
                                            <input type="radio" name="status" value="1" class="icheck"
                                                   data-radio="iradio_minimal-green" />
                                            Yes
                                        </label>
                                        <label class="control-label font-red-soft" role="button">
                                            <input type="radio" name="status" value="0" class="icheck"
                                                   data-radio="iradio_minimal-green" checked/>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                    <a href="{{ route('product-categories.index') }}" class="btn red-soft uppercase">Hủy
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
                        'name': {
                            required: true,
                            minlength: 3
                        },
                        'order': {
                            number: true
                        }
                    },
                    messages: {
                        'name': {
                            required: "Họ và tên không được để trống",
                            minlength: "Họ và tên quá ngắn"
                        },
                        'order': {
                            number: "Thứ tự phải là số"
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