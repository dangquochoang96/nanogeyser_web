<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Validator;
use ImageUpload;

class PageController extends Controller
{
    public function listPage(Request $request)
    {
        $query = Page::orderBy('created_at', 'DESC');
        if ($request->has('name') && $request->input('name') != "") {
            $query->where('name', 'LIKE', '%'.$request->input('name').'%');
        }
        if ($request->has('status') && is_numeric($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }
        $data['pages'] = $query->paginate(30);

        return view('admin.page.listPage', $data);
    }

    public function addPage(Request $request)
    {
        $response = [];
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'txt-name' => 'required|min:3',
                'txt-des' => 'required|min:20',
                'txt-order' => 'integer',
                'sl-parent' => 'integer',
            ], [
                    'txt-name.required' => 'Tên Blog không được để trống',
                    'txt-name.min' => 'Tên Blog quá ngắn',
                    'txt-des.required' => 'Mô tả không được để trống',
                    'txt-des.min' => 'Mô tả quá ngắn',
                    'txt-order.integer' => 'Thứ tự phải là số',
                    'sl-parent.integer' => 'Danh mục cha không hợp lệ'
                ]
            );
            if (!$validator->fails()) {
                try {
                    $page = new Page();
                    $page->name = trim($request->input('txt-name'));
                    $page->slug = str_slug(trim($request->input('txt-name')));
                    $page->shortdes = $request->input('txt-shortdes');
                    $page->des = $request->input('txt-des');
                    $page->status = $request->input('rd-status');
                    $page->keywords = $request->input('txt-keyword');
                    $page->metades = $request->input('txt-metades');
                    $page->created_at = time();
                    if ($request->has('txt-img-type')) {
                        if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                            $file = $request->file('file-img')->getClientOriginalName();
                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                            $name = rand(0, 10).time().'-'.str_slug($filename, '-');
                            $page->image = ImageUpload::image($request->file('file-img'), $name);
                        } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                            $name = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                            $page->image = ImageUpload::image($request->input('txt-img'), md5($name));
                        }
                    }
                    try {
                        $page->save();

                        return redirect()->action('Admin\PageController@listPage')
                            ->with('success', 'Thêm Trang "'.$page->name.'" thành công');
                    } catch (\Exception $ex) {
                        echo "$ex";
                        die;

                        return redirect()->action('Admin\PageController@addPage')
                            ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    echo "$ex";
                    die;

                    return redirect()->action('Admin\PageController@addPage')
                        ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\PageController@addPage')->withInput()
                    ->with('error', $validator->errors()->first());
            }
        }

        return view('admin.page.addPage', $response);
    }

    public function editPage($page_id, Request $request)
    {
        try {
            $page = Page::find($page_id);
            if (!empty($page)) {
                $response = [
                    'title' => "Sửa trang ".$page->name,
                    'page' => $page
                ];
                if ($request->isMethod('post')) {
                    $validator = Validator::make($request->all(), [
                        'txt-name' => 'required|min:3',
                        'txt-des' => 'required|min:20',
                        'txt-order' => 'integer',
                        'sl-parent' => 'integer',
                    ], [
                            'txt-name.required' => 'Tên Blog không được để trống',
                            'txt-name.min' => 'Tên Blog quá ngắn',
                            'txt-des.required' => 'Mô tả không được để trống',
                            'txt-des.min' => 'Mô tả quá ngắn',
                            'txt-order.integer' => 'Thứ tự phải là số',
                            'sl-parent.integer' => 'Danh mục cha không hợp lệ'
                        ]
                    );
                    if (!$validator->fails()) {
                        $page->name = trim($request->input('txt-name'));
                        $page->slug = str_slug(trim($request->input('txt-name')));
                        $page->shortdes = $request->input('txt-shortdes');
                        $page->des = $request->input('txt-des');
                        $page->status = $request->input('rd-status');
                        $page->keywords = $request->input('txt-keyword');
                        $page->metades = $request->input('txt-metades');
                        if ($request->has('txt-img-type')) {
                            if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                                $file = $request->file('file-img')->getClientOriginalName();
                                $filename = pathinfo($file, PATHINFO_FILENAME);
                                // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                                $name = rand(0, 10).time().'-'.str_slug($filename, '-');
                                $page->image = ImageUpload::image($request->file('file-img'), $name);
                            } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                                $name = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                                $page->image = ImageUpload::image($request->input('txt-img'), md5($name));
                            }
                        }
                        try {
                            $page->save();

                            return redirect()->action('Admin\PageController@listPage', ['id' => $page_id])
                                ->with('success', 'Sửa Trang "'.$page->name.'" thành công');
                        } catch (\Exception $ex) {
                            echo $ex;
                            die;

                            return redirect()->action('Admin\PageController@editPage', ['id' => $page_id])
                                ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                        }
                    } else {
                        return redirect()->action('Admin\PageController@editPage', ['id' => $page_id])->withInput()
                            ->with('error', $validator->errors()->first());
                    }
                }

                return view('admin.page.editPage', $response);
            } else {
                return redirect()->action('Admin\PageController@listPage')->with('error', 'Trang không tồn tại');
            }
        } catch (\Exception $ex) {
            return redirect()->action('Admin\PageController@listPage')
                ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
        }
    }

    public function delPage(Request $request)
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
                $data = Page::where('id', $request->input('txt-uid'))->first();
                if (!empty($data)) {
                    try {
                        $name = $data->name;
                        $data->delete();

                        return redirect()->back()->with('success', 'Xóa Trang "'.$name.'" thành công');
                    } catch (\Exception $ex) {
                        echo $ex;
                        die;

                        return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } else {
                    return redirect()->back()->with('error', 'Trang không tồn tại');
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
            }
        } else {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    }
}
