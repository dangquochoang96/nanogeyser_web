<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = EmailContact::orderBy('id', 'desc')->paginate(20);

        return view('admin.contact.index', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

    }
    public function check(Request $request)
    {
        $id = $request->input('id');
        $bill = EmailContact::find($id);
        if($bill){
            $is_check = ($bill->is_check == 0) ? 1 : 0;            
            $bill->update([
                'is_check' => $is_check
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Thành công!'
            ]);
        }
        return response()->json([
            'code' => 403,
            'message' => 'Có lỗi xảy ra'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = EmailContact::find($id);
        $bill->delete();

        return redirect()->back()->with('success', 'Xóa thành công!');
    }
}
