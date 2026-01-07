<?php

namespace App\Http\Controllers\Front;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $data = Page::where('slug', 've-chung-toi')->first();
            
        return view('watch.aboutUs', [
            'data' => $data
        ]);
    }
}
