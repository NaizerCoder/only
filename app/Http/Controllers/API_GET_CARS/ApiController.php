<?php

namespace App\Http\Controllers\API_GET_CARS;

use App\Http\Controllers\Controller;
use App\Http\Requests\API_GET_CARS\ApiRequest;
use App\Http\Resources\API_GET_CARS\ApiResource;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function __invoke(GetCarsEmployeeRequest $request)
    {
        $data = $request->validated();

        $carAll = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->where('employees.id', '=', $data['id'])
            ->where('categories_comfort.id', '=', $data['category_id'])
            ->where('cars.model', '=', $data['model'])
            ->select(
                'employees.id as employee_id',
                'cars.model',
                'cars.id as car_id',
                'cars.year as car_year',
                'categories_comfort.title as comfort'

            )
            ->get();

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
            ->select(
                'cars.id as car_id',
            )
            ->get()->unique('car_id')->toArray();

        $carsCollection = $carAll->keyBy('car_id');
        foreach ($carsBlock as $block) {
            $carsCollection->forget($block->car_id);
        }
        //dump($carsCollection);

        return response()->json(GetCarsEmployeeResource::collection($carsCollection));
    }
}



