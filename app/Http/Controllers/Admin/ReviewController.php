<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product\ProductCategory;
use Validator;
use ImageUpload;

class ReviewController extends Controller
{
    public function list(Request $request){
    	$query = Review::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['reviews'] = $query->paginate(30);
    	return view('admin.review.list',$data);
    }

    public function add(Request $request) {
        $response = [];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des' 		=> 'required|min:20',
                            ], [
                        'txt-name.required' 	=> 'Tên người review không được để trống',
                        'txt-name.min'          => 'Tên người review quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min' 			=> 'Mô tả quá ngắn'
                            ]
            );
            if (!$validator->fails()) {
                try {
                	$review           	= new Review();
                    $review->name	 	= trim($request->input('txt-name'));
                    $review->des      	= $request->input('txt-des');
                    $review->address        = $request->input('txt-address');
                    $review->order 		= $request->input('txt-order');
                    $review->status 		= $request->input('rd-status');
                    $review->created_at	= time();
                    if ($request->has('txt-img-type')) {
                        if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                            $file       = $request->file('file-img')->getClientOriginalName();
                            $filename   = pathinfo($file, PATHINFO_FILENAME);
                            // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                            $name = rand(0,10). time().'-'. str_slug($filename,'-');
                            $review->image = ImageUpload::image($request->file('file-img'), $name);
                        } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                            $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                            $review->image = ImageUpload::image($request->input('txt-img'), md5($name));
                        }
                    }
                    try {
                        $review->save();  
                        return redirect()->action('Admin\ReviewController@list')->with('success', 'Thêm Review "' . $review->name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\ReviewController@add')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\ReviewController@add')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\ReviewController@add')->withInput()->with('error', $validator->errors()->first());
            }
        }
        return view('admin.review.add', $response);
    }

    public function edit($review_id, Request $request) {
        try {
            $review = Review::find($review_id);
            if (!empty($review)) {
                $response = [
                    'title' => "Sửa danh mục " . $review->name,
                    'review' 	=> $review
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des' 		=> 'required|min:20',
                            ], [
                        'txt-name.required' 	=> 'Tên Review không được để trống',
                        'txt-name.min'          => 'Tên Review quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min' 			=> 'Mô tả quá ngắn'
                        ]
                    );
                    if (!$validator->fails()) {
	                    $review->name	 	= trim($request->input('txt-name'));
	                    $review->des      	= $request->input('txt-des');
                        $review->address        = $request->input('txt-address');
	                    $review->order 		= $request->input('txt-order');
	                    $review->status 		= $request->input('rd-status');
                        if ($request->has('txt-img-type')) {
                            if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                                $file       = $request->file('file-img')->getClientOriginalName();
                                $filename   = pathinfo($file, PATHINFO_FILENAME);
                                // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                                $name = rand(0,10). time().'-'. str_slug($filename,'-');
                                $review->image = ImageUpload::image($request->file('file-img'), $name);
                            } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                                $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                                $review->image = ImageUpload::image($request->input('txt-img'), md5($name));
                            }
                        }
                        try {
                            $review->save();
                            return redirect()->action('Admin\ReviewController@list', ['id' => $review_id])->with('success', 'Sửa review "' . $review->name . '" thành công');
                        } catch (\Exception $ex) {
                            return redirect()->action('Admin\ReviewController@edit', ['id' => $review_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\ReviewController@edit', ['id' => $review_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
        		$response['categories'] = ProductCategory::where('status',1)->get();
                return view('admin.review.edit', $response);
            } else {
                return redirect()->action('Admin\ReviewController@list')->with('error', 'Reviews không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\ReviewController@list')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function del(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txt-uid' => 'required|alpha_num',
                        ], [
                    'txt-uid.required' 	=> 'ID không hợp lệ',
                    'txt-uid.alpha_num' => 'ID không hợp lệ',
                        ]
        );
        if (!$validator->fails()) {
            try {
                $data = Review::where('id', $request->input('txt-uid'))->first();
                if (!empty($data)) {
                    try {    	
                        $name = $data->name;
                        $data->delete();
                        return redirect()->back()->with('success', 'Xóa Review "' . $name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Review không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
