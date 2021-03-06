<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::when(request()->q, function($vouchers) {
            $vouchers->where('name', 'like', '%'.request()->q.'%')->orWhere('description', 'like', '%'.request()->q.'%');
        })->get();
        return view('admin.voucher.index', compact('vouchers'));
    }
    public function create()
    {
        return view('admin.voucher.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'max_uses' => 'required',
            'max_uses_user' => 'required',
            'type' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
            'discount_amount' => 'required_if:discount_type,==,fixed',
            'discount_percent' => 'required_if:discount_type,==,percent',
            'discount_type' => 'required',
            'starts_at' => 'required',
            'is_active' => 'required',
            'expires_at' => 'required',
            'point_needed' => 'required',
        ]);
        if($request->image){
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        Voucher::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'uses_count' => $request->uses_count,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'type' => $request->type,
            'category' => $request->category,
            'image' => $namaImage,
            'discount_amount' => $request->discount_amount ?? null,
            'discount_percent' => $request->discount_percent ?? '0',
            'discount_type' => $request->discount_type,
            'starts_at' => $request->starts_at,
            'is_active' => $request->is_active,
            'expires_at' => $request->expires_at,
            'point_needed' => $request->point_needed,
        ]);
        return redirect()->route('admin.voucher.index')->with('success', 'Data voucher berhasil ditambahkan');
    }
    
    public function edit($voucherId)
    {
        $voucher = Voucher::find($voucherId);
        return view('admin.voucher.edit', compact('voucher'));
    }
    public function show($voucherId)
    {
        $voucher = Voucher::find($voucherId);
        return view('admin.voucher.show', compact('voucher'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'max_uses' => 'required',
            'max_uses_user' => 'required',
            'type' => 'required',
            'category' => 'required',
            'discount_amount' => 'required_if:discount_type,==,fixed',
            'discount_percent' => 'required_if:discount_type,==,percent',
            'discount_type' => 'required',
            'starts_at' => 'required',
            'is_active' => 'required',
            'expires_at' => 'required',
            'point_needed' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg',
        ]);
        $voucher = Voucher::find($request->id);
        if($request->image){
            Storage::disk('public')->delete('data/'.$voucher->image);
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        $voucher->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'uses_count' => $request->uses_count,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'type' => $request->type,
            'category' => $request->category,
            'image' => $namaImage ?? $voucher->image,
            'discount_amount' => $request->discount_amount ?? null,
            'discount_percent' => $request->discount_percent ?? '0',
            'discount_type' => $request->discount_type,
            'starts_at' => $request->starts_at,
            'is_active' => $request->is_active,
            'expires_at' => $request->expires_at,
            'point_needed' => $request->point_needed,
        ]);
        return redirect()->route('admin.voucher.index')->with('success', 'Data voucher berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $voucher = Voucher::find($request->id);
        Storage::disk('public')->delete('data/'.$voucher->image);
        $voucher->delete();
        return redirect()->route('admin.voucher.index')->with('success', 'Data voucher berhasil dihapus');
    }
}
