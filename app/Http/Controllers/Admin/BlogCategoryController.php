<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bcategory;
use Validator;

class BlogCategoryController extends Controller
{
    public function listCategory(Request $request){
        $data['categories'] = Bcategory::with('parentCategory')->get();
    	return view('admin.blog.listBlogCategory',$data);
    }

    public function addCategory(Request $request) {
        $response = [
            'title' => "Thêm danh mục"
        ];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'txt-name' 		=> 'required|min:3',
                        'txt-order' 	=> 'integer',
                        'sl-parent' 	=> 'integer',
                            ], [
                        'txt-name.required' 	=> 'Tên danh mục không được để trống',
                        'txt-name.min' 			=> 'Tên danh mục quá ngắn',
                        'txt-order.integer' 	=> 'Thứ tự phải là số',
                        'sl-parent.integer' 	=> 'Danh mục cha không hợp lệ'
                            ]
            );
            if (!$validator->fails()) {
                try {
                	$Category 		= new Bcategory();
                    $Category->name	= trim($request->input('txt-name'));
                    $Category->parent_id = $request->input('sl-parent');
                    $Category->order 	= $request->input('txt-order');
                    $Category->status 	= $request->input('rd-status');
                    $Category->keywords	= $request->input('txt-keyword');
                    $Category->metades 	= $request->input('txt-metades');
                    try {
                        $Category->save();
                        return redirect()->action('Admin\BlogCategoryController@listCategory')->with('success', 'Thêm Danh mục "' . $Category->name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\BlogCategoryController@addCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\BlogCategoryController@addCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\BlogCategoryController@addCategory')->withInput()->with('error', $validator->errors()->first());
            }
        }
        $response['category'] = Bcategory::where('status',1)->get();
        return view('admin.blog.addBlogCategory', $response);
    }

    public function editCategory($cate_id, Request $request) {
        try {
            $Category = Bcategory::find($cate_id);
            if (!empty($Category)) {
                $response = [
                    'title' => "Sửa danh mục " . $Category->name,
                    'cate' 	=> $Category
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name' 		=> 'required|min:3',
                        'txt-order' 	=> 'integer',
                        'sl-parent' 	=> 'integer',
                            ], [
                        'txt-name.required' 	=> 'Tên danh mục không được để trống',
                        'txt-name.min' 			=> 'Tên danh mục quá ngắn',
                        'txt-order.integer' 	=> 'Thứ tự phải là số',
                        'sl-parent.integer' 	=> 'Danh mục cha không hợp lệ'
                            ]
            		);
                    if (!$validator->fails()) {
                        $Category->name	= trim($request->input('txt-name'));
	                    $Category->parent_id = $request->input('sl-parent');
	                    $Category->order 	= $request->input('txt-order');
	                    $Category->status 	= $request->input('rd-status');
	                    $Category->keywords	= $request->input('txt-keyword');
	                    $Category->metades 	= $request->input('txt-metades');
                        try {
                            $Category->save();
                            return redirect()->action('Admin\BlogCategoryController@listCategory', ['id' => $cate_id])->with('success', 'Sửa danh mục "' . $Category->name . '" thành công');
                        } catch (\Exception $ex) {
                        	echo $ex;die;
                            return redirect()->action('Admin\BlogCategoryController@editCategory', ['id' => $cate_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\BlogCategoryController@editCategory', ['id' => $cate_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                $response['category'] = Bcategory::where('status',1)->where('id','!=',$cate_id)->get();
                return view('admin.blog.editBlogCategory', $response);
            } else {
                return redirect()->action('Admin\BlogCategoryController@listCategory')->with('error', 'Danh mục không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\BlogCategoryController@listCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delCategory(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txt-uid' => 'required|alpha_num',
                        ], [
                    'txt-uid.required' 	=> 'ID không hợp lệ',
                    'txt-uid.alpha_num' => 'ID không hợp lệ',
                        ]
        );
        if (!$validator->fails()) {
            try {
                $category = Bcategory::where('id', $request->input('txt-uid'))->first();
                if (!empty($category)) {
                    try {  
                    	$data_update = [
                    		'parent_id' => 0
                    	];    
                    	Bcategory::where('parent_id',$request->input('txt-uid'))->update($data_update);       	
                        $name = $category->name;
                        $category->delete();
                        return redirect()->back()->with('success', 'Xóa Danh Mục "' . $name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Danh mục không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
