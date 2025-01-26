<?php

namespace App\Http\Controllers\Trip;
use App\Http\Controllers\Controller;
use App\Http\Resources\Trip\IndexResource;
use App\Models\Trip;


class IndexController extends Controller
{
    public function __invoke()
    {
        $trip = Trip::all();
        return IndexResource::collection($trip);
    }
}

