<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\GetCarsEmployeeRequest;
use App\Http\Resources\Employee\GetCarsEmployeeResource;
use Illuminate\Support\Facades\DB;

class GetCarsEmployeeController extends Controller
{
    public function __invoke(GetCarsEmployeeRequest $request)
    {
        $data = $request->validated();
       // dump($data);

        $result = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            //->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->leftJoin('trips', 'trips.car_id', '=', 'cars.id')
            ->where('employees.id', '=', $data['id'])
            ->where(function ($query) use ($data) {
                $query->where('trips.status', '=', 'open')
                    ->whereBetween('trips.date_start', [$data['date_start'], $data['date_end']])
                    ->orwhereBetween('trips.date_end', [$data['date_start'], $data['date_end']]);
                $query->orWhere('trips.status', '=', null);
                $query->orWhere('trips.status', '=', 'closed');
            })
            ->select(
                'employees.id as employee_id',
                'employees.surname',
                'employees.name',
                'employees.patronymic',
                'cars.model',
                'cars.cat_comfort_id',
                'cars.id as car_id',
                'cars.year as car_year',
                //'categories_comfort.title as comfort',
                'trips.date_start',
                'trips.date_end',
                'trips.status as status',
            )
            ->get();
            //->get()->whereIn('status', ['closed',null]);

        //dump($result);

        return response()->json(GetCarsEmployeeResource::collection($result));
    }
}



