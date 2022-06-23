<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::when(request()->q, function($rooms) {
            $rooms->where('room_number', 'like', '%'.request()->q.'%')->orWhere('discount', 'like', '%'.request()->q.'%')
            ->orWhereHas('type', function($rooms) {
                $rooms->orWhere('name', 'like', '%'.request()->q.'%');
            });
        })->paginate(10);
        return view('admin.room.index', compact('rooms'));
    }
    public function create()
    {
        $types = Type::all();
        return view('admin.room.create', compact('types'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'room_number' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);
        Room::create([
            'room_number' => $request->room_number,
            'type_id' => $request->type_id,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);
        return redirect()->route('admin.room.index')->with('success', 'Data ruangan berhasil ditambahkan');
    }
    
    public function edit($room)
    {
        $room = Room::find($room);
        $types = Type::all();
        return view('admin.room.edit', compact('room','types'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'room_number' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);
        $room = Room::find($request->id);
        $room->update([
            'room_number' => $request->room_number,
            'type_id' => $request->type_id,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);
        return redirect()->route('admin.room.index')->with('success', 'Data ruangan berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $room = Room::find($request->id);
        $room->delete();
        return redirect()->route('admin.room.index')->with('success', 'Data ruangan berhasil dihapus');
    }
}
