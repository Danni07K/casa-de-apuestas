<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BetType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'min_selections',
        'max_selections',
        'min_stake',
        'max_stake',
    ];

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }
} 