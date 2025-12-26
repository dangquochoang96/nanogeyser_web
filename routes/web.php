<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('/');
});
Route::get('/.well-known/pki-validation/2CC9800E1191F1B6B3145592319E7363.txt',function(){
    return "745B510CED4C9BFF0F718E3AE22AAB78A44E75361816DBAC792E276BEB474EBE";
});
Route::get('/dang-ky-nhan-qua-mien-phi', 'Front\ContactController@nhanqua');
Route::post('/dang-ky-nhan-qua-mien-phi', 'Front\ContactController@submit');
Route::get('/', 'Front\IndexController@index');
Route::get('/search', 'Front\IndexController@search');
Route::get('/ve-chung-toi', 'Front\IndexController@aboutUs');
Route::get('/lien-he', 'Front\ContactController@index');
Route::post('/gui-lien-he', 'Front\ContactController@contactMe');
Route::post('/subscribe', 'Front\ContactController@subscribe');
Route::post('/add-bills', 'Admin\BillController@store');

Route::get('/blog', 'Front\BlogController@index')->name('blog');
Route::get('/blog/cate/{slug}', 'Front\BlogController@category')->name('blogcate');
Route::get('/blog/search', 'Front\BlogController@search');
Route::get('/blog/{slug}', 'Front\BlogController@blogDetail')->name('blog-detail');
Route::get('/province', 'Front\OrderController@province');
Route::get('/district', 'Front\OrderController@district');
Route::get('/ward', 'Front\OrderController@ward');
Route::get('/cart', 'Front\OrderController@index')->name('gio-hang');
Route::post('/addToCart', 'Front\OrderController@addToCart');
Route::get('/thong-tin-khach-hang', 'Front\OrderController@address');
Route::post('/thong-tin-khach-hang', 'Front\OrderController@saveAddress');
Route::get('/thong-tin-thanh-toan', 'Front\OrderController@payment');
Route::post('/luu-don-hang', 'Front\OrderController@saveOrder');
Route::get('/don-hang-thanh-cong', 'Front\OrderController@success');
Route::post('/xoa-don-hang', 'Front\OrderController@deleteToCart');

Route::get('/video', 'Front\VideoController@index')->name('video');
Route::get('/video/{slug}', 'Front\VideoController@videoDetail')->name('video-detail');
Route::get('/gallery', 'Front\GalleryController@index')->name('gallery');
Route::get('/gallery/{slug}', 'Front\GalleryController@detail')->name('gallery-detail');
Route::get('/certification', 'Front\CertificationController@index')->name('certification');
Route::get('/certification/{slug}', 'Front\CertificationController@detail')->name('certification-detail');

Route::get('/giai-phap-tll', 'Front\SolutionController@index')->name('giai-phap-tll');
Route::get('/giai-phap-combo', 'Front\SolutionController@index')->name('giai-phap-combo');
Route::get('/giai-phap-cao-cap', 'Front\SolutionController@index')->name('giai-phap-cao-cap');
Route::get('/giai-phap-phong-khach', 'Front\SolutionController@index')->name('giai-phap-phong-khach');
Route::get('/giai-phap-phong-bep', 'Front\SolutionController@index')->name('giai-phap-phong-bep');
Route::get('/giai-phap-nha-dan', 'Front\SolutionController@index')->name('giai-phap-nha-dan');

Route::group(['prefix' => 'upload'], function () {
    Route::post('image', 'Admin\ImageUploadController@upload');
    Route::delete('image/{id}/delete', 'Admin\ImageUploadController@delete');

    Route::post('gallery', 'Admin\GalleryUploadController@upload');
    Route::delete('gallery/{id}/delete', 'Admin\GalleryUploadController@delete');

    Route::post('certification', 'Admin\CertificationUploadController@upload');
    Route::delete('certification/{id}/delete', 'Admin\CertificationUploadController@delete');
});

