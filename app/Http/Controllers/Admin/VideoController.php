<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Product\ProductCategory;
use Validator;
use ImageUpload;

class VideoController extends Controller
{
    public function listVideo(Request $request){
    	$query = Video::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['videos'] = $query->paginate(30);
        // dd($data['videos']);
        // foreach ($data['videos'] as $key => $v) {
        //     foreach ($v->Category as $k2 => $v2) {
        //         dd($v2->name);
        //     }
        //     dd($v->Category);
        // }
        // die;
    	return view('admin.video.listVideo',$data);
    }

    public function addVideo(Request $request) {
        $response = [];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des' 		=> 'required|min:20',
                        'txt-link' 		=> 'required|min:3',
                            ], [
                        'txt-name.required' 	=> 'Tên Video không được để trống',
                        'txt-name.min'          => 'Tên Video quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min' 			=> 'Mô tả quá ngắn',
                        'txt-link.required' 	=> 'Link không hợp lệ',
                        'txt-link.min' 			=> 'Link không hợp lệ'
                            ]
            );
            if (!$validator->fails()) {
                try {
                	$video           	= new Video();
                    $video->name	 	= trim($request->input('txt-name'));
                    $video->des      	= $request->input('txt-des');
                    $video->order 		= $request->input('txt-order');
                    $video->status 		= $request->input('rd-status');
                    $video->show_home 	= $request->input('rd-show_home');
                    $video->link 		= $request->input('txt-link');
                    $video->keywords	= $request->input('txt-keyword');
                    $video->metades  	= $request->input('txt-metades');
                    $video->category  	= json_encode($request->input('sl_category_id'));
                    $video->created_at	= time();
                    if ($request->has('txt-img-type')) {
                        if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                            $file       = $request->file('file-img')->getClientOriginalName();
                            $filename   = pathinfo($file, PATHINFO_FILENAME);
                            // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                            $name = rand(0,10). time().'-'. str_slug($filename,'-');
                            $video->image = ImageUpload::image($request->file('file-img'), $name);
                        } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                            $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                            $video->image = ImageUpload::image($request->input('txt-img'), md5($name));
                        }
                    }
                    try {
                        $video->save();  
                        return redirect()->action('Admin\VideoController@listVideo')->with('success', 'Thêm Video "' . $video->name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\VideoController@addVideo')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\VideoController@addVideo')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\VideoController@addVideo')->withInput()->with('error', $validator->errors()->first());
            }
        }
        $response['categories'] = ProductCategory::where('status',1)->get();
        return view('admin.video.addVideo', $response);
    }

    public function editVideo($video_id, Request $request) {
        try {
            $video = Video::find($video_id);
            if (!empty($video)) {
                $response = [
                    'title' => "Sửa danh mục " . $video->name,
                    'video' 	=> $video
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des' 		=> 'required|min:20',
                        'txt-order' 	=> 'integer',
                        'txt-link' 		=> 'required|min:3',
                            ], [
                        'txt-name.required' 	=> 'Tên Video không được để trống',
                        'txt-name.min'          => 'Tên Video quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min' 			=> 'Mô tả quá ngắn',
                        'txt-order.integer' 	=> 'Thứ tự phải là số',
                        'txt-link.required' 	=> 'Link không hợp lệ',
                        'txt-link.min' 			=> 'Link không hợp lệ'
                        ]
                    );
                    if (!$validator->fails()) {
	                    $video->name	 	= trim($request->input('txt-name'));
	                    $video->des      	= $request->input('txt-des');
	                    $video->order 		= $request->input('txt-order');
	                    $video->status 		= $request->input('rd-status');
	                    $video->show_home 	= $request->input('rd-show_home');
	                    $video->link 		= $request->input('txt-link');
	                    $video->keywords	= $request->input('txt-keyword');
	                    $video->metades  	= $request->input('txt-metades');
	                    $video->category  	= json_encode($request->input('video_category_id'));
                        if ($request->has('txt-img-type')) {
                            if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                                $file       = $request->file('file-img')->getClientOriginalName();
                                $filename   = pathinfo($file, PATHINFO_FILENAME);
                                // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                                $name = rand(0,10). time().'-'. str_slug($filename,'-');
                                $video->image = ImageUpload::image($request->file('file-img'), $name);
                            } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                                $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                                $video->image = ImageUpload::image($request->input('txt-img'), md5($name));
                            }
                        }
                        try {
                            $video->save();
                            return redirect()->action('Admin\VideoController@listVideo', ['id' => $video_id])->with('success', 'Sửa video "' . $video->name . '" thành công');
                        } catch (\Exception $ex) {
                            return redirect()->action('Admin\VideoController@editVideo', ['id' => $video_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\VideoController@editVideo', ['id' => $video_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
        		$response['categories'] = ProductCategory::where('status',1)->get();
                return view('admin.video.editVideo', $response);
            } else {
                return redirect()->action('Admin\VideoController@listVideo')->with('error', 'Videos không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\VideoController@listVideo')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delVideo(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txt-uid' => 'required|alpha_num',
                        ], [
                    'txt-uid.required' 	=> 'ID không hợp lệ',
                    'txt-uid.alpha_num' => 'ID không hợp lệ',
                        ]
        );
        if (!$validator->fails()) {
            try {
                $data = Video::where('id', $request->input('txt-uid'))->first();
                if (!empty($data)) {
                    try {    	
                        $name = $data->name;
                        $data->delete();
                        return redirect()->back()->with('success', 'Xóa Video "' . $name . '" thành công');
                    } catch (\Exception $ex) {
                        echo $ex;die;
                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Video không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
