<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = "suzuki_car";

    public $timestamps = true;

    protected $fillable = [
        'car_name',
        'price',
        'type',
    ];
}
