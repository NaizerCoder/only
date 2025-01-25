<?php

namespace App\Http\Controllers\Position;
use App\Http\Controllers\Controller;
use App\Http\Requests\Position\StoreRequest;
use App\Models\Position;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Position::create($data);
    }
}

