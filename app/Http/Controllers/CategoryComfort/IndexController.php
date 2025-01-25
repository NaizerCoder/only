<?php

namespace App\Http\Controllers\CategoryComfort;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryComfort\IndexResource;
use App\Models\CategoryComfort;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories_comfort = CategoryComfort::all();
        return IndexResource::collection($categories_comfort);

    }
}

