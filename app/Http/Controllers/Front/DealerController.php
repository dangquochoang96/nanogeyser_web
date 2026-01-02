<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Province;
use App\Models\District;

class DealerController extends Controller
{
    public function index(Request $request)
    {
        $query = Dealer::where('is_active', 1);
        
        if ($request->has('province') && $request->input('province') != "") {
            $query->where('province_code', $request->input('province'));
        }
        
        if ($request->has('district') && $request->input('district') != "") {
            $query->where('district_code', $request->input('district'));
        }
        
        $dealers = $query->get();
        $provinces = Province::orderBy('name', 'ASC')->get();
        $districts = District::orderBy('name', 'ASC')->get();
        
        return view('watch.dealer', [
            'dealers' => $dealers,
            'provinces' => $provinces,
            'districts' => $districts,
            'selectedProvince' => $request->input('province'),
            'selectedDistrict' => $request->input('district')
        ]);
    }

    public function getDistricts(Request $request)
    {
        $provinceCode = $request->input('province_code');
        $districts = District::where('province_code', $provinceCode)
            ->orderBy('name', 'ASC')
            ->get();
        
        return response()->json($districts);
    }
}
