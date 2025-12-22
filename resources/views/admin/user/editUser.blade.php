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
				<a href="{{ URL::action('Admin\UserController@listUsers') }}">Danh sách người dùng</a>
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
        <span class="caption-subject bold uppercase"> Danh sách người quản trị </span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\UserController@editUser', ['user_id' => $user->id]) }}" accept-charset="UTF-8" id="user-form" enctype="multipart/form-data">
      	@csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="control-label">Họ và tên <span class="required"> * </span></label>
                            <input type="text" name="txt-username" class="form-control" value="{{ $user->username }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email <span class="required"> * </span></label>
                            <input type="text" name="txt-email" class="form-control" value="{{ $user->email }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mật khẩu</label>
                            <input type="text" name="txt-password" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="control-label">Giới tính</label>
                            <div class="input-group m-t-5" style="padding-bottom: 3px;">
                                <div class="icheck-inline">
                                    <label class="control-label" role="button">
                                        <input type="radio" name="rd-gender" value="1" class="icheck"
                                               data-radio="iradio_minimal-green" {{ $user->sex == 1 ? 'checked' : '' }} />
                                        Nam
                                    </label>
                                    <label class="control-label" role="button">
                                        <input type="radio" name="rd-gender" value="2" class="icheck"
                                               data-radio="iradio_minimal-green" {{ $user->sex == 2 ? 'checked' : '' }} />
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <div class="input-group m-t-5 p-b-5">
                                <div class="icheck-inline">
                                    <label class="control-label font-green" role="button">
                                        <input type="radio" name="rd-status" value="1" class="icheck"
                                               data-radio="iradio_minimal-green" {{ $user->status == 1 ? 'checked' : '' }} />
                                        Kích hoạt
                                    </label>
                                    <label class="control-label font-red-soft" role="button">
                                        <input type="radio" name="rd-status" value="2" class="icheck"
                                               data-radio="iradio_minimal-green" {{ $user->status == 2 ? 'checked' : '' }} />
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
                <a href="{{ URL::action('Admin\UserController@listUsers') }}" class="btn red-soft uppercase">Hủy bỏ</a>
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
        var User = function () {
            var handleValidate = function () {
                var form = $('#user-form');
                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        'txt-username': {
                            required: true,
                            minlength: 3
                        },
                        'txt-email': {
                            required: true,
                            email: true
                        },
                        'txt-password': {
                            minlength: 6
                        }
                    },
                    messages: {
                        'txt-username': {
                            required: "Họ và tên không được để trống",
                            minlength: "Họ và tên quá ngắn"
                        },
                        'txt-email': {
                            required: "Email không được để trống",
                            email: "Định dạng email không hợp lệ"
                        },
                        'txt-password': {
                            minlength: "Mật khẩu phải lớn hơn 6 ký tự"
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
            User.init();
        });
    </script>
@endsection