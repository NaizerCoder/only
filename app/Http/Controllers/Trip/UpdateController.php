<?php

namespace App\Http\Controllers\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\UpdateRequest;
use App\Models\Trip;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Trip $trip)
    {
        $data = $request->validated();
        $trip->update($data);
    }
}

