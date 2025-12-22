<div id="delete-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
    <div class="modal-dialog modal-md">
        <form method="POST" action="" accept-charset="UTF-8"
              id="delete-form">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title text-uppercase">Xóa danh muc</h4>
                </div>
                <div class="modal-body">
                    <div class="font-red-soft" id="message">{{$deleteMessage}}</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue text-uppercase">Xác nhận</button>
                    <button type="button" data-dismiss="modal" class="btn red-soft uppercase">Hủy bỏ</button>
                </div>
            </div>
        </form>
    </div>
</div>