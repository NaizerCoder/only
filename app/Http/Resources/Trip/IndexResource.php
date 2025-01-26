<?php

namespace App\Http\Resources\Trip;

use App\Http\Resources\Position\GetPositionResource;
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
            'car' => new \App\Http\Resources\Car\GetCarComfortResource($this->Car),
            'employee' => new \App\Http\Resources\Employee\IndexResource($this->Employee),
            'date_start' => $this->date_start->format('d.m.Y - H:i'),
            'date_end' => $this->date_end->format('d.m.Y - H:i'),
            'status' => $this->status,
        ];
    }
}
