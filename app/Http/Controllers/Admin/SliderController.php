<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(10);

        return view('admin.sliders.index', [
            'sliders' => $sliders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create', []);
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
            'image' => 'required|mimes:jpeg,jpg,png,bmp,gif,svg',
        ], [
            'image.required' => 'Hãy chọn 1 ảnh',
            'image.mimes' => 'file up lên phải là định dạng ảnh',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->with('error', $validate->errors()->first());
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('slider/image'), $imageName);

            $newImage = Slider::create([
                'image_link' => '/slider/image/'.$imageName,
                'name' => $request->input('name'),
                'link' => $request->input('link'),
                'text' => $request->input('text'),
                'type' => $request->input('type',1),
            ]);

            return redirect()->route('sliders.index')->with('success', 'Thêm ảnh thành công');
        } else {
            return redirect()->back()->with('error', 'upload không thành công');
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
        $slider = Slider::find($id);

        return view('admin.sliders.edit', [
            'slider' => $slider,
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
            "image" => 'mimes:jpeg,jpg,png,bmp,gif,svg',
        ], [
            'image.image' => 'file up lên phải là định dạng ảnh',
        ]);


        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->with('error', $validate->errors()->first());
        } else {
            $newImage = Slider::find($id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('slider/image'), $imageName);
                $newImage->fill([
                    'image_link' => '/slider/image/'.$imageName,
                    'name' => $request->input('name'),
                    'link' => $request->input('link'),
                    'text' => $request->input('text'),
                    'type' => $request->input('type'),
                ]);
                $newImage->save();
                return redirect()->route('sliders.index')->with('success', 'Chỉnh sửa thành công');
            } else {
                $newImage->fill([
                    'link' => $request->input('link'),
                    'type' => $request->input('type'),
                    'name' => $request->input('name'),
                    'text' => $request->input('text'),
                ]);
                $newImage->save();
                return redirect()->route('sliders.index')->with('success', 'Chỉnh sửa thành công');
            }
        }
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
        $slider = Slider::find($id);

        $slider->delete();


        return redirect()->back()->with('success', 'Xóa ảnh thành công');
    }
}
