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

        // Hotspot configuration - tùy chỉnh tại đây
        // top, left: vị trí (%), width, height: kích thước vùng click (%)
        // type: 'link' (mặc định) hoặc 'scroll' (cuộn xuống)
        // target: ID của element cần cuộn đến (dùng với type: 'scroll')
        $hotspots = [
            ['top' => 53, 'left' => 37, 'width' => 25.5, 'height' => 5.75, 'link' => 'https://nanogeyser.com/giai-phap-phong-bep', 'name' => 'Giải pháp phòng bếp', 'type' => 'link'],
            ['top' => 53, 'left' => 5, 'width' => 25.5, 'height' => 5.75, 'link' => 'https://nanogeyser.com/giai-phap-loc-tong', 'name' => 'Giải pháp lọc tổng', 'type' => 'link'],
            ['top' => 53, 'left' => 69, 'width' => 25.5, 'height' => 5.75, 'link' => 'https://nanogeyser.com/giai-phap-phong-khach', 'name' => 'Giải pháp phòng khách', 'type' => 'link'],
            ['top' => 62, 'left' => 37, 'width' => 25.5, 'height' => 5.5, 'link' => 'https://nanogeyser.com/giai-phap-combo', 'name' => 'Giải pháp combo nhà mới', 'type' => 'link'],
            ['top' => 62, 'left' => 5.25, 'width' => 25.5, 'height' => 5.5, 'link' => 'https://nanogeyser.com/giai-phap-cao-cap', 'name' => 'Giải pháp cao cấp', 'type' => 'link'],
            ['top' => 62, 'left' => 69, 'width' => 25.5, 'height' => 5.5, 'link' => 'https://nanogeyser.com/giai-phap-thay-loi-loc', 'name' => 'Giải pháp thay lõi lọc', 'type' => 'link'],
            ['top' => 73, 'left' => 5.5, 'width' => 42.5, 'height' => 9.5, 'link' => 'https://nanogeyser.com/certification/chung-nhan-bao-ho-thuong-hieu-61', 'name' => 'Bảo hộ thương hiệu', 'type' => 'link'],
            ['top' => 73, 'left' => 50.4, 'width' => 42.5, 'height' => 9.5, 'link' => 'https://nanogeyser.com/certification/chung-nhan-iso-90012015-58', 'name' => 'CHỨNG NHẬN ISO 9001:2015', 'type' => 'link'],
            ['top' => 86, 'left' => 5.25, 'width' => 42.5, 'height' => 9.5, 'link' => 'https://nanogeyser.com/certification/chung-nhan-tcvn-119782017-may-loc-nuoc-ro-nano-ion-kiem-59', 'name' => 'CHỨNG NHẬN TCVN 11978:2017 MÁY LỌC NƯỚC RO, NANO & ION KIỀM', 'type' => 'link'],
            ['top' => 86, 'left' => 51.25, 'width' => 44, 'height' => 9.5, 'link' => 'https://nanogeyser.com/certification/chung-nhan-qcvn-4-may-loc-nuoc-nong-lanh-60', 'name' => 'CHỨNG NHẬN QCVN 4 MÁY LỌC NƯỚC NÓNG LẠNH', 'type' => 'link'],
            // Hotspot cuộn xuống button
            ['top' => 7.8, 'left' => 5.5, 'width' => 20, 'height' => 1.3, 'target' => 'button-section', 'name' => 'Cuộn xuống', 'type' => 'scroll'],
        ];

        return view('watch.aboutUs', [
            'data' => $data,
            'hotspots' => $hotspots
        ]);
    }
}
