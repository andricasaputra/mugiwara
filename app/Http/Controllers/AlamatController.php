<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamats = Alamat::all();
        return view('compro.alamat', ['alamats' => $alamats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_alamat');
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
            $folderUpload = 'images/compro/alamat';
            $file->move($folderUpload, $namaFile);

            $sliders = new Alamat();
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.alamat.alamat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show(Alamat $alamat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alamat $alamat, $id)
    {
        $alamats = Alamat::find($id);
        return view('compro.edit_alamat', ['alamats' => $alamats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alamat $alamat, $id)
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
            $folderUpload = 'images/compro/alamat';
            $file->move($folderUpload, $namaFile);

            $sliders = Alamat::find($id);
            $sliders->heading = $request->heading;
            $sliders->keterangan = $request->keterangan;
            $sliders->gambar = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.alamat.alamat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alamat $alamat, $id)
    {
        $alam = Alamat::find($id);
        $alam->delete();

        return redirect()->route('admin.alamat.alamat');
    }
}
