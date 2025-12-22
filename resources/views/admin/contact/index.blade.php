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
                <a href="#">Danh sách liên hệ</a>
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
                <span class="caption-subject bold uppercase"> Danh sách liên hệ</span>
            </div>
            <div class="actions">

            </div>
        </div>
        <div class="portlet-body">
            @if (count($contacts))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover td-middle">
                        <thead>
                        <tr>
                            <th style="width:52px;" class="text-center">STT</th>
                            <th style="width: 300px;" class="text-center">Họ tên</th>
                            <th style="width: 300px;" class="text-center">Email/Phone</th>
                            <th class="text-center">Nội dung</th>
                            <th style="width: 100px;" class="text-center">Ngày tạo</th>
                            <th style="width: 100px;" class="text-center">Loại</th>
                            <th style="width: 150px;" class="text-center">Tình trạng xử lý</th>
                            <th style="width: 150px;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count = ($contacts->currentpage() - 1) * $contacts->perpage() + 1;  ?>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }} / {{ $contact->phone }}</td>
                                <td>{{ $contact->content }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    @if ($contact->type == 1)
                                    <span style="color:blue">contact</span>
                                    @else
                                    <span style="color:red">event</span>                                    
                                    @endif
                                </td>
                                <td>
                                    <input class="form-check-input" type="checkbox" @if($contact->is_check == 1) checked @endif value="{{ $contact->id }}">
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm my-delete-btn"
                                        data-action="{{route('contact.destroy', ['id' => $contact->id])}}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {!!  $contacts->appends(Request::all())->links() !!}
                </div>
            @else
                <h3 class="text-center">Không có dữ liệu</h3>
            @endif
            <div class="text-right">
            </div>
        </div>
    </div>
    @include('admin.myVendor.deleteModal', [
    'deleteMessage' => 'Bạn có muốn xóa dữ liệu này'])

@endsection



@section('script')
    <script>
        $('.my-delete-btn').click(function () {
            $('#delete-modal').modal('show');
            $('#delete-modal #delete-form').attr('action', $(this).data('action'));
        });
        $(document).ready(function () {
            $('.form-check-input').change(function(){
                $.ajax({
                    url: '{{ URL::action("Admin\ContactController@check")}}',
                    type: 'post',
                    data: {
                        "id": $(this).val(), 
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if(response.code == 200){
                        }
                    }
                });
            });
        });
    </script>
@endsection