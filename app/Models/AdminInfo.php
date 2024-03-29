<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminInfo extends Model
{
    use HasFactory;

    protected $table = "admin_info";

    public $timestamps = true;

    protected $fillable = [
        'admin_ID',
        'first_name', 
        'last_name', 
        'citizen_identification',
        'tel',
        'avatar',
        'district_id',
        'province_id',
        'ward_id',
        'district_name',
        'province_name',
        'ward_name',
        'address',
    ];

}
