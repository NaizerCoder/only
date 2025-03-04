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

        $carsBlock = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->leftJoin('trips', 'trips.car_id', '=', 'cars.id')
            ->where('employees.id', '=', $data['id'])
            ->where('trips.status', '=', 'open')
            ->where(function ($query) use ($data) {
                $query->whereBetween('trips.date_start', [$data['date_start'], $data['date_end']])
                    ->orwhereBetween('trips.date_end', [$data['date_start'], $data['date_end']])
                    ->orwhere('trips.date_start', '<', $data['date_start'])
                    ->where('trips.date_end','>', $data['date_end'])
                    ->orwhere('trips.date_end', '>', $data['date_start'])
                    ->where('trips.date_end', '<', $data['date_end'])
                    ;
                $query->Where('trips.status', '!=', 'null');
                $query->Where('trips.status', '!=', 'closed');
            })
            ->groupBy('cars.id')
            ->pluck('cars.id');
//            ->select(
//                'cars.id as car_id',
//            )
        //dd($carsBlock);
            //->get()->unique('car_id')->toArray();

        $carsCollection = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->where('employees.id', '=', $data['id'])
            //->where('categories_comfort.id', '=', '3')
            //->where('cars.model', '=', 'Audi Q3')
            ->select(
                'employees.id as employee_id',
                'cars.model',
                'cars.id as car_id',
                'cars.year as car_year',
                'categories_comfort.title as comfort'

            )
            ->whereNotIn('cars.id', $carsBlock)
            ->orderBy('cars.model','asc')
            ->get();
            //->toSql();

//        $carsCollection = $carAll->keyBy('car_id');
//        foreach ($carsBlock as $block) {
//            $carsCollection->forget($block->car_id);
//        }
        //dd($carAll);

        return response()->json(GetCarsEmployeeResource::collection($carsCollection));
    }
}



