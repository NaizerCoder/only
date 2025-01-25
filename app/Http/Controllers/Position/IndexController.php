<?php

namespace App\Http\Controllers\Position;
use App\Http\Controllers\Controller;
use App\Http\Resources\Position\IndexResource;
use App\Models\Position;

class IndexController extends Controller
{
    public function __invoke()
    {
        $position = Position::all();
        return IndexResource::collection($position);
    }
}

