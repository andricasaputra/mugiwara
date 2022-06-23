<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelOffice;
use App\Models\HotelSubOffice;
use Illuminate\Http\Request;

class HotelSubOfficeController extends Controller
{
    public function index($idHotelOffice)
    {
        $hotelOffice = HotelOffice::find($idHotelOffice);
        $hotelSubOffices = HotelSubOffice::when(request()->q, function($hotelSubOffices) {
            $hotelSubOffices->where('mobile_number', 'like', '%'.request()->q.'%')
            ->orWhere('address', 'like', '%'.request()->q.'%')->orWhere('type', 'like', '%'.request()->q.'%');
        })->where('hotel_office_id', $hotelOffice->id)->paginate(10);
        return view('admin.hotel.sub_office.index', compact('hotelSubOffices','hotelOffice'));
    }
    public function create($idHotelOffice)
    {
        $hotelOffice = HotelOffice::find($idHotelOffice);
        return view('admin.hotel.sub_office.create', compact('hotelOffice'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'hotel_office_id' => 'required',
            'mobile_number' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);
        $hotelOffice = HotelSubOffice::create([
            'hotel_office_id' => $request->hotel_office_id,
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'type' => $request->type,
        ]);
        return redirect()->route('admin.hotel_sub_office.index', $hotelOffice->hotel_office_id)->with('success', 'Data sub kantor hotel berhasil ditambahkan');
    }
    
    public function edit($hotelOfficeId, $idHotelOffice)
    {
        $hotelSubOffice = HotelSubOffice::find($hotelOfficeId);
        return view('admin.hotel.sub_office.edit', compact('hotelSubOffice'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'mobile_number' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);
        $hotelOffice = HotelSubOffice::find($request->id);
        $hotelOffice->update([
            'mobile_number' => $request->mobile_number,
            'address' => $request->address,
            'type' => $request->type,
        ]);
        return redirect()->route('admin.hotel_sub_office.index', $hotelOffice->hotel_office_id)->with('success', 'Data sub kantor hotel berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $hotelOffice = HotelSubOffice::find($request->id);
        $hotelOffice->delete();
        return redirect()->route('admin.hotel_sub_office.index', $hotelOffice->hotel_office_id)->with('success', 'Data sub kantor hotel berhasil dihapus');
    }
}
