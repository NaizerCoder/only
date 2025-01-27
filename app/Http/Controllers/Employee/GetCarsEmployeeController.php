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
        //dump(123);
        $data = $request->validated();
       // dump($data);

        $result = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->leftJoin('trips', 'trips.car_id', '=', 'cars.id')
            ->where('employees.id', '=', $data['id'])
            ->where(function ($query) use ($data) {
                $query->where('trips.status', '=', 'open')
                    ->Where('trips.date_start', '>', $data['date_end'])
                    ->orWhere('trips.date_end', '<', $data['date_start']);
                $query->orWhere('trips.date_start', '=', null);
                $query->orWhere('trips.date_end', '=', null);
            })
            ->select(
                'employees.id',
                'employees.surname',
                'employees.name',
                'employees.patronymic',
                'cars.model',
                'cars.cat_comfort_id',
                'categories_comfort.title as comfort',
                'trips.date_start',
                'trips.date_end',
                'trips.status',
            )
            ->get();

        //dump($result);
        return response()->json(GetCarsEmployeeResource::collection($result));
    }
}



