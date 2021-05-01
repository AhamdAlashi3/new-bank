<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    use HasFactory;

    public function merchants()
    {
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }
}
