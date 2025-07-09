<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $bonus_id
 * @property numeric $amount
 * @property numeric $wagered_amount
 * @property string $status
 * @property \Illuminate\Support\Carbon $activated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bonus $bonus
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereBonusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonus whereWageredAmount($value)
 * @mixin \Eloquent
 */
class UserBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bonus_id',
        'amount',
        'wagered_amount',
        'status',
        'activated_at',
        'expires_at',
        'completed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'wagered_amount' => 'decimal:2',
        'activated_at' => 'datetime',
        'expires_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }

    public function addWageredAmount(float $amount): void
    {
        $this->wagered_amount += $amount;

        // Verificar si completó el requisito de apuesta
        if ($this->wagered_amount >= $this->bonus->wagering_requirement * $this->amount) {
            $this->complete();
        }

        $this->save();
    }

    private function complete(): void
    {
        $this->status = 'completed';
        $this->completed_at = now();

        // Agregar el bono al saldo del usuario
        $this->user->balance += $this->amount;
        $this->user->save();

        // Notificar al usuario
        $this->user->notifications()->create([
            'message' => "¡Bono completado! Se han agregado PEN {$this->amount} a tu saldo",
            'type' => 'bonus_completed',
        ]);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
