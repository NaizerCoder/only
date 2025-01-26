<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryComfort\GetCategoriesComfortResource;
use App\Http\Resources\Position\GetPositionResource;
use App\Models\Position;

class CreateController extends Controller
{
    public function __invoke()
    {
        $position = Position::all();
        return response()->json(GetPositionResource::collection($position));
    }
}

