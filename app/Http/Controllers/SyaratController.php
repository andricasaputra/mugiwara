<?php

namespace App\Http\Controllers;

use App\Models\Syarat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SyaratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syarats = Syarat::all();
        return view('compro.syarat', ['syarats' => $syarats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_syarat');
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
            'keterangan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = new Syarat();
            $sliders->keterangan = $request->keterangan;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.prosesPendaftaran.prosesPendaftaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function show(Syarat $syarat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function edit(Syarat $syarat, $id)
    {
        $syarats = Syarat::find($id);
        return view('compro.edit_syarat', ['syarats' => $syarats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syarat $syarat, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $syarats = Syarat::find($id);
            $syarats->keterangan = $request->keterangan;
            $syarats->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.syarat.syarat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syarat  $syarat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syarat $syarat, $id)
    {
        $sy = Syarat::find($id);
        $sy->delete();

        return redirect()->route('admin.syarat.syarat');
    }
}
