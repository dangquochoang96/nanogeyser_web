<style>
    #collection {
    }

    #collection ul {
        list-style: none;
        padding-left: 0px;
    }

    #collection ul li {
        position: relative;
        top: 3px;
        right: 0px;
    }

    #collection ul li input {
        margin-right: 9px;
    }

    #collection ul li i {
        position: absolute;
        top: 3px;
        right: 10px;
    }

    #collection ul ul {
        margin-left: 24px;
    }

    li i.rotate {
        transform: rotate(90deg);
        transition-duration: 0.5s;
    }

    li i.myfade {
        transition-duration: 0.5s;
    }
</style>
<div class="bg-block">
    <div class="search search-bl" id="search">
        <form method="get" id="idf" action="/search">
            <input class="top_input" type="text" placeholder="Tìm kiếm theo tên hoặc mã sản phẩm" name="search"
                   value="">
            <button class="nut_searh" onclick="">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <div class="tit-block">Lọc sản phẩm</div>
    <div method="get" id="filter-form">
        <div class="box-loc">
            <h5 class="click-0">Bộ sưu tập<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
            <div class="tab-pane" id="loc-0">
                <?php
                function showCollection($categories, $parentId = 0, $level = 0)
                {
                    $string = '';

                    foreach ($categories as $category) {
                        if ($category->parent_id == $parentId) {
                            $childs = showCollection($categories, $category->id, $level + 1);

                            if ($childs) {
                                $string .= "<li><label><input value='{$category->id}' name='categories[]' type='checkbox'>{$category->name}</label>{$childs}<i onclick='showchild(this);' class='fa fa-angle-down dis-2 myfade' aria-hidden='true'></i></li>";
                            } else {
                                $string .= "<li><label><input type='checkbox' value='{$category->id}' name='categories[]'>{$category->name}</label></li>";
                            }
                        }
                    }

                    if ($string != '') {
                        if ($level != 0) {
                            $string = "<ul style='display:none;'>{$string}</ul>";
                        } else {
                            $string = "<ul>{$string}</ul>";
                        }
                    }

                    return $string;
                }
                ?>
                <div id="collection">
                    @if (!isset($currentCategory))
                        {!! showCollection($filterCates) !!}
                    @else
                        {!! showCollection($filterCates, $currentCategory->id) !!}
                    @endif
                </div>
                <script>
                    function showchild(e) {
                        var $chil = $(e).closest('li').children('ul');
                        $chil.toggle(300);

                        var $elm = $(e);
                        if ($elm.hasClass('rotate')) {
                            $elm.removeClass('rotate');
                        } else {
                            $elm.addClass('rotate');
                        }
                    }
                </script>
            </div>
            <h5 class="click-1">Giá<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
            <div class="tab-pane" id="loc-1">
                <div class="checkbox">
                    <label><input type="radio" name="price" value="1" {!! $filter['price']->first(function($value)  {
               return $value == '1';
               }) ? ' checked' : '' !!}>Dưới 100 triệu</label>
                </div>
                <div class="checkbox">
                    <label><input type="radio" name="price" value="2" {!! $filter['price']->first(function($value)  {
               return $value == '2';
               }) ? ' checked' : '' !!}>Từ 100 triệu đến 300 triệu</label>
                </div>
                <div class="checkbox">
                    <label><input type="radio" name="price" value="3" {!! $filter['price']->first(function($value)  {
               return $value == '3';
               }) ? ' checked' : '' !!}>Trên 300 triệu</label>
                </div>
            </div>
            <h5 class="click-2">Chất liệu vỏ<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
            <div class="tab-pane" id="loc-2">
                <div class="checkbox">
                    <label><input type="checkbox" name="material[]" value="1" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
               return $value == '1';
               }) ? ' checked' : '' !!}>Thép</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="material[]" value="2" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
               return $value == '2';
               }) ? ' checked' : '' !!}>Vàng</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="material[]" value="3" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
               return $value == '3';
               }) ? ' checked' : '' !!}>Bạch kim</label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="material[]" value="3" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
                       return $value == '4';
                       }) ? ' checked' : '' !!}>Ceramic
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="material[]" value="3" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
                       return $value == '5';
                       }) ? ' checked' : '' !!}>Titanium
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="material[]" value="3" id="defaultCheck1" {!! $filter['material']->first(function($value)  {
                       return $value == '6';
                       }) ? ' checked' : '' !!}>Tinh thể sapphire
                    </label>
                </div>
            </div>
            <h5 class="click-3">Đường kính mặt<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
            <div class="tab-pane tab1" id="loc-3">
                <div class="checkbox">
                    <label><input type="checkbox" name="faceSize[]" value="1" {!! $filter['faceSize']->first(function($value)  {
               return $value == '1';
               }) ? ' checked' : '' !!}>< 38 mm</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="faceSize[]" value="2" {!! $filter['faceSize']->first(function($value)  {
               return $value == '2';
               }) ? ' checked' : '' !!}>38 mm - 41mm</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="faceSize[]" value="3" {!! $filter['faceSize']->first(function($value)  {
               return $value == '3';
               }) ? ' checked' : '' !!}>> 41mm</label>
                </div>
            </div>
            <h5 class="click-4">Chất liệu dây<i class="fa fa-angle-down" aria-hidden="true"></i></h5>
            <div class="tab-pane" id="loc-4">
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="1">Da cá sấu</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="2">Thép không gỉ</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="3">Cao su</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="4">Satin</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="5">Vàng</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="6">Bạch kim</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="7">Ceramic</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cord[]" value="8">Thép và vàng</label>
                </div>
            </div>
        </div>
    </div>
    <code>
    </code>
    <script>
        $('#filter-form input').change(function () {
            $('#filter-form').submit();
        });
        $(".click-0").click(function () {
            $("#loc-0").toggle(300);
        });
        $(".click-1").click(function () {
            $("#loc-1").toggle(300);
        });
        $(".click-2").click(function () {
            $("#loc-2").toggle(300);
        });
        $(".click-3").click(function () {
            $("#loc-3").toggle(300);
        });
        $(".click-4").click(function () {
            $("#loc-4").toggle(300);
        });
        $('#loc-0 input').click(function () {
            LoadMore.loadMore(2);
        });
        $('#loc-1 input').click(function () {
            LoadMore.loadMore(2);
        });
        $('#loc-2 input').click(function () {
            LoadMore.loadMore(2);
        });
        $('#loc-3 input').click(function () {
            LoadMore.loadMore(2);
        });
        $('#loc-4 input').click(function () {
            LoadMore.loadMore(2);
        });
    </script>
</div>