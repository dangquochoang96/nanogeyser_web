<?php

namespace App\Http\Controllers\Front;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product\Product;
use Mail;
use Validator;

class OrderController extends Controller
{   
    public function __construct() {
    }

    public function index()
    {        
        $datas = [];
        $data_returns = [];
        $listId = [];
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];
        $address = isset($_SESSION["address"]) ? $_SESSION["address"] : [];
        foreach ($carts as $key => $value) {
            $listId [] = $key;
        }
        $datas  = Product::with([
                                'productImages' => function ($query) {
                                    return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
                                }
                            ])
                            ->whereIn('id',$listId)
                            ->where('status',1)
                            ->get();
        foreach ($datas as $key => $item) {
            $data_returns[$item->id] = [
                'id' =>  $item->id,
                'name' =>  $item->name,
                'image' =>  sizeof($item->productImages) ? asset($item->productImages->first()->link) : '',
                'price' =>  $item->price,
                'sale_price' =>  $item->sale_price,
                'slug' =>  $item->slug,
            ];
            $data_returns[$item->id]['buy'] = isset($carts[$item->id]) ? $carts[$item->id] : 1;
        }                
        return view('watch.cart',[
            'datas' => $data_returns,
            'address' => $address,
        ]);
    }

    public function address(){
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];

        if(count($carts) == 0){
            return redirect()->action('Front\OrderController@index')->with('error', 'Giỏ hàng trống');
        }
        $provinces = Province::where('status',1)
                          ->get();
        foreach ($carts as $key => $value) {
            $listId [] = $key;
        }
        $datas  = Product::with([
                                'productImages' => function ($query) {
                                    return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
                                }
                            ])
                            ->whereIn('id',$listId)
                            ->where('status',1)
                            ->get();
        foreach ($datas as $key => $item) {
            $data_returns[$item->id] = [
                'id' =>  $item->id,
                'name' =>  $item->name,
                'image' =>  sizeof($item->productImages) ? asset($item->productImages->first()->link) : '',
                'price' =>  $item->price,
                'sale_price' =>  $item->sale_price,
                'slug' =>  $item->slug,
            ];
            $data_returns[$item->id]['buy'] = isset($carts[$item->id]) ? $carts[$item->id] : 1;
        }                  
                          
        return view('watch.address',[
            'datas' => $data_returns,
            'provinces' => $provinces,
        ]);
    }

    public function saveAddress(Request $request){  
        $validate = Validator::make($request->all(), [
            "name" => 'required|min:3|max:255',
            "phone" => 'string|min:3|max:255',
            "address" => "required",
            "province" => "required",
            "district" => "required",
            "ward" => "required",
        ], [
            "name.required" => 'Tên không được để trống',
            "name.min" => 'Tên quá ngắn',
            "phone.required" => 'Số điện thoại không hợp lệ',
            "address.required" => "Địa chỉ không hợp lệ",
            "province.required" => "Chưa chọn Tỉnh/ Thành phố",
            "district.required" => "Chưa chọn Quận/ Huyện",
            "ward.required" => "Chưa chọn Phường/ Xã",
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('success', $validate->errors()->first());
        }
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];
        // $address = isset($_SESSION["address"]) ? json_decode($_SESSION["address"], true) : [];

        if(count($carts) == 0){
            return redirect()->action('Front\OrderController@index')->with('error', 'Giỏ hàng trống');
        }
        // if(count($address) == 0){
        //     return redirect()->action('Front\OrderController@addAddress')->with('error', 'Chưa nhập thông tin địa chỉ');
        // }    

        $data = [];
        $data['name'] = $request->input('name');
        $data['phone'] = $request->input('phone');
        $data['address'] = $request->input('address');
        $data['province'] = $request->input('province');
        $data['district'] = $request->input('district');
        $data['ward'] = $request->input('ward');
        $_SESSION['address'] = json_encode($data);

        return redirect()->action('Front\OrderController@payment');
    }

    public function payment(){          
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];
        $address = isset($_SESSION["address"]) ? json_decode($_SESSION["address"], true) : [];  
        if(count($carts) == 0){
            return redirect()->action('Front\OrderController@index')->with('error', 'Giỏ hàng trống');
        }
        if(count($address) == 0){
            return redirect()->action('Front\OrderController@addAddress')->with('error', 'Chưa nhập thông tin địa chỉ');
        }  

        foreach ($carts as $key => $value) {
            $listId [] = $key;
        }
        $datas  = Product::with([
                                'productImages' => function ($query) {
                                    return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
                                }
                            ])
                            ->whereIn('id',$listId)
                            ->where('status',1)
                            ->get();
        foreach ($datas as $key => $item) {
            $data_returns[$item->id] = [
                'id' =>  $item->id,
                'name' =>  $item->name,
                'image' =>  sizeof($item->productImages) ? asset($item->productImages->first()->link) : '',
                'price' =>  $item->price,
                'sale_price' =>  $item->sale_price,
                'slug' =>  $item->slug,
            ];
            $data_returns[$item->id]['buy'] = isset($carts[$item->id]) ? $carts[$item->id] : 1;
        } 
        return view('watch.payment',[
            'datas' => $data_returns,
            'address' => $address
        ]);  
    }

    public function saveOrder(Request $request){        
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];
        $address = isset($_SESSION["address"]) ? json_decode($_SESSION["address"], true) : [];  
        if(count($carts) == 0){
            return redirect()->action('Front\OrderController@index')->with('error', 'Giỏ hàng trống');
        }
        if(count($address) == 0){
            return redirect()->action('Front\OrderController@address')->with('error', 'Chưa nhập thông tin địa chỉ');
        }
        $province = Province::where('code',$address['province'])
                                ->first();
        $district = District::where('code',$address['district'])
                                ->first();
        $ward = Ward::where('code',$address['ward'])
                                ->first();

        $order = new Order();
        $order->name = $address['name'];
        $order->phone = $address['phone'];
        $order->address = $address['address'];
        $order->province = $province ? $province->name : '';
        $order->district = $district ? $district->name : '';
        $order->ward = $ward ? $ward->name : '';
        $order->payment_type = $request->input('payment','Nhận tại cửa hàng'); 
        $order->save();

        $data_insert = [];
        foreach ($carts as $key => $value) {
            $listId [] = $key;
        }
        $datas  = Product::with([
                                'productImages' => function ($query) {
                                    return $query->orderBy('thumbnail', 'desc')->orderBy('order', 'asc')->get();
                                }
                            ])
                            ->whereIn('id',$listId)
                            ->where('status',1)
                            ->get();        
        $count_cart = 0;
        $total_price = 0;

        foreach ($datas as $key => $item) {
            $tmp = [
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'product_image' => sizeof($item->productImages) ? asset($item->productImages->first()->link) : '',
                'number' => isset($carts[$item->id]) ? $carts[$item->id] : 1,
                'price' => $item->price,
            ];

            $buy = isset($carts[$item->id]) ? $carts[$item->id] : 1;
            $count_cart += $buy;
            if($item['sale_price']){
                $total_price += $buy*$item->sale_price;
                $tmp['price'] = $item->sale_price;
            }else{
                $total_price += $buy*$item->price;
                $tmp['price'] = $item->price;
            }
            $data_insert[] = $tmp;
        }     
        $order->total_price = $total_price;
        $order->total= $count_cart;
        $order->save();

        OrderDetail::insert($data_insert);
        $_SESSION["succes"] = 1;
        unset($_SESSION['cart']); 
        return redirect()->action('Front\OrderController@success');
    }

    public function success(){      
        if(!isset($_SESSION["succes"]) || $_SESSION["succes"] != 1){
            return redirect()->action('Front\OrderController@index')->with('error', 'Giỏ hàng trống');
        }  
        return view('watch.success',[
        ]);
    }

    public function addToCart(Request $request){
        $id = $request->input('id','');
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'code' => 403,
                'message' => 'Error',
            ]); 
        }
        $number = (int) $request->input('number');
        if($number <= 0){
            return response()->json([
                'code' => 403,
                'message' => 'Số lượng mua không hợp lệ',
            ]); 
        }
        // $tmp = isset($_SESSION["cart"][$product->id]) ? ($_SESSION["cart"][$product->id] + $number) : $number;
        $data = [];
        if(isset($_SESSION['cart'])){
            $data = json_decode($_SESSION['cart'], true);
            $data[$product->id] = isset($data[$product->id]) ? ($data[$product->id] + $number) : $number ;
            $_SESSION['cart'] = json_encode($data);
        }else{
            $data[$product->id] = $number;
            $_SESSION['cart'] = json_encode($data);
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
        ]);
    }

    public function removeToCart(Request $request){
        $number = (int)  $request->input('number');
        $id = $request->input('id');
        if(!isset($_SESSION["cart"][$id])){
            return response()->json([
                'code' => 403,
                'message' => 'Error',
            ]);
        }

        if($number <= 0){
            return response()->json([
                'code' => 403,
                'message' => 'Số lượng mua không hợp lệ',
            ]); 
        }

        $_SESSION["cart"][$id] = $_SESSION["cart"][$id] - $number;
        if($_SESSION["cart"][$id] <= 0){
            unset($_SESSION["cart"][$id]);
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
        ]);
    }

    public function deleteToCart(Request $request){
        $id = $request->input('id');        
        $carts = isset($_SESSION["cart"]) ? json_decode($_SESSION["cart"], true) : [];
        if(isset($carts[$id])){
            unset($carts[$id]);
        }
        $_SESSION["cart"] = json_encode($carts);
        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
        ]);
    }

    // public function saveAddress(Request $request){
    //     $id = $request->input('id');
    //     if(isset($_SESSION["cart"][$id])){
    //         unset($_SESSION["cart"][$id]);
    //     }
    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'Thành công!',
    //     ]);
    // }

    public function province()
    {
        $provinces = Province::where('status',1)
                          ->get();
        $data = [];                  
        foreach ($provinces as $key => $value) {
          $data[] = [
            "id" => (int) $value->id,
            "name" => $value->name,
            "code" => $value->code
          ];
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
            'data' => $data,
        ]);
    }

    public function district(Request $request)
    {
        $province_code = $request->input('province_code','');

        $districts = District::where('province_code',$province_code)
                          ->where('status',1)
                          ->get();
        $data = [];                  
        foreach ($districts as $key => $value) {
            $data[] = [
                "id" => (int) $value->id,
                "name" => $value->name,
                "code" => $value->code,
                "isInner" => $value->isInner
            ];
        }

        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
            'data' => $data,
        ]);
    }

    public function ward(Request $request)
    {
        $district_code = $request->input('district_code','');

        $wards = Ward::where('district_code',$district_code)
                          ->where('status',1)
                          ->get();
        $data = [];                  
        foreach ($wards as $key => $value) {
          $data[] = [
            "id" => (int) $value->id,
            "name" => $value->name,
            "code" => $value->code
          ];
        }
        return response()->json([
            'code' => 200,
            'message' => 'Thành công!',
            'data' => $data,
        ]);
    }

}
