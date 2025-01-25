<?php

namespace App\Http\Controllers\CategoryComfort;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPosition\StoreRequest;
use App\Models\CategoryComfort;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        CategoryComfort::create($data);
    }
}

