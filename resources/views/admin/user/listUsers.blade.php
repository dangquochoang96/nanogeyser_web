@extends('layouts.admin')

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
				<a href="#">Danh sách người dùng</a>
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
     <div class="actions">
        <a href="{{ URL::action('Admin\UserController@addUser') }}" class="btn blue uppercase">
        <i class="fa fa-plus-circle"></i> Thêm
        </a>
     </div>
  </div>
  <div class="portlet-body">
     <form method="GET" action="{{ URL::action('Admin\UserController@listUsers') }}" accept-charset="UTF-8" id="filter-form">
        <div class="row form-body">
           <div class="col-md-3">
              <div class="form-group">
                 <input type="text" name="name" class="form-control" placeholder="Tìm theo họ và tên" value="">
              </div>
           </div>
           <div class="col-md-2">
              <div class="form-group">
                 <input type="text" name="email" class="form-control" placeholder="Tìm theo email" value="">
              </div>
           </div>
           <div class="col-md-2">
              <div class="form-group">
                 <select name="status" class="form-control input-small select2me" tabindex="-1" aria-hidden="true">
                    <option value="">Chọn trạng thái</option>
                    <option value="1">
                       Kích hoạt
                    </option>
                    <option value="2">
                       Khóa
                    </option>
                 </select>
              </div>
           </div>
           <div class="col-md-1">
              <div class="form-group">
                 <button type="submit" class="btn uppercase yellow-lemon btn-block"><i class="fa fa-search"></i>
                 </button>
              </div>
           </div>
        </div>
     </form>
 	 @if(count($users) > 0)
     <div class="table-responsive">
        <table class="table table-bordered table-hover td-middle">
           <thead>
              <tr>
                 <th style="width:52px;" class="text-center">STT</th>
                 <th class="text-center">Họ và tên</th>
                 <th style="width: 300px;" class="text-center">Email</th>
                 <!-- <th style="width: 150px;" class="text-center">Nhóm</th> -->
                 <th style="width: 100px;" class="text-center">Trạng thái</th>
                 <th style="width: 100px;" class="text-center"></th>
              </tr>
           </thead>
           <tbody>
            <?php  $count = ($users->currentpage() - 1) * $users->perpage() + 1;  ?>
              @foreach ($users as $user)
              <tr>
                 <td class="text-center"><?php  echo $count++; ?></td>
                 <td>{{ $user->username }}</td>
                 <td>{{ $user->email }}</td>
                 <td class="font-12 text-center">
                    @if($user->status == 1)
                    	<span class="font-green">Kích hoạt</span>
                    @else
                    	<span class="font-red-soft">Khóa</span>
                    @endif
                 </td>
                 <td>
                    <a href="{{ URL::action('Admin\UserController@editUser', ['user_id' => $user->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-id="{{ $user->id }}" class="btn-del-user btn btn-xs red-soft m-0"><i class="fa fa-trash"></i>
                    </button>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
     </div> 
 	<div class="text-right">
        {!!  $users->appends(Request::all())->links() !!}
    </div>
    @else
    <h3 class="text-center">Không có dữ liệu</h3>
    @endif
     <div class="text-right">
     </div>
  </div>
</div>
<div id="del-user-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
  <div class="modal-dialog modal-md">
     <form method="POST" action="{{ URL::action('Admin\UserController@delUser') }}" accept-charset="UTF-8" id="del-user-form">
        @csrf
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title text-uppercase">Xóa Người dùng</h4>
           </div>
           <div class="modal-body">
              <input type="hidden" name="txt-uid" value="">
              <div class="font-red-soft">Bạn có chắc chắn muốn xóa Người dùng này?</div>
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
  $('.btn-del-user').click(function () {
    var uid = $.trim($(this).data('id'));
    if (uid !== "") {
      $('#del-user-modal').find('input[name="txt-uid"]').val(uid);
      $('#del-user-modal').modal('show');
    }
  });
  $('#del-user-modal').on('hidden.bs.modal', function () {
    $(this).find('#del-user-form').trigger('reset');
  });
</script>
@endsection