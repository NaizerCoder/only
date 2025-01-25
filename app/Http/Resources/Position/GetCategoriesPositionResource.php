<?php

namespace App\Http\Resources\Position;

use App\Models\CategoryComfort;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCategoriesPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categories_comfort = CategoryComfort::all();
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
