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
                <a href="#">Danh sách sản phẩm</a>
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
                <span class="caption-subject bold uppercase"> Danh sách sản phẩm</span>
            </div>
            <div class="actions">
                <a href="{{ route('products.create') }}" class="btn blue uppercase">
                    <i class="fa fa-plus-circle"></i> Thêm
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <form class="filter-form">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="{{ $filter['name'] }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control">
                                <option value="0">-- Chọn danh mục --</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" {!! $value->id == $filter['category_id'] ? 'selected' : '' !!}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="margin-top: 24px;">Filter</button>
                        </div>
                    </div>


                </div>
            </form>
            @if (count($products))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                            <tr>
                                <th style="width:52px;" class="text-center">STT</th>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                {{-- <th class="text-center">Link</th> --}}
                                <th style="width: 150px;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->index + $products->currentPage() * $products->perPage() - $products->perPage() + 1 }}
                                    </td>
                                    <td>
                                        <img src="{{ sizeof($product->productImages) ? asset($product->productImages->first()->link) : '' }}"
                                            class="img-responsive" style="width:100px;">
                                        <p>{{ $product->product_code }}</p>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    {{-- 
                                    @if ($product->permission == 1)
                                        <td>
                                            <a
                                                href="{{ env('APP_URL_GEYSERECO') . '/' . $product->slug . '-' . $product->id }}">
                                                {{ env('APP_URL_GEYSERECO') . '/' . $product->slug . '-' . $product->id }}
                                            </a>
                                        </td>
                                    @elseif ($product->permission == 0)
                                        <td>
                                            <div>
                                                <a
                                                    href="{{ env('APP_URL_GEYSERECO') . '/' . $product->slug . '-' . $product->id }}">
                                                    {{ env('APP_URL_GEYSERECO') . '/' . $product->slug . '-' . $product->id }}
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}">
                                                    {{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}
                                                </a>
                                            </div>
                                        </td>
                                    @elseif ($product->permission == 2)
                                        <td>
                                            <a href="{{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}">
                                                {{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}">
                                                {{ env('APP_URL_NANOGEYSER') . '/' . $product->slug }}
                                            </a>
                                        </td>
                                    @endif --}}



                                    <td>
                                        <a href="{{ route('products.edit', ['id' => $product->id]) }}"
                                            class="btn btn-sm btn-info">sửa</a>
                                        <button class="btn btn-danger btn-sm my-delete-btn"
                                            data-action="{{ route('products.destroy', ['id' => $product->id]) }}">Xóa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!! $products->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>
    @include('admin.myVendor.deleteModal', [
        'deleteMessage' => 'Bạn có muốn xóa sản phẩm này',
    ])
@endsection
@section('script')
    <script>
        $('.my-delete-btn').click(function() {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
    </script>
@endsection
