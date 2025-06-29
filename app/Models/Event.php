<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team',
        'away_team',
        'start_time',
        'date',
        'league',
        'status',
        'home_odds',
        'draw_odds',
        'away_odds',
        'result',
        'first_goal',
        'both_score',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
    ];

    public function bets()
    {
        return $this->hasMany(\App\Models\Bet::class);
    }
} 