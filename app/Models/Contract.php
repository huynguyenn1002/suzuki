<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = "contract";
    
    public $timestamps = false;

    protected $fillable = [
        'contract_num', 
        'contract_type', 
        'customer_type', 
        'contract_sign_date',
        'admin_id',
        'customer_name',
        'customer_gender',
        'customer_birthday',
        'position',
        'representative',
        'tax_code',
        'tax_issuance_date',
        'tax_issuance_place',
        'province_id',
        'district_id',
        'ward_id',
        'province_name',
        'district_name',
        'ward_name',
        'address',
        'customer_phone',
        'customer_id_card',
        'customer_id_card_register',
        'issued_by',
        'mail_address',
        'car_id',
        'car_type',
        'car_color',
        'year_of_manufacture',
        'notice_price',
        'real_price',
        'amount',
        'deposit',
        'car_delivery_time',
        'promotion',
        'gift',
        'broker_name',
        'broker_address',
        'broker_ic_card',
        'broker_phone',
        'amount_of_commission',
    ];
}
