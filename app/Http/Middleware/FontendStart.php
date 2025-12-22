<?php

namespace App\Http\Middleware;

use App\Models\Popup;
use Closure;
use Illuminate\Support\Facades\View;

class FontendStart
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('_popup', Popup::inRandomOrder()->limit(5)->get());

        return $next($request);
    }
}
