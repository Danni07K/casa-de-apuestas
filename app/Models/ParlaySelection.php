<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $parlay_id
 * @property int $event_id
 * @property string $bet_type
 * @property string $selection
 * @property numeric $odds
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Parlay $parlay
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereBetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereOdds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereParlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParlaySelection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParlaySelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'parlay_id',
        'event_id',
        'bet_type',
        'selection',
        'odds',
        'status',
    ];

    protected $casts = [
        'odds' => 'decimal:2',
    ];

    public function parlay()
    {
        return $this->belongsTo(Parlay::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function updateStatus(): void
    {
        $event = $this->event;

        if ($event->status !== 'finished') {
            return;
        }

        $isWon = false;

        switch ($this->bet_type) {
            case '1x2':
                $isWon = $this->selection === $event->result;
                break;
            case 'primer_gol':
                $isWon = $this->selection === $event->first_goal;
                break;
            case 'ambos_marcan':
                $isWon = $this->selection === $event->both_score;
                break;
        }

        $this->status = $isWon ? 'won' : 'lost';
        $this->save();

        // Actualizar el estado del parlay
        $this->parlay->updateStatus();
    }
}
