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
            return redirect()->back()->with('error', $validator->errors());
        }

        try {
            $gambar = $request->file('gambar');
            $gambar_sosmed = $request->file('gambar_sosmed');
            $namaGambar = $gambar->getClientOriginalName();
            $namaGambarSosmed = $gambar_sosmed->getClientOriginalName();
            $folderUpload = 'images/compro/team_header';
            $gambar->move($folderUpload, $namaGambar);
            $gambar_sosmed->move($folderUpload, $namaGambarSosmed);

            $teamHeaders = new TeamHeader();
            $teamHeaders->fill($request->except('gambar', 'gambar_sosmed'));
            $teamHeaders->gambar = $namaGambar;
            $teamHeaders->gambar_sosmed = $namaGambarSosmed;
            $teamHeaders->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('admin.teamHeader.teamHeader')->with('success', 'Berhasil menyimpan data');
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
        try {
            $teamHeaders = TeamHeader::find($id);
            $teamHeaders->fill($request->except('id', 'gambar', 'gambar_sosmed'));
            if(!is_null($request->gambar)) {
                $file = $request->file('gambar');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/team_header';
                $file->move($folderUpload, $namaFile);
                $teamHeaders->gambar = $namaFile;
            }

            if(!is_null($request->gambar_sosmed)) {
                $gambar_sosmed = $request->file('gambar');
                $namaGambarSosmed = $gambar_sosmed->getClientOriginalName();
                $folderUploadGambarSosmed = 'images/compro/team_header';
                $file->move($folderUploadGambarSosmed, $namaGambarSosmed);
                $teamHeaders->gambar_sosmed = $namaGambarSosmed;
            }
            $teamHeaders->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('admin.teamHeader.teamHeader')->with('success', 'Berhasil mengubah data');
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
