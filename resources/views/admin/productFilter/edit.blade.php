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
                <a href="{{ route('product-filter.index') }}">Danh sách bộ lọc</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">sửa bộ lọc</a>
            </li>
        </ul>
        <a href="{{ route('product-filter.index') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div id="alerts" class="note" style="display: none;"></div>
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold uppercase">Sửa bộ lọc</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{route('product-filter.update', ['id' => $productFilter->id])}}"
                  accept-charset="UTF-8" id="add-form"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên bộ lọc <span class="required"> * </span></label>
                                <input type="text" name="name" class="form-control" value="{{ $productFilter->name }}"/>
                            </div>
                             <div class="form-group">
                                <label class="control-label">Thứ tự hiển thị</label>
                                <input type="text" name="order" class="form-control" value="{{ $productFilter->order }}"/>
                            </div>    
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Giá trị</label>
                            </div>
                            <table class="table table-bordered table-hover" id="table-image">
                               <thead>
                                  <tr role="row" class="heading">
                                     <th width="50%">
                                        Tên
                                     </th>
                                     <th width="50%">
                                        Thứ tự
                                     </th>
                                     <th width="10%">
                                     </th>
                                  </tr>
                               </thead>
                               <tbody>
                                @if(isset($productFilter->getValues))
                                    @foreach ($productFilter->getValues as $key => $value)
                                      <tr class="item-filter-{{$key}}">
                                        <td>
                                            <input name="att[{{$key}}][]" type="text" class="form-control" value="{{$value->name}}">
                                        </td>
                                        <td>
                                            <input name="att[{{$key}}][]" type="number" class="form-control" value="{{$value->order}}">
                                        </td>
                                         <td>
                                            <a onclick="removeFilter({{$key}})" class="btn default btn-sm">
                                                <i class="fa fa-times"></i> Remove 
                                            </a>
                                         </td>
                                      </tr>
                                    @endforeach
                                    <?php $k = (count($productFilter->getValues) > 0) ? count($productFilter->getValues) : 1; ?>
                                @else
                                    <tr class="item-filter-0">
                                        <td>
                                            <input name="att[0][]" type="text" class="form-control" value="">
                                        </td>
                                         <td>
                                            <a onclick="removeFilter(0)" class="btn default btn-sm">
                                                <i class="fa fa-times"></i> Remove 
                                            </a>
                                         </td>
                                    </tr>
                                    <?php $k = 1; ?>
                                @endif
                               </tbody>
                               <tfoot>
                                  <tr>
                                    <td></td>
                                    <td>
                                        <a onclick="addFilter()" class="btn default btn-sm">
                                            <i class="fa fa-plus"></i> Thêm giá trị
                                        </a>
                                    </td>
                                  </tr>
                              </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                    <a href="{{ route('product-filter.index') }}" class="btn red-soft uppercase">Hủy
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
        var id = {{$k}};
        function addFilter(){
            id++;
            var stringTable = '';
            stringTable += '<tr class="item-filter-'+id+'">' +
                '<td>' +
                '<input name="att['+id+'][]" type="text" class="form-control" value="">' +
                '</td>' +
                '<td>' +
                '<input name="att['+id+'][]" type="number" class="form-control" value="">' +
                '</td>' +
                ' <td>' +
                '<a onclick="removeFilter(' + id + ')" class="btn default btn-sm">' +
                '<i class="fa fa-times"></i> Remove </a>' +
                '</td>' +
                '</tr>';
                $('#table-image tbody').append(stringTable)
        }
        function removeFilter(id){
            $(".item-filter-"+id).remove();
        }
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