<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\GetCarsRequest;
use App\Http\Resources\API\GetCarsResource;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class GetCars extends Controller
{
    public function __invoke(GetCarsRequest $request)
    {
        $data = $request->validated();

        if(!isset($data['model'])){
            $data['model'] = false;
        }

        if(!isset($data['category_id'])){
            $data['category_id'] = false;
        }

        $carsBlock = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')
            ->leftJoin('trips', 'trips.car_id', '=', 'cars.id')
            ->where('employees.id', '=', $data['employee_id'])
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

        $carsCollection = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('cat_comfort_position', 'positions.id', '=', 'cat_comfort_position.position_id')
            ->join ('cars', 'cars.cat_comfort_id','=','cat_comfort_position.cat_comfort_id')
            ->join ('categories_comfort', 'cars.cat_comfort_id','=','categories_comfort.id')

            ->when($data['category_id'], function ($query) use ($data) {
                return $query->where('categories_comfort.id', $data['category_id']);
            })

            ->when($data['model'], function ($query) use ($data) {
                return $query->where('cars.model', 'LIKE', "%{$data['model']}%");
            })

            ->where('employees.id', '=', $data['employee_id'])
            ->select(
                'employees.id as employee_id',
                'employees.surname',
                'employees.name',
                'employees.patronymic',
                'cars.model',
                'cars.id as car_id',
                'cars.year as car_year',
                'categories_comfort.title as comfort'

            )
            ->whereNotIn('cars.id', $carsBlock)
            ->orderBy('cars.model','asc')
            ->get();
        //dd($carAll);



//        $carsCollection = $carAll->keyBy('car_id');
//        foreach ($carsBlock as $block) {
//            $carsCollection->forget($block->car_id);
//        }
        //dump($carsCollection);

        return response()->json(GetCarsResource::collection($carsCollection));
    }
}



