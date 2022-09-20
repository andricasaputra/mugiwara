<?php

namespace App\Http\Controllers;

use App\Mail\RegistranCompose;
use App\Models\MitraGabung;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function submitCompose(Request $request)
    {
        try {
            Mail::to($request->to)->send(new RegistranCompose($request));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.mitra-registran.mitra-registran');
    }
}