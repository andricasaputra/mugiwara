<?php

namespace App\Http\Controllers;

use App\Mail\RegistranCompose;
use App\Models\HubungiKami;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            'file' => 'required|image|mimes:jpeg,png,jpg|max:500',
        ],[
            'required' => ':attribute harus diisi',
            'image' => ':attribute harus gambar',
            'mimes' => ':attribute harus dengan format jpeg,png,jpg',
            'max' => ':attribute max 500 mb'
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->messages() as $key => $v) {
                return redirect()->back()->with('error', $v[0]);
            }
        }

        try {

            $file = $request->file('file');
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

        return redirect()->route('profile.bantuan')->with('success', 'Berhasil terkirim');

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

    public function compose($id)
    {
        $bantuan = HubungiKami::find($id);
        return view('compro.hubungi_kami_compose', [
            'bantuan' => $bantuan
        ]);
    }

    public function submitCompose(Request $request)
    {
        try {
            Mail::to($request->to)->send(new RegistranCompose($request));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.hubungiKami.hubungiKami')->with('success', 'Berhasil mengirim email');
    }
}
