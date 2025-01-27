<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\GetCarsEmployeeRequest;

class GetCarsEmployeeController extends Controller
{
    public function __invoke()
    {
        dump(123);
        //$data = $request->validated();
        //dump($data);
        //return response()->json(GetDriverCreateResource::collection($employees));
    }
}



