<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::when(request()->q, function($hotels) {
            $hotels->where('name', 'like', '%'.request()->q.'%')->orWhere('address', 'like', '%'.request()->q.'%');
        })->paginate(10);
        return view('admin.hotel.profil.index', compact('hotels'));
    }
    public function create()
    {
        $regencies = Regency::where('is_deleted', '0')->get();
        return view('admin.hotel.profil.create', compact('regencies'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'regency_id' => 'required',
            'address' => 'required',
            'ratings' => 'required',
        ]);
        Hotel::create([
            'name' => $request->name,
            'regency_id' => $request->regency_id,
            'city' => $request->regency_id,
            'address' => $request->address,
            'ratings' => $request->ratings,
        ]);
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil ditambahkan');
    }
    
    public function edit($hotelId)
    {
        $hotel = Hotel::find($hotelId);
        $regencies = Regency::where('is_deleted', '0')->get();
        return view('admin.hotel.profil.edit', compact('hotel','regencies'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'regency_id' => 'required',
            'address' => 'required',
            'ratings' => 'required',
        ]);
        $hotel = Hotel::find($request->id);
        $hotel->update([
            'name' => $request->name,
            'regency_id' => $request->regency_id,
            'city' => $request->regency_id,
            'address' => $request->address,
            'ratings' => $request->ratings,
        ]);
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $hotel = Hotel::find($request->id);
        $hotel->delete();
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil dihapus');
    }
}
