<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\IndexResource;
use App\Models\Employee;


class IndexController extends Controller
{
    public function __invoke()
    {
        $employee = Employee::all();
        return IndexResource::collection($employee);
    }
}

