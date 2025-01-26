<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $guarded = [];
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value),
        );
    }
    public function catComfort(){
        return $this->belongsTo( CategoryComfort::class, 'cat_comfort_id', 'id');
    }

    public function driver(){
        return $this->belongsTo( Employee::class, 'driver_id', 'id');
    }
}
