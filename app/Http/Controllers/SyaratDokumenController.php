<?php

namespace App\Http\Controllers;

use App\Models\SyaratDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($request->all(), [
                'file' => 'max:1000|mimes:jpeg,png,jpg,zip,docx'
            ],[
                'max' => ':attribute max 1 mb',
                'mimes' => ':attribute harus gambar, zip, atau docx'
            ]);

            if ($validator->fails()) {
                foreach($validator->errors()->messages() as $key => $v) {
                    return redirect()->back()->with('error', $v[0]);
                }
            }

            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/syarat';
                $file->move($folderUpload, $namaFile);
                $syarat->file = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->route('admin.syarat-dokumen.syarat-dokumen')->with('error', $th->getMessage());
            }
        }

        $syarat->order = $order;
        $syarat->save();

        return redirect()->route('admin.syarat-dokumen.syarat-dokumen')->with('success', 'Berhasil menambah data');
    }

    public function destroy(Request $request)
    {
        $syarat = SyaratDokumen::find($request->id);
        $syarat->delete();
        return redirect()->route('admin.syarat-dokumen.syarat-dokumen')->with('success', 'Berhasil menghapus data');
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
            $validator = Validator::make($request->all(), [
                'file' => 'max:1000|mimes:jpeg,png,jpg,zip,docx'
            ],[
                'max' => ':attribute max 1 mb',
                'mimes' => ':attribute harus gambar, zip, atau docx'
            ]);

            if ($validator->fails()) {
                foreach($validator->errors()->messages() as $key => $v) {
                    return redirect()->back()->with('error', $v[0]);
                }
            }
            
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/syarat';
                $file->move($folderUpload, $namaFile);
                $syarat->file = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->route('admin.syarat-dokumen.syarat-dokumen')->with('error', $th->getMessage());
            }
        }

        $syarat->save();
        return redirect()->route('admin.syarat-dokumen.syarat-dokumen')->with('success', 'Berhasil mengubah data');
    }
}