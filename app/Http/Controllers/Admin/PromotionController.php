<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\AccomodationPromotion;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index()
    {
        return view('admin.promotions.index')
            ->withPromotions(Promotion::with('images')
            ->get());
    }

    public function create()
    {
        return view('admin.promotions.create')
            ->withAccomodations(Accomodation::all());
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit')
            ->withPromotion($promotion->load(['images', 'accomodation', 'room']))
            ->withAccomodations(Accomodation::all());
    }

    public function show(Promotion $promotion)
    {
         return view('admin.promotions.index')->withPromotion($promotion);
    }

    public function store(Request $request)
    {
        $request->validate([
            'accomodation_id' => 'required',
            'type' => 'required',
            'promotion_image' => 'required|mimes:jpg,jpeg,png',
            'start_date' => 'required',
            'end_date' => 'required',
            'name' => 'required',
            'is_active' => 'nullable'
        ]);

        DB::beginTransaction();

        try {

             if ($request->hasFile('promotion_image')) {
                $upload = app()->make(UploadServiceInterface::class);
                $filename = $upload->process($request->file('promotion_image'));
            }

            $ex = explode("-", $request->type);

            $promotion = Promotion::create([
                'accomodation_id' => $request->accomodation_id,
                'room_type' => $ex[0],
                'room_number' => $ex[1],
                'name' => $request->name,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            $promotion->images()->create(['image' => $filename]);

            // foreach($request->room_id as $room_id)
            // {
            //     $acc = AccomodationPromotion::create([
            //         'promotion_id' => $promotion->id,
            //         'accomodation_id' => $request->accomodation_id,
            //         'tye' => $room_id
            //     ]);
            // }

            DB::commit();

            return redirect(route('admin.promotion.index'))->withSuccess('Berhasil tambah promosi');
            
        } catch (\Exception $e) {
            DB::commit();

            dd($e->getMessage());

            return redirect(route('admin.promotion.index'))->withErrors('Gagal Tamabah Data');
        }

        
    }

    public function update(Request $request, Promotion $promotion)
    {

        $request->validate([
            'accomodation_id' => 'required',
            'type' => 'required',
            'promotion_image' => 'sometimes|mimes:jpg,jpeg,png',
            'start_date' => 'required',
            'end_date' => 'required',
            'name' => 'required'
        ]);

        $ex = explode("-", $request->type);

        if ($request->hasFile('promotion_image')) {
            $upload = app()->make(UploadServiceInterface::class);
            $filename = $upload->process($request->file('promotion_image'));

            $promotion->images()->update(['image' => $filename]);
        }

        $promotion = $promotion->update([
            'accomodation_id' => $request->accomodation_id,
            'room_type' => $ex[0],
            'room_number' => $ex[1],
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect(route('admin.promotion.index'))->withSuccess('Berhasil ubah promosi');

    }

    public function destroy(Promotion $promotion)
    {
        foreach($promotion->images as $image){
            if(file_exists(asset('storage/promotions/' . $image->image))){
               \Illuminate\Support\Facades\Storage::disk('public')->delete('promotions/'. $image->image);
            }
        }

        $promotion->delete();

        return redirect(route('admin.promotion.index'))->withSuccess('Berhasil hapus promosi');
    }
}
