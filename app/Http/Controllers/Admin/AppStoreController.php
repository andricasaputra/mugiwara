<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppStoreLink;
use Illuminate\Http\Request;

class AppStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $appstores = AppStoreLink::latest()->get();

        return view('admin.settings.appstore.index')->withAppstores($appstores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.settings.appstore.create');
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
            'name' => 'required',
            'description' => 'required',
            'url' => 'required'
        ]);

        AppStoreLink::create($request->all());

        return redirect(route('admin.appstores.index'))->withSuccess('Berhasil Tambah Setting');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appystore = AppStoreLink::findOrFail($id);

        return view('admin.settings.appstore.edit')->withAppstore($appystore);
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
            'name' => 'required',
            'description' => 'required',
            'url' => 'required'
        ]);

        $appystore = AppStoreLink::findOrFail($id);

        $appystore->update($request->all());

        return redirect(route('admin.appstores.index'))->withSuccess('Berhasil Ubah Setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appystore = AppStoreLink::findOrFail($id);

        $appystore->delete();

        return redirect(route('admin.appstores.index'))->withSuccess('Berhasil Hapus Setting');
    }
}
