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
        <a href="#">Danh sách blog</a>
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
        <span class="caption-subject bold uppercase"> Danh sách Blog </span>
     </div>
     <div class="actions">
        <a href="{{ URL::action('Admin\BlogController@addBlog') }}" class="btn blue uppercase">
        <i class="fa fa-plus-circle"></i> Thêm
        </a>
     </div>
  </div>
  <div class="portlet-body">
    @if(count($blogs) > 0)
     <div class="table-responsive">
        <table class="table table-bordered table-hover td-middle">
           <thead>
              <tr>
                 <th style="width:52px;" class="text-center">STT</th>
                 <th class="text-center">Tên blog</th>
                 <th style="width: 300px;" class="text-center">Danh mục</th>
                 <th style="width: 150px;" class="text-center">Thứ tự</th>
                 <th style="width: 100px;" class="text-center">Trạng thái</th>
                 <th style="width: 100px;" class="text-center">Ngày tạo</th>
                 <th style="width: 100px;" class="text-center"></th>
              </tr>
           </thead>
           <tbody>
            <?php  $count = ($blogs->currentpage() - 1) * $blogs->perpage() + 1;  ?>
              @foreach ($blogs as $blog)
              <tr>
                 <td class="text-center"><?php  echo $count++; ?></td>
                 <td>{{ $blog->name }}</td>
                 <td>
                  @if ($blog->category != null ) 
                    @foreach ($blog->Category as $category)
                      {{$category->name}} 
                      @if (!$loop->last) 
                      ,
                      @endif
                    @endforeach
                  @endif
                  </td>
                 <td>{{ $blog->order }}</td>
                 <td class="font-12 text-center">
                    @if($blog->status == 1)
                      <span class="font-green">Kích hoạt</span>
                    @else
                      <span class="font-red-soft">Khóa</span>
                    @endif
                 </td>
                 <td>{{$blog->time_view}}</td>
                 <td>
                    <a href="{{ URL::action('Admin\BlogController@editBlog', ['id' => $blog->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-id="{{ $blog->id }}" class="btn-del btn btn-xs red-soft m-0"><i class="fa fa-trash"></i>
                    </button>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
     </div> 
     <div class="text-right">
      {!!  $blogs->appends(Request::all())->links() !!}
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
     <form method="POST" action="{{ URL::action('Admin\BlogController@delBlog') }}" accept-charset="UTF-8" id="del-form">
        @csrf
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title text-uppercase">Xóa Blog</h4>
           </div>
           <div class="modal-body">
              <input type="hidden" name="txt-uid" value="">
              <div class="font-red-soft">Bạn có chắc chắn muốn xóa bài viết này?</div>
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