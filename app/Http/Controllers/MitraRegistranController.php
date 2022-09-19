<?php

namespace App\Http\Controllers;

use App\Models\MitraGabung;

class MitraRegistranController extends Controller
{
    public function index()
    {
        $mitraRegistran = MitraGabung::all();
        return view('admin.mitra_registran.index', [
            'mitraRegistran' => $mitraRegistran
        ]);
    }

    public function compose($id)
    {
        $mitraRegistran = MitraGabung::find($id);
        return view('admin.mitra_registran.compose', [
            'mitraRegistran' => $mitraRegistran
        ]);
    }

    public function submitCompose()
    {
        return redirect()->route('admin.mitra-registran.mitra-registran');
    }
}