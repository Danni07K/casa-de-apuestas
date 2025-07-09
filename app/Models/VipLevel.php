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
 * @property int $level
 * @property numeric $min_deposits
 * @property numeric $cashback_percentage
 * @property numeric $bonus_percentage
 * @property int $free_bets_monthly
 * @property bool $priority_support
 * @property bool $exclusive_events
 * @property string $badge_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserVip> $userVips
 * @property-read int|null $user_vips_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereBadgeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereBonusPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereCashbackPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereExclusiveEvents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereFreeBetsMonthly($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereMinDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel wherePrioritySupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VipLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VipLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'level',
        'min_deposits',
        'cashback_percentage',
        'bonus_percentage',
        'free_bets_monthly',
        'priority_support',
        'exclusive_events',
        'badge_color',
    ];

    protected $casts = [
        'min_deposits' => 'decimal:2',
        'cashback_percentage' => 'decimal:2',
        'bonus_percentage' => 'decimal:2',
        'priority_support' => 'boolean',
        'exclusive_events' => 'boolean',
    ];

    public function userVips()
    {
        return $this->hasMany(UserVip::class);
    }

    public function getNextLevel()
    {
        return static::where('level', '>', $this->level)
            ->orderBy('level')
            ->first();
    }

    public function getPreviousLevel()
    {
        return static::where('level', '<', $this->level)
            ->orderByDesc('level')
            ->first();
    }
}
