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
        'contract_sign_date',
        'admin_id',
        'customer_name',
        'customer_gender',
        'customer_birthday',
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
        'notice_price',
        'real_price',
        'invoice_selling_price',
        'amount',
        'deposit',
        'car_delivery_time',
        'promotion',
        'gift',
        'chassis_number',
        'engine_number',
        'pdi_time',
        'pdi_confirm_time',
        'note',
        'dnxhs_date',
        'payment_date',
        'payment_amount',
        'receipt_type',
        'banking_from',
        'banking_to',
    ];
}
