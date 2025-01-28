<?php

namespace App\Http\Controllers\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreRequest;
use App\Models\Trip;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Trip::create($data);
        //dd($data);
    }
}

