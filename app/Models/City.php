<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'net_sms_code'];


    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
