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

        if (isset($data['cat_comfort_ids'])) {
            $dataCatComfort = $data['cat_comfort_ids'];
            unset($data['cat_comfort_ids']);
        }

        $position = Position::create($data);
        $position->catComfort()->sync($dataCatComfort);
    }
}

