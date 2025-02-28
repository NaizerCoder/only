<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $guarded = [];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value),
        );
    }

    public function catPosition(){
        return $this->belongsTo( CategoryPosition::class, 'cat_position_id', 'id');
    }

    public function catComfort()
    {
        return $this->belongsToMany(CategoryComfort::class, 'cat_comfort_position', 'position_id', 'cat_comfort_id')->orderBy('title','asc');
    }

}
