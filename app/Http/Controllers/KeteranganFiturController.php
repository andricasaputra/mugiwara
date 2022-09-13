<?php

namespace App\Http\Controllers;

use App\Models\KeteranganFitur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeteranganFiturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keteranganFiturs = KeteranganFitur::all();
        return view('compro.keterangan_fitur', ['keteranganFiturs' => $keteranganFiturs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_keterangan_fitur');
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

            $keteranganFiturs = new KeteranganFitur();
            $keteranganFiturs->heading = $request->heading;
            $keteranganFiturs->keterangan = $request->keterangan;
            $keteranganFiturs->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.keteranganFitur.keteranganFitur');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeteranganFitur  $keteranganFitur
     * @return \Illuminate\Http\Response
     */
    public function show(KeteranganFitur $keteranganFitur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeteranganFitur  $keteranganFitur
     * @return \Illuminate\Http\Response
     */
    public function edit(KeteranganFitur $keteranganFitur, $id)
    {
        $keteranganFiturs = KeteranganFitur::find($id);
        return view('compro.edit_keterangan_fitur', ['keteranganFiturs' => $keteranganFiturs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeteranganFitur  $keteranganFitur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeteranganFitur $keteranganFitur, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $keteranganFiturs = KeteranganFitur::find($id);
            $keteranganFiturs->heading = $request->heading;
            $keteranganFiturs->keterangan = $request->keterangan;
            $keteranganFiturs->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.keteranganFitur.keteranganFitur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeteranganFitur  $keteranganFitur
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeteranganFitur $keteranganFitur, $id)
    {
        $keterangan = KeteranganFitur::find($id);
        $keterangan->delete();

        return redirect()->route('admin.keteranganFitur.keteranganFitur');
    }
}
