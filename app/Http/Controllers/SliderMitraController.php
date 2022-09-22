<?php

namespace App\Http\Controllers;

use App\Models\SliderMitra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderMitras = SliderMitra::all();
        return view('compro.slider_mitra', ['sliderMitras' => $sliderMitras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_slider_mitra');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_mitra';
            $file->move($folderUpload, $namaFile);

            $sliders = new SliderMitra();
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.sliderMitra.sliderMitra')->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SliderMitra  $sliderMitra
     * @return \Illuminate\Http\Response
     */
    public function show(SliderMitra $sliderMitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SliderMitra  $sliderMitra
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderMitra $sliderMitra, $id)
    {
        $sliderMitras = SliderMitra::find($id);
        return view('compro.edit_slider_mitra', ['sliderMitras' => $sliderMitras]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SliderMitra  $sliderMitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderMitra $sliderMitra, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_mitra';
            $file->move($folderUpload, $namaFile);

            $sliders = SliderMitra::find($id);
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.sliderMitra.sliderMitra')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SliderMitra  $sliderMitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderMitra $sliderMitra, $id)
    {
        $sliders = SliderMitra::find($id);
        $sliders->delete();

        return redirect()->route('admin.sliderMitra.sliderMitra')->with('success', 'Berhasil menghapus data');
    }
}
