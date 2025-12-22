<?php

namespace App\Http\Controllers\front;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Video;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Certification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bcategory;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use MobileDetect;
use Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $detect = new MobileDetect;
        $listProduct1 = Product::with([
            'productImages' => function ($query) {
                return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
            }
        ])
            ->where('permission','!=', 1)
            ->where('status', 1)
            ->where('show_home', 1)
            // ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        $blogs = Blog::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        $sliders = Slider::limit(5)
            ->get();

        $videos = Video::where('status', 1)
            ->where('show_home', 1)
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        $reviews = Review::where('status', 1)
            ->orderBy('order', 'desc')
            ->limit(6)
            ->get();
        $gallery = Gallery::where('status', 1)
            ->take(4)
            ->orderBy('id', 'DESC')
            ->get();
        $certification = Certification::where('status', 1)
            ->take(4)
            ->get();
        return view('watch.home', [
            'sliders'       => $sliders,
            'blogs'         => $blogs,
            'videos'         => $videos,
            'listProduct1'         => $listProduct1,
            'reviews'         => $reviews,
            'gallery'      => $gallery,
            'certification'      => $certification,
        ]);
    }


    public function search(Request $request)
    {
        $key = $request->get('search');
        $key2 = preg_replace("/[^a-zA-Z0-9]/", '', $request->get('search'));
        $filter = [
            'material'  => collect($request->get('material', [])),
            'price'     => collect($request->get('price', [])),
            'faceSize'  => collect($request->get('faceSize', []))
        ];

        $Qproducts = Product::with([
            'productImages' => function ($query) {
                return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
            }
        ])->where('status', 1)->where('name', 'like', "%{$key}%")->where('permission','!=', 1);

        $products = $Qproducts->paginate(28);
        /***
         * Tìm ngược lại list danh mục
         */

        /**
         * tìm các sản phẩm của danh mục
         */

        return view('watch.search', [
            'products' => $products,
            'key_serch' => $request->get('search'),
        ]);
    }

    public function aboutUs(Request $request)
    {
        $data = Page::where('slug', 've-chung-toi')
            ->first();
        return view('watch.aboutUs', [
            'data' => $data
        ]);
    }
    /***
     * @param         $slug
     *
     * @param Request $request
     *
     *
     * Nếu slug trùng với cate thì trả về cate
     * Nếu không tìm kiếm sản phẩm (nếu không được nữa nhảy về 404)
     *
     * @return mixed
     */

    public function showBySlug($slug, Request $request)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        $categories = ProductCategory::all();
        if ($category) {
            if ($category->parent_id == 0) {
                $categories = ProductCategory::where('parent_id', $category->id)
                    ->orderBy('order', 'DESC')
                    ->get();
                return view('watch.productCategoriesParent', [
                    'category' => $category,
                    'categories' => $categories
                ]);
            } else {
                $listChilds = $this->getAllChildsCategories($category, $categories);
                $listId = [];
                foreach ($listChilds as $child) {
                    $listId[] = $child->id;
                }
                $Qproducts = Product::select()->with([
                    'productImages' => function ($query) {
                        return $query->orderBy('thumbnail', 'desc')->orderBy('updated_at', 'desc');
                    }
                ])->whereHas('categories', function ($query) use ($listId) {
                    return $query->whereIn('product_categories.id', $listId);
                });
                $Qproducts->where('status', 1)->where('permission','!=', 1);
                $Qproducts->distinct()
                    ->orderBy('updated_at', 'desc');
                $products = $Qproducts->paginate(32);
                return view('watch.productCategories', [
                    'products' => $products,
                    'category' => $category,
                ]);
            }
        } else {
            $page = Page::where('slug', $slug)->first();
            if ($page) {
                $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->limit(10)->get();

                return view('watch.pageDetail', [
                    'page' => $page,
                    'blogs' => $blogs
                ]);
            }
        }


        /***
         * tìm sản phẩm
         */
        /***
         * sản phẩm lấy theo ID cuối slug
         */
        $productId = $slug;
        $product = Product::with([
            'productImages' => function ($query) {
                return $query->orderBy('thumbnail', 'desc')->orderBy('updated_at', 'desc');
            }
        ])->where('slug', $productId)->first();
        if ($product) {
            $specialProducts = Product::with([
                'productImages' => function ($query) {
                    return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc');
                }
            ])
                ->where('status', 1)
                ->where('permission','!=', 1)
                ->where('best_sell', 1)
                ->orderBy('id', 'desc')
                ->limit(8)
                ->get();
            $options = [];
            if ($product->options) {
                $options = json_decode($product->options, true);
            }
            // dd($options);
            return view('watch.productDetail', [
                'product' => $product,
                'specialProducts'   => $specialProducts,
                'options' => $options,
            ]);
        } else {
            throw new NotFoundHttpException;
        }
    }


    public function getAllChildsCategories($current, $allCategories, &$visited = [])
    {
        if (isset($visited[$current->id])) {
            return [];
        }
    
        $visited[$current->id] = true;
        $listChilds = [$current];
    
        foreach ($allCategories as $category) {
            if ($category->parent_id == $current->id) {
                $listChilds = array_merge(
                    $listChilds,
                    $this->getAllChildsCategories($category, $allCategories, $visited)
                );
            }
        }
    
        return $listChilds;
    }


    public function getParentCategories($current, $allCategories)
    {
        $listChilds = '';
        foreach ($allCategories as $category) {
            if ($current->parent_id == $category->id) {
                $listChilds = $this->getParentCategories($category, $allCategories);
            }
        }
        if ($current->parent_id == 0) {
            $listChilds = $current;
        }

        return $listChilds;
    }
}
