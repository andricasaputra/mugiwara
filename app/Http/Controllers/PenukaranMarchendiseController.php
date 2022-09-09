<?php

namespace App\Http\Controllers;

use App\Models\PenukaranMarchendise;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenukaranMarchendiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penukaranMarchendises = PenukaranMarchendise::join('users', 'users.id', '=', 'penukaran_marchendises.user_id')->select('*')->get();
        return view('admin.marchedise.penukaran_marchendise', ['penukaranMarchendises' => $penukaranMarchendises]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.marchedise.tambah_penukaran', ['users' => $users]);
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
            'user_id' => 'required',
            'bukti_penukaran' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('bukti_penukaran');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images';
            $file->move($folderUpload, $namaFile);
            $penukarans = new PenukaranMarchendise();
            $penukarans->user_id = $request->user_id;
            $penukarans->bukti_penukaran = $namaFile;
            $penukarans->save();

            return redirect(route('tukar_marchendise'));

        } catch (\Throwable $th) {
            return $th->getMessage();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenukaranMarchendise  $penukaranMarchendise
     * @return \Illuminate\Http\Response
     */
    public function show(PenukaranMarchendise $penukaranMarchendise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenukaranMarchendise  $penukaranMarchendise
     * @return \Illuminate\Http\Response
     */
    public function edit(PenukaranMarchendise $penukaranMarchendise)
    {
        $users = User::all();
        return view('admin.marchedise.edit_penukaran', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenukaranMarchendise  $penukaranMarchendise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenukaranMarchendise $penukaranMarchendise, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'bukti_penukaran' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $file = $request->file('bukti_penukaran');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'images';
            $file->move($folderUpload, $namaFile);

            $penukarans = PenukaranMarchendise::find($id);
            $penukarans->user_id = $request->user_id;
            $penukarans->bukti_penukaran = $namaFile;
            $penukarans->update();

            return redirect(route('tukar_marchendise'));

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenukaranMarchendise  $penukaranMarchendise
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenukaranMarchendise $penukaranMarchendise, $id)
    {
        try {
            $penukarans = PenukaranMarchendise::find($id);
            $penukarans->delete();
            return redirect(route('tukar_marchendise'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
