@extends('layouts.admin')

@php
    function showCategories($categories, $parentId = 0) {
    $string = '';

    foreach ($categories as  $category) {
        if ($category->parent_id == $parentId) {
            $string .= '<li>';
            $string .= '<a href="'.url($category->slug).'">'.$category->name.'</a>';
            $string .= actionCategory($category);
            $string .= showCategories($categories, $category->id);
            $string .= '</li>';
        }
    }

    if ($string) {
        $string = '<ul class="my-menu">'.$string.'</ul>';
    }


    return $string;
    }

    function actionCategory($category) {
        return '<div class="pull-right"><a href='.
        route('product-categories.edit', ['id' => $category->id])
        .' class="btn btn-info btn-sm">Sửa</a><button class="btn btn-danger btn-sm my-delete-btn" data-action="'.
        route('product-categories.destroy', ['id' => $category->id])
        .'">Xóa</button></div>';
    }
@endphp


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
                {!! showCategories($productCategories) !!}
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
    'deleteMessage' => 'Bạn có muốn xóa danh mục này, các danh mục cấp thấp hơn của danh mục sẽ bị xóa?'])
@endsection


@section('script')
    <script>
        $('.my-delete-btn').click(function () {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
    </script>
@endsection