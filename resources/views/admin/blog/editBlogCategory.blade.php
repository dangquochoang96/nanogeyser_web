@extends('layouts.admin')
@section('head')
<link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
    Dashboard <small>reports & statistics</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ URL::action('Admin\IndexController@index') }}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ URL::action('Admin\BlogCategoryController@listCategory') }}">Danh sách Danh mục Blog</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Chỉnh sửa danh mục</a>
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
        <span class="caption-subject bold uppercase"> Chỉnh sửa danh mục: {{$cate->name}} </span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\BlogCategoryController@editCategory',['id' => $cate->id]) }}" accept-charset="UTF-8" id="add-form" enctype="multipart/form-data">
        @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="control-label">Tên danh mục <span class="required"> * </span></label>
                            <input type="text" name="txt-name" class="form-control" value="{{$cate->name}}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Danh mục cha <span class="required"> * </span></label>
                            <select name="sl-parent"  class="form-control select2me">
                                <option value="0" @if ($cate->parent_id == 0)  selected @endif>Chọn Danh mục</option>
                                @foreach ($category as $cate2)
                                <option value="{{$cate2->id}}" @if ($cate->parent_id == $cate2->id)  selected @endif>
                                    {{$cate2->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Thứ tự</label>
                            <input type="text" name="txt-order" class="form-control" value="{{$cate->order}}"/>
                        </div>
                    </div>
                    <div class="col-md-5">
                         <div class="form-group">
                            <label class="control-label">keywords</label>
                            <input type="text" name="txt-keyword" class="form-control" value="{{$cate->keywords}}"/>
                        </div>
                         <div class="form-group">
                            <label class="control-label">Meta description</label>
                            <textarea name="txt-metades" class="form-control">
                                {{$cate->metades}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <div class="input-group m-t-5 p-b-5">
                                <div class="icheck-inline">
                                    <label class="control-label font-green" role="button">
                                        <input type="radio" name="rd-status" value="1" class="icheck" data-radio="iradio_minimal-green" @if ($cate->status == 1)  checked @endif/>
                                        Kích hoạt
                                    </label>
                                    <label class="control-label font-red-soft" role="button">
                                        <input type="radio" name="rd-status" value="2" class="icheck" data-radio="iradio_minimal-green" @if ($cate->status == 2)  checked @endif />
                                        Khóa
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                <a href="{{ URL::action('Admin\BlogCategoryController@listCategory') }}" class="btn red-soft uppercase">Hủy bỏ</a>
            </div>
            </form>
  </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
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
                        }
                    },
                    messages: {
                        'txt-name': {
                            required: "Họ và tên không được để trống",
                            minlength: "Họ và tên quá ngắn"
                        },
                        'txt-order': {
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