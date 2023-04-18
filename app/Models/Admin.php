<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\AdminInfo;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "admin";
    
    public $timestamps = true;

    protected $fillable = [
        'email',
        'password',
        'password_confirm',
        'is_admin'
    ];

    protected $hidden = [
        'password', 'remember_token', 'password_confirm'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function infoDetail()
    {
        return $this->hasOne(AdminInfo::class, 'admin_id', 'id');
    }
}
