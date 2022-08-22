<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotion = Promotion::with(['images'])->latest()->first();

        return new PromotionResource($promotion);
    }

    public function show(Promotion $promotion)
    {
        return new PromotionResource($promotion);
    }
}
