<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductsFilter;
use App\Models\Product\ProductsFilterValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $request      Request
     * @param $productModel Product
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $productModel)
    {
        // $productsQ = $productModel->with('productImages');
        $productsQ = $productModel->with('productImages');

        if ($request->get('name')) {
            $c = $request->get('name');
            $productsQ = $productsQ->where(function ($query) use ($c) {
                return $query->where('name', 'like', "%$c%")
                    ->orWhere('product_code', 'like', "%$c%");
            });
        }
        if ($request->get('category_id')) {
            $productsQ = $productsQ->whereHas('categories', function ($query) use ($request) {
                return $query->where('product_categories.id', $request->get('category_id'));
            });
        }
        if ($request->get('type') > 0) {
            $productsQ = $productsQ->where('type', $request->get('type'));
        }
        $products = $productsQ->orderBy('id', 'desc')->paginate(50);
        $categories = ProductCategory::all();

        return view('admin.products.index', [
            'products'      => $products,
            'categories'    => $categories,
            'filter' => [
                'name'          => $request->get('name', ''),
                'category_id'   => $request->get('category_id', ''),
                'show_home'   => $request->get('show_home', 0),
                'best_sell'   => $request->get('best_sell', 0),
                'type'      => $request->get('type', 0),
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
        $categories = ProductCategory::all();
        // $configs = ProductsConfig::with([
        //                                 'getValues'
        //                                 ])
        //                                 ->get();
        $filters = ProductsFilter::with([
            'getValues'
        ])
            ->get();
        return view('admin.products.create', [
            'categories' => $categories,
            // 'configs' => $configs,
            'filters' => $filters,
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
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            "name" => 'required|string|min:3|max:255',
            "slug" => 'string|min:3|max:255|nullable',
            "product_category_id" => "required",
        ], []);
        if ($validate->fails()) {
            // return redirect()->back()->withInput()->withErrors($validate);
            return redirect()->back()->with('success', $validate->errors()->first());
        }
        if ($request->input('price')) {
            $price = filter_var($request->input('price'), FILTER_SANITIZE_NUMBER_FLOAT);
        } else {
            $price = NULL;
        }
        if ($request->input('sale_price')) {
            $sale_price = filter_var($request->input('sale_price'), FILTER_SANITIZE_NUMBER_FLOAT);
        } else {
            $sale_price = NULL;
        }
        $newProduct = Product::create([
            "name"          => $request->input('name', ''),
            "type"          => $request->input('type', 1),
            "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
            'meta'          => $request->input('meta', ''),
            "price"         => $price,
            "sale_price"    => $sale_price,
            "description"   => $request->input('description'),
            "keyword"       => $request->input('keyword'),
            "content"       => $request->input('content'),
            "product_code"  => $request->input('product_code'),
            "stock_status"  => $request->input('stock_status'),
            "status"        => $request->input('status'),
            "video"         => $request->input('video'),
            "show_home"     => $request->input('show_home'),
            "show_category"     => $request->input('show_category'),
            "best_sell"     => $request->input('best_sell'),
            "model"     => $request->input('model'),
            "weight"     => $request->input('weight'),
            "number_filter"     => $request->input('number_filter'),
            "filter_technology"     => $request->input('filter_technology'),
            "filter_capacity"     => $request->input('filter_capacity'),
            "producer"     => $request->input('producer'),
            "ability_clean"     => $request->input('ability_clean'),
            "guarantee"     => $request->input('guarantee'),
            "technical_special"     => $request->input('technical_special'),
            "advantages"     => $request->input('advantages'),
            "intro_video" => $request->input('intro_video'),
            "options" => $request->input('variants_json', []),
            'permission' => $request->input('permission', 0),
        ]);
        foreach ($request->input('group', []) as $key2 => $value2) {
            $config = ProductsProductConfig::create([
                'product_id' => $newProduct->id,
                'name' => isset($value2['name']) ? $value2['name'] : '',
                'max' => isset($value2['max']) ? $value2['max'] : '',
            ]);
            if (isset($value2['att'])) {
                foreach ($value2['att'] as $key3 => $value3) {
                    ProductsProductConfigGroup::create([
                        'group_id' => isset($value3['name']) ? $value3['name'] : '',
                        'product_product_config_id' => $config->id,
                        'order' => isset($value3['order']) ? $value3['order'] : '',
                        'max' => isset($value3['max']) ? $value3['max'] : '',
                    ]);
                }
            }
        }
        foreach ($request->input('att', []) as $key => $value) {
            ProductValue::create([
                'product_id' => $newProduct->id,
                "name"          => $value[0],
                "value"         => $value[1],
                "info"          => $value[2],
            ]);
        }
        $newProduct->categories()->sync($request->input('product_category_id'));
        $newProduct->filters()->sync($request->input('product_filter_id'));
        // foreach ($request->input('propety',[]) as $key => $value) {
        //     ProductsProperty::create([
        //         'product_id' => $newProduct->id,
        //         'name' => $key,
        //         'value' => $value[0],
        //         'info' => $value[1],
        //     ]);
        // }
        $listLink = [];
        $listImages = json_decode($request->input('data-images', '{}'));
        foreach ($listImages as $value) {
            $extend = '.' . last(explode('.', $value->link));
            /***
             * get image
             */
            $image = ProductImage::find($value->id);

            if ($value->alt == '') {
                $image->alt = str_slug($newProduct->slug);
            } else {
                $image->alt = $value->alt;
            }
            /***
             * create new file
             */
            copy(
                public_path($image->link),
                public_path('product_images/' . str_slug($image->alt) . '-' . $image->id . $extend)
            );
            $image->order       = $value->order;
            $image->thumbnail   = $value->thumbnail;
            $image->link        = '/product_images/' . str_slug($image->alt) . '-' . $image->id . $extend;
            $image->product_id  = $newProduct->id;
            $image->save();
        }
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
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
        $categories = ProductCategory::all();
        $filters = ProductsFilter::with([
            'getValues'
        ])
            ->get();
        $product    = Product::with([
            'filters',
        ])
            ->find($id);
        $options = [];
        if ($product->options) {
            $options = json_decode($product->options, true);
        }
        return view('admin.products.edit', [
            'categories'    => $categories,
            'product'       => $product,
            'filters'       => $filters,
            'options' => $options,
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
        // dd($request->input('variants_json'));
        $validate = Validator::make($request->all(), [
            "name" => 'required|string|min:3|max:255',
            "slug" => 'string|min:3|max:255|nullable',
            "product_category_id" => "required",
        ], []);


        if ($validate->fails()) {
            // return redirect()->back()->withInput()->withErrors($validate);
            return redirect()->back()->with('success', $validate->errors()->first());
        }
        $newProduct = Product::find($id);
        if ($request->input('price')) {
            $price = filter_var($request->input('price'), FILTER_SANITIZE_NUMBER_FLOAT);
        } else {
            $price = NULL;
        }
        if ($request->input('sale_price')) {
            $sale_price = filter_var($request->input('sale_price'), FILTER_SANITIZE_NUMBER_FLOAT);
        } else {
            $sale_price = NULL;
        }
        $newProduct->fill([
            "name"          => $request->input('name', ''),
            "type"          => $request->input('type', 1),
            "slug"          => ($request->input('slug', false)) ? str_slug($request->input('slug')) : str_slug($request->input('name')),
            'meta'          => $request->input('meta', ''),
            "price"         => $price,
            "sale_price"    => $sale_price,
            "description"   => $request->input('description'),
            "keyword"       => $request->input('keyword'),
            "content"       => $request->input('content'),
            "product_code"  => $request->input('product_code'),
            "stock_status"  => $request->input('stock_status'),
            "status"        => $request->input('status'),
            "video"        => $request->input('video'),
            "show_home"        => $request->input('show_home'),
            "show_category"        => $request->input('show_category'),
            'best_sell'   => $request->input('best_sell', 0),
            "model"     => $request->input('model'),
            "weight"     => $request->input('weight'),
            "number_filter"     => $request->input('number_filter'),
            "filter_technology"     => $request->input('filter_technology'),
            "filter_capacity"     => $request->input('filter_capacity'),
            "producer"     => $request->input('producer'),
            "ability_clean"     => $request->input('ability_clean'),
            "guarantee"     => $request->input('guarantee'),
            "technical_special"     => $request->input('technical_special'),
            "advantages"     => $request->input('advantages'),
            "intro_video" => $request->input('intro_video'),
            "options" => $request->input('variants_json'),
            'permission' => $request->input('permission', $newProduct->permission),
        ]);
        // dd($request->all());
        $newProduct->save();
        $newProduct->categories()->sync($request->input('product_category_id'));
        $newProduct->filters()->sync($request->input('product_filter_id'));
        $listLink = [];
        $listImages = json_decode($request->input('data-images', '{}'));
        foreach ($listImages as $value) {
            $extend = '.' . last(explode('.', $value->link));
            /***
             * get image
             */
            $image = ProductImage::find($value->id);
            if ($value->alt == '') {
                $image->alt = str_slug($newProduct->slug);
            } else {
                $image->alt = $value->alt;
            }
            /***
             * create new file
             */
            copy(
                public_path($image->link),
                public_path('product_images/' . str_slug($image->alt) . '-' . $image->id . $extend)
            );
            $image->order       = $value->order;
            $image->thumbnail   = $value->thumbnail;
            $image->link        = '/product_images/' . str_slug($image->alt) . '-' . $image->id . $extend;
            $image->product_id  = $newProduct->id;
            $image->save();
        }

        return redirect()->route('products.index')->with('success', 'Lưu sản phẩm thành công!');
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
        // $productConfig_delete = ProductsProductConfig::where('product_id',$id)
        //                                             ->get();
        // foreach ($productConfig_delete as $kd => $vd) {
        //     ProductsProductConfigGroup::where('product_product_config_id',$vd->id)
        //                                 ->delete();
        // }
        // ProductsProductConfig::where('product_id',$id)
        //                         ->delete();
        // ProductValue::where('product_id',$id)->delete();
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Xoá sản phẩm thành công!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Tạo tên file ngẫu nhiên
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            // Lưu ảnh vào thư mục tạm: public/tmp_product_images
            $file->move(public_path('tmp_product_images'), $filename);

            // Lưu vào bảng tạm ProductImage để xử lý sau
            $image = ProductImage::create([
                'link' => 'tmp_product_images/' . $filename,
                'alt' => '',
                'order' => 0,
                'thumbnail' => 0,
                'product_id' => null,
            ]);

            return response()->json([
                'id' => $image->id,
                'url' => asset('tmp_product_images/' . $filename),
                'link' => $image->link,
            ]);
        }

        return response()->json(['error' => 'No image found'], 400);
    }
}
