<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['demand_id', 'path', 'type'];


    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }
}
