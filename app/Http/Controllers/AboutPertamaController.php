<?php

namespace App\Http\Controllers;

use App\Models\AboutPertama;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutPertamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutPertamas = AboutPertama::all();
        return view('compro.aboutPertmana', ['aboutPertamas' => $aboutPertamas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_about_pertama');
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
            $folderUpload = 'images/compro/about_pertama';
            $file->move($folderUpload, $namaFile);

            $sliders = new AboutPertama();
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutPertama.aboutPertama');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutPertama  $aboutPertama
     * @return \Illuminate\Http\Response
     */
    public function show(AboutPertama $aboutPertama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutPertama  $aboutPertama
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutPertama $aboutPertama, $id)
    {
        $aboutPertamas = AboutPertama::find($id);
        return view('compro.edit_about_pertama', ['aboutPertamas' => $aboutPertamas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutPertama  $aboutPertama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutPertama $aboutPertama, $id)
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
            $folderUpload = 'images/compro/about_pertama';
            $file->move($folderUpload, $namaFile);

            $sliders = AboutPertama::find($id);
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutPertama.aboutPertama');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutPertama  $aboutPertama
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutPertama $aboutPertama, $id)
    {
        $aboutPertamas = AboutPertama::find($id);
        $aboutPertamas->delete();

        return redirect()->route('admin.aboutPertama.aboutPertama');
    }
}
