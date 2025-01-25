<?php

namespace App\Http\Controllers\Car;
use App\Http\Controllers\Controller;
use App\Http\Resources\Car\IndexResource;
use App\Models\Car;


class IndexController extends Controller
{
    public function __invoke()
    {
        $car = Car::all();
        return IndexResource::collection($car);
    }
}

