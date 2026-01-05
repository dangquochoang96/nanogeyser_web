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
                <a href="#">Sửa đại lý</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\AgentController@list') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
<div class="portlet light">
  <div class="portlet-title">
     <div class="caption">
        <span class="caption-subject bold uppercase">{{ $title ?? 'Sửa đại lý' }}</span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\AgentController@edit', ['id' => $dealer->id]) }}" accept-charset="UTF-8" id="edit-form">
        @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tên đại lý <span class="required"> * </span></label>
                            <input type="text" name="txt-name" class="form-control" value="{{ old('txt-name', $dealer->name) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Địa chỉ <span class="required"> * </span></label>
                            <input type="text" name="txt-address" class="form-control" value="{{ old('txt-address', $dealer->address) }}" placeholder="Nhập địa chỉ có thể tìm trên Google Maps"/>
                            <small class="text-muted">Địa chỉ này sẽ được dùng để tìm kiếm trên Google Maps</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Điện thoại</label>
                            <input type="text" name="txt-phone" class="form-control" value="{{ old('txt-phone', $dealer->phone) }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tỉnh/Thành phố</label>
                            <select name="txt-province-code" id="province-select" class="form-control">
                                <option value="">-- Chọn tỉnh/thành phố --</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->province_code }}" {{ $dealer->province_code == $province->province_code ? 'selected' : '' }}>{{ $province->province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Quận/Huyện</label>
                            <select name="txt-district-code" id="district-select" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                                @foreach($locations as $location)
                                <option value="{{ $location->district_code }}" data-province="{{ $location->province_code }}" {{ $dealer->district_code == $location->district_code ? 'selected' : '' }} style="{{ $dealer->province_code != $location->province_code ? 'display:none' : '' }}">{{ $location->district_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <div class="input-group m-t-5 p-b-5">
                                <div class="icheck-inline">
                                    <label class="control-label font-green" role="button">
                                        <input type="radio" name="rd-status" value="1" class="icheck" data-radio="iradio_minimal-green" {{ $dealer->is_active == 1 ? 'checked' : '' }} />
                                        Kích hoạt
                                    </label>
                                    <label class="control-label font-red-soft" role="button">
                                        <input type="radio" name="rd-status" value="0" class="icheck" data-radio="iradio_minimal-green" {{ $dealer->is_active == 0 ? 'checked' : '' }} />
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
    var currentDistrict = '{{ $dealer->district_code }}';
    
    // Store all districts data
    var allDistricts = [];
    $('#district-select option').each(function() {
        if ($(this).val() !== '') {
            allDistricts.push({
                id: $(this).val(),
                text: $(this).text(),
                province: $(this).data('province')
            });
        }
    });
    
    // Initialize Select2 for province
    $('#province-select').select2({
        placeholder: '-- Chọn tỉnh/thành phố --',
        allowClear: true
    });
    
    function updateDistrictSelect(provinceCode, selectedValue) {
        // Clear current options
        $('#district-select').empty();
        $('#district-select').append('<option value="">-- Chọn quận/huyện --</option>');
        
        // Add filtered districts
        if (provinceCode) {
            allDistricts.forEach(function(district) {
                if (String(district.province) === String(provinceCode)) {
                    var selected = (selectedValue && String(district.id) === String(selectedValue)) ? ' selected' : '';
                    $('#district-select').append('<option value="' + district.id + '"' + selected + '>' + district.text + '</option>');
                }
            });
        }
        
        // Reinitialize Select2
        $('#district-select').select2({
            placeholder: '-- Chọn quận/huyện --',
            allowClear: true
        });
    }
    
    // Initialize district select with current value
    updateDistrictSelect($('#province-select').val(), currentDistrict);
    
    $('#province-select').on('change', function() {
        updateDistrictSelect($(this).val(), null);
    });
});
</script>
@endsection
