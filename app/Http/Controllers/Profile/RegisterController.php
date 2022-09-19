<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\MitraGabung;
use App\Models\Tambah_menu_compro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showregister()
    {
        $menu = Tambah_menu_compro::all();
        return view('profile.register', [
            'title' => 'Jadi Mitra - Register',
            'menu' => $menu
        ]);
    }

    public function submitRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:zip|max:500'
        ],[
            'required' => ':attribute harus diisi',
            'mimes' => ':attribute harus memiliki format zip',
            'max' => ':attribute maximal 5 mb'
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->messages() as $key => $v) {
                return redirect()->back()->with('error', $v[0]);
            }
        }

        try {
            $file = $request->file('file');
            $namaFile = $file->getClientOriginalName();
            $folderUpload = 'file/compro/mitra/submit';
            $file->move($folderUpload, $namaFile);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        $mitra = new MitraGabung;
        $mitra->fill($request->except('file'));
        $mitra->file = $namaFile;
        $mitra->save();

        return redirect()->back()->with('success', 'Berhasil mengirim berkas');
    }
}
