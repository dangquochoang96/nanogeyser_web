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
        <a href="#">Danh sách quận/huyện</a>
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
        <span class="caption-subject bold uppercase"> Danh sách quận/huyện </span>
     </div>
     <div class="actions">
        <a href="{{ URL::action('Admin\AgentController@addDistrict') }}" class="btn blue uppercase">
        <i class="fa fa-plus-circle"></i> Thêm
        </a>
     </div>
  </div>
  <div class="portlet-body">
    <form method="GET" action="{{ URL::action('Admin\AgentController@listDistricts') }}" class="form-inline m-b-15">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Tên quận/huyện" value="{{ request('name') }}">
        </div>
        <button type="submit" class="btn blue"><i class="fa fa-search"></i> Tìm kiếm</button>
    </form>
    @if(count($districts) > 0)
     <div class="table-responsive">
        <table class="table table-bordered table-hover td-middle">
           <thead>
              <tr>
                 <th style="width:52px;" class="text-center">STT</th>
                 <th class="text-center">Mã</th>
                 <th class="text-center">Tên</th>
                 <th class="text-center">Mã tỉnh</th>
                 <th style="width: 100px;" class="text-center"></th>
              </tr>
           </thead>
           <tbody>
            <?php $count = ($districts->currentpage() - 1) * $districts->perpage() + 1; ?>
              @foreach ($districts as $district)
              <tr>
                 <td class="text-center"><?php echo $count++; ?></td>
                 <td class="text-center">{{ $district->code }}</td>
                 <td class="text-center">{{ $district->name }}</td>
                 <td class="text-center">{{ $district->province_code }}</td>
                 <td>
                    <a href="{{ URL::action('Admin\AgentController@editDistrict', ['id' => $district->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-id="{{ $district->id }}" class="btn-del btn btn-xs red-soft m-0"><i class="fa fa-trash"></i></button>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
     </div> 
     <div class="text-right">
      {!! $districts->appends(Request::all())->links() !!}
    </div>
    @else
    <h3 class="text-center">Không có dữ liệu</h3>
    @endif
  </div>
</div>
<div id="del-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
  <div class="modal-dialog modal-md">
     <form method="POST" action="{{ URL::action('Admin\AgentController@delDistrict') }}" accept-charset="UTF-8" id="del-form">
        @csrf
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title text-uppercase">Xóa quận/huyện</h4>
           </div>
           <div class="modal-body">
              <input type="hidden" name="txt-uid" value="">
              <div class="font-red-soft">Bạn có chắc chắn muốn xóa quận/huyện này?</div>
           </div>
           <div class="modal-footer">
              <button type="submit" class="btn blue text-uppercase">Xác nhận</button>
              <button type="button" data-dismiss="modal" class="btn red-soft uppercase">Hủy bỏ</button>
           </div>
        </div>
     </form>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $('.btn-del').click(function () {
    var uid = $.trim($(this).data('id'));
    if (uid !== "") {
      $('#del-modal').find('input[name="txt-uid"]').val(uid);
      $('#del-modal').modal('show');
    }
  });
  $('#del-modal').on('hidden.bs.modal', function () {
    $(this).find('#del-form').trigger('reset');
  });
</script>
@endsection
