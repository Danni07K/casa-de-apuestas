<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property numeric|null $amount
 * @property numeric|null $percentage
 * @property int|null $min_deposit
 * @property numeric|null $max_bonus
 * @property int|null $wagering_requirement
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property bool $is_active
 * @property array<array-key, mixed>|null $conditions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserBonus> $userBonuses
 * @property-read int|null $user_bonuses_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereMaxBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereMinDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bonus whereWageringRequirement($value)
 * @mixin \Eloquent
 */
class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'amount',
        'percentage',
        'min_deposit',
        'max_bonus',
        'wagering_requirement',
        'start_date',
        'end_date',
        'is_active',
        'conditions',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'max_bonus' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'conditions' => 'array',
    ];

    public function userBonuses()
    {
        return $this->hasMany(UserBonus::class);
    }

    public function isAvailable(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->start_date && $this->start_date->isFuture()) {
            return false;
        }

        if ($this->end_date && $this->end_date->isPast()) {
            return false;
        }

        return true;
    }

    public function calculateBonusAmount(float $depositAmount): float
    {
        if ($this->amount) {
            return min($this->amount, $this->max_bonus ?? $this->amount);
        }

        if ($this->percentage) {
            $bonusAmount = $depositAmount * ($this->percentage / 100);
            return min($bonusAmount, $this->max_bonus ?? $bonusAmount);
        }

        return 0;
    }
}
