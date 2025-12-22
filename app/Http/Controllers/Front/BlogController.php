<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bcategory;
use App\Models\Video;
use App\Models\Product\Product;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Product\ProductCategory;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories   = Bcategory::where('status', 1)
                                ->where('parent_id',0)
                                ->get();
        $videos = Video::where('status', 1)
                        ->take(3)
                        ->orderBy('id','DESC')
                        ->get();
        $gallery = Gallery::where('status', 1)
                        ->take(4)
                        ->orderBy('id','DESC')
                        ->get();
        return view('watch.blog', [
            'categories'      => $categories, 
            'videos'      => $videos, 
            'gallery'      => $gallery, 
        ]);
    }
    public function category($slug)
    {
        $cateId = last(explode('-', $slug));
        $blogs      = Blog::select('blog.*')->join('blog_bcategory','blog.id','=','blog_bcategory.blog_id')->where('status', 1)->where('blog_bcategory.bcategory_id',$cateId)->orderBy('blog.id', 'desc')->paginate(8);
        $category   = Bcategory::where('status', 1)
                                ->where('id',$cateId)
                                ->first();
        return view('watch.listBlog', [
            'category'      => $category, 
            'blogs'         => $blogs
        ]);
    }
    public function search(Request $request)
    {
        $key    = $request->get('search');
        $blogs      = Blog::select('blog.*')->join('blog_bcategory','blog.id','=','blog_bcategory.blog_id')->where('status', 1)->where('blog.name', 'like',"%$key%")->orderBy('blog.id', 'desc')->get();
        $category   = Bcategory::where('status', 1)->get();
        return view('watch.searchBlog', [
            'category'      => $category, 
            'key'           => $key,
            'blogs'         => $blogs
        ]);
    }
    public function blogDetail($slug)
    {
        $category   = Bcategory::where('status', 1)->get();
        $blog       = Blog::find(last(explode('-', $slug)));
        $blog->view++;
        $blog->save();  
        $recentBlog = Blog::where('id','!=',$blog->id)
                            ->offset(0)
                            ->limit(8)
                            ->get();
        return view('watch.blogDetail', [
            'category'      => $category,
            'blog'      => $blog,
            'recentBlog'      => $recentBlog,
        ]);
    }
}
