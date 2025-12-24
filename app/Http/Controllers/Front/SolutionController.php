<?php

namespace App\Http\Controllers\Front;

use App\Models\EmailContact;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Validator;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->route()->getName();

        $slides = [
            'giai-phap-tll' => [
                '0001.jpg',
                '0002.jpg',
                '0003.jpg',
                '0004.jpg',
            ],
            'giai-phap-combo' => [
                '1.jpg',
                '2.jpg',
                '3.jpg',
                '4.jpg',
            ],
            'giai-phap-cao-cap' => [
                'caocap1.jpg',
                'caocap2.jpg',
                'caocap3.jpg',
                'caocap4.jpg',
            ],
            'giai-phap-phong-khach' => [
                'phongkhach1.jpg',
                'phongkhach2.jpg',
                'phongkhach3.jpg',
                'phongkhach4.jpg',
            ],
            'giai-phap-phong-bep' => [
                'phongbep1.jpg',
                'phongbep2.jpg',
                'phongbep3.jpg',
                'phongbep4.jpg',
            ],
            'giai-phap-nha-dan' => [
                'nhadan1.jpg',
                'nhadan2.jpg',
                'nhadan3.jpg',
                'nhadan4.jpg',
            ],
        ];

        return view('front.solution.index', [
            'images' => $slides[$slug] ?? []
        ]);
    }
}