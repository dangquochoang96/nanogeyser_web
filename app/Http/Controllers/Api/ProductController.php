<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['productImages', 'category', 'categories', 'filters'])->get();
        return response()->json(['data' => $products]);
    }

    public function listCate()
    {
        $data = ProductCategory::where('status', 1)->get();
        return response()->json([
            'code'      => 1,
            'message'   => 'success',
            'data'      => $data
        ]);
    }
    public function show($id)
    {
        $product = Product::with(['productImages', 'category', 'categories', 'filters'])->find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }
        return response()->json(['data' => $product]);
    }


}
