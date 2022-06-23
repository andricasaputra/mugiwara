<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $room_types = RoomType::query()->get();

        return view('admin.booking.room_types.index')->with(compact('room_types'));
    }

    public function create()
    {
        return view('admin.booking.room_types.create');
    }

    public function store(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required|string|unique:types',
                'description' => 'nullable|string'
            ]);

            RoomType::create($request->all());

            return redirect(route('room_types.index'))->withSuccess('Berhasil tambah data');
            
        } catch (\Exception $e) {

            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit(RoomType $room_type)
    {
        return view('admin.booking.room_types.edit')->with(compact('room_type'));
    }

    public function update(Request $request, RoomType $room_type)
    {
        try {

            $request->validate([
                'name' => [
                    'required',
                    \Illuminate\Validation\Rule::unique('types')->ignore($room_type->id),
                ]
            ]);

            $room_type->update($request->all());

            return redirect(route('room_types.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {
            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy(RoomType $room_type)
    {
        $room_type->delete();

        return redirect(route('room_types.index'))->withSuccess('Berhasil hapus data'); 
    }
}
