<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelOffice;
use Illuminate\Http\Request;

class HotelOfficeController extends Controller
{
    public function index($idHotel)
    {
        $hotel = Hotel::find($idHotel);
        $hotelOffices = HotelOffice::when(request()->q, function($hotelOffices) {
            $hotelOffices->where('mobile_number', 'like', '%'.request()->q.'%')
            ->orWhere('address', 'like', '%'.request()->q.'%')->orWhere('type', 'like', '%'.request()->q.'%');
        })->where('hotel_id', $hotel->id)->paginate(10);
        return view('admin.hotel.office.index', compact('hotelOffices','hotel'));
    }
    public function create($idHotel)
    {
        $hotel = Hotel::find($idHotel);
        return view('admin.hotel.office.create', compact('hotel'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'hotel_id' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);
        $hotelOffice = HotelOffice::create([
            'hotel_id' => $request->hotel_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'type' => $request->type,
        ]);
        return redirect()->route('admin.hotel_office.index', $hotelOffice->hotel_id)->with('success', 'Data kantor hotel berhasil ditambahkan');
    }
    
    public function edit($hotelOfficeId, $idHotel)
    {
        $hotelOffice = HotelOffice::find($hotelOfficeId);
        return view('admin.hotel.office.edit', compact('hotelOffice'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'mobile_number' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);
        $hotelOffice = HotelOffice::find($request->id);
        $hotelOffice->update([
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'type' => $request->type,
        ]);
        return redirect()->route('admin.hotel_office.index', $hotelOffice->hotel_id)->with('success', 'Data kantor hotel berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $hotelOffice = HotelOffice::find($request->id);
        $hotelOffice->delete();
        return redirect()->route('admin.hotel_office.index', $hotelOffice->hotel_id)->with('success', 'Data kantor hotel berhasil dihapus');
    }
}
