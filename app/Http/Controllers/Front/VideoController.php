<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bcategory;
use App\Models\Video;

class VideoController extends Controller
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
        $videos      = Video::where('status', 1)->orderBy('id', 'desc')
        				->paginate(20);
        return view('watch.video', [
            'video'         => $videos,
        ]);
    }
    // public function category($slug)
    // {
    //     $cateId = last(explode('-', $slug));
    //     $recentBlog = Blog::select('blog.*')->join('blog_bcategory','blog.id','=','blog_bcategory.blog_id')->where('status', 1)->where('blog_bcategory.bcategory_id',$cateId)->orderBy('blog.id', 'desc')->first();
    //     $blogs      = Blog::select('blog.*')->join('blog_bcategory','blog.id','=','blog_bcategory.blog_id')->where('status', 1)->where('blog_bcategory.bcategory_id',$cateId)->where('blog.id', '<>', $recentBlog->id)->orderBy('blog.id', 'desc')->get();
    //     $category   = Bcategory::where('status', 1)->get();
    //     return view('watch.blog', [
    //         'recentBlog'    => $recentBlog, 
    //         'category'      => $category, 
    //         'blogs'         => $blogs
    //     ]);
    // }
    public function videoDetail($slug)
    {
        $video       = Video::find(last(explode('-', $slug)));
        $video->view++;
        $video->save();  
         $videoRelation = Video::where('id','!=',$video->id)
                                    ->take(8)
                                    ->get();
        return view('watch.videoDetail', [
        	'video'         => $video,
            'videoRelation'         => $videoRelation,
        ]);
    }
}
