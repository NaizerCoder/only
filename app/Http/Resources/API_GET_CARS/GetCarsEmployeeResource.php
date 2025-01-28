<?php

namespace App\Http\Resources\API_GET_CARS;

use App\Http\Resources\CategoryComfort\GetCategoriesComfortResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class GetCarsEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->employee_id,
//            'surname' => $this->surname,
//            'name' => $this->name,
//            'patronymic' => $this->patronymic,
            'model' => $this->model,
//            'cat_comfort_id' => $this->cat_comfort_id,
            'car_id' => $this->car_id,
            'car_year' => $this->car_year,
            'comfort' => $this->comfort,
        ];
    }
}