Route::group(['prefix' => '/quan-tri', 'middleware' => ['auth','action']], function () {
    Route::get('/', 'Admin\IndexController@index');
    Route::group(['prefix' => '/nguoi-dung'], function () {
        Route::get('/', 'Admin\UserController@listUsers');
        Route::get('/sua/{id}', 'Admin\UserController@editUser');
        Route::post('/sua/{id}', 'Admin\UserController@editUser');
        Route::get('/them', 'Admin\UserController@addUser');
        Route::post('/them', 'Admin\UserController@addUser');
        Route::post('/xoa', 'Admin\UserController@delUser');
    });
    Route::group(['prefix' => '/blog'], function () {
        Route::group(['prefix' => '/danh-muc'], function () {
            Route::get('/', 'Admin\BlogCategoryController@listCategory');
            Route::get('/sua/{id}', 'Admin\BlogCategoryController@editCategory');
            Route::post('/sua/{id}', 'Admin\BlogCategoryController@editCategory');
            Route::get('/them', 'Admin\BlogCategoryController@addCategory');
            Route::post('/them', 'Admin\BlogCategoryController@addCategory');
            Route::post('/xoa', 'Admin\BlogCategoryController@delCategory');
        });
        Route::group(['prefix' => '/bai-viet'], function () {
            Route::get('/', 'Admin\BlogController@listBlogs');
            Route::get('/sua/{id}', 'Admin\BlogController@editBlog');
            Route::post('/sua/{id}', 'Admin\BlogController@editBlog');
            Route::get('/them', 'Admin\BlogController@addBlog');
            Route::post('/them', 'Admin\BlogController@addBlog');
            Route::post('/xoa', 'Admin\BlogController@delBlog');
        });
    });
    Route::resource('product-categories', 'Admin\Product\ProductCategoryController');
    Route::resource('products', 'Admin\Product\ProductController');
    Route::resource('gallerys', 'Admin\GalleryController');
    Route::resource('certifications', 'Admin\CertificationController');
    Route::resource('sliders', 'Admin\SliderController');
    Route::resource('popups', 'Admin\PopupController');
    Route::resource('orders', 'Admin\OrderController');
    Route::resource('contact', 'Admin\ContactController');
    Route::resource('product-filter', 'Admin\Product\ProductFilterController');

    Route::group(['prefix' => '/page'], function () {
        Route::get('/', 'Admin\PageController@listPage');
        Route::get('/sua/{id}', 'Admin\PageController@editPage');
        Route::post('/sua/{id}', 'Admin\PageController@editPage');
        Route::get('/them', 'Admin\PageController@addPage');
        Route::post('/them', 'Admin\PageController@addPage');
        Route::post('/xoa', 'Admin\PageController@delPage');
    });
    Route::group(['prefix' => '/danh-muc'], function () {
        Route::get('/', 'Admin\MenuController@listMenu');
        Route::get('/sua/{id}', 'Admin\MenuController@editMenu');
        Route::post('/sua/{id}', 'Admin\MenuController@editMenu');
        Route::get('/them', 'Admin\MenuController@addMenu');
        Route::post('/them', 'Admin\MenuController@addMenu');
        Route::post('/xoa', 'Admin\MenuController@delMenu');
    });
    Route::group(['prefix' => '/video'], function () {
        Route::get('/', 'Admin\VideoController@listVideo');
        Route::get('/sua/{id}', 'Admin\VideoController@editVideo');
        Route::post('/sua/{id}', 'Admin\VideoController@editVideo');
        Route::get('/them', 'Admin\VideoController@addVideo');
        Route::post('/them', 'Admin\VideoController@addVideo');
        Route::post('/xoa', 'Admin\VideoController@delVideo');
    });
    Route::group(['prefix' => '/review'], function () {
        Route::get('/', 'Admin\ReviewController@list');
        Route::get('/sua/{id}', 'Admin\ReviewController@edit');
        Route::post('/sua/{id}', 'Admin\ReviewController@edit');
        Route::get('/them', 'Admin\ReviewController@add');
        Route::post('/them', 'Admin\ReviewController@add');
        Route::post('/xoa', 'Admin\ReviewController@del');
    });
    Route::group(['prefix' => '/cai-dat'], function () {
        Route::get('/sua', 'Admin\SettingController@index');
        Route::post('/sua', 'Admin\SettingController@index');
    });
    Route::post('check-contact', 'Admin\ContactController@check');
});
/***
 * product or categories
 */
Route::get('/{slug}', 'Front\IndexController@showBySlug')->name('showBySlug');
