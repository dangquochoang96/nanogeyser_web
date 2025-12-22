<?php

namespace App\Http\Middleware;

use Closure;

class FunctionMiddleware
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
        return $next($request);
        //        if ($user->user_id == 0) {
//            return $next($request);
//        }
//        $function_keys = explode("|", $function_keys);
//        foreach ($user->permissions as $permission) {
//            if (in_array($permission->key, $function_keys)) {
//                return $next($request);
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
