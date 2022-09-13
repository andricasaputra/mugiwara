<?php

namespace App\Http\Controllers;

use App\Models\HubungiKami;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HubungiKamiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hubungiKamis = HubungiKami::all();
        return view('compro.hubungi_kami', ['hubungiKamis' => $hubungiKamis]);
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
            'judul_pertanyaan' => 'required',
            'pertanyaan' => 'required',
            'files' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {

            $file = $request->file('files');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/hubungi_kami';
            $file->move($folderUpload, $namaFile);

            $keteranganFiturs = new HubungiKami();
            $keteranganFiturs->nama_lengkap = $request->nama_lengkap;
            $keteranganFiturs->email = $request->email;
            $keteranganFiturs->judul_pertanyaan = $request->judul_pertanyaan;
            $keteranganFiturs->pertanyaan = $request->pertanyaan;
            $keteranganFiturs->file = $namaFile;
            $keteranganFiturs->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('bantuan');

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
