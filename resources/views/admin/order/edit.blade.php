@extends('layouts.admin')
@section('head')
    <link href="{{ asset('quantri/theme/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"/>
@endsection
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
                <a href="{{route('orders.index') }}">Danh sách Đơn hàng</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{URL::current()}}">Thông tin đơn hàng</a>
            </li>
        </ul>
        <a href="{{ URL::action('Admin\IndexController@index') }}" class="btn default btn-sm uppercase pull-right">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>
    <div id="alerts" class="note" style="display: none;"></div>
    <div class="portlet light">
        <div class="portlet-body">
            <form method="POST" action="{{route('orders.update', ['id' => $order->id])}}" accept-charset="UTF-8"
                  id="add-form"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase"> Thông khách hàng</span>
                    </div>
                </div>
                <div class="form-body row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tên</label>
                                <div class="form-control">{{ $order->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Số điện thoại</label>
                                <div class="form-control">{{ $order->phone }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ</label>
                                <div class="form-control">{{ $order->address }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Tỉnh, thành phố</label>
                                <div class="form-control">{{ $order->province }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Quận, huyện</label>
                                <div class="form-control">{{ $order->district }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Phường, xã</label>
                                <div class="form-control">{{ $order->ward }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase"> Thông tin đơn hàng </span>
                    </div>
                </div>
                <div class="form-body row">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col" class="col-name">Số lượng sản phẩm</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Hình thức thanh toán</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>
                                {{ $order->total }}
                            </td>
                            <td>{{number_format($order->total_price,0,".",",")}} đ</td>
                            <td>{{ $order->payment_type }}</td>
                          </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Hình ảnh sản phẩm</th>
                            <th scope="col" class="col-name">Tên sản phẩm</th>
                            <th scope="col">Số tiền</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $count_cart = 0;
                            $total_price = 0;
                        ?> 
                        @foreach ($order->details as $item)
                          <tr>
                            <td>
                              <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                              </div>
                            </td>
                            <td><img style="width: 150px;" src="{{ $item->product_image }}" alt="" class="img-responsive"></td>
                            <td>{{ $item->product_name }}</td>
                            <td>
                                {{number_format($item->price,0,".",",")}} đ
                            </td>
                            <td>
                                {{ $item->number }}
                            </td>
                            <td>{{number_format($item->price*$item->number,0,".",",")}} đ</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
                <div class="form-actions">
                    <!-- <button type="submit" class="btn blue uppercase">Lưu chỉnh sửa</button> -->
                    <a href="{{ URL::previous() }}" class="btn red-soft uppercase">Quay lại</a>
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
    <script src="{{ asset('quantri/theme/assets/global/plugins/icheck/icheck.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('quantri/theme/assets/global/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('js/my.js') }}"></script>
    <link href="{{asset('css/my.css')}}" rel="stylesheet" type="text/css"/>
@endsection