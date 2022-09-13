<?php

namespace App\Http\Controllers;

use App\Models\documentUnduh;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentUnduhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unduhs = documentUnduh::all();
        return view('compro.document_unduh', ['unduhs' => $unduhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_document_unduh');
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
            'keterangan' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/document_unduh';
            $file->move($folderUpload, $namaFile);

            $sliders = new documentUnduh();
            $sliders->keterangan = $request->keterangan;
            $sliders->file = $namaFile;
            $sliders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.documentUnduh.documentUnduh');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\documentUnduh  $documentUnduh
     * @return \Illuminate\Http\Response
     */
    public function show(documentUnduh $documentUnduh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\documentUnduh  $documentUnduh
     * @return \Illuminate\Http\Response
     */
    public function edit(documentUnduh $documentUnduh, $id)
    {
        $documentUnduh = documentUnduh::find($id);
        return view('compro.edit_document_unduh', ['unduhs' => $documentUnduh]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\documentUnduh  $documentUnduh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, documentUnduh $documentUnduh, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
            'file' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/document_unduh';
            $file->move($folderUpload, $namaFile);

            $sliders = documentUnduh::find($id);
            $sliders->keterangan = $request->keterangan;
            $sliders->file = $namaFile;
            $sliders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.documentUnduh.documentUnduh');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\documentUnduh  $documentUnduh
     * @return \Illuminate\Http\Response
     */
    public function destroy(documentUnduh $documentUnduh, $id)
    {
        $und = documentUnduh::find($id);
        $und->delete();

        return redirect()->route('admin.documentUnduh.documentUnduh');
    }
}
