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
        <a href="#">Đối tác phân phối</a>
      </li>
    </ul>
  </div>
<div class="portlet light">
  <div class="portlet-title">
     <div class="caption">
        <span class="caption-subject bold uppercase"> Danh sách đối tác phân phối </span>
     </div>
     <div class="actions">
        <a href="{{ URL::action('Admin\PartnerController@add') }}" class="btn blue uppercase">
        <i class="fa fa-plus-circle"></i> Thêm
        </a>
     </div>
  </div>
  <div class="portlet-body">
    <form method="GET" action="{{ URL::action('Admin\PartnerController@list') }}" class="form-inline m-b-15">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Tên đối tác" value="{{ request('name') }}">
        </div>
        <button type="submit" class="btn blue"><i class="fa fa-search"></i> Tìm kiếm</button>
    </form>
    @if(count($partners) > 0)
     <div class="table-responsive">
        <table class="table table-bordered table-hover td-middle">
           <thead>
              <tr>
                 <th style="width:52px;" class="text-center">STT</th>
                 <th style="width:80px;" class="text-center">Logo</th>
                 <th class="text-center">Tên đối tác</th>
                 <th class="text-center">Điện thoại</th>
                 <th class="text-center">Địa chỉ</th>
                 <th style="width:60px;" class="text-center">Thứ tự</th>
                 <th style="width:80px;" class="text-center">Trạng thái</th>
                 <th style="width: 100px;" class="text-center"></th>
              </tr>
           </thead>
           <tbody>
            <?php $count = ($partners->currentpage() - 1) * $partners->perpage() + 1; ?>
              @foreach ($partners as $partner)
              <tr>
                 <td class="text-center"><?php echo $count++; ?></td>
                 <td class="text-center">
                    @if($partner->image)
                    <img src="{{ asset($partner->image) }}" alt="{{ $partner->name }}" style="max-width: 60px; max-height: 40px;">
                    @else
                    <i class="fa fa-image text-muted"></i>
                    @endif
                 </td>
                 <td>{{ $partner->name }}</td>
                 <td class="text-center">{{ $partner->phone }}</td>
                 <td>{{ \Illuminate\Support\Str::limit($partner->address, 50) }}</td>
                 <td class="text-center">{{ $partner->order }}</td>
                 <td class="text-center">
                    @if($partner->is_active == 1)
                    <span class="label label-success">Kích hoạt</span>
                    @else
                    <span class="label label-danger">Khóa</span>
                    @endif
                 </td>
                 <td>
                    <a href="{{ URL::action('Admin\PartnerController@edit', ['id' => $partner->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-id="{{ $partner->id }}" class="btn-del btn btn-xs red-soft m-0"><i class="fa fa-trash"></i></button>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
     </div> 
     <div class="text-right">
      {!! $partners->appends(Request::all())->links() !!}
    </div>
    @else
    <h3 class="text-center">Không có dữ liệu</h3>
    @endif
  </div>
</div>
<div id="del-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
  <div class="modal-dialog modal-md">
     <form method="POST" action="{{ URL::action('Admin\PartnerController@del') }}" accept-charset="UTF-8" id="del-form">
        @csrf
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title text-uppercase">Xóa đối tác</h4>
           </div>
           <div class="modal-body">
              <input type="hidden" name="txt-uid" value="">
              <div class="font-red-soft">Bạn có chắc chắn muốn xóa đối tác này?</div>
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
</script>
@endsection
