<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date',
        'total_amount',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
