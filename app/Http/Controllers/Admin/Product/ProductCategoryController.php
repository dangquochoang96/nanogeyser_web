<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\ProductCategory;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ImageUpload;
use Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /***
         * get all categories
         */
        $productCategories = ProductCategory::all();

        return view('admin.productCategories.index', [
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /***
         * get all categories
         */
        $productCategories = ProductCategory::all();

        return view('admin.productCategories.create', [
            'productCategories' => $productCategories
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'order' => 'integer',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.min' => 'Tên tối thiểu 3 kí tự',
            'name.max' => 'Tên tối đa 255 kí tự',
            'order.integer' => 'Thứ tự phải là kiểu số'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            if ($request->has('txt-img-type')) {
                if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                    $file       = $request->file('file-img')->getClientOriginalName();
                    $filename   = pathinfo($file, PATHINFO_FILENAME);
                    // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                    $name   = rand(0, 10).time().'-'.str_slug($filename, '-');
                    $image  = ImageUpload::image($request->file('file-img'), $name);
                } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                    $name   = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                    $image  = ImageUpload::image($request->input('txt-img'), md5($name));
                }else{
                    $image = '';
                }
            }else{
                $image = '';
            }
            $newProduct = ProductCategory::create([
                'name'      => $request->input('name'),
                'slug'      => ($request->input('slug', '')) ? str_slug($request->input('slug'))
                    : str_slug($request->input('name')),
                'parent_id' => $request->input('parent_id'),
                'order'     => $request->input('order'),
                'keyword'   => $request->input('keyword'),
                'meta_description' => $request->input('meta_description'),
                'description' => $request->input('description'),
                'status'    => $request->input('status'),
                'img'       => $image
            ]);
            return redirect()->route('product-categories.index');
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
        /***
         * get all categories
         */
        $productCategories = ProductCategory::all();
        $category = ProductCategory::find($id);

        return view('admin.productCategories.edit', [
            'productCategories' => $productCategories,
            'category' => $category,
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'order' => 'integer',
        ], [
            'name.required' => 'Tên không được để trống',
            'order.integer' => 'Thứ tự phải là kiểu số'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $newProduct = ProductCategory::find($id);
            if ($request->has('txt-img-type')) {
                if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                    $file       = $request->file('file-img')->getClientOriginalName();
                    $filename   = pathinfo($file, PATHINFO_FILENAME);
                    // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                    $name   = rand(0, 10).time().'-'.str_slug($filename, '-');
                    $image  = ImageUpload::image($request->file('file-img'), $name);
                } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                    $name   = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                    $image  = ImageUpload::image($request->input('txt-img'), md5($name));
                }else{
                    $image = $newProduct->img;
                }
            }else{
                $image = '';
            }
            $newProduct->fill([
                'name' => $request->input('name'),
                'slug' => ($request->input('slug', '')) ? str_slug($request->input('slug'))
                    : str_slug($request->input('name')),
                'parent_id' => $request->input('parent_id'),
                'order' => $request->input('order'),
                'keyword' => $request->input('keyword'),
                'meta_description' => $request->input('meta_description'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'img' => $image
            ]);
            $newProduct->save();

            return redirect()->route('product-categories.index');
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
        $category = ProductCategory::find($id);

        $category->delete();


        return redirect()->back();
    }
}
