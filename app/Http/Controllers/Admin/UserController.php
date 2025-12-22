<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class UserController extends Controller
{
    public function listUsers(Request $request){
    	$users_query = User::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $users_query->where('username', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('email') && $request->input('email') != "") {
            $users_query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $users_query->where('status', $request->input('status'));
        }
        $data['users'] = $users_query->paginate(20);
    	return view('admin.user.listUsers',$data);
    }

    public function addUser(Request $request) {
        $response = [
            'title' => "Thêm người dùng"
        ];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'txt-username' 	=> 'required|min:3',
                        'txt-email' 	=> 'required|email|unique:users,email',
                        'txt-password' 	=> 'required|min:6'
                            ], [
                        'txt-username.required' => 'Họ và tên không được để trống',
                        'txt-username.min' 		=> 'Họ và tên quá ngắn',
                        'txt-email.required' 	=> 'Email không được để trống',
                        'txt-email.email' 		=> 'Định dạng email không hợp lệ',
                        'txt-email.unique' 		=> 'Email đã tồn tại trên hệ thống',
                        'txt-password.required' => 'Mật khẩu không được để trống',
                        'txt-password.min' 		=> 'Mật khẩu phải lớn hơn 6 ký tự'
                            ]
            );
            if (!$validator->fails()) {
                try {
                	$user 			= new User();
                    $user->username	= trim($request->input('txt-username'));
                    $user->email 	= $request->input('txt-email');
                    $user->password	= bcrypt($request->input('txt-password'));
                    $user->sex 		= $request->input('rd-gender');
                    $user->type 	= 2;
                    $user->status 	= $request->input('rd-status');
                    try {
                        $user->save();
                        return redirect()->action('Admin\UserController@listUsers')->with('success', 'Thêm người dùng "' . $user->email . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\UserController@addUser')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\UserController@addUser')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\UserController@addUser')->withInput()->with('error', $validator->errors()->first());
            }
        }
        return view('admin.user.addUser', $response);
    }

    public function editUser($user_id, Request $request) {
        try {
            $user = User::find($user_id);
            if (!empty($user)) {
                $response = [
                    'title' => "Sửa người dùng " . $user->username,
                    'user' 	=> $user
                ];
                if ($request->isMethod('post')) {
                    $rules = [
                        'txt-username' 	=> 'required|min:3',
                        'txt-email' 	=> "required|email|unique:users,email,$user_id"
                    ];
                    $message = [
                        'txt-username.required' => 'Họ và tên không được để trống',
                        'txt-username.min' 		=> 'Họ và tên quá ngắn',
                        'txt-email.required' 	=> 'Email không được để trống',
                        'txt-email.email' 		=> 'Định dạng email không hợp lệ'
                    ];
                    if ($request->input('txt-password') != "") {
                        $rules['txt-password'] 			= 'min:6';
                        $message['txt-password.min'] 	= "Mật khẩu phải lớn hơn 6 ký tự";
                    }
                    $validator = Validator::make($request->all(), $rules, $message);
                    if (!$validator->fails()) {
                        $email 			= trim($request->input('txt-email'));
                        $user->username = trim($request->input('txt-username'));
                        $user->email 	= $email;
                        if ($request->input('txt-password') != "") {
                            $user->password = bcrypt($request->input('txt-password'));
                        }
                        $user->sex 		= $request->input('rd-gender');
                        $user->status 	= $request->input('rd-status');
                        try {
                            $user->save();
                            return redirect()->action('Admin\UserController@listUsers', ['user_id' => $user_id])->with('success', 'Sửa người dùng "' . $user->email . '" thành công');
                        } catch (\Exception $ex) {
                            return redirect()->action('Admin\UserController@editUser', ['user_id' => $user_id])->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\UserController@editUser', ['user_id' => $user_id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                return view('admin.user.editUser', $response);
            } else {
                return redirect()->action('Admin\UserController@listUsers')->with('error', 'Người dùng không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\UserController@listUsers')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delUser(Request $request) {
        $validator = Validator::make($request->all(), [
                    'txt-uid' => 'required|alpha_num',
                        ], [
                    'txt-uid.required' 	=> 'ID người dùng không hợp lệ',
                    'txt-uid.alpha_num' => 'ID người dùng không hợp lệ',
                        ]
        );
        if (!$validator->fails()) {
            try {
                $user = User::select(['id', 'email'])->where('id', $request->input('txt-uid'))->first();
                if (!empty($user)) {
                    try {
                        $email = $user->email;
                        // $user->delete();
                        return redirect()->back()->with('success', 'Xóa người dùng "' . $email . '" thành công');
                    } catch (\Exception $ex) {
                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Người dùng không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
    public function SSL(){
        return response("745B510CED4C9BFF0F718E3AE22AAB78A44E75361816DBAC792E276BEB474EBE comodoca.com", 200)->header('Content-Type', 'text/html');
    }
}
