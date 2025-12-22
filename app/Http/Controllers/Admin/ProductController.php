<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Validator;
use ImageUpload;

class ProductController extends Controller
{
    public function listProduct(Request $request){
    	$query = Product::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['products'] = $query->with('category')->paginate(30);

    	return view('admin.product.listProduct',$data);
    }

    public function addProduct(Request $request) {
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
                try {
                	$blog           = new Blog();
                    $blog->name	    = trim($request->input('txt-name'));
                    $blog->shortdes = $request->input('txt-shortdes');
                    $blog->des      = $request->input('txt-des');
                    $blog->order 	= $request->input('txt-order');
                    $blog->status 	= $request->input('rd-status');
                    $blog->keywords	= $request->input('txt-keyword');
                    $blog->metades  = $request->input('txt-metades');
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
                    try {
                        $blog->save();
                        $blog->category()->sync($request->input('sl-category'));    
                        return redirect()->action('Admin\BlogController@listBlogs')->with('success', 'Thêm Blog "' . $blog->name . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\BlogController@addBlog')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\BlogController@addBlog')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\BlogController@addBlog')->withInput()->with('error', $validator->errors()->first());
            }
        }
        $response['category'] = Category::select('name','parent_id','id')->where('status',1)->get();
        return view('admin.product.addProduct', $response);
    } 
    function showCate($category)
        {
            foreach ($category as $key => $item)
            {   
                if($item->parent_id == 0){                                     
                    echo '<li>';
                        echo $item->name;
                    echo '</li>';
                    unset($category[$key]);
                    var_dump($category);
                    $this->showCate($category);
                }else{
                    unset($category[$key]);
                    echo "kien";
                    var_dump($category);
                }
                // if ($item->parent_id == $parent_id)
                // {   
                    // echo '<ul>';
                    //     echo '<li>';
                    //         echo $item->name;
                    //     echo '</li>';
                    // echo '<ul>';
                    // unset($category[$key]);
                    // showCate($category, $item->id);
                // }
            }
        }

    public function editProduct($blog_id, Request $request) {
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

    public function delProduct(Request $request) {
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
