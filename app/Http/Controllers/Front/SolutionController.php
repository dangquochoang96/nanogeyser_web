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

        // Cấu trúc mới: mỗi ảnh có thể có nhiều hotspot (vùng click)
        // hotspots: mảng các vùng click với tọa độ % (top, left, width, height), link, và tên sản phẩm
        $slides = [
            'giai-phap-tll' => [
                ['image' => '0001.jpg', 'hotspots' => []],
                ['image' => '0002.jpg', 'hotspots' => [
                    ['top' => 13, 'left' => 5, 'width' => 52, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 13, 'left' => 62, 'width' => 34, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 39, 'left' => 18  , 'width' => 64, 'height' => 21, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 67, 'left' => 5, 'width' => 90, 'height' => 26, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                ]],
                ['image' => '0003.jpg', 'hotspots' => [
                    ['top' => 13, 'left' => 16, 'width' => 30, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 13, 'left' => 54, 'width' => 30, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 40.5, 'left' => 10, 'width' => 22, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 40.5, 'left' => 35.5, 'width' => 22, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 40.5, 'left' => 61, 'width' => 30, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 67, 'left' => 9.5, 'width' => 81, 'height' => 26, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                ]],
                ['image' => '0004.jpg', 'hotspots' => [
                    ['top' => 13, 'left' => 5, 'width' => 90, 'height' => 25.5, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                ]],
            ],
            'giai-phap-combo' => [
                ['image' => '1.jpg', 'hotspots' => []],
                ['image' => '2.jpg', 'hotspots' => []],
                ['image' => '3.jpg', 'hotspots' => []],
                ['image' => '4.jpg', 'hotspots' => []],
            ],
            'giai-phap-cao-cap' => [
                ['image' => 'caocap1.jpg', 'hotspots' => []],
                ['image' => 'caocap2.jpg', 'hotspots' => []],
                ['image' => 'caocap3.jpg', 'hotspots' => [
                    ['top' => 17, 'left' => 5, 'width' => 90, 'height' => 19, 'link' => 'https://nanogeyser.com/may-ion-kiem', 'name' => 'Máy ion kiềm'],
                ]],
                ['image' => 'caocap4.jpg', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-dien-giai-ion-kiem-nano-geyser-ion-geyser-gn-i8s', 'name' => 'Máy điện giải ion kiềm GN-I8S'],
                ]],
            ],
            'giai-phap-phong-khach' => [
                ['image' => 'phongkhach1.jpg', 'hotspots' => []],
                ['image' => 'phongkhach2.jpg', 'hotspots' => []],
                ['image' => 'phongkhach3.jpg', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nong-nguoi-nano-geyser-gr-k25ds', 'name' => 'Máy lọc nước nóng nguội GR-K25DS'],
                ]],
                ['image' => 'phongkhach4.jpg', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nong-lanh-nguoi-nano-geyser-gr-k35d', 'name' => 'Máy lọc nước nóng lạnh nguội GR-K35D'],
                ]],
            ],
            'giai-phap-phong-bep' => [
                ['image' => 'phongbep1.png', 'hotspots' => []],
                ['image' => 'phongbep2.png', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-gn-b37-10-cap-loc', 'name' => 'Máy lọc nước GN-B37'],
                ]],
                ['image' => 'phongbep3.png', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-ro-gr-b37-10-cap-loc', 'name' => 'Máy lọc nước RO GR-B37'],
                ]],
                ['image' => 'phongbep4.png', 'hotspots' => [
                    ['top' => 20, 'left' => 20, 'width' => 60, 'height' => 60, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-gm1-b35', 'name' => 'Máy lọc nước GM1-B35'],
                ]],
            ],
            'giai-phap-nha-dan' => [
                ['image' => 'nhadan1.png', 'hotspots' => []],
                ['image' => 'nhadan2.png', 'hotspots' => []],
                [
                    // Ảnh: Bộ lõi lọc nước dành cho máy công nghệ RO
                    'image' => 'nhadan3.png', 
                    'hotspots' => [
                        // === COMBO BỘ LỌC THÔ RO (hàng trên bên trái) ===
                        ['top' => 8, 'left' => 5, 'width' => 12, 'height' => 15, 'link' => '/loi-loc/pp-5mcr', 'name' => '1. PP 5MCR'],
                        ['top' => 8, 'left' => 18, 'width' => 12, 'height' => 15, 'link' => '/loi-loc/udf', 'name' => '2. UDF'],
                        ['top' => 8, 'left' => 31, 'width' => 12, 'height' => 15, 'link' => '/loi-loc/pp-1mcr', 'name' => '3. PP 1MCR'],
                        
                        // === MÀNG LỌC CHÍNH (hàng trên bên phải) ===
                        ['top' => 8, 'left' => 62, 'width' => 15, 'height' => 15, 'link' => '/loi-loc/mang-ro', 'name' => '4. Màng RO'],
                        
                        // === COMBO CHỨC NĂNG (hàng giữa) ===
                        ['top' => 32, 'left' => 18, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/maifan', 'name' => '6. Maifan'],
                        ['top' => 32, 'left' => 52, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/pure-life', 'name' => '8. Pure Life'],
                        ['top' => 42, 'left' => 25, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/t33', 'name' => '5. T33'],
                        ['top' => 42, 'left' => 42, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/hydrogen', 'name' => '7. Hydrogen'],
                        
                        // === COMBO BỘ 8 LÕI RO (hàng dưới) ===
                        ['top' => 62, 'left' => 2, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/pp-5mcr', 'name' => '1. PP 5MCR'],
                        ['top' => 62, 'left' => 13, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/udf', 'name' => '2. UDF'],
                        ['top' => 62, 'left' => 24, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/pp-1mcr', 'name' => '3. PP 1MCR'],
                        ['top' => 62, 'left' => 35, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/mang-ro', 'name' => '4. Màng RO'],
                        ['top' => 62, 'left' => 46, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/t33', 'name' => '5. T33'],
                        ['top' => 62, 'left' => 57, 'width' => 10, 'height' => 14, 'link' => '/loi-loc/hydrogen', 'name' => '7. Hydrogen'],
                        ['top' => 78, 'left' => 46, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/maifan', 'name' => '6. Maifan'],
                        ['top' => 78, 'left' => 62, 'width' => 10, 'height' => 12, 'link' => '/loi-loc/pure-life', 'name' => '8. Pure Life'],
                    ]
                ],
                ['image' => 'nhadan4.png', 'hotspots' => []],
            ],
        ];

        return view('front.solution.index', [
            'images' => $slides[$slug] ?? []
        ]);
    }
}
