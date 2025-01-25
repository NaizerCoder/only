<?php

namespace App\Http\Controllers\Position;
use App\Http\Controllers\Controller;
use App\Http\Resources\Position\GetCategoriesComfortResource;
use App\Http\Resources\Position\GetCategoriesPositionResource;
use App\Models\CategoryComfort;
use App\Models\CategoryPosition;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories_position = CategoryPosition::all();
        $categories_comfort = CategoryComfort::all();

        return response()->json([
            'categories_position' => GetCategoriesPositionResource::collection($categories_position),
            'categories_comfort' => GetCategoriesComfortResource::collection($categories_comfort),
        ]);
        //return response()->json(GetCategoriesPositionResource::collection($categories_position));
    }
}

