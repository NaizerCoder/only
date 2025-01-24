<?php

namespace App\Http\Controllers\CategoryPosition;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPosition\StoreRequest;
use App\Models\CategoryPosition;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        CategoryPosition::create($data);
    }
}

