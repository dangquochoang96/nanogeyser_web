$('.nk-image').change(function () {
    var files = $('.nk-image').prop('files');
    if (files.length) {
        var regex_type = /^(image\/jpeg|image\/png|image\/gif)$/;
        $.each(files, function (key, file) {
            if (regex_type.test(file.type)) {
                var fr = new FileReader();
                fr.readAsDataURL(file);
                fr.onload = function (event) {
                    $('#img-img').attr('src', event.target.result);
                    $('.txt-img-type').val('file');
                    $('#img-modal').find('input[name="txt-img"]').val("");
                    $('#img-modal').modal('hide');
                };
            } else {
                $('#img-img').attr('src', $('#img-img').data('old'));
                $('.txt-img-type').val('none');
            }
        });
    } else {
        $('#img-img').attr('src', $('#img-img').data('old'));
        $('.txt-img-type').val('none');
    }
});
$('#btn-img').click(function () {
    var url = $('#img-modal').find('input[name="txt-img"]').val();
    var regex_url = /(https?:\/\/(.*)\.(png|jpg|gif))/i;
    if (url !== "" && regex_url.test(url)) {
        $('#img-img').attr('src', url);
        $('.txt-img-type').val('url');
        $('.file-img').val(null);
    }
    $('#img-modal').modal('hide');
});
$('.nk-image2').change(function () {
    var files = $('.nk-image2').prop('files');
    if (files.length) {
        var regex_type = /^(image\/jpeg|image\/png|image\/gif)$/;
        $.each(files, function (key, file) {
            if (regex_type.test(file.type)) {
                var fr = new FileReader();
                fr.readAsDataURL(file);
                fr.onload = function (event) {
                    $('#img-img2').attr('src', event.target.result);
                    $('.txt-img-type2').val('file');
                    $('#img-modal2').find('input[name="txt-img2"]').val("");
                    $('#img-modal2').modal('hide');
                };
            } else {
                $('#img-img2').attr('src', $('#img-img2').data('old'));
                $('.txt-img-type2').val('none');
            }
        });
    } else {
        $('#img-img2').attr('src', $('#img-img2').data('old'));
        $('.txt-img-type2').val('none');
    }
});
$('#btn-img2').click(function () {
    var url = $('#img-modal2').find('input[name="txt-img2"]').val();
    var regex_url = /(https?:\/\/(.*)\.(png|jpg|gif))/i;
    if (url !== "" && regex_url.test(url)) {
        $('#img-img2').attr('src', url);
        $('.txt-img-type2').val('url');
        $('.file-img2').val(null);
    }
    $('#img-modal2').modal('hide');
});