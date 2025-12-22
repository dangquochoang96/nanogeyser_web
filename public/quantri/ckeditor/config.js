/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.language = 'vi';
    // config.uiColor = '#AADC6E';
    //config.extraPlugins = 'svgedit';
    config.skin = 'office2013';

    config.allowedContent = true;
    // config.extraPlugins = 'lightbox';
    config.protectedSource.push(/<i[^>]*><\/i>/g);
    config.filebrowserBrowseUrl = '/quantri/ckfinder/ckfinder.html';
    config.filebrowserUploadUrl = '/quantri/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserWindowWidth = '1000';
    config.filebrowserWindowHeight = '700';
    config.image_prefillDimensions = false;
    config.resize_maxHeight = 2048; // max resize height
    config.resize_maxWidth = 3048; // max resize width

    // config.filebrowserBrowseUrl = '/assets/js/ckfinder/ckfinder.html';
    //
    // config.filebrowserImageBrowseUrl = '/assets/js/ckfinder/ckfinder.html?type=Images';
    //
    // config.filebrowserFlashBrowseUrl = '/assets/js/ckfinder/ckfinder.html?type=Flash';
    //
    // config.filebrowserUploadUrl = '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    //
    // config.filebrowserImageUploadUrl = '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    //
    // config.filebrowserFlashUploadUrl = '/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
