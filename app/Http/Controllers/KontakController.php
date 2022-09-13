<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontaks = Kontak::all();
        return view('compro.kontak', ['kontaks' => $kontaks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_kontak');
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
            'heading_kontak' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = new Kontak();
            $sliders->heading_kontak = $request->heading_kontak;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.kontak.kontak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontak $kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontak $kontak, $id)
    {
        $kontaks = Kontak::find($id);
        return view('compro.edit_kontak', ['kontaks' => $kontaks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $kontak, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading_kontak' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sliders = Kontak::find($id);
            $sliders->heading_kontak = $request->heading_kontak;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.kontak.kontak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontak $kontak, $id)
    {
        $kon = Kontak::find($id);
        $kon->delete();

        return redirect()->route('admin.kontak.kontak');
    }
}
