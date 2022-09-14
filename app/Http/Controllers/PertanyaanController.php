<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        return view('compro.pertanyaan', ['pertanyaans' => $pertanyaans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_pertanyaan');
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
            'keterangan' => 'required',
            'kategori' => 'required',
            'jawaban' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $pertanyaan = new Pertanyaan();
            $pertanyaan->keterangan = $request->keterangan;
            $pertanyaan->kategori = $request->kategori;
            $pertanyaan->jawaban = $request->jawaban;
            $pertanyaan->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.pertanyaan.pertanyaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaans = Pertanyaan::find($id);
        return view('compro.edit_pertanyaan', ['pertanyaans' => $pertanyaans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
            'kategori' => 'required',
            'jawaban' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $pertanyaan = Pertanyaan::find($id);
            $pertanyaan->keterangan = $request->keterangan;
            $pertanyaan->kategori = $request->kategori;
            $pertanyaan->jawaban = $request->kategori;
            $pertanyaan->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.pertanyaan.pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proses = Pertanyaan::find($id);
        $proses->delete();

        return redirect()->route('admin.pertanyaan.pertanyaan');
    }


}
