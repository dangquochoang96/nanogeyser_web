<?php

namespace App\Http\Controllers\Front;

use App\Models\EmailContact;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('watch.contact', []);
    }

    public function nhanqua()
    {
        $data = Page::where('id',12)
                    ->first();
        return view('watch.event', [
            'data' => $data
        ]);
    }
    public function submit()
    {
        return view('watch.events', []);
    }
    public function contactMe(Request $request)
    {
        $validate = Validator::make($request->all(), [
            // "full_name" => 'required|string|min:3|max:255',
            // "email" => 'required|string|email',
            "phone" => 'required'
        ], []);
        if ($validate->fails()) {
            return response()->json([
                'code' => 403,
                'message' => $validate->errors()->first()
            ]);
        }
        EmailContact::create([
            'email' => $request->input('email',''),
            'name' => $request->input('full_name',''),
            'phone' => $request->input('phone',''),
            'content' => $request->input('note',''),
            'type' => $request->input('type',1),
            'is_check' => 0
        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Đăng kí thành công!'
        ]);
    }

    public function subscribe(Request $request)
    {
        EmailContact::create([
            'email' => $request->input('email')
        ]);
        $array = [
            'title' => 'Có một liên hệ mới',
            'content' => 'Có một liên hệ mới từ người email: '.$request->input('email').'<br>Truy cập vào '. route('contact.index').' để xem chi tiết',
        ];

        Mail::send('admin.email.makeOffer', $array, function ($message) use ($array) {
            // $message->to('server@oitc.com.vn',  'Admin')
            $message->to('kienhatay90@gmail.com',  'Admin')
                ->subject('New Contact');
        });
        return response()->json([
            'code' => 200,
            'message' => 'Đăng kí thành công!'
        ]);
    }
}
