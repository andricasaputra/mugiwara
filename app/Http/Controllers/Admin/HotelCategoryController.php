<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelCategory;
use Illuminate\Http\Request;

class HotelCategoryController extends Controller
{
    public function index($idHotel)
    {
        $hotel = Hotel::find($idHotel);
        $hotelCategories = HotelCategory::when(request()->q, function($hotelCategories) {
            $hotelCategories->where('mobile_number', 'like', '%'.request()->q.'%')
            ->orWhere('address', 'like', '%'.request()->q.'%')->orWhere('type', 'like', '%'.request()->q.'%');
        })->where('hotel_id', $hotel->id)->paginate(10);
        return view('admin.hotel.category.index', compact('hotelCategories','hotel'));
    }
    public function create($idHotel)
    {
        $hotel = Hotel::find($idHotel);
        return view('admin.hotel.category.create', compact('hotel'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'hotel_id' => 'required',
            'name' => 'required',
            'tag' => 'required',
        ]);
        $hotelCategory = HotelCategory::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'tag' => $request->tag,
        ]);
        return redirect()->route('admin.hotel_category.index', $hotelCategory->hotel_id)->with('success', 'Data kategori hotel berhasil ditambahkan');
    }
    
    public function edit($hotelCategoryId, $idHotel)
    {
        $hotelCategory = HotelCategory::find($hotelCategoryId);
        return view('admin.hotel.category.edit', compact('hotelCategory'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'tag' => 'required',
        ]);
        $hotelCategory = HotelCategory::find($request->id);
        $hotelCategory->update([
            'name' => $request->name,
            'tag' => $request->tag,
        ]);
        return redirect()->route('admin.hotel_category.index', $hotelCategory->hotel_id)->with('success', 'Data kategori hotel berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $hotelCategory = HotelCategory::find($request->id);
        $hotelCategory->delete();
        return redirect()->route('admin.hotel_category.index', $hotelCategory->hotel_id)->with('success', 'Data kategori hotel berhasil dihapus');
    }
}
