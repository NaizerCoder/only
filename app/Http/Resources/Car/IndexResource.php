<?php

namespace App\Http\Resources\Car;

use App\Http\Resources\Employee\GetDriverIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class IndexResource extends JsonResource
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
            'year' => $this->year,
            'category_comfort' => new \App\Http\Resources\CategoryComfort\IndexResource($this->catComfort),
            'driver' => new GetDriverIndexResource($this->driver),
            'date_created' => $this->created_at->format('d.m.Y'),
        ];
    }
}
