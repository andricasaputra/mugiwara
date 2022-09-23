<?php

namespace App\Http\Controllers;

use App\Models\SliderMitra;
use Illuminate\Http\Request;

class TambahSliderMitraController extends Controller
{
    public function index()
    {
        $slider = SliderMitra::all();
        return view('admin.slider_mitra.index', [
            'slider' => $slider
        ]);
    }

    public function create()
    {
        return view('admin.slider_mitra.create');
    }

    public function store(Request $request)
    {
        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_mitra';
            $file->move($folderUpload, $namaFile);

            $slider = new SliderMitra;
            $slider->gambar = $namaFile;
            $slider->save();

            return redirect()->route('admin.slider-mitra.slider-mitra')->withSuccess('Berhasil Tambah Data');

        } catch (\Throwable $th) {

            return redirect()->route('admin.slider-mitra.slider-mitra')->withErrors('Gagal Tambah Data Error : ' . $th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {

            $slider = SliderMitra::find($request->id);
            $slider->delete();

            return redirect()->route('admin.slider-mitra.slider-mitra')->withSuccess('Berhasil Hapus Data');
            
        } catch (\Exception $e) {
            
            return redirect()->route('admin.slider-mitra.slider-mitra')->withErrors('Gagal Hapus Data');
        }
    }
}