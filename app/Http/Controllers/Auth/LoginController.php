<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/quan-tri/nguoi-dung';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function check(Request $request)
    {
        $data=[
            'username'=>$request->username,
            'password'=>$request->password,
        ];
        $validator = Validator::make($request->all(), [
                // 'name' => 'required|string|max:255',
                'email'     => 'required|string|email|max:255|unique:users',
                'password'  => 'required|string|min:6|confirmed',
            ],
            [
                'email.required'    => 'Email không được để trống',
                'email.string'      => 'Email không đúng định dạng',
                'email.email'       => 'Email không đúng định dạng',
                'email.max'         => 'Email không đúng định dạng',
                'email.unique'      => 'Email đã tồn tại',
                'password.required' => 'Password không được để trống',
                'password.string'   => 'Password quá ngắn',
                'password.min'      => 'Password quá ngắn',
                'password.confirmed'=> 'Password không khớp',
            ]);
        if(!$validator->fails()){     
            if(Auth::attempt($data)){
                //true
            }else{
                //false
            }
        }else{

            return redirect()->action('LoginController@login')->with('error', $validator->errors()->first());
        }
    }
}
