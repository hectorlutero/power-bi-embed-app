<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['contract_number', 'partner_id'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
