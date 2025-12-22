<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class GalleryUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $uploadSuccess = [];

            foreach ($image as $value) {
                $name = time().str_random(4).'.'.$value->getClientOriginalExtension();
                $value->move(public_path('/upload/images'), $name);
                $path = '/upload/images/'.$name;

                $newProduct = GalleryImage::create([
                    'link' => $path,
                    'gallery_id' => 0,
                    'alt' => '',
                    'order' => 0,
                    'thumbnail' => 0
                ]);
                array_push($uploadSuccess, $newProduct);

            }


            return response()->json([
                'code' => 200,
                'message' => 'Tải ảnh thành công',
                'data' => [
                    'uploadSuccess' => $uploadSuccess
                ]
            ]);

        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Không thấy ảnh upload',
                'data' => []
            ]);
        }
    }

    public function delete($id)
    {
        $image = GalleryImage::find($id);

        $image->delete();

        return response()->json([
            'code' => 1,
            'message' => 'delete success',
            'data' => [

            ]
        ]);

    }
}
