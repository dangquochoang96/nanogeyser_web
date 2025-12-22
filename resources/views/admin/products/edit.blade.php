@extends('layouts.admin')
@section('head')
    <link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
@endsection
<?php
function optionCategories($categories, $parentId = 0, $level = 0, $listSelected = [])
{
    //    dd($categories);
    $string = '';
    foreach ($categories as $category) {
        if ($category->parent_id == $parentId) {
            $levelString = '';
            for ($i = 1; $i <= $level; $i++) {
                $levelString .= '---';
            }
            if (in_array($category->id, $listSelected)) {
                $string .= "<option value='{$category->id}' selected>{$levelString}{$category->name}</option>";
            } else {
                $string .= "<option value='{$category->id}'>{$levelString}{$category->name}</option>";
            }

            $string .= optionCategories($categories, $category->id, $level + 1, $listSelected);
        }
    }

    return $string;
}

?>
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
                <a href="{{ route('products.index') }}">Danh sách sản phẩm</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">sửa sản phẩm</a>
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
                <span class="caption-subject bold uppercase">Sửa sản phẩm</span>
            </div>
        </div>
        <div class="portlet-body">
            <form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}" accept-charset="UTF-8"
                id="add-form" enctype="multipart/form-data">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_general" data-toggle="tab" aria-expanded="true">
                                Thông tin sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="#tab_seo" data-toggle="tab" aria-expanded="false">
                                Thông tin khác
                            </a>
                        </li>
                        <li>
                            <a href="#tab_images" data-toggle="tab" aria-expanded="false">
                                Ảnh sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="#tab_boloc" data-toggle="tab" aria-expanded="false">
                                Bộ lọc sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="#tab_options" data-toggle="tab" aria-expanded="false">
                                Các lựu chọn khác
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content no-space">
                        <div class="tab-pane active" id="tab_general">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Tên sản phẩm<span class="required"> *
                                                </span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $product->name }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mã sản phẩm</label>
                                            <input type="text" name="product_code" class="form-control"
                                                value="{{ $product->product_code }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Chủng loại<span class="required"> *
                                                </span></label>
                                            <select name="type" class="form-control">
                                                <option value="1" @if ($product->type == 1) selected @endif>
                                                    Máy lọc nước</option>
                                                <option value="2" @if ($product->type == 2) selected @endif>
                                                    Lõi lọc</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Danh mục<span class="required"> * </span></label>
                                            <select name="product_category_id[]" class="form-control select2me" multiple>
                                                {!! optionCategories(
                                                    $categories,
                                                    0,
                                                    0,
                                                    $product->categories->map(function ($item) {
                                                            return $item->id;
                                                        })->toArray(),
                                                ) !!}
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Giá</label>
                                            <input type="text" name="price" class="form-control money"
                                                value="{{ $product->price }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Giá khuyến mại</label>
                                            <input type="text" name="sale_price" class="form-control money"
                                                value="{{ $product->sale_price }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Model</label>
                                            <input type="text" name="model" class="form-control"
                                                value="{{ $product->model }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Trọng lượng</label>
                                            <input type="text" name="weight" class="form-control"
                                                value="{{ $product->weight }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Số lõi lọc</label>
                                            <input type="number" name="number_filter" class="form-control"
                                                value="{{ $product->number_filter }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Công nghệ lọc</label>
                                            <input type="text" name="filter_technology" class="form-control"
                                                value="{{ $product->filter_technology }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Công suất lọc</label>
                                            <input type="text" name="filter_capacity" class="form-control"
                                                value="{{ $product->filter_capacity }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nhà sản xuất</label>
                                            <input type="text" name="producer" class="form-control"
                                                value="{{ $product->producer }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Khả năng lọc sạch</label>
                                            <input type="text" name="ability_clean" class="form-control"
                                                value="{{ $product->ability_clean }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Bảo hành</label>
                                            <input type="text" name="guarantee" class="form-control"
                                                value="{{ $product->guarantee }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Trạng thái</label>
                                            <div class="input-group m-t-5 p-b-5">
                                                <div class="icheck-inline">
                                                    <label class="control-label font-green" role="button">
                                                        <input type="radio" name="status" value="1"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->status == 1 ? ' checked' : '' }} />
                                                        Kích hoạt
                                                    </label>
                                                    <label class="control-label font-red-soft" role="button">
                                                        <input type="radio" name="status" value="2"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->status == 2 ? ' checked' : '' }} />
                                                        Khóa
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="permistion">Phân quyền thương hiệu</label>
                                            <select name="permission" class="form-control" id="permission">
                                                <option value="0" {{ $product->permission == 0 ? 'selected' : '' }}>
                                                    Tất cả</option>
                                                <option value="1" {{ $product->permission == 1 ? 'selected' : '' }}>
                                                    Geysereco.com</option>
                                                <option value="2" {{ $product->permission == 2 ? 'selected' : '' }}>
                                                    Nanogeyser.com</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_seo">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Hiển thị trang chủ</label>
                                            <div class="input-group m-t-5 p-b-5">
                                                <div class="icheck-inline">
                                                    <label class="control-label font-green" role="button">
                                                        <input type="radio" name="show_home" value="1"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->show_home == 1 ? ' checked' : '' }} />
                                                        Hiển thị
                                                    </label>
                                                    <label class="control-label font-red-soft" role="button">
                                                        <input type="radio" name="show_home" value="2"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->show_home == 2 ? ' checked' : '' }} />
                                                        Không hiển thị
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Hiển thị Danh mục</label>
                                            <div class="input-group m-t-5 p-b-5">
                                                <div class="icheck-inline">
                                                    <label class="control-label font-green" role="button">
                                                        <input type="radio" name="show_category" value="1"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->show_category == 1 ? ' checked' : '' }} />
                                                        Hiển thị
                                                    </label>
                                                    <label class="control-label font-red-soft" role="button">
                                                        <input type="radio" name="show_category" value="2"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->show_category == 2 ? ' checked' : '' }} />
                                                        Không hiển thị
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Sản phẩm bán chạy nhất</label>
                                            <div class="input-group m-t-5 p-b-5">
                                                <div class="icheck-inline">
                                                    <label class="control-label font-green" role="button">
                                                        <input type="radio" name="best_sell" value="1"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->best_sell == 1 ? ' checked' : '' }} />
                                                        Yes
                                                    </label>
                                                    <label class="control-label font-red-soft" role="button">
                                                        <input type="radio" name="best_sell" value="0"
                                                            class="icheck" data-radio="iradio_minimal-green"
                                                            {{ $product->best_sell == 0 ? ' checked' : '' }} />
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Thứ tự (số càng lớn càng ưu tiên)</label>
                                            <input type="text" name="order" class="form-control"
                                                value="{{ $product->order }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Link video sản phẩm</label>
                                            <input type="text" name="video" class="form-control"
                                                value="{{ $product->video }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Seo URL</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ $product->slug }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Meta</label>
                                            <input type="text" name="meta" class="form-control"
                                                value="{{ $product->meta }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">keywords</label>
                                            <input type="text" name="keyword" class="form-control"
                                                value="{{ $product->keyword }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mô tả ngắn</label>
                                            <textarea class="form-control ckeditor" name="description">{{ $product->description }}</textarea>
                                        </div>
                                        <input type="hidden" value="{}" name="data-images" id="data-images">
                                        <div class="form-group">
                                            <label class="control-label">Tổng quan</label>
                                            <textarea class="form-control ckeditor" name="content">{{ $product->content }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Ưu điểm nổi bật</label>
                                            <textarea class="form-control ckeditor" name="advantages">{{ $product->advantages }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Thông số kĩ thuật</label>
                                            <textarea class="form-control ckeditor" name="technical_special">{{ $product->technical_special }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Video hướng dẫn lắp đặt và Kiếm tra hàng chính
                                                hãng</label>
                                            <textarea class="form-control ckeditor" name="intro_video">{{ $product->intro_video }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_images">
                            <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10"
                                style="position: relative;">
                                <label for="input-upload-image" class="btn yellow"></span>
                                    <i class="fa fa-plus"></i> Select Files </label>
                                <input type="file" style="display: none" name="my-image-upload"
                                    id="input-upload-image" multiple accept="image/png, image/jpeg">
                            </div>
                            <div class="row">
                                <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"></div>
                            </div>
                            <table class="table table-bordered table-hover" id="table-image">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="8%">
                                            Image
                                        </th>
                                        <th width="25%">
                                            Label
                                        </th>
                                        <th width="8%">
                                            Sort Order
                                        </th>
                                        <th width="10%">
                                            Ảnh đại diện
                                        </th>
                                        <th width="10%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_boloc">
                            <div class="form-body">
                                <?php $listFilter = $product->filters
                                    ->map(function ($item) {
                                        return $item->id;
                                    })
                                    ->toArray(); ?>
                                @foreach ($filters as $key => $val)
                                    <div class="form-group">
                                        <label class="control-label">{{ $val->name }}</label>
                                        @if (isset($val->getValues))
                                            @foreach ($val->getValues as $k => $v)
                                                <div>
                                                    <label>
                                                        <input type="checkbox" name="product_filter_id[]"
                                                            @if (in_array($v->id, $listFilter)) checked @endif
                                                            value="{{ $v->id }}">{{ $v->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_options">
                            <div class="form-body">
                                <button id="addGroup" type="button" class="btn btn-primary btn-sm">+ Thêm nhóm tuỳ
                                    chọn</button>
                                <br><br>

                                <div id="optionGroups"></div>
                                <hr>
                                <div id="variantsTable"></div>
                                <input type="hidden" name="variants_json" id="variants_json">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" id="generateJSON" class="btn blue uppercase">Lưu chỉnh sửa</button>
                            <a href="{{ route('products.index') }}" class="btn red-soft uppercase">Hủy
                                bỏ</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    @include('admin.myVendor.uploadImage')
@endsection

@section('script')
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('quantri/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/my.js') }}"></script>
    <link href="{{ asset('css/my.css') }}" rel="stylesheet" type="text/css" />
    <script>
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return regexpr.test(value);
        }, "Số điện thoại không hợp lệ");
        var Form_validate = function() {
            var handleValidate = function() {
                var form = $('#add-form');
                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    rules: {
                        'name': {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        'name': {
                            required: "Tên không được để trống",
                            minlength: "Tên quá ngắn"
                        }
                    },
                    invalidHandler: function(event, validator) {},
                    errorPlacement: function(error, element) {
                        $(element).closest('.form-group').append(error);
                    },
                    highlight: function(element) {
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight: function(element) {
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    success: function(label) {
                        label.closest('.form-group').removeClass('has-error');
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
                form.find('input[class!="tt-input"]').keypress(function(e) {
                    if (e.which === 13) {
                        if (form.validate().form()) {
                            form.submit();
                        }
                        return false;
                    }
                });
            };
            return {
                init: function() {
                    handleValidate();
                }
            };
        }();

        jQuery(document).ready(function() {
            $('.money').simpleMoneyFormat();
            Form_validate.init();
        });

        @php
            $list = [];
            foreach ($product->productImages as $value) {
                $list[] = $value->link;
            }
        @endphp
        MyImageUpload.init({
            idUpload: '#input-upload-image',
            idTable: '#table-image',
            idTarget: '#data-images',
            uploadSuccessData: {!! $product->productImages !!}
        });
    </script>

    <script>
        function cartesianProduct(arr) {
            if (arr.length === 0) return [];
            if (arr.length === 1) return arr[0].map(i => [i]);
            return arr.reduce((a, b) => a.flatMap(d => b.map(e => [].concat(d, e))));
        }

        function formatCurrency(number) {
            number = parseFloat(number || 0);
            return number.toLocaleString('vi-VN') + ' đ';
        }

        function renderVariantTable() {
            let groupTitles = [];
            let groupValues = [];

            // Lưu lại dữ liệu cũ một cách chuẩn hoá
            const oldData = [];
            $('#variantsTable .variant-row').each(function() {
                const combo = $(this).find('td').slice(0, -3).map(function() {
                    return $(this).text().trim();
                }).get();

                oldData.push({
                    key: JSON.stringify(combo), // key ổn định bất kể thay đổi nhóm
                    combo: combo,
                    price: $(this).find('.variant-price').val(),
                    price_sale: $(this).find('.variant-price-sale').val(),
                    image: $(this).find('.variant-image')[0]?.dataset?.uploaded || ''
                });
            });

            // Lấy lại nhóm và option
            $('.option-group').each(function() {
                const title = $(this).find('.group-title').val().trim();
                if (!title) return;

                groupTitles.push(title);
                let options = [];

                $(this).find('.option-item .option-title').each(function() {
                    const val = $(this).val().trim();
                    if (val) options.push(val);
                });

                if (options.length > 0) groupValues.push(options);
            });

            if (groupValues.length === 0) {
                $('#variantsTable').html('');
                return;
            }

            const combos = cartesianProduct(groupValues);
            let table = `
        <table class="table table-bordered">
            <thead>
                <tr>${groupTitles.map(t => `<th>${t}</th>`).join('')}
                    <th>Giá gốc</th><th>Giá sale</th><th>Ảnh</th>
                </tr>
            </thead>
            <tbody>
    `;

            combos.forEach((combo, index) => {
                const key = JSON.stringify(combo);
                const matched = oldData.find(row => row.key === key) || {};

                const price = matched.price || 0;
                const price_sale = matched.price_sale || 0;
                const imageURL = matched.image || '';

                table += `
            <tr class="variant-row" data-index="${index}">
                ${combo.map(val => `<td>${val}</td>`).join('')}
                <td><input type="number" class="form-control variant-price" value="${price}"></td>
                <td><input type="number" class="form-control variant-price-sale" value="${price_sale}"></td>
                <td>
                    <input type="file" class="variant-image" accept="image/*" data-uploaded="${imageURL}">
                    ${imageURL ? `<br><img src="${imageURL}" width="40" style="margin-top:5px;">` : ''}
                </td>
            </tr>`;
            });

            table += '</tbody></table>';
            $('#variantsTable').html(table);
        }


        $(document).ready(function() {
            let groupIndex = 0;

            // Thêm nhóm
            $('#addGroup').click(function() {
                const html = `
            <div class="option-group panel panel-default" data-index="${groupIndex}">
                <div class="panel-heading">
                    <strong>Nhóm tuỳ chọn</strong>
                    <button type="button" class="btn btn-danger btn-xs pull-right remove-group">X</button>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Tiêu đề nhóm</label>
                        <input type="text" class="form-control group-title" placeholder="VD: Màu sắc, Dung tích">
                    </div>
                    <div class="options-list"></div>
                    <button type="button" class="btn btn-info btn-xs add-option">+ Thêm tuỳ chọn</button>
                </div>
            </div>`;
                $('#optionGroups').append(html);
                groupIndex++;
            });

            // Xoá nhóm
            $(document).on('click', '.remove-group', function() {
                $(this).closest('.option-group').remove();
                renderVariantTable();
            });

            // Thêm option
            $(document).on('click', '.add-option', function() {
                const optionHtml = `
            <div class="row option-item" style="margin-bottom:5px;">
                <div class="col-md-10">
                    <input type="text" class="form-control option-title" placeholder="VD: Đỏ, 10L">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-xs remove-option">X</button>
                </div>
            </div>`;
                $(this).siblings('.options-list').append(optionHtml);
            });

            // Xoá option
            $(document).on('click', '.remove-option', function() {
                $(this).closest('.option-item').remove();
                renderVariantTable();
            });

            // Tự động render lại bảng biến thể khi nhập nội dung
            $(document).on('input', '.option-title, .group-title', function() {
                renderVariantTable();
            });

            // Upload ảnh từng biến thể
            $(document).on('change', '.variant-image', function() {
                const fileInput = this;
                const formData = new FormData();
                formData.append('image', fileInput.files[0]);

                $.ajax({
                    url: 'https://nanogeyser.com/api/products/upload-option-image',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.url) {
                            fileInput.dataset.uploaded = res.url;
                        } else {
                            alert('Upload ảnh thất bại!');
                        }
                    },
                    error: function() {
                        alert('Upload ảnh thất bại!');
                    }
                });
            });
            const oldVariants = @json($options);

            // Khi nhấn nút submit form → sinh JSON
            $('#generateJSON').click(function() {
                const variants = [];
                const groupCount = $('.option-group').length;

                $('#variantsTable .variant-row').each(function() {
                    const combo = $(this).find('td').slice(0, groupCount).map(function() {
                        return $(this).text().trim();
                    }).get();

                    const price = parseFloat($(this).find('.variant-price').val()) || 0;
                    const price_sale = parseFloat($(this).find('.variant-price-sale').val()) || 0;
                    const imageInput = $(this).find('.variant-image')[0];
                    const imageURL = imageInput?.dataset?.uploaded || '';

                    variants.push({
                        title: combo.join(' - '),
                        price: price,
                        price_sale: price_sale,
                        image: imageURL
                    });
                });
                // console.log(variants, 'variants');
                $('#variants_json').val(JSON.stringify(variants));
                

            });




            // console.log(oldVariants, 'oldVariant');

            if (oldVariants && oldVariants.length > 0) {
                const groupCount = oldVariants[0].title.split(' - ').length;
                const optionGroups = [];

                for (let i = 0; i < groupCount; i++) {
                    optionGroups.push(new Set());
                }

                oldVariants.forEach(v => {
                    const parts = v.title.split(' - ');
                    parts.forEach((val, idx) => {
                        optionGroups[idx].add(val.trim());
                    });
                });

                optionGroups.forEach((set, index) => {
                    const groupName = `Nhóm ${index + 1}`;
                    const html = `
                <div class="option-group panel panel-default" data-index="${index}">
                    <div class="panel-heading">
                        <strong>Nhóm tuỳ chọn</strong>
                        <button type="button" class="btn btn-danger btn-xs pull-right remove-group">X</button>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề nhóm</label>
                            <input type="text" class="form-control group-title" value="${groupName}">
                        </div>
                        <div class="options-list">
                            ${Array.from(set).map(val => `
                                                                                                            <div class="row option-item" style="margin-bottom:5px;">
                                                                                                                <div class="col-md-10">
                                                                                                                    <input type="text" class="form-control option-title" value="${val}">
                                                                                                                </div>
                                                                                                                <div class="col-md-2">
                                                                                                                    <button type="button" class="btn btn-danger btn-xs remove-option">X</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        `).join('')}
                        </div>
                        <button type="button" class="btn btn-info btn-xs add-option">+ Thêm tuỳ chọn</button>
                    </div>
                </div>
            `;
                    $('#optionGroups').append(html);
                });

                renderVariantTable();

                // Gán giá và ảnh
                $('#variantsTable .variant-row').each(function(index) {
                    const data = oldVariants[index];
                    if (!data) return;

                    $(this).find('.variant-price').val(data.price || 0);
                    $(this).find('.variant-price-sale').val(data.price_sale || 0);
                    if (data.image) {
                        $(this).find('.variant-image').attr('data-uploaded', data.image);
                        $(this).find('.variant-image').after(
                            `<img src="${data.image}" width="40" style="margin-top:5px;">`);
                    }
                });
            }

        });
    </script>
@endsection
