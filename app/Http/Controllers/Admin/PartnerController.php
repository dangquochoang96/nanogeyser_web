<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Validator;

class PartnerController extends Controller
{
    // Danh sách đối tác
    public function list(Request $request)
    {
        $query = Partner::query();
        
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        
        $data['partners'] = $query->orderBy('order', 'ASC')->paginate(30);
        
        return view('admin.partner.list', $data);
    }

    // Thêm đối tác
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'txt-name' => 'required|min:2',
            ], [
                'txt-name.required' => 'Tên đối tác không được để trống',
                'txt-name.min' => 'Tên đối tác quá ngắn',
            ]);
            
            if (!$validator->fails()) {
                try {
                    $partner = new Partner();
                    $partner->name = trim($request->input('txt-name'));
                    $partner->phone = trim($request->input('txt-phone'));
                    $partner->address = trim($request->input('txt-address'));
                    $partner->order = (int)$request->input('txt-order', 0);
                    $partner->is_active = $request->input('rd-status', 1);
                    
                    // Upload ảnh
                    if ($request->hasFile('txt-image')) {
                        $file = $request->file('txt-image');
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/partners'), $filename);
                        $partner->image = 'uploads/partners/' . $filename;
                    }
                    
                    $partner->save();
                    
                    return redirect()->action('Admin\PartnerController@list')->with('success', 'Thêm đối tác "' . $partner->name . '" thành công');
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\PartnerController@add')->with('error', 'Lỗi: ' . $ex->getMessage());
                }
            } else {
                return redirect()->action('Admin\PartnerController@add')->withInput()->with('error', $validator->errors()->first());
            }
        }
        
        return view('admin.partner.add');
    }

    // Sửa đối tác
    public function edit($id, Request $request)
    {
        try {
            $partner = Partner::find($id);
            
            if (!empty($partner)) {
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name' => 'required|min:2',
                    ], [
                        'txt-name.required' => 'Tên đối tác không được để trống',
                        'txt-name.min' => 'Tên đối tác quá ngắn',
                    ]);
                    
                    if (!$validator->fails()) {
                        $partner->name = trim($request->input('txt-name'));
                        $partner->phone = trim($request->input('txt-phone'));
                        $partner->address = trim($request->input('txt-address'));
                        $partner->order = (int)$request->input('txt-order', 0);
                        $partner->is_active = $request->input('rd-status', 1);
                        
                        // Upload ảnh
                        if ($request->hasFile('txt-image')) {
                            $file = $request->file('txt-image');
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('uploads/partners'), $filename);
                            $partner->image = 'uploads/partners/' . $filename;
                        }
                        
                        $partner->save();
                        
                        return redirect()->action('Admin\PartnerController@list')->with('success', 'Sửa đối tác "' . $partner->name . '" thành công');
                    } else {
                        return redirect()->action('Admin\PartnerController@edit', ['id' => $id])->withInput()->with('error', $validator->errors()->first());
                    }
                }
                
                return view('admin.partner.edit', ['partner' => $partner]);
            } else {
                return redirect()->action('Admin\PartnerController@list')->with('error', 'Đối tác không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\PartnerController@list')->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    // Xóa đối tác
    public function del(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt-uid' => 'required|numeric',
        ]);
        
        if (!$validator->fails()) {
            try {
                $data = Partner::find($request->input('txt-uid'));
                
                if (!empty($data)) {
                    $name = $data->name;
                    $data->delete();
                    return redirect()->back()->with('success', 'Xóa đối tác "' . $name . '" thành công');
                } else {
                    return redirect()->back()->with('error', 'Đối tác không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
