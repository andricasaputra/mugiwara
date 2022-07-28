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
        return PromotionResource::collection(Promotion::with('images')->get());
    }

    public function show(Promotion $promotion)
    {
        return new PromotionResource($promotion);
    }
}
