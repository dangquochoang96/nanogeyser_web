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
                <a href="#">Danh sách bộ lọc</a>
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
                <span class="caption-subject bold uppercase"> Danh sách bộ lọc</span>
            </div>
            <div class="actions">
                <a href="{{ route('product-filter.create') }}" class="btn blue uppercase">
                    <i class="fa fa-plus-circle"></i> Thêm
                </a>
            </div>
        </div>
        <div class="portlet-body">
            @if (count($productsFilter))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                        <tr>
                            <th style="width:52px;" class="text-center">STT</th>
                            <th class="text-center">Tên</th>
                            <th style="width: 150px;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productsFilter as $value)
                            <tr>
                                <td>{{$loop->index + ($productsFilter->currentPage() * $productsFilter->perPage()) - $productsFilter->perPage() + 1}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <a href="{{route('product-filter.edit', ['id' => $value->id])}}"
                                       class="btn btn-sm btn-info">sửa</a>
                                    <button class="btn btn-danger btn-sm my-delete-btn"
                                            data-action="{{route('product-filter.destroy', ['id' => $value->id])}}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!!  $productsFilter->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>
    <style>

        .my-menu li {
            border: solid 1px #ccc;
            list-style: none;
            padding: 20px;
            box-sizing: border-box;
            border-bottom: none;
        }

        .my-menu li:last-child {
            border-bottom: 1px solid #ccc;
        }

        .my-menu li ul {
            padding-top: 30px;
        }
    </style>

    @include('admin.myVendor.deleteModal', [
    'deleteMessage' => 'Bạn có muốn xóa dữ liệu này?'])
@endsection


@section('script')
    <script>
        $('.my-delete-btn').click(function () {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
    </script>
@endsection