<?php

namespace App\Http\Controllers;

use App\Models\ProsesPendaftaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProsesPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prosesPendaftarans = ProsesPendaftaran::all();
        return view('compro.proses_pendaftaran', ['prosesPendaftarans' => $prosesPendaftarans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_proses_pendaftaran');
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

            $prosess = new ProsesPendaftaran();
            $prosess->keterangan = $request->keterangan;
            $prosess->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.prosesPendaftaran.prosesPendaftaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProsesPendaftaran  $prosesPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(ProsesPendaftaran $prosesPendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProsesPendaftaran  $prosesPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(ProsesPendaftaran $prosesPendaftaran, $id)
    {
        $prosesPendaftarans = ProsesPendaftaran::find($id);
        return view('compro.edit_proses_pendaftaran', ['prosesPendaftarans' => $prosesPendaftarans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProsesPendaftaran  $prosesPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProsesPendaftaran $prosesPendaftaran, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = ProsesPendaftaran::find($id);
            $sliders->keterangan = $request->keterangan;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.prosesPendaftaran.prosesPendaftaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProsesPendaftaran  $prosesPendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProsesPendaftaran $prosesPendaftaran, $id)
    {
        $proses = ProsesPendaftaran::find($id);
        $proses->delete();

        return redirect()->route('admin.prosesPendaftaran.prosesPendaftaran');
    }
}
