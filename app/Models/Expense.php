<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'original_value',
        'currency',
        'exchange_rate',
        'brl_value',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}