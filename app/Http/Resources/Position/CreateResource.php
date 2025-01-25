<?php

namespace App\Http\Resources\Position;

use App\Http\Controllers\CategoryComfort\IndexController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CreateResource extends JsonResource
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
            'title' => $this->title,
            'categories_comfort' => IndexController::collection($this->categories_comfort) ,

        ];
    }
}
