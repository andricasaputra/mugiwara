<?php

namespace App\Http\Controllers;

use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $settings = GeneralSettings::first();
        return view('admin.general_settings.index', [
            'settings' => $settings
        ]);
    }

    public function store(Request $request)
    {
        $settings = GeneralSettings::first();
        if (is_null($settings)) {
            $settings = new GeneralSettings;
        }
        $settings->fill($request->except('id', 'logo'));

        if (!is_null($request->logo)) {
            try {
                $file = $request->file('logo');
                $namaFile = $file->getClientOriginalName();
                $folderUpload = 'images/compro/logo';
                $file->move($folderUpload, $namaFile);
            } catch (\Throwable $th) {
                return redirect()->route('admin.general-settings.general-settings')->with('error', $th->getMessage());
            }

            $settings->logo = $namaFile;
        }

        $settings->save();
        return redirect()->route('admin.general-settings.general-settings')->with('success', 'Berhasil menyimpan daata');
    }
}