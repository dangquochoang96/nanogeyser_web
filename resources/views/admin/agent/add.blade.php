@extends('layouts.admin')
@section('head')
<link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"/>
<style>
.select2-container { width: 100% !important; }
.select2-container .select2-selection--single { height: 34px; border: 1px solid #c2cad8; border-radius: 4px; }
.select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 34px; }
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 32px; }
</style>
@endsection
@section('content')
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
                <a href="{{ URL::action('Admin\AgentController@list') }}">Danh sách đại lý</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Thêm mới</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\AgentController@list') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
<div class="portlet light">
  <div class="portlet-title">
     <div class="caption">
        <span class="caption-subject bold uppercase"> Thêm đại lý mới</span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\AgentController@add') }}" accept-charset="UTF-8" id="add-form">
        @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tên đại lý <span class="required"> * </span></label>
                            <input type="text" name="txt-name" class="form-control" value="{{ old('txt-name') }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Địa chỉ <span class="required"> * </span></label>
                            <input type="text" name="txt-address" class="form-control" value="{{ old('txt-address') }}" placeholder="Nhập địa chỉ có thể tìm trên Google Maps"/>
                            <small class="text-muted">Địa chỉ này sẽ được dùng để tìm kiếm trên Google Maps</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Điện thoại</label>
                            <input type="text" name="txt-phone" class="form-control" value="{{ old('txt-phone') }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tỉnh/Thành phố</label>
                            <select name="txt-province-code" id="province-select" class="form-control">
                                <option value="">-- Chọn tỉnh/thành phố --</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->province_code }}">{{ $province->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Quận/Huyện</label>
                            <select name="txt-district-code" id="district-select" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                                @foreach($locations as $location)
                                <option value="{{ $location->district_code }}" data-province="{{ $location->province_code }}" style="display:none">{{ $location->district_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <div class="input-group m-t-5 p-b-5">
                                <div class="icheck-inline">
                                    <label class="control-label font-green" role="button">
                                        <input type="radio" name="rd-status" value="1" class="icheck" data-radio="iradio_minimal-green" checked />
                                        Kích hoạt
                                    </label>
                                    <label class="control-label font-red-soft" role="button">
                                        <input type="radio" name="rd-status" value="0" class="icheck" data-radio="iradio_minimal-green" />
                                        Khóa
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue uppercase">Lưu</button>
                <a href="{{ URL::action('Admin\AgentController@list') }}" class="btn red-soft uppercase">Hủy bỏ</a>
            </div>
      </form>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    // Initialize Select2 for province
    $('#province-select').select2({
        placeholder: '-- Chọn tỉnh/thành phố --',
        allowClear: true
    });
    
    // Initialize Select2 for district
    $('#district-select').select2({
        placeholder: '-- Chọn quận/huyện --',
        allowClear: true
    });
    
    function filterDistricts(provinceCode) {
        $('#district-select option').each(function() {
            var $opt = $(this);
            var districtProvince = $opt.data('province');
            
            if ($opt.val() === '') {
                $opt.prop('disabled', false);
            } else if (provinceCode !== '' && String(districtProvince) === String(provinceCode)) {
                $opt.prop('disabled', false).show();
            } else {
                $opt.prop('disabled', true).hide();
            }
        });
        // Refresh Select2 to apply changes
        $('#district-select').val('').trigger('change');
    }
    
    $('#province-select').on('change', function() {
        var provinceCode = $(this).val();
        filterDistricts(provinceCode);
    });
    
    // Initial filter
    filterDistricts($('#province-select').val() || '');
});
</script>
@endsection
