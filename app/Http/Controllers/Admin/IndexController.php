<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class IndexController extends Controller
{
    public function index()
    {
        return redirect()->route('products.index');
    }

}