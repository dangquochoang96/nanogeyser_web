<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\ProductCategory;
use App\Models\Product\ProductsFilter;
use App\Models\Product\ProductsFilterValue;
use App\Models\Product\ProductsProductFilter;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ImageUpload;
use Validator;

class ProductFilterController extends Controller
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
        $productsFilter = ProductsFilter::paginate(30);

        return view('admin.productFilter.index', [
            'productsFilter' => $productsFilter
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

        return view('admin.productFilter.create', [
            
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
        ], [
            'name.required' => 'Tên không được để trống',
            'name.min' => 'Tên tối thiểu 3 kí tự',
            'name.max' => 'Tên tối đa 255 kí tự',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $productsFilter = ProductsFilter::create([
                'name'      => $request->input('name'),
                'order'      => $request->input('order'),
            ]);
            foreach ($request->input('att') as $key => $value) {
                ProductsFilterValue::create([
                    'filter_id'  => $productsFilter->id,
                    'name'      => $value[0],
                    'order'      => $value[1],
                    // 'value'      => $value[1],
                ]);
            }
            return redirect()->route('product-filter.index');
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
        $productFilter = ProductsFilter::with([
                                                'getValues'
                                            ])
                                        ->where('id',$id)
                                        ->first();

        return view('admin.productFilter.edit', [
            'productFilter' => $productFilter,
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
        ], [
            'name.required' => 'Tên không được để trống',
            'name.min' => 'Tên tối thiểu 3 kí tự',
            'name.max' => 'Tên tối đa 255 kí tự',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $productsFilter = ProductsFilter::find($id);
            $productsFilter->fill([
                'name' => $request->input('name'),
                'order'      => $request->input('order'),
            ]);
            $productsFilter->save();

            ProductsFilterValue::where('filter_id',$productsFilter->id)
                                    ->delete();
            foreach ($request->input('att') as $key => $value) {
                ProductsFilterValue::create([
                    'filter_id'  => $productsFilter->id,
                    'name'      => $value[0],
                    'order'      => $value[1],
                    // 'value'      => $value[1],
                ]);
            }
            return redirect()->route('product-filter.index');
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
        $productsFilter = ProductsFilter::find($id);
        ProductsFilterValue::where('filter_id',$productsFilter->id)
                                    ->delete();
        $productsFilter->delete();
        return redirect()->back();
    }
}
