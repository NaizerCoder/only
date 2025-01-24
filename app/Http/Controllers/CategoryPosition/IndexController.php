<?php

namespace App\Http\Controllers\CategoryPosition;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryPosition\IndexResource;
use App\Models\CategoryPosition;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories_position = CategoryPosition::all();
        return IndexResource::collection($categories_position);

    }
}

