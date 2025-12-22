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
                        ->orderBy('id', 'desc')
        				->paginate(12);
        return view('watch.certification', [
            'certification'         => $certifications,
        ]);
    }

    public function detail($slug)
    {
        $certification = Certification::find(last(explode('-', $slug)));
        $certification->view++;
        $certification->save();
        $certificationRelation = Certification::where('id','!=',$certification->id)
                                    ->take(8)
                                    ->get();
        return view('watch.certificationDetail', [
        	'certification'         => $certification,
            'certificationRelation' => $certificationRelation,
        ]);
    }
}
