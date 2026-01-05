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
                    ['top' => 13, 'left' => 62, 'width' => 34, 'height' => 20, 'link' => 'https://nanogeyser.com/mang-loc-nuoc-nano-geyser-ro', 'name' => 'Màng lọc nước Nano Geyser RO'],
                    ['top' => 39, 'left' => 18  , 'width' => 64, 'height' => 21, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 67, 'left' => 5, 'width' => 90, 'height' => 26, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                ]],
                ['image' => '0003.jpg', 'hotspots' => [
                    ['top' => 13, 'left' => 16, 'width' => 30, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 13, 'left' => 54, 'width' => 30, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nano-geyser', 'name' => 'Lõi lọc Nano Geyser'],
                    ['top' => 40.5, 'left' => 10, 'width' => 22, 'height' => 20, 'link' => 'https://nanogeyser.com/loi-loc-nuoc-nano-geyser-cbc', 'name' => 'Lõi lọc nước Nano Geyser CBC'],
                    ['top' => 40.5, 'left' => 35.5, 'width' => 22, 'height' => 20, 'link' => 'https://nanogeyser.com/mang-loc-nuoc-nano-geyser-disruptor', 'name' => 'Màng lọc nước Nano Geyser Disruptor'],
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
                    ['top' => 17, 'left' => 5, 'width' => 90, 'height' => 19, 'link' => 'https://nanogeyser.com/may-dien-giai-ion-kiem-geyser-ion-6s-gn-i6s', 'name' => 'Máy điện giải ion kiềm Nano Geyser - ION GEYSER GN-I6S'],
                    ['top' => 42, 'left' => 5, 'width' => 90, 'height' => 25, 'link' => 'https://nanogeyser.com/may-dien-giai-ion-kiem-nano-geyser-ion-geyser-6s-plus-gn-i6sp', 'name' => 'Máy điện giải ion kiềm Nano Geyser - ION GEYSER 6S PLUS GN-I6SP'],
                ]],
                ['image' => 'caocap4.jpg', 'hotspots' => [
                    ['top' => 17, 'left' => 5, 'width' => 90, 'height' => 26, 'link' => 'https://nanogeyser.com/may-dien-giai-ion-kiem-nano-geyser-ion-geyser-gn-i8s', 'name' => 'Máy điện giải ion kiềm Nano Geyser - ION GEYSER GN-I8S'],
                ]],
            ],
            'giai-phap-phong-khach' => [
                ['image' => 'phongkhach1.jpg', 'hotspots' => []],
                ['image' => 'phongkhach2.jpg', 'hotspots' => [
                    ['top' => 15, 'left' => 5, 'width' => 95, 'height' => 26, 'link' => 'https://nanogeyser.com/may-loc-nuoc', 'name' => 'Máy lọc nước Nano Geyser'],
                ]],
                ['image' => 'phongkhach3.jpg', 'hotspots' => [
                    ['top' => 12, 'left' => 5, 'width' => 95, 'height' => 29, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nong-nguoi-nano-geyser-gr-k25ds', 'name' => 'Máy lọc nước nóng nguội Nano Geyser GR-K25DS'],
                ]],
                ['image' => 'phongkhach4.jpg', 'hotspots' => [
                    ['top' => 12, 'left' => 5, 'width' => 95, 'height' => 29, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-nong-lanh-nguoi-ro-10-cap-loc-phong-khach-gr-k37d', 'name' => 'Máy lọc nước Nano Geyser nóng - lạnh - nguội GR-K37D'],
                ]],
            ],
            'giai-phap-phong-bep' => [
                ['image' => 'phongbep1.png', 'hotspots' => []],
                ['image' => 'phongbep2.png', 'hotspots' => [
                    ['top' => 10, 'left' => 3, 'width' => 95, 'height' => 31, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-gn-b37-10-cap-loc', 'name' => 'Máy lọc nước Nano Geyser GN-B37'],
                ]],
                ['image' => 'phongbep3.png', 'hotspots' => [
                    ['top' => 10, 'left' => 3, 'width' => 95, 'height' => 31, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-ro-gr-b37-10-cap-loc', 'name' => 'Máy lọc nước Nano Geyser GR-B37'],
                ]],
                ['image' => 'phongbep4.png', 'hotspots' => [
                    ['top' => 10, 'left' => 3, 'width' => 95, 'height' => 31, 'link' => 'https://nanogeyser.com/may-loc-nuoc-nano-geyser-gm1-b35', 'name' => 'Máy lọc nước Nano Geyser GM1-B35'],
                ]],
            ],
            'giai-phap-nha-dan' => [
                ['image' => 'nhadan1.png', 'hotspots' => []],
                ['image' => 'nhadan2.png', 'hotspots' => [
                    ['top' => 13, 'left' => 3, 'width' => 95, 'height' => 31, 'link' => 'https://nanogeyser.com/loc-tong-tu-truong-disruptor-nano-geyser-gn-lt03d', 'name' => 'Lọc Tổng Từ Trường Disruptor Nano Geyser GN-LT03D'],
                ]],
                ['image' => 'nhadan3.png', 'hotspots' => [
                    ['top' => 13, 'left' => 3, 'width' => 95, 'height' => 31, 'link' => 'https://nanogeyser.com/loc-tong', 'name' => 'Lọc Tổng'],     
                ]],
                ['image' => 'nhadan4.png', 'hotspots' => [
                     ['top' => 12, 'left' => 3, 'width' => 95, 'height' => 33, 'link' => 'https://nanogeyser.com/loc-tong', 'name' => 'Lọc Tổng'],
                ]],
            ],
        ];

        return view('front.solution.index', [
            'images' => $slides[$slug] ?? []
        ]);
    }
}
