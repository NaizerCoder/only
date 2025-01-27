<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\GetDriverCreateResource;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class GetDriverController extends Controller
{
    public function __invoke()
    {
//        $employees = Employee::with('Position.catPosition');
//        foreach ($employees->get() as $employee) {
//            dump($employee->Position->catPosition->title);
//        }

        $employees = DB::table('employees')
            ->leftJoin('cars', 'cars.driver_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('categories_position', 'categories_position.id', '=', 'positions.cat_position_id')
            ->whereNull('cars.model')
            ->where('categories_position.title','=', 'водители')
            ->select(
                'employees.id',
                'employees.surname',
                'employees.name',
                'employees.patronymic',
                'positions.title as position',
                'cars.model'
            )
        ->get();
        //dump($employees);
        return response()->json(GetDriverCreateResource::collection($employees));
    }
}



