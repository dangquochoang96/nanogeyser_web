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
                <a href="{{ URL::action('Admin\PartnerController@list') }}">Đối tác phân phối</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Sửa đối tác</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\PartnerController@list') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
<div class="portlet light">
  <div class="portlet-title">
     <div class="caption">
        <span class="caption-subject bold uppercase">Sửa đối tác: {{ $partner->name }}</span>
     </div>
  </div>
  <div class="portlet-body">
      <form method="POST" action="{{ URL::action('Admin\PartnerController@edit', ['id' => $partner->id]) }}" accept-charset="UTF-8" id="edit-form" enctype="multipart/form-data">
        @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tên đối tác <span class="required"> * </span></label>
                            <input type="text" name="txt-name" class="form-control" value="{{ old('txt-name', $partner->name) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Điện thoại</label>
                            <input type="text" name="txt-phone" class="form-control" value="{{ old('txt-phone', $partner->phone) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Địa chỉ</label>
                            <textarea name="txt-address" class="form-control" rows="3">{{ old('txt-address', $partner->address) }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Logo/Ảnh đối tác</label>
                            <input type="file" name="txt-image" class="form-control" accept="image/*"/>
                            @if($partner->image)
                            <div class="m-t-10">
                                <img src="{{ asset($partner->image) }}" alt="{{ $partner->name }}" style="max-width: 150px; max-height: 100px;">
                                <br><small class="text-muted">Ảnh hiện tại</small>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Thứ tự hiển thị</label>
                            <input type="number" name="txt-order" class="form-control" value="{{ old('txt-order', $partner->order) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <div class="input-group m-t-5 p-b-5">
                                <div class="icheck-inline">
                                    <label class="control-label font-green" role="button">
                                        <input type="radio" name="rd-status" value="1" class="icheck" data-radio="iradio_minimal-green" {{ $partner->is_active == 1 ? 'checked' : '' }} />
                                        Kích hoạt
                                    </label>
                                    <label class="control-label font-red-soft" role="button">
                                        <input type="radio" name="rd-status" value="0" class="icheck" data-radio="iradio_minimal-green" {{ $partner->is_active == 0 ? 'checked' : '' }} />
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
                <a href="{{ URL::action('Admin\PartnerController@list') }}" class="btn red-soft uppercase">Hủy bỏ</a>
            </div>
      </form>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection
