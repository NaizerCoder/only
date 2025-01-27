<?php

namespace App\Http\Resources\Employee;

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
            'id' => $this->id,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
            'model' => $this->model,
            'cat_comfort_id' => $this->cat_comfort_id,
            'comfort' => $this->comfort,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
        ];
    }
}
