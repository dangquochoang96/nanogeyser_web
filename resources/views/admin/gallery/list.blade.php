@extends('layouts.admin')

@section('content')
    <!-- END STYLE CUSTOMIZER -->
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Dashboard
        <small>reports & statistics</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ URL::action('Admin\IndexController@index') }}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Danh sách thư viện ảnh</a>
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
                <span class="caption-subject bold uppercase"> Danh sách thư viện ảnh</span>
            </div>
            <div class="actions">
                <a href="{{ route('gallerys.create') }}" class="btn blue uppercase">
                    <i class="fa fa-plus-circle"></i> Thêm
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <form class="filter-form">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tên thư viện ảnh</label>
                            <input type="text" name="name" class="form-control" value="{{$filter['name']}}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="margin-top: 24px;">Filter</button>
                        </div>
                    </div>


                </div>
            </form>
            @if (count($gallerys))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                        <tr>
                            <th style="width:52px;" class="text-center">STT</th>
                            <th class="text-center">Ảnh</th>
                            <th class="text-center">Tên thư viện ảnh</th>
                            <th style="width: 150px;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($gallerys as $gallery)
                            <tr>
                                <td>{{$loop->index + ($gallerys->currentPage() * $gallerys->perPage()) - $gallerys->perPage() + 1}}</td>
                                <td>
                                    <img src="{{(sizeof($gallery->galleryImages)) ? asset($gallery->galleryImages->first()->link) : '' }}"
                                         class="img-responsive" style="width:100px;">
                                    <p>{{$gallery->gallery_code}}</p>
                                </td>
                                <td>{{$gallery->name}}</td>
                                <td>
                                    <a href="{{route('gallerys.edit', ['id' => $gallery->id])}}"
                                       class="btn btn-sm btn-info">sửa</a>
                                    <button class="btn btn-danger btn-sm my-delete-btn"
                                            data-action="{{route('gallerys.destroy', ['id' => $gallery->id])}}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!!  $gallerys->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>
    @include('admin.myVendor.deleteModal', [
    'deleteMessage' => 'Bạn có muốn xóa thư viện ảnh này'])
@endsection
@section('script')
    <script>
        $('.my-delete-btn').click(function () {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
    </script>
@endsection