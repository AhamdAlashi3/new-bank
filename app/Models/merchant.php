<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Merchant extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,Notifiable,HasRoles,HasApiTokens;

    public function car()
    {
        return $this->hasMany(car::class,'merchant_id','id');
    }
}
