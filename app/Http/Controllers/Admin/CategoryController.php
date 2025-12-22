<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function listCategory(Request $request){
        $data['categories'] = Category::with('parentCategory')->get();
    	return view('admin.product.listCategory',$data);
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
                	$Category 		= new Category();
                    $Category->name	= trim($request->input('txt-name'));
                    $Category->parent_id = $request->input('sl-parent');
                    $Category->order 	= $request->input('txt-order');
                    $Category->shortdes = $request->input('txt-shortdes');
                    $Category->status 	= $request->input('rd-status');
                    $Category->keywords	= $request->input('txt-keyword');
                    $Category->metades 	= $request->input('txt-metades');
                    if($request->input('txt-url') != ''){
                    	$Category->url 	= str_slug($request->input('txt-url'));
                    }else{
                    	$Category->url 	= str_slug($request->input('txt-name'));	
                    }
                    try {
                        $Category->save();
                        return redirect()->action('Admin\CategoryController@listCategory')->with('success', 'Thêm Danh mục "' . $Category->name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\CategoryController@addCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\CategoryController@addCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\CategoryController@addCategory')->withInput()->with('error', $validator->errors()->first());
            }
        }
        $response['category'] = Category::where('status',1)->get();
        return view('admin.product.addCategory', $response);
    }

    public function editCategory($cate_id, Request $request) {
        try {
            $Category = Category::find($cate_id);
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
	                    $Category->shortdes = $request->input('txt-shortdes');
	                    $Category->status 	= $request->input('rd-status');
	                    $Category->keywords	= $request->input('txt-keyword');
	                    $Category->metades 	= $request->input('txt-metades');
	                    if($request->input('txt-url') != ''){
	                    	$Category->url 	= str_slug($request->input('txt-url'));
	                    }else{
	                    	$Category->url 	= str_slug($request->input('txt-name'));	
	                    }
                        try {
                            $Category->save();
                            return redirect()->action('Admin\CategoryController@listCategory', ['id' => $cate_id])->with('success', 'Sửa danh mục "' . $Category->name . '" thành công');
                        } catch (\Exception $ex) {
                        	echo $ex;die;
                            return redirect()->action('Admin\CategoryController@editCategory', ['id' => $cate_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\CategoryController@editCategory', ['id' => $cate_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                $response['category'] = Category::where('status',1)->where('id','!=',$cate_id)->get();
                return view('admin.product.editCategory', $response);
            } else {
                return redirect()->action('Admin\CategoryController@listCategory')->with('error', 'Danh mục không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\CategoryController@listCategory')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
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
                $category = Category::where('id', $request->input('txt-uid'))->first();
                if (!empty($category)) {
                    try {  
                    	$data_update = [
                    		'parent_id' => 0
                    	];    
                    	Category::where('parent_id',$request->input('txt-uid'))->update($data_update);       	
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
