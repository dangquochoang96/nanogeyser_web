<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Blog;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Product\ProductCategory;
use App\Models\Video;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        session_start();
        $_menu = Menu::orderBy('order', 'asc')->where('status',1)->get();
        $categories = ProductCategory::where('status',1)->get();
        $setting = Setting::find(1);
        $nkBlogs = Blog::select('name','id','updated_at','created_at')->orderBy('updated_at','DESC')->limit(3)->get();
        $nkvideos = Video::orderBy('order', 'DESC')->where('status',1)->inRandomOrder()->limit(6)->get();
        View::share('_nkBlogs', $nkBlogs);
        View::share('_menu', $_menu);
        View::share('_categories', $categories);
        View::share('_setting', $setting);
        View::share('_videos', $nkvideos);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
