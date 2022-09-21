<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    public function index()
    {
        $tentang = Tentang::all();
        return view('admin.tentang.index', [
            'tentang' => $tentang
        ]);
    }

    public function create()
    {
        return view('admin.tentang.create');
    }

    public function store(Request $request)
    {
        $tentang = Tentang::where('section', $request->section)->first();
        if (!is_null($tentang)) {
           return redirect()->back()->with('error', 'Sesi sudah terpilih');
        }

        $tentang = new Tentang;
        $tentang->fill($request->except('image'));
        $tentang->status = 1;
        $tentang->created_by = Auth::user()->id;
        if (!is_null($request->image)) {
            try {
                $file = $request->file('image');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/tentang';
                $file->move($folderUpload, $namaFile);
                $tentang->image = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
        $tentang->save();

        return redirect()->route('admin.beranda-tentang.beranda-tentang')->with('success', 'Berhasil menyimpan data');
    }

    public function destroy(Request $request)
    {
        $tentang = Tentang::find($request->id);
        $tentang->delete();
        return redirect()->route('admin.beranda-tentang.beranda-tentang')->with('success', 'Berhasil menghapus data');
    }

    public function edit($id)
    {
        $tentang = Tentang::find($id);
        return view('admin.tentang.edit', [
            'tentang' => $tentang
        ]);
    }

    public function update(Request $request)
    {
        $tentang = Tentang::find($request->id);
        $tentang->fill($request->except('id', 'image'));
        if (!is_null($request->image)) {
            try {
                $file = $request->file('image');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/tentang';
                $file->move($folderUpload, $namaFile);
                $tentang->image = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
        $tentang->save();
        return redirect()->route('admin.beranda-tentang.beranda-tentang')->with('success', 'Berhasil mengubah data');
    }
}