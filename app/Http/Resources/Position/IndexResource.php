<?php

namespace App\Http\Resources\Position;

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
            'title' => $this->title,
            'category_position' => new \App\Http\Resources\CategoryPosition\IndexResource($this->catPosition),
            'category_comfort' => \App\Http\Resources\CategoryComfort\IndexResource::collection($this->catComfort),
            'date_created' => $this->created_at->format('d.m.Y'),
        ];
    }
}
