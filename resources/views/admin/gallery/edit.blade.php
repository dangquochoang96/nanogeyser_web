@extends('layouts.admin')
@section('head')
    <link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
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
                <a href="{{ route('gallerys.index') }}">Danh sách thư viện ảnh</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">sửa thư viện ảnh</a>
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
                <span class="caption-subject bold uppercase">Sửa thư viện ảnh</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{route('gallerys.update', ['id' => $gallery->id])}}" accept-charset="UTF-8" id="add-form" enctype="multipart/form-data">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_general" data-toggle="tab" aria-expanded="true">
                            Thông tin chung
                        </a>
                    </li>
                    <li>
                        <a href="#tab_images" data-toggle="tab" aria-expanded="false">
                            Ảnh thư viện
                        </a>
                    </li>
                </ul>
                <div class="tab-content no-space">
                    <div class="tab-pane active" id="tab_general">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên thư viện ảnh<span
                                                    class="required"> * </span></label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $gallery->name }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Trạng thái</label>
                                        <div class="input-group m-t-5 p-b-5">
                                            <div class="icheck-inline">
                                                <label class="control-label font-green" role="button">
                                                    <input type="radio" name="status" value="1" class="icheck"
                                                           data-radio="iradio_minimal-green"{{ $gallery->status == 1 ? ' checked' : ''}}/>
                                                    Kích hoạt
                                                </label>
                                                <label class="control-label font-red-soft" role="button">
                                                    <input type="radio" name="status" value="2" class="icheck"
                                                           data-radio="iradio_minimal-green"{{ $gallery->status == 2 ? ' checked' : ''}}/>
                                                    Khóa
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Seo URL</label>
                                        <input type="text" name="slug" class="form-control" value="{{ $gallery->slug }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Meta</label>
                                        <input type="text" name="meta" class="form-control" value="{{ $gallery->meta }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">keywords</label>
                                        <input type="text" name="keyword" class="form-control" value="{{ $gallery->keyword }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mô tả</label>
                                        <textarea class="form-control ckeditor" name="description">{{ $gallery->description }}</textarea>
                                    </div>
                                    <input type="hidden" value="{}" name="data-images" id="data-images"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_images">
                        <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10"
                             style="position: relative;">
                            <label for="input-upload-image" class="btn yellow"></span>
                                <i class="fa fa-plus"></i> Select Files </label>
                            <input type="file" style="display: none" name="my-image-upload" id="input-upload-image"
                                   multiple accept="image/png, image/jpeg">
                        </div>
                        <div class="row">
                            <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"></div>
                        </div>
                        <table class="table table-bordered table-hover" id="table-image">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="8%">
                                    Image
                                </th>
                                <th width="25%">
                                    Label
                                </th>
                                <th width="8%">
                                    Sort Order
                                </th>
                                <th width="10%">
                                    Ảnh đại diện
                                </th>
                                <th width="10%">
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                        <a href="{{ route('gallerys.index') }}"
                           class="btn red-soft uppercase">Hủy
                            bỏ</a>
                    </div>
                </div>
            </div>
        </form>

        </div>
    </div>

    @include('admin.myVendor.uploadImage')
@endsection

@section('script')
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('quantri/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/my.js') }}"></script>
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
                    rules: {
                        'name': {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        'name': {
                            required: "Tên không được để trống",
                            minlength: "Tên quá ngắn"
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

        @php
            $list = [];
        foreach ($gallery->galleryImages as $value) {
            $list[] = $value->link;
        }
        @endphp
        GalleryUpload.init({
            idUpload: '#input-upload-image',
            idTable: '#table-image',
            idTarget: '#data-images',
            uploadSuccessData: {!! $gallery->galleryImages !!}
        });
    </script>
@endsection