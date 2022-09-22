<?php
namespace App\Http\Controllers;

use App\Models\TambahBerandaInformasi;
use Illuminate\Http\Request;

class TambahBerandaInformasiController extends Controller
{
    public function index()
    {
        $info = TambahBerandaInformasi::all();
        return view('admin.beranda_informasi.index', [
            'info' => $info
        ]);
    }

    public function create()
    {
        return view('admin.beranda_informasi.create');
    }

    public function store(Request $request)
    {
        try {
            $file = $request->file('image');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_informasi';
            $file->move($folderUpload, $namaFile);

            $info = new TambahBerandaInformasi;
            $info->fill($request->except('status', 'image'));
            $info->image = $namaFile;
            $info->status = 1;
            $info->save();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.beranda-informasi.beranda-informasi');
    }

    public function destroy(Request $request)
    {
        $info = TambahBerandaInformasi::find($request->id);
        $info->delete();
        return redirect()->route('admin.beranda-informasi.beranda-informasi');
    }

    public function edit($id)
    {
        $info = TambahBerandaInformasi::find($id);
        return view('admin.beranda_informasi.edit', [
            'info' => $info
        ]);
    }

    public function update(Request $request)
    {
        $slider = TambahBerandaInformasi::find($request->id);
        $slider->fill($request->except('id', 'status', 'image'));

        if(!is_null($request->image)) {
            try {
                $file = $request->file('image');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/slider_informasi';
                $file->move($folderUpload, $namaFile);

                $slider->image = $namaFile;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $slider->save();
        return redirect()->route('admin.beranda-informasi.beranda-informasi');
    }
}
