<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::orderBy('order', 'asc')->get();
        return view('admin.pendaftaran.index', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    public function create()
    {
        return view('admin.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $prevPendaftaran = Pendaftaran::orderBy('order', 'desc')->first();
        $order = 1;
        if (!is_null($prevPendaftaran)) {
            $order = $prevPendaftaran->order + 1;
        }

        $pendaftaran = new Pendaftaran;
        $pendaftaran->fill($request->except('file'));

        if (!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/pendaftaran';
                $file->move($folderUpload, $namaFile);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $pendaftaran->file = $namaFile;
        $pendaftaran->order = $order;
        $pendaftaran->save();

        return redirect()->route('admin.pendaftaran.pendaftaran');
    }

    public function destroy(Request $request)
    {
        $pendaftaran = Pendaftaran::find($request->id);
        $pendaftaran->delete();
        return redirect()->route('admin.pendaftaran.pendaftaran');
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaranCount = Pendaftaran::count();
        return view('admin.pendaftaran.edit', [
            'pendaftaran' => $pendaftaran,
            'pendaftaranCount' => $pendaftaranCount
        ]);
    }

    public function update(Request $request)
    {
        $pendaftaran = Pendaftaran::find($request->id);
        $pendaftaran->fill($request->except('id', 'file'));

        if (!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/pendaftaran';
                $file->move($folderUpload, $namaFile);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $pendaftaran->save();
        return redirect()->route('admin.pendaftaran.pendaftaran');
    }
}