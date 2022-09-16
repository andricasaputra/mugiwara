<?php

namespace App\Http\Controllers;

use App\Models\MitraGabung;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MitraRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_lengkap' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'hp' => 'required',
            'alamat_usaha' => 'required',
            'alamat_tinggal' => 'required',
            'file' => 'required|mimes:zip',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/mitra_gabung';
            $file->move($folderUpload, $namaFile);

            $mitraGabungs = new MitraGabung();
            $mitraGabungs->nama_lengkap = $request->nama_lengkap;
            $mitraGabungs->email = $request->email;
            $mitraGabungs->nik = $request->nik;
            $mitraGabungs->hp = $request->hp;
            $mitraGabungs->alamat_usaha = $request->alamat_usaha;
            $mitraGabungs->alamat_tinggal = $request->alamat_tinggal;
            $mitraGabungs->file = $namaFile;
            $mitraGabungs->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('gabung')->with('message', 'Berhasil Registrasi');;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
