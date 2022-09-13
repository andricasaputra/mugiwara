<?php

namespace App\Http\Controllers;

use App\Models\KeteranganSlider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeteranganSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keteranganSliders = KeteranganSlider::all();
        return view('compro.keterangan_slider', ['keteranganSliders' => $keteranganSliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_keterangan_slider');
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
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = new KeteranganSlider();
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.keteranganSlider.keteranganSlider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeteranganSlider  $keteranganSlider
     * @return \Illuminate\Http\Response
     */
    public function show(KeteranganSlider $keteranganSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeteranganSlider  $keteranganSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(KeteranganSlider $keteranganSlider, $id)
    {
        $keteranganSliders = KeteranganSlider::find($id);
        return view('compro.edit_keterangan_slider', ['keteranganSliders' => $keteranganSliders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeteranganSlider  $keteranganSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeteranganSlider $keteranganSlider)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = KeteranganSlider::find($id);
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.keteranganSlider.keteranganSlider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeteranganSlider  $keteranganSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeteranganSlider $keteranganSlider, $id)
    {
        $ket = KeteranganSlider::find($id);
        $ket->delete();

        return redirect()->route('admin.keteranganSlider.keteranganSlider');
    }
}
