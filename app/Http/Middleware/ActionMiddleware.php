<?php

namespace App\Http\Middleware;

use Closure;

class ActionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::user()->type != 2){
            return redirect()->action('Front\IndexController@index')->with('error', 'Không có quyền truy cập');
        }
        return $next($request);
//        $user = $request->session()->get('user');
//        if ($user->user_id == 0) {
//            return $next($request);
//        }
//        $function_keys = explode("|", $function_keys);
//        $action_ids = explode("|", $action_ids);
//        foreach ($user->permissions as $permission) {
//            if (in_array($permission->key, $function_keys)) {
//                foreach ($action_ids as $action_id) {
//                    if(in_array($action_id, $permission->actions)) {
//                        return $next($request);
//                    }
//                }
//            }
//        }
//        if ($request->ajax()) {
//            return response(json_encode([
//                'status_code' => 403,
//                'message' => "Không có quyền truy cập"
//            ]));
//        } else {
//            return redirect()->action('Admin\IndexController@index')->with('error', 'Không có quyền truy cập');
//        }
    }
}
