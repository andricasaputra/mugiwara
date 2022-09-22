<?php

namespace App\Http\Controllers;

use App\Models\SliderFitur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderFiturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderFiturs = SliderFitur::all();
        return view('compro.slider_fitur', ['sliderFiturs' => $sliderFiturs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_slider_fitur');
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

        if ($validator->fails()) {
            foreach($validator->errors()->messages() as $key => $v) {
                return redirect()->back()->with('error', $v[0]);
            }
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_fitur';
            $file->move($folderUpload, $namaFile);

            $sliders = new SliderFitur();
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('admin.sliderFitur.sliderFitur');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SliderFitur  $sliderFitur
     * @return \Illuminate\Http\Response
     */
    public function show(SliderFitur $sliderFitur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SliderFitur  $sliderFitur
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderFitur $sliderFitur, $id)
    {
        $sliderFiturs = SliderFitur::find($id);
        return view('compro.edit_slider_fitur', ['sliderFiturs' => $sliderFiturs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SliderFitur  $sliderFitur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderFitur $sliderFitur, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required'
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->messages() as $key => $v) {
                return redirect()->back()->with('error', $v[0]);
            }
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/slider_fitur';
            $file->move($folderUpload, $namaFile);

            $sliders = SliderFitur::find($id);
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('admin.sliderFitur.sliderFitur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SliderFitur  $sliderFitur
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderFitur $sliderFitur, $id)
    {
        $sliders = SliderFitur::find($id);
        $sliders->delete();

        return redirect()->route('admin.sliderFitur.sliderFitur');
    }
}
