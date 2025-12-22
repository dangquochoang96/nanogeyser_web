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
				<a href="#">Danh sách danh mục blog</a>
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
        <span class="caption-subject bold uppercase"> Danh sách danh mục </span>
     </div>
     <div class="actions">
        <a href="{{ URL::action('Admin\BlogCategoryController@addCategory') }}" class="btn blue uppercase">
        <i class="fa fa-plus-circle"></i> Thêm
        </a>
     </div>
  </div>
  <div class="portlet-body">
 	 @if(count($categories) > 0)
     <div class="table-responsive">
        <table class="table table-bordered table-hover td-middle">
           <thead>
              <tr>
                 <th style="width:52px;" class="text-center">STT</th>
                 <th class="text-center">Tên danh mục</th>
                 <th style="width: 300px;" class="text-center">Danh mục cha</th>
                 <th style="width: 150px;" class="text-center">Thứ tự</th>
                 <th style="width: 100px;" class="text-center">Trạng thái</th>
                 <th style="width: 100px;" class="text-center"></th>
              </tr>
           </thead>
           <tbody>
            <?php $i=1; ?>
              @foreach ($categories as $category)
              <tr>
                 <td class="text-center">{{ $i }} <?php $i++; ?></td>
                 <td>{{ $category->name }}</td>
                 <td>@if ($category->parentCategory != null ) {{ $category->parentCategory()->first()->name }} @endif</td>
                 <td>{{ $category->order }}</td>
                 <td class="font-12 text-center">
                    @if($category->status == 1)
                    	<span class="font-green">Kích hoạt</span>
                    @else
                    	<span class="font-red-soft">Khóa</span>
                    @endif
                 </td>
                 <td>
                    <a href="{{ URL::action('Admin\BlogCategoryController@editCategory', ['cate_id' => $category->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-id="{{ $category->id }}" class="btn-del btn btn-xs red-soft m-0"><i class="fa fa-trash"></i>
                    </button>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
     </div> 
    @else
    <h3 class="text-center">Không có dữ liệu</h3>
    @endif
     <div class="text-right">
     </div>
  </div>
</div>
<div id="del-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
  <div class="modal-dialog modal-md">
     <form method="POST" action="{{ URL::action('Admin\BlogCategoryController@delCategory') }}" accept-charset="UTF-8" id="del-form">
        @csrf
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title text-uppercase">Xóa Danh mục</h4>
           </div>
           <div class="modal-body">
              <input type="hidden" name="txt-uid" value="">
              <div class="font-red-soft">Bạn có chắc chắn muốn xóa Danh mục này?</div>
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