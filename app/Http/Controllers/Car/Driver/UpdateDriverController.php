<?php

namespace App\Http\Controllers\Car\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\UpdateDriverRequest;
use App\Models\Car;


class UpdateDriverController extends Controller
{
    public function __invoke(UpdateDriverRequest $request, Car $car)
    {
        $data = $request->validated();
        $car->update($data);
    }
}

