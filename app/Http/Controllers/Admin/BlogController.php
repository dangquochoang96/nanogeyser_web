<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bcategory;
use Carbon\Carbon;
use Validator;
use ImageUpload;

class BlogController extends Controller
{
    public function listBlogs(Request $request){
    	$query = Blog::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['blogs'] = $query->with('category')->paginate(30);
        // dd($data['blogs']);
        // foreach ($data['blogs'] as $key => $v) {
        //     foreach ($v->Category as $k2 => $v2) {
        //         dd($v2->name);
        //     }
        //     dd($v->Category);
        // }
        // die;
    	return view('admin.blog.listBlogs',$data);
    }

    public function addBlog(Request $request) {
        $response = [];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des' 		=> 'required|min:20',
                        'txt-order' 	=> 'integer',
                        'sl-parent' 	=> 'integer',
                            ], [
                        'txt-name.required' 	=> 'Tên Blog không được để trống',
                        'txt-name.min'          => 'Tên Blog quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min' 			=> 'Mô tả quá ngắn',
                        'txt-order.integer' 	=> 'Thứ tự phải là số',
                        'sl-parent.integer' 	=> 'Danh mục cha không hợp lệ'
                            ]
            );
            if (!$validator->fails()) {
            	$blog           = new Blog();
                $blog->name	    = trim($request->input('txt-name'));
                $blog->shortdes = $request->input('txt-shortdes');
                $blog->des      = $request->input('txt-des');
                $blog->order 	= $request->input('txt-order');
                $blog->status 	= $request->input('rd-status');
                $blog->keywords	= $request->input('txt-keyword');
                $blog->metades  = $request->input('txt-metades');
                $blog->view     = $request->input('txt-view') ? $request->input('txt-view') :1000;
                if($request->input('time_view') == ''){
                    $blog->time_view = time();
                }else{
                    $blog->time_view = Carbon::parse($request->input('time_view'));
                }
                $blog->created_at= time();
                if ($request->has('txt-img-type')) {
                    if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                        $file       = $request->file('file-img')->getClientOriginalName();
                        $filename   = pathinfo($file, PATHINFO_FILENAME);
                        // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                        $name = rand(0,10). time().'-'. str_slug($filename,'-');
                        $blog->image = ImageUpload::image($request->file('file-img'), $name);
                    } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                        $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                        $blog->image = ImageUpload::image($request->input('txt-img'), md5($name));
                    }
                }
                $blog->save();
                $blog->category()->sync($request->input('sl-category'));    
                return redirect()->action('Admin\BlogController@listBlogs')->with('success', 'Thêm Blog "' . $blog->name . '" thành công');
            } else {
                return redirect()->action('Admin\BlogController@addBlog')->withInput()->with('error', $validator->errors()->first());
            }
        }
        $response['category'] = Bcategory::where('status',1)->get();
        return view('admin.blog.addBlog', $response);
    }

    public function editBlog($blog_id, Request $request) {
        try {
            $blog = Blog::with('category')->find($blog_id);
            if (!empty($blog)) {
                $response = [
                    'title' => "Sửa danh mục " . $blog->name,
                    'blog' 	=> $blog
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name'      => 'required|min:3',
                        'txt-des'       => 'required|min:20',
                        'txt-order'     => 'integer',
                        'sl-parent'     => 'integer',
                            ], [
                        'txt-name.required'     => 'Tên Blog không được để trống',
                        'txt-name.min'          => 'Tên Blog quá ngắn',
                        'txt-des.required'      => 'Mô tả không được để trống',
                        'txt-des.min'           => 'Mô tả quá ngắn',
                        'txt-order.integer'     => 'Thứ tự phải là số',
                        'sl-parent.integer'     => 'Danh mục cha không hợp lệ'
                            ]
                    );
                    if (!$validator->fails()) {
                        $blog->name     = trim($request->input('txt-name'));
                        $blog->shortdes = $request->input('txt-shortdes');
                        $blog->des      = $request->input('txt-des');
                        $blog->order    = $request->input('txt-order');
                        $blog->status   = $request->input('rd-status');
                        $blog->keywords = $request->input('txt-keyword');
                        $blog->metades  = $request->input('txt-metades');
                        $blog->view     = $request->input('txt-view') ? $request->input('txt-view') :1000;
                        if($request->input('time_view') == ''){
                            $blog->time_view = time();
                        }else{
                            $blog->time_view = Carbon::parse($request->input('time_view'));
                        }
                        if ($request->has('txt-img-type')) {
                            if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                                $file       = $request->file('file-img')->getClientOriginalName();
                                $filename   = pathinfo($file, PATHINFO_FILENAME);
                                // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                                $name = rand(0,10). time().'-'. str_slug($filename,'-');
                                $blog->image = ImageUpload::image($request->file('file-img'), $name);
                            } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                                $name = rand(0,10). time().'-'. str_slug($request->input('txt-img'),'-');
                                $blog->image = ImageUpload::image($request->input('txt-img'), md5($name));
                            }
                        }
                        try {
                            $blog->save();
                            $blog->category()->sync($request->input('sl-category')); 
                            return redirect()->action('Admin\BlogController@listBlogs', ['id' => $blog_id])->with('success', 'Sửa blog "' . $blog->name . '" thành công');
                        } catch (\Exception $ex) {
                            return redirect()->action('Admin\BlogController@editBlog', ['id' => $blog_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\BlogController@editBlog', ['id' => $blog_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                $response['category'] = Bcategory::where('status',1)->get();
                return view('admin.blog.editBlog', $response);
            } else {
                return redirect()->action('Admin\BlogController@listBlogs')->with('error', 'Blogs không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\BlogController@listBlogs')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delBlog(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txt-uid' => 'required|alpha_num',
                        ], [
                    'txt-uid.required' 	=> 'ID không hợp lệ',
                    'txt-uid.alpha_num' => 'ID không hợp lệ',
                        ]
        );
        if (!$validator->fails()) {
            try {
                $data = Blog::where('id', $request->input('txt-uid'))->first();
                if (!empty($data)) {
                    try {  
                    	$data->category()->sync([]);   	
                        $name = $data->name;
                        $data->delete();
                        return redirect()->back()->with('success', 'Xóa bài viết "' . $name . '" thành công');
                    } catch (\Exception $ex) {
                        echo $ex;die;
                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Bài viết không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
