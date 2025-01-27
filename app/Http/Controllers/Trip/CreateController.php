<?php

namespace App\Http\Controllers\Trip;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\GetEmployeeTripResource;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function __invoke()
    {
        $employees = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('categories_position', 'categories_position.id', '=', 'positions.cat_position_id')
            ->where('categories_position.title','!=', 'водители')
            ->orderBy('employees.surname','ASC')
            ->select(
                'employees.id',
                'employees.surname',
                'employees.name',
                'employees.patronymic',
                'categories_position.title',
            )
            ->get();

        //dump($employees);
        return response()->json(GetEmployeeTripResource::collection($employees));
    }
}

