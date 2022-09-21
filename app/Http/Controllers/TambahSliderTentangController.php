<?php

namespace App\Http\Controllers;

use App\Models\TambahSliderTentang;
use Illuminate\Http\Request;

class TambahSliderTentangController extends Controller
{
    public function index()
    {
        $sliderTentang = TambahSliderTentang::all();
        return view('admin.slider_tentang.index', [
            'sliderTentang' => $sliderTentang
        ]);       
    }

    public function create()
    {
        return view('admin.slider_tentang.create');
    }

    public function store(Request $request)
    {
        try {
            $file = $request->file('image');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_tentang';
            $file->move($folderUpload, $namaFile);

            $sliders = new TambahSliderTentang;
            $sliders->fill($request->except('status', 'image'));
            $sliders->image = $namaFile;
            $sliders->status = 1;
            $sliders->save();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.slider-tentang.slider-tentang');
    }

    public function destroy(Request $request)
    {
        $slider = TambahSliderTentang::find($request->id);
        $slider->delete();
        return redirect()->route('admin.slider-tentang.slider-tentang'); 
    }

    public function edit($id)
    {
        $slider = TambahSliderTentang::find($id);
        return view('admin.slider_tentang.edit', [
            'slider' => $slider
        ]);
    }

    public function update(Request $request)
    {
        $slider = TambahSliderTentang::find($request->id);
        $slider->fill($request->except('id', 'status', 'image'));

        if(!is_null($request->image)) {
            try {
                $file = $request->file('image');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/slider_tentang';
                $file->move($folderUpload, $namaFile);

                $slider->image = $namaFile;
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        $slider->save();
        return redirect()->route('admin.slider-tentang.slider-tentang');
    }
}