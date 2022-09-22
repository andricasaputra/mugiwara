<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TambahBerandaController extends Controller 
{
    public function index()
    {
        $beranda = Beranda::all();
        return view('admin.beranda.index', [
            'beranda' => $beranda
        ]);
    }

    public function create()
    {
        return view('admin.beranda.create');
    }

    public function store(Request $request) 
    {
        $beranda = Beranda::where('section', $request->section)->first();
        if (!is_null($beranda)) {
           return redirect()->back()->with('error', 'Sesi sudah terpilih');
        }

        $beranda = new Beranda();
        $beranda->fill($request->except('file'));
        if(!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/beranda';
                $file->move($folderUpload, $namaFile);

                $beranda->file = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
        $beranda->status = 1;
        $beranda->created_by = Auth::user()->id;
        $beranda->save();

        return redirect()->route('admin.beranda.beranda');
    }

    public function destroy(Request $request)
    {
        $beranda = Beranda::find($request->id);
        $beranda->delete();
        return redirect()->route('admin.beranda.beranda');
    }

    public function edit($id)
    {
        $beranda = Beranda::find($id);
        return view('admin.beranda.edit', ['beranda' => $beranda]);
    }

    public function update(Request $request)
    {
        $beranda = Beranda::find($request->id);
        $beranda->fill($request->except('id', 'file'));
        if(!is_null($request->file)) {
            try {
                $file = $request->file('file');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/beranda';
                $file->move($folderUpload, $namaFile);

                $beranda->file = $namaFile;
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
        $beranda->save();
        return redirect()->route('admin.beranda.beranda');
    }
}