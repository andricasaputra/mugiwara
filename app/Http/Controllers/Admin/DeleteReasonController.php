<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeleteReason;
use Illuminate\Http\Request;

class DeleteReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = DeleteReason::latest()->get();

        return view('admin.delete_reason.index')->withReasons($reasons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delete_reason.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required',
            'description' => 'sometimes'
        ]);

        try {

            DeleteReason::create($request->all());

            return redirect(route('admin.delete_reason.index'))->withSuccess('Berhasil Tambah Data');
            
        } catch (\Exception $e) {

            return redirect(route('admin.delete_reason.index'))->withErrors('Gagal Tambah Data, Error : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reason = DeleteReason::findOrFail($id);

        return view('admin.delete_reason.edit')->withReason($reason);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required',
            'description' => 'sometimes'
        ]);

        try {

            $reason = DeleteReason::findOrFail($id);

            $reason->update($request->all());

            return redirect(route('admin.delete_reason.index'))->withSuccess('Berhasil Ubah Data');
            
        } catch (\Exception $e) {

            return redirect(route('admin.delete_reason.index'))->withErrors('Gagal Ubah Data, Error : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason = DeleteReason::findOrFail($id);

        $reason->delete();

        return redirect(route('admin.delete_reason.index'))->withSuccess('Berhasil Hapus Data');
    }
}
