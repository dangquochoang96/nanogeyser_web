<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('details')->orderBy('id', 'desc')->paginate(10);

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // $order = Order::create([
        //     'product_id' => $request->input('product_id'),
        //     'count' => $request->input('count','1'),
        //     'full_name' => $request->input('full_name'),
        //     'phone' => $request->input('phone'),
        //     'email' => $request->input('email',''),
        //     'address' => $request->input('address',''),
        //     'note' => $request->input('note'),
        // ]);

        // $array = [
        //     'title' => 'Có một yêu cầu giá mới',
        //     'content' => 'Người dùng: '.$request->input('full_name'). 'Có SĐT: '. $request->input('phone') . '<br>Nội dung yêu cầu: '. $request->input('note') .'<br>Truy cập vào '. route('orders.index').' để xem chi tiết',
        // ];
        // Mail::send('admin.email.makeOffer', $array, function ($message) use ($array) {
        //     $message->to('mrtienwatch@gmail.com',  'Admin Mrwatch')
        //         // ->from('nguyentienmrwatch@gmail.com', 'Admin Mrwatch')
        //         ->subject('New Offer');
        // });
        // return response()->json([
        //     'code' => 200,
        //     'message' => 'Đăng kí thành công!',
        //     'data' => [
        //         'order' => $order
        //     ]
        // ]);
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
        $order = Order::with([
                                'details',
                            ])
                        ->where('id',$id)
                        ->first();
        // dd($order);                        
        return view('admin.order.edit', [
            'order'       => $order
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
        $order = Order::find($id);

        $order->delete();

        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
