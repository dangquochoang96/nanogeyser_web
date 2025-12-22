MyUpload = {
    data: {
        listImages: [],
        divImage: {},
        modalUpload: $('#upload-image-modal')
    },

    init: function (param) {
        MyUpload.data.listImages = param.listImages;
        MyUpload.data.divImage = param.divImage;


        MyUpload.addListImageToDiv();

    },

    openUpload: function () {
        MyUpload.data.modalUpload.modal('show');
    },

    upload: function () {
        var input = MyUpload.data.modalUpload.find('#image-input');

        var formData = new FormData();

        formData.append('image', input[0].files[0]);
        formData.append('_token', Laravel.token);


        $.ajax({
            url: '/upload/image',
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                MyUpload.data.listImages.push(result.data.imagePath);
                MyUpload.addListImageToDiv();
                MyUpload.data.modalUpload.modal('hide');
                input.val('');
            },
            error: function (result) {

            }
        });
    },

    delete: function (index) {

        MyUpload.data.listImages.splice(index, 1);
        MyUpload.addListImageToDiv();
    },

    addListImageToDiv: function () {
        var liString = '';
        MyUpload.data.listImages.forEach(function (value, index) {
            liString += '<li id="path' + index + '">' +
                '<img src="' + value + '" style="max-height: 80px; max-width: 80px;">' +
                '<input type="hidden" name="my-image[]" value="' + value + '">' +
                '<button data-path="' + value + '" onclick="MyUpload.delete(`' + index + '`)">Xóa ảnh</button>';
            '</li>';
        });

        liString = '<ul>' + liString + ' <li><button type="button" onclick="MyUpload.openUpload()">Thêm ảnh mới</button></li><div class="clearfix"></div></ul>'

        MyUpload.data.divImage.addClass('my-upload-image');
        MyUpload.data.divImage.html(liString);
    }
};


