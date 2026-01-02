<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Dealer;
use App\Models\Province;
use Validator;

class AgentController extends Controller
{
    // Danh sách đại lý (dealers)
    public function list(Request $request)
    {
        $query = Dealer::query();
        
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        
        if ($request->has('province_code') && $request->input('province_code') != "") {
            $query->where('province_code', $request->input('province_code'));
        }
        
        $data['dealers'] = $query->paginate(30);
        $data['provinces'] = Province::orderBy('name', 'ASC')->get();
        
        return view('admin.agent.list', $data);
    }

    // Thêm đại lý
    public function add(Request $request)
    {
        $response = [];
        // Lấy danh sách tỉnh từ bảng locations (unique)
        $response['provinces'] = Location::select('province_code', 'province_name')
            ->distinct()
            ->orderBy('province_name', 'ASC')
            ->get();
        $response['locations'] = Location::orderBy('district_name', 'ASC')->get();
        
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'txt-name' => 'required|min:3',
                'txt-address' => 'required',
            ], [
                'txt-name.required' => 'Tên đại lý không được để trống',
                'txt-name.min' => 'Tên đại lý quá ngắn',
                'txt-address.required' => 'Địa chỉ không được để trống',
            ]);
            
            if (!$validator->fails()) {
                try {
                    $dealer = new Dealer();
                    $dealer->name = trim($request->input('txt-name'));
                    $dealer->address = trim($request->input('txt-address'));
                    $dealer->phone = trim($request->input('txt-phone'));
                    $dealer->province_code = trim($request->input('txt-province-code'));
                    $dealer->district_code = trim($request->input('txt-district-code'));
                    $dealer->is_active = $request->input('rd-status', 1);
                    $dealer->save();
                    
                    return redirect()->action('Admin\AgentController@list')->with('success', 'Thêm đại lý "' . $dealer->name . '" thành công');
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\AgentController@add')->with('error', 'Lỗi trong quá trình xử lý dữ liệu: ' . $ex->getMessage());
                }
            } else {
                return redirect()->action('Admin\AgentController@add')->withInput()->with('error', $validator->errors()->first());
            }
        }
        
        return view('admin.agent.add', $response);
    }

    // Sửa đại lý
    public function edit($id, Request $request)
    {
        try {
            $dealer = Dealer::find($id);
            
            if (!empty($dealer)) {
                // Lấy danh sách tỉnh từ bảng locations (unique)
                $provinces = Location::select('province_code', 'province_name')
                    ->distinct()
                    ->orderBy('province_name', 'ASC')
                    ->get();
                
                $response = [
                    'title' => "Sửa đại lý " . $dealer->name,
                    'dealer' => $dealer,
                    'provinces' => $provinces,
                    'locations' => Location::orderBy('district_name', 'ASC')->get()
                ];
                
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name' => 'required|min:3',
                        'txt-address' => 'required',
                    ], [
                        'txt-name.required' => 'Tên đại lý không được để trống',
                        'txt-name.min' => 'Tên đại lý quá ngắn',
                        'txt-address.required' => 'Địa chỉ không được để trống',
                    ]);
                    
                    if (!$validator->fails()) {
                        $dealer->name = trim($request->input('txt-name'));
                        $dealer->address = trim($request->input('txt-address'));
                        $dealer->phone = trim($request->input('txt-phone'));
                        $dealer->province_code = trim($request->input('txt-province-code'));
                        $dealer->district_code = trim($request->input('txt-district-code'));
                        $dealer->is_active = $request->input('rd-status', 1);
                        $dealer->save();
                        
                        return redirect()->action('Admin\AgentController@list')->with('success', 'Sửa đại lý "' . $dealer->name . '" thành công');
                    } else {
                        return redirect()->action('Admin\AgentController@edit', ['id' => $id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                
                return view('admin.agent.edit', $response);
            } else {
                return redirect()->action('Admin\AgentController@list')->with('error', 'Đại lý không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\AgentController@list')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    // Xóa đại lý
    public function del(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt-uid' => 'required|numeric',
        ], [
            'txt-uid.required' => 'ID không hợp lệ',
            'txt-uid.numeric' => 'ID không hợp lệ',
        ]);
        
        if (!$validator->fails()) {
            try {
                $data = Dealer::find($request->input('txt-uid'));
                
                if (!empty($data)) {
                    $name = $data->name;
                    $data->delete();
                    return redirect()->back()->with('success', 'Xóa đại lý "' . $name . '" thành công');
                } else {
                    return redirect()->back()->with('error', 'Đại lý không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }

    // Danh sách quận/huyện (locations)
    public function listDistricts(Request $request)
    {
        $query = Location::query();
        
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('district_name', 'LIKE', '%' . $request->input('name') . '%');
        }
        
        $data['locations'] = $query->paginate(30);
        
        return view('admin.agent.districts', $data);
    }

    // Thêm quận/huyện
    public function addDistrict(Request $request)
    {
        $response = [];
        $response['provinces'] = Province::orderBy('name', 'ASC')->get();
        
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'txt-district-name' => 'required|min:2',
                'txt-district-code' => 'required',
            ], [
                'txt-district-name.required' => 'Tên quận/huyện không được để trống',
                'txt-district-name.min' => 'Tên quận/huyện quá ngắn',
                'txt-district-code.required' => 'Mã quận/huyện không được để trống',
            ]);
            
            if (!$validator->fails()) {
                try {
                    $location = new Location();
                    $location->district_name = trim($request->input('txt-district-name'));
                    $location->district_code = trim($request->input('txt-district-code'));
                    $location->province_code = trim($request->input('txt-province-code'));
                    $location->province_name = trim($request->input('txt-province-name'));
                    $location->save();
                    
                    return redirect()->action('Admin\AgentController@listDistricts')->with('success', 'Thêm quận/huyện "' . $location->district_name . '" thành công');
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\AgentController@addDistrict')->with('error', 'Lỗi trong quá trình xử lý dữ liệu: ' . $ex->getMessage());
                }
            } else {
                return redirect()->action('Admin\AgentController@addDistrict')->withInput()->with('error', $validator->errors()->first());
            }
        }
        
        return view('admin.agent.add_district', $response);
    }

    // Sửa quận/huyện
    public function editDistrict($id, Request $request)
    {
        try {
            $location = Location::find($id);
            
            if (!empty($location)) {
                $response = [
                    'title' => "Sửa quận/huyện " . $location->district_name,
                    'location' => $location,
                    'provinces' => Province::orderBy('name', 'ASC')->get()
                ];
                
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-district-name' => 'required|min:2',
                        'txt-district-code' => 'required',
                    ], [
                        'txt-district-name.required' => 'Tên quận/huyện không được để trống',
                        'txt-district-name.min' => 'Tên quận/huyện quá ngắn',
                        'txt-district-code.required' => 'Mã quận/huyện không được để trống',
                    ]);
                    
                    if (!$validator->fails()) {
                        $location->district_name = trim($request->input('txt-district-name'));
                        $location->district_code = trim($request->input('txt-district-code'));
                        $location->province_code = trim($request->input('txt-province-code'));
                        $location->province_name = trim($request->input('txt-province-name'));
                        $location->save();
                        
                        return redirect()->action('Admin\AgentController@listDistricts')->with('success', 'Sửa quận/huyện "' . $location->district_name . '" thành công');
                    } else {
                        return redirect()->action('Admin\AgentController@editDistrict', ['id' => $id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                
                return view('admin.agent.edit_district', $response);
            } else {
                return redirect()->action('Admin\AgentController@listDistricts')->with('error', 'Quận/huyện không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\AgentController@listDistricts')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    // Xóa quận/huyện
    public function delDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt-uid' => 'required|numeric',
        ], [
            'txt-uid.required' => 'ID không hợp lệ',
            'txt-uid.numeric' => 'ID không hợp lệ',
        ]);
        
        if (!$validator->fails()) {
            try {
                $data = Location::find($request->input('txt-uid'));
                
                if (!empty($data)) {
                    $name = $data->district_name;
                    $data->delete();
                    return redirect()->back()->with('success', 'Xóa quận/huyện "' . $name . '" thành công');
                } else {
                    return redirect()->back()->with('error', 'Quận/huyện không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}