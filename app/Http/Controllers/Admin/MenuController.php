<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Validator;
use ImageUpload;

class MenuController extends Controller
{
    public function listMenu(Request $request)
    {
        $query = Menu::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%'.$request->input('name').'%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['menus'] = $query->paginate(30);

        return view('admin.menu.listMenu', $data);
    }

    public function addMenu(Request $request)
    {
        $response = [];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'txt-name' => 'required|min:3',
                'txt-order' => 'integer',
                'sl-category' => 'integer',
            ], [
                    'txt-name.required' => 'Tên Menu không được để trống',
                    'txt-name.min' => 'Tên Menu quá ngắn',
                    'txt-order.integer' => 'Thứ tự phải là số',
                    'sl-category.integer' => 'Danh mục cha không hợp lệ'
                ]
            );
            if (!$validator->fails()) {
                try {
                    $menu = new Menu();
                    $menu->name = trim($request->input('txt-name'));
                    $menu->url = $request->input('txt-url');
                    $menu->parent_id = $request->input('sl-category');
                    $menu->order = $request->input('txt-order');
                    $menu->status = $request->input('rd-status');
                    $menu->created_at = time();
                    $menu->is_big_menu = $request->input('is_big_menu', 0);
                    $menu->is_left_menu = $request->input('is_left_menu', 0);
                    if ($request->has('txt-img-type')) {
                        if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                            $file = $request->file('file-img')->getClientOriginalName();
                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                            $name = rand(0, 10).time().'-'.str_slug($filename, '-');
                            $menu->image = ImageUpload::image($request->file('file-img'), $name);
                        } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                            $name = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                            $menu->image = ImageUpload::image($request->input('txt-img'), md5($name));
                        }
                    }
                    try {
                        $menu->save();

                        return redirect()->action('Admin\MenuController@listMenu')
                            ->with('success', 'Thêm Menu "'.$menu->name.'" thành công');
                    } catch (\Exception $ex) {
                        echo "$ex";
                        die;

                        return redirect()->action('Admin\MenuController@addMenu')
                            ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    echo "$ex";
                    die;

                    return redirect()->action('Admin\MenuController@addMenu')
                        ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\MenuController@addMenu')->withInput()
                    ->with('error', $validator->errors()->first());
            }
        }
        $response['menus'] = Menu::all();

        return view('admin.menu.addMenu', $response);
    }

    public function editMenu($menu_id, Request $request)
    {
        try {
            $menu = Menu::find($menu_id);
            if (!empty($menu)) {
                $response = [
                    'title' => "Sửa Menu ".$menu->name,
                    'menu' => $menu
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name' => 'required|min:3',
                        'txt-order' => 'integer',
                        'sl-category' => 'integer',
                    ], [
                            'txt-name.required' => 'Tên Menu không được để trống',
                            'txt-name.min' => 'Tên Menu quá ngắn',
                            'txt-order.integer' => 'Thứ tự phải là số',
                            'sl-category.integer' => 'Danh mục cha không hợp lệ'
                        ]
                    );
                    if (!$validator->fails()) {
                        $menu->name = trim($request->input('txt-name'));
                        $menu->url = $request->input('txt-url');
                        $menu->parent_id = $request->input('sl-category');
                        $menu->order = $request->input('txt-order');
                        $menu->status = $request->input('rd-status');
                        $menu->is_big_menu = $request->input('is_big_menu', 0);
                        $menu->is_left_menu = $request->input('is_left_menu', 0);
                        if ($request->has('txt-img-type')) {
                            if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                                $file = $request->file('file-img')->getClientOriginalName();
                                $filename = pathinfo($file, PATHINFO_FILENAME);
                                // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                                $name = rand(0, 10).time().'-'.str_slug($filename, '-');
                                $menu->image = ImageUpload::image($request->file('file-img'), $name);
                            } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                                $name = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                                $menu->image = ImageUpload::image($request->input('txt-img'), md5($name));
                            }
                        }
                        try {
                            $menu->save();

                            return redirect()->action('Admin\MenuController@listMenu', ['id' => $menu_id])
                                ->with('success', 'Sửa Menu "'.$menu->name.'" thành công');
                        } catch (\Exception $ex) {
                            echo $ex;
                            die;

                            return redirect()->action('Admin\MenuController@editMenu', ['id' => $menu_id])
                                ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\MenuController@editMenu', ['id' => $menu_id])->withInput()
                            ->with('error', $validator->errors()->first());
                    }
                }
                $response['menus'] = Menu::where('id', '!=', $menu_id)->get();

                return view('admin.menu.editMenu', $response);
            } else {
                return redirect()->action('Admin\MenuController@listMenu')->with('error', 'Menu không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\MenuController@listMenu')
                ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'txt-uid' => 'required|alpha_num',
        ], [
                'txt-uid.required' => 'ID không hợp lệ',
                'txt-uid.alpha_num' => 'ID không hợp lệ',
            ]
        );
        if (!$validator->fails()) {
            try {
                $data = Menu::where('id', $request->input('txt-uid'))->first();
                if (!empty($data)) {
                    try {
                        $name = $data->name;
                        $data->delete();

                        return redirect()->back()->with('success', 'Xóa Menu "'.$name.'" thành công');
                    } catch (\Exception $ex) {
                        echo $ex;
                        die;

                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Menu không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