MyImageUpload = {
    data: {
        uploadSuccessData: [],
        idTarget: '',
        idUpload: '',
        targetUploadUrl: '',
        idTable: ''
    },

    init: function (param) {
        MyImageUpload.data.idUpload = param.idUpload;
        MyImageUpload.data.idTable = param.idTable;
        MyImageUpload.data.idTarget = param.idTarget;

        MyImageUpload.data.uploadSuccessData = param.uploadSuccessData;
        this.renderToTable();
        $(MyImageUpload.data.idUpload).change(function () {
            MyImageUpload.onselectImage()
        });
    },

    onselectImage: function () {
        console.log('select image');
        MyImageUpload.uploadImage();
    },

    uploadImage: function () {
        var formData = new FormData;

        var images = $(MyImageUpload.data.idUpload)[0].files;

        var ins = images.length;

        formData.append('_token', Laravel.token);
        for (var x = 0; x < ins; x++) {
            formData.append('images[]', images[x]);
        }


        $.ajax({
            url: '/upload/image',
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                MyImageUpload.uploadSuccess(result);
            },
            error: function (result) {

            }
        });
    },

    uploadSuccess: function (data) {
        /***
         * add to table
         */
        console.log(data);
        data.data.uploadSuccess.forEach(function (value) {
            MyImageUpload.data.uploadSuccessData.push(value);
        });
        this.renderToTable();


    },
    uploadError: function () {

    },


    renderToTable: function () {
        var stringTable = '';
        MyImageUpload.data.uploadSuccessData.forEach(function (value, index) {

            var thumbChecked = '';
            if (value.thumbnail == 1) {
                thumbChecked = ' checked';
            } else {
                thumbChecked = '';
            }
            stringTable += '<tr>' +
                '<td>' +
                ' <a href="" class="fancybox-button"' +
                'data-rel="fancybox-button">' +
                '<img class="img-responsive" src="' + value.link + '" >' +
                '</a>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" value="' + value.alt + '" onchange="MyImageUpload.onchangeLabel(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="number" class="form-control" value="' + value.order + '" onchange="MyImageUpload.onChangeOrder(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="radio" onchange="MyImageUpload.onChangeThumbnail(' + value.id + ', this)"' + thumbChecked + '>' +
                ' <td>' +
                '<a onclick="MyImageUpload.onRemoveImage(' + value.id + ')" class="btn default btn-sm">' +
                '<i class="fa fa-times"></i> Remove </a>' +
                '</td>' +
                '</tr>';
        });

        $(MyImageUpload.data.idTable + ' tbody').html(stringTable);
        this.renderToTarget();
    },

    renderToTarget: function () {
        $(this.data.idTarget).val(JSON.stringify(this.data.uploadSuccessData));
    },

    onChangeThumbnail: function (id, elm) {
        console.log(elm);
        MyImageUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                MyImageUpload.data.uploadSuccessData[index].thumbnail = 1;
            } else {
                MyImageUpload.data.uploadSuccessData[index].thumbnail = 0;
            }
        });

        this.renderToTable();
    },

    onChangeOrder: function (id, elm) {
        MyImageUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                MyImageUpload.data.uploadSuccessData[index].order = elm.value;
            }
        });

        this.renderToTable();
    },

    onchangeLabel: function (id, elm) {

        MyImageUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                MyImageUpload.data.uploadSuccessData[index].alt = elm.value;
            }
        });

        this.renderToTable();
    },

    onRemoveImage: function (id) {
        console.log(id);
        MyImageUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                MyImageUpload.data.uploadSuccessData.splice(index, 1);
            }
        });

        $.ajax({
            url: '/upload/image/' + id + '/delete',
            type: 'delete',
            data: {
                _token: Laravel.token
            },
            dataType: 'json',
            success: function (result) {
                console.log(result)
            }
        })

        this.renderToTable();

    }
};
GalleryUpload = {
    data: {
        uploadSuccessData: [],
        idTarget: '',
        idUpload: '',
        targetUploadUrl: '',
        idTable: ''
    },

    init: function (param) {
        GalleryUpload.data.idUpload = param.idUpload;
        GalleryUpload.data.idTable = param.idTable;
        GalleryUpload.data.idTarget = param.idTarget;

        GalleryUpload.data.uploadSuccessData = param.uploadSuccessData;
        this.renderToTable();
        $(GalleryUpload.data.idUpload).change(function () {
            GalleryUpload.onselectImage()
        });
    },

    onselectImage: function () {
        console.log('select image');
        GalleryUpload.uploadImage();
    },

    uploadImage: function () {
        var formData = new FormData;

        var images = $(GalleryUpload.data.idUpload)[0].files;

        var ins = images.length;

        formData.append('_token', Laravel.token);
        for (var x = 0; x < ins; x++) {
            formData.append('images[]', images[x]);
        }


        $.ajax({
            url: '/upload/gallery',
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                GalleryUpload.uploadSuccess(result);
            },
            error: function (result) {

            }
        });
    },

    uploadSuccess: function (data) {
        /***
         * add to table
         */
        console.log(data);
        data.data.uploadSuccess.forEach(function (value) {
            GalleryUpload.data.uploadSuccessData.push(value);
        });
        this.renderToTable();


    },
    uploadError: function () {

    },


    renderToTable: function () {
        var stringTable = '';
        GalleryUpload.data.uploadSuccessData.forEach(function (value, index) {

            var thumbChecked = '';
            if (value.thumbnail == 1) {
                thumbChecked = ' checked';
            } else {
                thumbChecked = '';
            }
            stringTable += '<tr>' +
                '<td>' +
                ' <a href="" class="fancybox-button"' +
                'data-rel="fancybox-button">' +
                '<img class="img-responsive" src="' + value.link + '" >' +
                '</a>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" value="' + value.alt + '" onchange="GalleryUpload.onchangeLabel(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="number" class="form-control" value="' + value.order + '" onchange="GalleryUpload.onChangeOrder(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="radio" onchange="GalleryUpload.onChangeThumbnail(' + value.id + ', this)"' + thumbChecked + '>' +
                ' <td>' +
                '<a onclick="GalleryUpload.onRemoveImage(' + value.id + ')" class="btn default btn-sm">' +
                '<i class="fa fa-times"></i> Remove </a>' +
                '</td>' +
                '</tr>';
        });

        $(GalleryUpload.data.idTable + ' tbody').html(stringTable);
        this.renderToTarget();
    },

    renderToTarget: function () {
        $(this.data.idTarget).val(JSON.stringify(this.data.uploadSuccessData));
    },

    onChangeThumbnail: function (id, elm) {
        console.log(elm);
        GalleryUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                GalleryUpload.data.uploadSuccessData[index].thumbnail = 1;
            } else {
                GalleryUpload.data.uploadSuccessData[index].thumbnail = 0;
            }
        });

        this.renderToTable();
    },

    onChangeOrder: function (id, elm) {
        GalleryUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                GalleryUpload.data.uploadSuccessData[index].order = elm.value;
            }
        });

        this.renderToTable();
    },

    onchangeLabel: function (id, elm) {

        GalleryUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                GalleryUpload.data.uploadSuccessData[index].alt = elm.value;
            }
        });

        this.renderToTable();
    },

    onRemoveImage: function (id) {
        console.log(id);
        GalleryUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                GalleryUpload.data.uploadSuccessData.splice(index, 1);
            }
        });

        $.ajax({
            url: '/upload/gallery/' + id + '/delete',
            type: 'delete',
            data: {
                _token: Laravel.token
            },
            dataType: 'json',
            success: function (result) {
                console.log(result)
            }
        })

        this.renderToTable();

    }
};

