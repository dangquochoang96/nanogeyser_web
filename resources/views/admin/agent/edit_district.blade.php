@extends('layouts.admin')
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
                <a href="{{ URL::action('Admin\AgentController@listDistricts') }}">Danh sách quận/huyện</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Sửa quận/huyện</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\AgentController@listDistricts') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
<div class="portlet light">
  <div class="portlet-title">
     <div class="caption">
        <span class="caption-subject bold uppercase">{{ $title ?? 'Sửa quận/huyện' }}</span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\AgentController@editDistrict', ['id' => $district->id]) }}" accept-charset="UTF-8" id="edit-form">
        @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Mã quận/huyện <span class="required"> * </span></label>
                            <input type="text" name="txt-code" class="form-control" value="{{ old('txt-code', $district->code) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tên quận/huyện <span class="required"> * </span></label>
                            <input type="text" name="txt-name" class="form-control" value="{{ old('txt-name', $district->name) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mã tỉnh/thành</label>
                            <input type="text" name="txt-province-code" class="form-control" value="{{ old('txt-province-code', $district->province_code) }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button>
                <a href="{{ URL::action('Admin\AgentController@listDistricts') }}" class="btn red-soft uppercase">Hủy bỏ</a>
            </div>
      </form>
  </div>
</div>
@endsection
