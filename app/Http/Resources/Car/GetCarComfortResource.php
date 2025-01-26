<?php

namespace App\Http\Resources\Car;

use App\Http\Resources\Employee\GetDriverIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class GetCarComfortResource extends JsonResource
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
            'model' => $this->model,
            'category_comfort' => new \App\Http\Resources\CategoryComfort\GetCategoriesComfortResource($this->catComfort),
        ];
    }
}