CertificationUpload = {
    data: {
        uploadSuccessData: [],
        idTarget: '',
        idUpload: '',
        targetUploadUrl: '',
        idTable: ''
    },

    init: function (param) {
        CertificationUpload.data.idUpload = param.idUpload;
        CertificationUpload.data.idTable = param.idTable;
        CertificationUpload.data.idTarget = param.idTarget;

        CertificationUpload.data.uploadSuccessData = param.uploadSuccessData;
        this.renderToTable();
        $(CertificationUpload.data.idUpload).change(function () {
            CertificationUpload.onselectImage()
        });
    },

    onselectImage: function () {
        console.log('select image');
        CertificationUpload.uploadImage();
    },

    uploadImage: function () {
        var formData = new FormData;

        var images = $(CertificationUpload.data.idUpload)[0].files;

        var ins = images.length;

        formData.append('_token', Laravel.token);
        for (var x = 0; x < ins; x++) {
            formData.append('images[]', images[x]);
        }


        $.ajax({
            url: '/upload/certification',
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                CertificationUpload.uploadSuccess(result);
            },
            error: function (result) {

            }
        });
    },

    uploadSuccess: function (data) {
        /***
         * add to table
         */
        console.log(data);
        data.data.uploadSuccess.forEach(function (value) {
            CertificationUpload.data.uploadSuccessData.push(value);
        });
        this.renderToTable();


    },
    uploadError: function () {

    },


    renderToTable: function () {
        var stringTable = '';
        CertificationUpload.data.uploadSuccessData.forEach(function (value, index) {

            var thumbChecked = '';
            if (value.thumbnail == 1) {
                thumbChecked = ' checked';
            } else {
                thumbChecked = '';
            }
            stringTable += '<tr>' +
                '<td>' +
                ' <a href="" class="fancybox-button"' +
                'data-rel="fancybox-button">' +
                '<img class="img-responsive" src="' + value.link + '" >' +
                '</a>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" value="' + value.alt + '" onchange="CertificationUpload.onchangeLabel(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="number" class="form-control" value="' + value.order + '" onchange="CertificationUpload.onChangeOrder(' + value.id + ', this)">' +
                '</td>' +
                '<td>' +
                '<input type="radio" onchange="CertificationUpload.onChangeThumbnail(' + value.id + ', this)"' + thumbChecked + '>' +
                ' <td>' +
                '<a onclick="CertificationUpload.onRemoveImage(' + value.id + ')" class="btn default btn-sm">' +
                '<i class="fa fa-times"></i> Remove </a>' +
                '</td>' +
                '</tr>';
        });

        $(CertificationUpload.data.idTable + ' tbody').html(stringTable);
        this.renderToTarget();
    },

    renderToTarget: function () {
        $(this.data.idTarget).val(JSON.stringify(this.data.uploadSuccessData));
    },

    onChangeThumbnail: function (id, elm) {
        console.log(elm);
        CertificationUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                CertificationUpload.data.uploadSuccessData[index].thumbnail = 1;
            } else {
                CertificationUpload.data.uploadSuccessData[index].thumbnail = 0;
            }
        });

        this.renderToTable();
    },

    onChangeOrder: function (id, elm) {
        CertificationUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                CertificationUpload.data.uploadSuccessData[index].order = elm.value;
            }
        });

        this.renderToTable();
    },

    onchangeLabel: function (id, elm) {

        CertificationUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                CertificationUpload.data.uploadSuccessData[index].alt = elm.value;
            }
        });

        this.renderToTable();
    },

    onRemoveImage: function (id) {
        console.log(id);
        CertificationUpload.data.uploadSuccessData.forEach(function (value, index) {
            if (value.id == id) {
                CertificationUpload.data.uploadSuccessData.splice(index, 1);
            }
        });

        $.ajax({
            url: '/upload/certification/' + id + '/delete',
            type: 'delete',
            data: {
                _token: Laravel.token
            },
            dataType: 'json',
            success: function (result) {
                console.log(result)
            }
        })

        this.renderToTable();

    }
};