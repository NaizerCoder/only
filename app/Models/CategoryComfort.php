<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComfort extends Model
{
    use HasFactory;

    protected $table = 'categories_comfort';
    protected $guarded = [];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value),
        );
    }

    public function position()
    {
        return $this->belongsToMany(Position::class, 'cat_comfort_position', 'cat_comfort_id', 'position_id');
    }
}
