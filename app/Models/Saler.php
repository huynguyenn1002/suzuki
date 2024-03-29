<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saler extends Model
{
    use HasFactory;

    protected $table = "saler";

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'tel',
    ];
}
