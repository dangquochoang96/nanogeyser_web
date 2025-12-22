<?php
namespace App\Http\Controllers\Admin;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request      Request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Gallery $galleryModel)
    {
        $gallerysQ = $galleryModel->with('galleryImages');
        if ($request->get('name')) {
            $c = $request->get('name');
            $gallerysQ = $gallerysQ->where('name', 'like', "%$c%");
        }
        $gallerys = $gallerysQ->orderBy('id', 'desc')->paginate(50);

        return view('admin.gallery.list', [
            'gallerys'      => $gallerys,
            'filter' => [
                'name'          => $request->get('name', ''),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.add', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => 'required|string|min:3|max:255',
            "slug" => 'string|min:3|max:255|nullable'
        ], []);
        if ($validate->fails()) {
            return redirect()->back()->with('success', $validate->errors()->first());
        }
        $newGallery = Gallery::create([
            "name"          => $request->input('name', ''),
            "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
            'meta'          => $request->input('meta', ''),
            "description"   => $request->input('description'),
            "keyword"       => $request->input('keyword'),
            "status"        => $request->input('status'),
        ]);
        $listLink = [];
        $listImages = json_decode($request->input('data-images', '{}'));
        foreach ($listImages as $value) {
            $extend = '.'.last(explode('.', $value->link));
            $image = GalleryImage::find($value->id);
            if ($value->alt == '') {
                $image->alt = str_slug($newGallery->slug);
            } else {
                $image->alt = $value->alt;
            }
            copy(
                public_path($image->link),
                public_path('gallery_images/'.str_slug($image->alt).'-'.$image->id.$extend)
            );
            $image->order       = $value->order;
            $image->thumbnail   = $value->thumbnail;
            $image->link        = '/gallery_images/'.str_slug($image->alt).'-'.$image->id.$extend;
            $image->gallery_id  = $newGallery->id;
            $image->save();
        }
        return redirect()->route('gallerys.index')->with('success', 'Thêm thành công!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery    = Gallery::find($id);    
        return view('admin.gallery.edit', [
            'gallery'       => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "name" => 'required|string|min:3|max:255',
            "slug" => 'string|min:3|max:255|nullable'
        ], []);


        if ($validate->fails()) {
            return redirect()->back()->with('success', $validate->errors()->first());
        }
        $newGallery = Gallery::find($id);
        $newGallery->fill([
            "name"          => $request->input('name', ''),
            "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
            'meta'          => $request->input('meta', ''),
            "description"   => $request->input('description'),
            "keyword"       => $request->input('keyword'),
            "status"        => $request->input('status'),
        ]);
        $newGallery->save();
        $listLink = [];
        $listImages = json_decode($request->input('data-images', '{}'));
        foreach ($listImages as $value) {
            $extend = '.'.last(explode('.', $value->link));
            $image = GalleryImage::find($value->id);
            if ($value->alt == '') {
                $image->alt = str_slug($newGallery->slug);
            } else {
                $image->alt = $value->alt;
            }
            copy(
                public_path($image->link),
                public_path('gallery_images/'.str_slug($image->alt).'-'.$image->id.$extend)
            );
            $image->order       = $value->order;
            $image->thumbnail   = $value->thumbnail;
            $image->link        = '/gallery_images/'.str_slug($image->alt).'-'.$image->id.$extend;
            $image->gallery_id  = $newGallery->id;
            $image->save();
        }

        return redirect()->route('gallerys.index')->with('success', 'Lưu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Xoá thành công!');
    }
}
