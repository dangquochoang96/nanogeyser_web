<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Validator;
use ImageUpload;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::first();
        $data = [
            'setting' => $setting
        ];
        if ($request->isMethod('post') && !empty($setting)) {
            $validator = Validator::make($request->all(), [
                'txt-name'      => 'min:3',
                'txt-email'     => 'email',
                'txt-metatitle' => 'max:100',
                'txt-keywords'  => 'max:500',
                'txt-metades'   => 'max:250'
            ], [
                    'txt-name.min'      => 'Tên quá ngắn',
                    'txt-email.email'   => 'Email không đúng định dạng',
                    'txt-metatitle.max' => 'Title quá dài',
                    'txt-keywords.max'  => 'Keywords quá dài',
                    'sl-metades.max'    => 'Description quá dài'
                ]
            );
            if (!$validator->fails()) {
                try {
                    $setting->name  = trim($request->input('txt-name'));
                    $setting->email = $request->input('txt-email');
                    $setting->phone = $request->input('txt-phone');
                    $setting->fb    = $request->input('txt-fb');
                    $setting->header = $request->input('txt-header');
                    $setting->middle = $request->input('txt-middle');
                    $setting->footer = $request->input('txt-footer');
                    $setting->about_us = $request->input('txt-about_us');
                    $setting->title = $request->input('txt-metatitle');
                    $setting->keywords = trim($request->input('txt-keywords'));
                    $setting->metades = trim($request->input('txt-metades'));

                    $setting->facebook = ($request->input('facebook'));
                    $setting->youtube = ($request->input('youtube'));
                    $setting->twitter = ($request->input('twitter'));
                    $setting->pinterest = ($request->input('pinterest'));
                    $setting->address = ($request->input('address'));
                    $setting->cskh = ($request->input('cskh'));
                    $setting->open_time = ($request->input('open_time'));

                    if ($request->has('txt-img-type')) {
                        if ($request->hasFile('file-img') && $request->input('txt-img-type') == 'file') {
                            $file = $request->file('file-img')->getClientOriginalName();
                            $filename = pathinfo($file, PATHINFO_FILENAME);
                            // $extension  = pathinfo($file, PATHINFO_EXTENSION);
                            $name = rand(0, 10).time().'-'.str_slug($filename, '-');
                            $setting->logo = ImageUpload::image($request->file('file-img'), $name);
                        } elseif ($request->input('txt-img') != "" && $request->input('txt-img-type') == 'url') {
                            $name = rand(0, 10).time().'-'.str_slug($request->input('txt-img'), '-');
                            $setting->logo = ImageUpload::image($request->input('txt-img'), md5($name));
                        }
                    }
                    try {
                        $setting->save();
                        return redirect()->action('Admin\SettingController@index')
                            ->with('success', 'Cài đặt trang thành công');
                    } catch (\Exception $ex) {
                        return redirect()->action('Admin\SettingController@index')
                            ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                    }
                } catch (\Exception $ex) {
                    return redirect()->action('Admin\SettingController@index')
                        ->with('error', 'Lỗi trong quá trình xử lý dữ liệu');
                }
            } else {
                return redirect()->action('Admin\SettingController@index')->withInput()
                    ->with('error', $validator->errors()->first());
            }
        }

        return view('admin.setting.index', $data);
    }

}