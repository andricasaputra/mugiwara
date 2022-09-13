<?php

namespace App\Http\Controllers;

use App\Models\TeamHeader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamHeaders = TeamHeader::all();
        return view('compro.team_header', ['teamHeaders' => $teamHeaders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compro.create_team_header');
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
            'gambar' => 'required',
            'alt' => 'required',
            'jabatan' => 'required',
            'url_sosmed' => 'required',
            'gambar_sosmed' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('gambar');
            $gambar_sosmed = $request->file('gambar_sosmed');
            $namaFile = $file->getClientOriginalName();
            $namaGambarSosmed = $gambar_sosmed->getClientOriginalName();
            $folderUpload = 'images/compro/team_header';
            $file->move($folderUpload, $namaFile);
            $gambar_sosmed->move($folderUpload, $namaGambarSosmed);

            $teamHeaders = new TeamHeader();
            $teamHeaders->heading = $request->heading;
            $teamHeaders->keterangan = $request->keterangan;
            $teamHeaders->jabatan = $request->jabatan;
            $teamHeaders->url_sosmed = $request->url_sosmed;
            $teamHeaders->alt = $request->alt;
            $teamHeaders->gambar = $namaFile;
            $teamHeaders->gambar_sosmed = $request->gambar_sosmed;
            $teamHeaders->save();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.teamHeader.teamHeader');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamHeader  $teamHeader
     * @return \Illuminate\Http\Response
     */
    public function show(TeamHeader $teamHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamHeader  $teamHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamHeader $teamHeader, $id)
    {
        $teamHeaders = TeamHeader::find($id);
        return view('compro.edit_team_header', ['teamHeaders' => $teamHeaders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamHeader  $teamHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamHeader $teamHeader, $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
            'alt' => 'required',
            'jabatan' => 'required',
            'url_sosmed' => 'required',
            'gambar_sosmed' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('gambar');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images/compro/team_header';
            $file->move($folderUpload, $namaFile);

            $teamHeaders = TeamHeader::find($id);
            $teamHeaders->heading = $request->heading;
            $teamHeaders->keterangan = $request->keterangan;
            $teamHeaders->jabatan = $request->jabatan;
            $teamHeaders->url_sosmed = $request->url_sosmed;
            $teamHeaders->alt = $request->alt;
            $teamHeaders->gambar = $namaFile;
            $teamHeaders->gambar_sosmed = $request->gambar_sosmed;
            $teamHeaders->update();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return redirect()->route('admin.teamHeader.teamHeader');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamHeader  $teamHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamHeader $teamHeader, $id)
    {
        $team = TeamHeader::find($id);
        $team->delete();

        return redirect()->route('admin.teamHeader.teamHeader');
    }
}
