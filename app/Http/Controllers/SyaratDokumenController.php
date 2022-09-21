<?php

namespace App\Http\Controllers;

use App\Models\SyaratDokumen;
use Illuminate\Http\Request;

class SyaratDokumenController extends Controller
{
    public function index()
    {
        $syarat = SyaratDokumen::orderBy('order', 'asc')->get();
        return view('admin.syarat_dokumen.index', [
            'syarat' => $syarat
        ]);
    }

    public function create()
    {
        return view('admin.syarat_dokumen.create');
    }

    public function store(Request $request)
    {
        $prevSyarat = SyaratDokumen::orderBy('order', 'desc')->first();
        $order = 1;
        if (!is_null($prevSyarat)) {
            $order = $prevSyarat->order + 1;
        }

        $syarat = new SyaratDokumen;
        $syarat->fill($request->except('file'));

        if (!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/syarat';
                $file->move($folderUpload, $namaFile);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $syarat->file = $namaFile;
        $syarat->order = $order;
        $syarat->save();

        return redirect()->route('admin.syarat-dokumen.syarat-dokumen');
    }

    public function destroy(Request $request)
    {
        $syarat = SyaratDokumen::find($request->id);
        $syarat->delete();
        return redirect()->route('admin.syarat-dokumen.syarat-dokumen');
    }

    public function edit($id)
    {
        $syarat = SyaratDokumen::find($id);
        $syaratCount = SyaratDokumen::count();
        return view('admin.syarat_dokumen.edit', [
            'syarat' => $syarat,
            'syaratCount' => $syaratCount
        ]);
    }

    public function update(Request $request)
    {
        $syarat = SyaratDokumen::find($request->id);
        $syarat->fill($request->except('id', 'file'));

        if (!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/syarat';
                $file->move($folderUpload, $namaFile);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $syarat->save();
        return redirect()->route('admin.syarat-dokumen.syarat-dokumen');
    }
}