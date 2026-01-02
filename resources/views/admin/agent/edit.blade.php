@extends('layouts.admin')
@section('head')
<link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"/>
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
                                <option value="{{ $province->code }}" {{ $dealer->province_code == $province->code ? 'selected' : '' }}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Quận/Huyện</label>
                            <select name="txt-district-code" id="district-select" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->code }}" data-province="{{ $district->province_code }}" {{ $dealer->district_code == $district->code ? 'selected' : '' }}>{{ $district->name }}</option>
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
    var currentProvince = $('#province-select').val();
    if (currentProvince) {
        $('#district-select option').each(function() {
            var districtProvince = $(this).data('province');
            if (districtProvince != currentProvince && $(this).val() !== '') {
                $(this).hide();
            }
        });
    }
    
    $('#province-select').change(function() {
        var provinceCode = $(this).val();
        $('#district-select option').each(function() {
            var districtProvince = $(this).data('province');
            if (provinceCode === '' || districtProvince == provinceCode || $(this).val() === '') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        $('#district-select').val('');
    });
});
</script>
@endsection
