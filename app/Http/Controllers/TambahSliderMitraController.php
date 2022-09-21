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
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        $slider = new SliderMitra;
        $slider->gambar = $namaFile;
        $slider->save();

        return redirect()->route('admin.slider-mitra.slider-mitra');
    }

    public function destroy(Request $request)
    {
        $slider = SliderMitra::find($request->id);
        $slider->delete();
        return redirect()->route('admin.slider-mitra.slider-mitra');
    }
}