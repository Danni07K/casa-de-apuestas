<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $vip_level_id
 * @property numeric $total_deposits
 * @property numeric $total_wagered
 * @property \Illuminate\Support\Carbon|null $level_up_at
 * @property \Illuminate\Support\Carbon|null $last_activity_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\VipLevel $vipLevel
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereLastActivityAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereLevelUpAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereTotalDeposits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereTotalWagered($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVip whereVipLevelId($value)
 * @mixin \Eloquent
 */
class UserVip extends Model
{
    use HasFactory;

    protected $table = 'user_vip';

    protected $fillable = [
        'user_id',
        'vip_level_id',
        'total_deposits',
        'total_wagered',
        'level_up_at',
        'last_activity_at',
    ];

    protected $casts = [
        'total_deposits' => 'decimal:2',
        'total_wagered' => 'decimal:2',
        'level_up_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vipLevel()
    {
        return $this->belongsTo(VipLevel::class);
    }

    public function addDeposit(float $amount): void
    {
        $this->total_deposits += $amount;
        $this->last_activity_at = now();

        // Verificar si sube de nivel VIP
        $this->checkLevelUp();

        $this->save();
    }

    public function addWagered(float $amount): void
    {
        $this->total_wagered += $amount;
        $this->last_activity_at = now();
        $this->save();
    }

    private function checkLevelUp(): void
    {
        $nextLevel = VipLevel::where('min_deposits', '>', $this->total_deposits)
            ->orderBy('min_deposits')
            ->first();

        if ($nextLevel && $nextLevel->id !== $this->vip_level_id) {
            $this->vip_level_id = $nextLevel->id;
            $this->level_up_at = now();

            // Notificar al usuario
            $this->user->notifications()->create([
                'message' => "¡Felicidades! Has alcanzado el nivel VIP {$nextLevel->name}",
                'type' => 'vip_level_up',
            ]);
        }
    }

    public function getCashbackAmount(float $lostAmount): float
    {
        return $lostAmount * ($this->vipLevel->cashback_percentage / 100);
    }
}
