<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
