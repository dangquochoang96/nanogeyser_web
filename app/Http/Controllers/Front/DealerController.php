<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Partner;
use App\Models\Location;

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
        
        // Lấy đối tác phân phối cho slider
        $partners = Partner::where('is_active', 1)->orderBy('order', 'ASC')->get();
        
        // Lấy danh sách tỉnh từ bảng locations (unique)
        $provinces = Location::select('province_code', 'province_name')
            ->distinct()
            ->orderBy('province_name', 'ASC')
            ->get();
        $locations = Location::orderBy('district_name', 'ASC')->get();
        
        return view('watch.dealer', [
            'dealers' => $dealers,
            'partners' => $partners,
            'provinces' => $provinces,
            'locations' => $locations,
            'selectedProvince' => $request->input('province'),
            'selectedDistrict' => $request->input('district')
        ]);
    }

    public function getDistricts(Request $request)
    {
        $provinceCode = $request->input('province_code');
        $locations = Location::where('province_code', $provinceCode)
            ->orderBy('district_name', 'ASC')
            ->get();
        
        return response()->json($locations);
    }
}
