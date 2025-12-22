<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certification;
use App\Models\CertificationImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request      Request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Certification $certificationModel)
    {
        $certificationsQ = $certificationModel->with('certificationImages');
        if ($request->get('name')) {
            $c = $request->get('name');
            $certificationsQ = $certificationsQ->where('name', 'like', "%$c%");
        }
        $certifications = $certificationsQ->orderBy('id', 'desc')->paginate(50);

        return view('admin.certification.list', [
            'certifications'      => $certifications,
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
        return view('admin.certification.add', []);
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
        try {
            $newCertification = Certification::create([
                "name"          => $request->input('name', ''),
                "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
                'meta'          => $request->input('meta', ''),
                "description"   => $request->input('description'),
                "keyword"       => $request->input('keyword'),
                "status"        => $request->input('status'),
            ]);

            $listImages = json_decode($request->input('data-images', '{}'));
            foreach ($listImages as $value) {
                $extend = '.' . last(explode('.', $value->link));
                $image = CertificationImages::find($value->id);
                if ($value->alt == '') {
                    $image->alt = str_slug($newCertification->slug);
                } else {
                    $image->alt = $value->alt;
                }
                copy(
                    public_path($image->link),
                    public_path('certification_images/' . str_slug($image->alt) . '-' . $image->id . $extend)
                );
                $image->order       = $value->order;
                $image->thumbnail   = $value->thumbnail;
                $image->link        = '/certification_images/' . str_slug($image->alt) . '-' . $image->id . $extend;
                $image->certification_id  = $newCertification->id;
                $image->save();
            }
            return redirect()->route('certifications.index')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        $certification    = Certification::find($id);
        return view('admin.certification.edit', [
            'certification'       => $certification,
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
        $newCertification = Certification::find($id);
        $newCertification->fill([
            "name"          => $request->input('name', ''),
            "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
            'meta'          => $request->input('meta', ''),
            "description"   => $request->input('description'),
            "keyword"       => $request->input('keyword'),
            "status"        => $request->input('status'),
        ]);
        $newCertification->save();
        $listLink = [];
        $listImages = json_decode($request->input('data-images', '{}'));
        foreach ($listImages as $value) {
            $extend = '.' . last(explode('.', $value->link));
            $image = CertificationImages::find($value->id);
            if ($value->alt == '') {
                $image->alt = str_slug($newCertification->slug);
            } else {
                $image->alt = $value->alt;
            }
            copy(
                public_path($image->link),
                public_path('certification_images/' . str_slug($image->alt) . '-' . $image->id . $extend)
            );
            $image->order       = $value->order;
            $image->thumbnail   = $value->thumbnail;
            $image->link        = '/certification_images/' . str_slug($image->alt) . '-' . $image->id . $extend;
            $image->certification_id  = $newCertification->id;
            $image->save();
        }

        return redirect()->route('certifications.index')->with('success', 'Lưu thành công!');
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
        $certification = Certification::find($id);
        $certification->delete();
        return redirect()->back()->with('success', 'Xoá thành công!');
    }
}
