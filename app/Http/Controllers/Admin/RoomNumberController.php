<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomNumber;
use Illuminate\Http\Request;

class RoomNumberController extends Controller
{
    public function index()
    {
        $numbers = RoomNumber::query()->latest()->get();

        return view('admin.booking.room_numbers.index')->withRoomnumbers($numbers);
    }

    public function create()
    {
        return view('admin.booking.room_numbers.create');
    }

    public function store(Request $request)
    {

        try {

            $request->validate([
                'number' => 'required|string',
            ]);

            $number = RoomNumber::create($request->all());

            return redirect(route('room_numbers.index'))->withSuccess('Berhasil tambah data');
            
        } catch (\Exception $e) {

            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit(RoomNumber $room_number)
    {
        return view('admin.booking.room_numbers.edit')->withNumber($room_number);
    }

    public function update(Request $request, RoomNumber $room_number)
    {
        try {

            $request->validate([
                'number' => 'required|string',
            ]);

            $room_number->update($request->all());

            return redirect(route('room_numbers.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {
            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy(RoomNumber $room_number)
    {
        $room_number->delete();

        return redirect(route('room_numbers.index'))->withSuccess('Berhasil hapus data'); 
    }
}
