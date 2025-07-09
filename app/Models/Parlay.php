<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property numeric $total_odds
 * @property numeric $amount
 * @property numeric $potential_win
 * @property string $status
 * @property int $total_selections
 * @property int $won_selections
 * @property numeric|null $partial_win_amount
 * @property \Illuminate\Support\Carbon|null $settled_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ParlaySelection> $selections
 * @property-read int|null $selections_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay wherePartialWinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay wherePotentialWin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereSettledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereTotalOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereTotalSelections($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parlay whereWonSelections($value)
 * @mixin \Eloquent
 */
class Parlay extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_odds',
        'amount',
        'potential_win',
        'status',
        'total_selections',
        'won_selections',
        'partial_win_amount',
        'settled_at',
    ];

    protected $casts = [
        'total_odds' => 'decimal:4',
        'amount' => 'decimal:2',
        'potential_win' => 'decimal:2',
        'partial_win_amount' => 'decimal:2',
        'settled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function selections()
    {
        return $this->hasMany(ParlaySelection::class);
    }

    public function calculateTotalOdds(): float
    {
        return $this->selections()->pluck('odds')->reduce(function ($carry, $odds) {
            return $carry * $odds;
        }, 1);
    }

    public function calculatePotentialWin(): float
    {
        return $this->amount * $this->total_odds;
    }

    public function updateStatus(): void
    {
        $selections = $this->selections;
        $totalSelections = $selections->count();
        $wonSelections = $selections->where('status', 'won')->count();
        $lostSelections = $selections->where('status', 'lost')->count();

        if ($lostSelections > 0) {
            $this->status = 'lost';
        } elseif ($wonSelections === $totalSelections) {
            $this->status = 'won';
        } elseif ($wonSelections > 0) {
            $this->status = 'partial';
            // Calcular ganancia parcial basada en selecciones ganadas
            $this->partial_win_amount = $this->calculatePartialWin($wonSelections, $totalSelections);
        }

        $this->won_selections = $wonSelections;
        $this->settled_at = now();
        $this->save();
    }

    private function calculatePartialWin(int $wonSelections, int $totalSelections): float
    {
        // Lógica para calcular ganancia parcial
        // Por ejemplo: si ganas 2 de 3 selecciones, obtienes una parte proporcional
        $winRatio = $wonSelections / $totalSelections;
        return $this->amount * $winRatio * 0.5; // 50% de la proporción ganada
    }
}
