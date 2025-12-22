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
                <a href="#">Danh sách danh mục sản phẩm</a>
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
                <span class="caption-subject bold uppercase"> Danh sách danh mục sản phẩm</span>
            </div>
            <div class="actions">
                <a href="{{ route('product-categories.create') }}" class="btn blue uppercase">
                    <i class="fa fa-plus-circle"></i> Thêm
                </a>
            </div>
        </div>
        <div class="portlet-body">
            @if (count($productCategories))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                        <tr>
                            <th style="width:52px;" class="text-center">STT</th>
                            <th class="text-center">Tên trang</th>
                            <th class="text-center">Mô tả ngắn</th>
                            <th style="width: 100px;" class="text-center">Trạng thái</th>
                            <th style="width: 100px;" class="text-center">Ngày tạo</th>
                            <th style="width: 100px;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count = ($pages->currentpage() - 1) * $pages->perpage() + 1;  ?>
                        @foreach ($productCategories as $category)
                            <tr>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!!  $productCategories->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection