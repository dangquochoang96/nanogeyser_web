<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Certification;

class CertificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certifications      = Certification::where('status', 1)
                        ->orderBy('order', 'asc')
        $chungNhan = Certification::where('status', 1)
                        ->where('type', Certification::TYPE_CHUNG_NHAN)
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        
        $xetNghiem = Certification::where('status', 1)
                        ->where('type', Certification::TYPE_XET_NGHIEM)
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        
        return view('watch.certification', [
            'chungNhan' => $chungNhan,
            'xetNghiem' => $xetNghiem,
        ]);
    }

    public function detail($slug)
    {
        // Thử tìm theo ID ở cuối slug
        $id = last(explode('-', $slug));
        $certification = Certification::find($id);
        
        // Nếu không tìm thấy theo ID, thử tìm theo slug
        if (!$certification) {
            $certification = Certification::where('slug', $slug)->first();
        }
        
        if (!$certification) {
            abort(404);
        }
        
        $certification->view++;
        $certification->save();
        
        $certificationRelation = Certification::where('id', '!=', $certification->id)
                                    ->take(8)
                                    ->get();
        return view('watch.certificationDetail', [
        	'certification'         => $certification,
            'certificationRelation' => $certificationRelation,
        ]);
    }

    /**
     * Hiển thị danh sách Chứng Nhận
     */
    public function chungNhan()
    {
        $certifications = Certification::where('status', 1)
                        ->where('type', Certification::TYPE_CHUNG_NHAN)
                        ->orderBy('order', 'asc')
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        return view('watch.certification', [
            'chungNhan'         => $certifications,
            'xetNghiem'         => [],
            'pageTitle'             => 'Chứng Nhận',
        ]);
    }

    /**
     * Hiển thị danh sách Xét Nghiệm
     */
    public function xetNghiem()
    {
        $certifications = Certification::where('status', 1)
                        ->where('type', Certification::TYPE_XET_NGHIEM)
                        ->orderBy('order', 'asc')
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        return view('watch.certification', [
            'xetNghiem'         => $certifications,
            'chungNhan'         => [],
            'pageTitle'             => 'Xét Nghiệm',
        ]);
    }
}
