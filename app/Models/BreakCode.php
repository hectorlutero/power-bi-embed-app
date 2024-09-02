<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakCode extends Model
{
    use HasFactory;

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
