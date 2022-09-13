<?php

namespace App\Http\Controllers;

use App\Models\AboutKedua;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutKeduaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutKeduas = AboutKedua::all();
        return view('compro.aboutKedua', ['aboutKeduas' => $aboutKeduas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_about_kedua');
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
            $folderUpload = 'images/compro/about_kedua';
            $file->move($folderUpload, $namaFile);

            $aboutKeduas = new AboutKedua();
            $aboutKeduas->heading = $request->heading;
            $aboutKeduas->keterangan = $request->keterangan;
            $aboutKeduas->gambar = $namaFile;
            $aboutKeduas->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutKedua.aboutKedua');

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
        $aboutKeduas = AboutKedua::find($id);
        return view('compro.edit_aboutKedua', ['aboutKeduas' => $aboutKeduas]);
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
            $folderUpload = 'images/compro/about_kedua';
            $file->move($folderUpload, $namaFile);

            $aboutKeduas = AboutKedua::find($id);
            $aboutKeduas->heading = $request->heading;
            $aboutKeduas->keterangan = $request->keterangan;
            $aboutKeduas->gambar = $namaFile;
            $aboutKeduas->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutKedua.aboutKedua');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutKeduas = AboutKedua::find($id);
        $aboutKeduas->delete();
        return redirect()->route('admin.aboutKedua.aboutKedua');
    }
}
