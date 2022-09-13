<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosmeds = Sosmed::all();
        return view('compro.sosmed', ['sosmeds' => $sosmeds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_sosmed');
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
            'link_sosmed' => 'required',
            'nama_sosmed' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $sosmeds = new Sosmed();
            $sosmeds->link_sosmed = $request->link_sosmed;
            $sosmeds->nama_sosmed = $request->nama_sosmed;

            $sosmeds->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.sosmed.sosmed');
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
        $sosmeds = Sosmed::find($id);
        return view('compro.edit_sosmed', ['sosmeds' => $sosmeds]);
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
            'link_sosmed' => 'required',
            'nama_sosmed' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {


            $sosmeds = Sosmed::find($id);
            $sosmeds->link_sosmed = $request->link_sosmed;
            $sosmeds->nama_sosmed = $request->nama_sosmed;
            $sosmeds->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.sosmed.sosmed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sos = Sosmed::find($id);
        $sos->delete();
        return redirect()->route('admin.sosmed.sosmed');
    }
}
