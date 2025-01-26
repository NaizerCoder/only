<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Position\GetPositionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class GetEmployeeResource extends JsonResource
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
            'position' => new GetPositionResource($this->Position),
            'date_created' => $this->created_at->format('d.m.Y'),
        ];
    }
}
