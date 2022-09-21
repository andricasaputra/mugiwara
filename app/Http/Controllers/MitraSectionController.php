<?php

namespace App\Http\Controllers;

use App\Models\MitraSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraSectionController extends Controller
{
    public function index()
    {
        $mitra = MitraSection::all();
        return view('admin.mitra_section.index', [
            'mitra' => $mitra
        ]);
    }

    public function create()
    {
        return view('admin.mitra_section.create');
    }

    public function store(Request $request)
    {
        $mitra = MitraSection::where('section', $request->section)->first();
        if (!is_null($mitra)) {
           return redirect()->back()->with('error', 'Sesi sudah terpilih');
        }

        $mitra = new MitraSection;
        $mitra->fill($request->input());
        $mitra->status = 1;
        $mitra->created_by = Auth::user()->id;
        $mitra->save();

        return redirect()->route('admin.mitra-section.mitra-section');
    }

    public function destroy(Request $request)
    {
        $mitra = MitraSection::find($request->id);
        $mitra->delete();
        return redirect()->route('admin.mitra-section.mitra-section');
    }

    public function edit($id)
    {
        $mitra = MitraSection::find($id);
        return view('admin.mitra_section.edit', [
            'mitra' => $mitra
        ]);
    }

    public function update(Request $request)
    {
        $mitra = MitraSection::find($request->id);
        $mitra->fill($request->except('id'));
        $mitra->save();
        return redirect()->route('admin.mitra-section.mitra-section');
    }
}