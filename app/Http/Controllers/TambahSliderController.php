<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\TambahSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TambahSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = TambahSlider::all();
        return view('compro.slider', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_slider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image'
        ]);

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider';
            $file->move($folderUpload, $namaFile);

            $sliders = new TambahSlider();
            $sliders->gambar = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.slider.slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TambahSlider  $tambahSlider
     * @return \Illuminate\Http\Response
     */
    public function show(TambahSlider $tambahSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TambahSlider  $tambahSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(TambahSlider $tambahSlider, $id)
    {
        $tambahSlider = TambahSlider::find($id);
        return view('compro.edit_slider', ['sliders' => $tambahSlider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TambahSlider  $tambahSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TambahSlider $tambahSlider, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider';
            $file->move($folderUpload, $namaFile);

            $sliders = TambahSlider::find($id);
            $sliders->gambar = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.slider.slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TambahSlider  $tambahSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(TambahSlider $tambahSlider, $id)
    {
        $sliders = TambahSlider::find($id);
        $sliders->delete();
        return redirect()->route('admin.slider.slider');
    }
}
