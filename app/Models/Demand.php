<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'contract_id', 'break_code_id', 'status', 'description'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function breakCode()
    {
        return $this->belongsTo(BreakCode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
