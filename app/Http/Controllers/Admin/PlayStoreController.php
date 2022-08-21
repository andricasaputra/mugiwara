<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlayStoreLink;
use Illuminate\Http\Request;

class PlayStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $playstores = PlayStoreLink::latest()->get();

        return view('admin.settings.playstore.index')->withPlaystores($playstores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.settings.playstore.create');
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

        PlayStoreLink::create($request->all());

        return redirect(route('admin.playstores.index'))->withSuccess('Berhasil Tambah Setting');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $playstore = PlayStoreLink::findOrFail($id);

        return view('admin.settings.playstore.edit')->withPlaystore($playstore);
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

        $playstore = PlayStoreLink::findOrFail($id);

        $playstore->update($request->all());

        return redirect(route('admin.playstores.index'))->withSuccess('Berhasil Ubah Setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playstore = PlayStoreLink::findOrFail($id);

        $playstore->delete();

        return redirect(route('admin.playstores.index'))->withSuccess('Berhasil Hapus Setting');
    }
}
