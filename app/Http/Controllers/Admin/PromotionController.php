<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return view('admin.promotions.index')
            ->withPromotions(Promotion::with('images')->get());
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function edit()
    {
        return view('admin.promotions.edit');
    }

    public function show(Promotion $promotion)
    {
         return view('admin.promotions.index')->withPromotion($promotion);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('promotion_image')) {
            $upload = app()->make(UploadServiceInterface::class);
            $filename = $upload->process($request->file('promotion_image'));
        }

        $promotion = Promotion::create($request->all());

        $promotion->images()->create(['image' => $filename]);

        return redirect(route('admin.promotion.index'))->withSuccess('Berhasil tambah promosi');
    }

    public function update(Request $request, Promotion $promotion)
    {

    }

    public function destroy(Request $request)
    {

    }
}
