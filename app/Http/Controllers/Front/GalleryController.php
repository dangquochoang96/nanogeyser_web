<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
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
        $gallerys      = Gallery::where('status', 1)
                        ->orderBy('id', 'desc')
        				->paginate(12);
        return view('watch.gallery', [
            'gallery'         => $gallerys,
        ]);
    }

    public function detail($slug)
    {
        $gallery = Gallery::find(last(explode('-', $slug)));
        $gallery->view++;
        $gallery->save();
        $galleryRelation = Gallery::where('id','!=',$gallery->id)
                                    ->take(8)
                                    ->get();
        return view('watch.galleryDetail', [
        	'gallery'         => $gallery,
            'galleryRelation' => $galleryRelation,
        ]);
    }
}
