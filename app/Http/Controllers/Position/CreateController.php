<?php

namespace App\Http\Controllers\Position;
use App\Http\Controllers\Controller;
use App\Http\Resources\Position\CreateResource;
use App\Http\Resources\Position\GetCategoriesPositionResource;
use App\Models\CategoryComfort;
use App\Models\CategoryPosition;
use App\Models\Position;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories_position = CategoryPosition::all();

        $cat_pos = new Position();
        dd($cat_pos->cat_comfort()->get());
        //dd(CategoryPosition::all()->cat_comfort);

       return CreateResource::collection($categories_position);
        //return response()->json(GetCategoriesPositionResource::collection($categories_position));
    }
}

