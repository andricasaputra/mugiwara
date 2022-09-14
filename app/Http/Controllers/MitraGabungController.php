<?php

namespace App\Http\Controllers;

use App\Events\ForgotPasswordEvent;
use App\Http\Resources\UserResource;
use App\Models\MitraGabung;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MitraGabungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mitraGabungs = MitraGabung::all();
        return view('compro.mitra_gabung', ['mitraGabungs' => $mitraGabungs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_mitra_gabung');
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
            'file' => 'required',
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

        return redirect()->route('admin.mitraGabung.mitraGabung');
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
        $mitraGabungs = MitraGabung::find($id);
        return view('compro.edit_mitra_gabung', ['mitraGabungs' => $mitraGabungs]);
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
            'nama_lengkap' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'hp' => 'required',
            'alamat_usaha' => 'required',
            'alamat_tinggal' => 'required',
            'file' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $this->email($request->email);

            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/mitra_gabung';
            $file->move($folderUpload, $namaFile);

            $mitraGabungs = MitraGabung::find($id);
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

        return redirect()->route('admin.mitraGabung.mitraGabung');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mitra = MitraGabung::find($id);
        $mitra->delete();

        return redirect()->route('admin.mitraGabung.sliderFitur');
    }

    private function email($email)
    {

        return (new UserResource($email))->additional(
            [
                'data' => [
                    // 'token' => $request->bearerToken(),
                    'message' => 'kami telah mengirimkan kambali kode verifikasi ke email anda',
                    'verifcation_url' => route('api.otp.verification')
                ],
            ]
        );
    }


}
