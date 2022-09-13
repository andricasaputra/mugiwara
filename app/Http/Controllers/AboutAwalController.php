<?php

namespace App\Http\Controllers;

use App\Models\aboutAwal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutAwals = aboutAwal::all();
        return view('compro.about_awal', ['aboutAwals' => $aboutAwals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_about_awal');
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

            $aboutKeduas = new aboutAwal();
            $aboutKeduas->heading = $request->heading;
            $aboutKeduas->keterangan = $request->keterangan;
            $aboutKeduas->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutAwal.aboutAwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aboutAwal  $aboutAwal
     * @return \Illuminate\Http\Response
     */
    public function show(aboutAwal $aboutAwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\aboutAwal  $aboutAwal
     * @return \Illuminate\Http\Response
     */
    public function edit(aboutAwal $aboutAwal)
    {
        $aboutAwal = aboutAwal::find($id);
        return view('compro.edit_aboutKedua', ['aboutAwal' => $aboutAwal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aboutAwal  $aboutAwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, aboutAwal $aboutAwal, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $aboutKeduas = aboutAwal::find($id);
            $aboutKeduas->heading = $request->heading;
            $aboutKeduas->keterangan = $request->keterangan;
            $aboutKeduas->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.aboutAwal.aboutAwal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aboutAwal  $aboutAwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(aboutAwal $aboutAwal, $id)
    {
        $aboutKeduas = AboutAwal::find($id);
        $aboutKeduas->delete();

        return redirect()->route('admin.aboutAwal.aboutAwal');
    }
}
