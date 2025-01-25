<?php

namespace App\Http\Controllers\Car;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryComfort\GetCategoriesComfortResource;
use App\Http\Resources\CategoryPosition\GetCategoriesPositionResource;
use App\Models\CategoryComfort;
use App\Models\CategoryPosition;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories_comfort = CategoryComfort::all();
        return response()->json(GetCategoriesComfortResource::collection($categories_comfort));
    }
}

