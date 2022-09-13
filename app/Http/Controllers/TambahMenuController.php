<?php

namespace App\Http\Controllers;

use App\Models\Tambah_menu_compro;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TambahMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_compro = Tambah_menu_compro::all();
        return view('compro.tambah_menu', ['menu_compros' => $menu_compro]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_menu');
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
            'nama_menu' => 'required',
            'url_menu' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            Tambah_menu_compro::create($request->all());
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        $menu_compro = Tambah_menu_compro::all();
        return view('compro.tambah_menu', ['menu_compros' => $menu_compro]);

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
    public function edit($id, Request $request)
    {
        $menu_compros = Tambah_menu_compro::find($id);
        return view('compro.edit_menu', ['menu_compros' => $menu_compros]);
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
            'nama_menu' => 'required',
            'url_menu' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
           $menu_compros = Tambah_menu_compro::find($id);
           $menu_compros->nama_menu = $request->nama_menu;
           $menu_compros->url_menu = $request->url_menu;
           $menu_compros->update();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        $menu_compro = Tambah_menu_compro::all();
        return view('compro.tambah_menu', ['menu_compros' => $menu_compro]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menus = Tambah_menu_compro::find($id);
        $menus->delete();

        return redirect()->route('admin.compro.tambah.menu');
    }
}
