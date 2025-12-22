<div id="upload-image-modal" class="modal fade" tabindex="-1" data-keyboard="false" style="margin-top: 5%">
    <div class="modal-dialog modal-md">
        <form method="POST" action="" accept-charset="UTF-8"
              id="delete-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title text-uppercase">Tải ảnh lên</h4>
                </div>
                <div class="modal-body">
                    <input type="file" id="image-input">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" onclick="MyUpload.upload()">Upload</button>
                    <button type="button" data-dismiss="modal" class="btn red-soft uppercase">Hủy bỏ</button>
                </div>
            </div>
        </form>
    </div>
</div>