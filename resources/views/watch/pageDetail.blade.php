@extends('watch.layout.master')
@section('title', $page->name)
@section('keywords', $page->keywords)
@section('description', $page->metades)
@section('fb_image', env('APP_URL').$page->image ?? '') 
@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{URL::current()}}">{{$page->name}}</a></li>
        </ul>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 block-l">
                
                <div class="box-block">
                    <!--Danh muc sp con-->
                    <div class="dm-con bg-block">
                        <div class="tit-block"><span>Danh mục sản phẩm</span></div>
                        @php
                            function showCategories($_categories, $parentId = 0) {
                            $string = '';

                            foreach ($_categories as  $category) {
                                if ($category->parent_id == $parentId) {
                                    $string .= '<li>';
                                    $string .= '<a href="'.url($category->slug).'"><i class="fas fa-angle-right show-mn" aria-hidden="true"></i>'.$category->name.'</a>';
                                    $string .= showCategories($_categories, $category->id);
                                    $string .= '</li>';
                                }
                            }

                            if ($string) {
                                $string = '<ul class="dmsp-menu ul-none">'.$string.'</ul><i class="fas fa-angle-down show-mn" aria-hidden="true"></i>';
                            }


                            return $string;
                            }

                        @endphp
                        
                        <div class="block-dmsp">
                                {!! showCategories($_categories) !!}
                        </div>
                        <script type="text/javascript">
                            $(".show-mn").click(function(){
                              $( this ).parent().children(".dmsp-menu").toggle(300);
                            });
                        </script>
                    </div>
                    <!--End Danh muc sp con-->
                    <!--Tin tuc random-->
                    <div class="news-bl bg-block">
                        <div class="tit-block"><span>Tin nổi bật</span></div>
                        <ul class="ul-bl ul-news ul-none">
                            @foreach($blogs as $item)
                                <li>
                                    <div class="w-30">
                                        <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                           title="{{$item->name}}">
                                            <img src="{{$item->image}}" class="img-responsive"></a>
                                    </div>
                                    <div class="w-70">
                                        <h3>
                                            <a href="{{route('blog-detail', ['slug' => str_slug($item->name.'-'.$item->id)])}}"
                                               title="{{$item->name}}">
                                                {{$item->name}} </a>
                                        </h3>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--End Tin tuc random-->
                    <!--San pham ban chay-->
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h1 class="tit-home tit-l" style="margin-top: 0">{{$page->name}}</h1>
                <div class="main-post">
                    {!! $page->des !!}
                </div>
            </div>
        </div>
    </div>
    @include('watch.layout.map')
@stop