<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'address', 'email'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
