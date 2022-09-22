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
        ]);

        if($validator->fails()) {
            foreach($validator->errors()->messages() as $key => $v) {
                return redirect()->back()->with('error', $v[0]);
            }
        }

        try {
            $gambar = $request->file('gambar');
            $namaGambar = $gambar->getClientOriginalName();
            $folderUpload = 'images/compro/team_header';
            $gambar->move($folderUpload, $namaGambar);

            $teamHeaders = new TeamHeader();
            $teamHeaders->fill($request->except('gambar', 'gambar_sosmed', 'url_gambar'));
            $teamHeaders->gambar = $namaGambar;
            $teamHeaders->gambar_sosmed = "-";
            if (!empty($request->sosmed)) {
                $teamHeaders->url_sosmed = json_encode($request->sosmed);
            } else {
                $teamHeaders->url_sosmed = '';
            }
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
            $teamHeaders->fill($request->except('id', 'gambar', 'gambar_sosmed', 'url_sosmed'));
            if(!is_null($request->gambar)) {
                $file = $request->file('gambar');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/team_header';
                $file->move($folderUpload, $namaFile);
                $teamHeaders->gambar = $namaFile;
            }

            $teamHeaders->gambar_sosmed = '-';
            if (!empty($request->sosmed)) {
                $teamHeaders->url_sosmed = json_encode($request->sosmed);
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
