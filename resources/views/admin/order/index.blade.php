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
                <a href="#">Đơn đặt hàng</a>
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
                <span class="caption-subject bold uppercase"> Danh sách đơn đặt hàng</span>
            </div>
            <div class="actions">

            </div>
        </div>
        <div class="portlet-body">
            @if (count($orders))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                        <tr>
                            <th style="width:52px;" class="text-center">STT</th>
                            <th class="text-center">Tên khách hàng</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Địa chỉ</th>
                            <th style="width: 150px;" class="text-center">Ngày tạo</th>
                            <th style="width: 150px;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$loop->index + ($orders->currentPage() * $orders->perPage()) - $orders->perPage() + 1}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a style="padding: 5px 20px;" href="{{ route('orders.edit', ['id' => $order->id]) }}" class="btn btn-xs green-jungle"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-sm my-delete-btn"
                                            data-action="{{route('orders.destroy', ['id' => $order->id])}}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!!  $orders->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>
    @include('admin.myVendor.deleteModal', [
    'deleteMessage' => 'Bạn có muốn xóa đơn hàng này'])

@endsection



@section('script')
    <script>
        $('.my-delete-btn').click(function () {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
    </script>
@endsection