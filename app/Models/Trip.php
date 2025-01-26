<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';
    protected $guarded = [];

    protected function dateStart(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value),
        );
    }
    protected function dateEnd(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::create($value),
        );
    }
    public function Car(){
        return $this->belongsTo( Car::class, 'car_id', 'id');
    }
    public function Employee(){
        return $this->belongsTo( Employee::class, 'employee_id', 'id');
    }
}
