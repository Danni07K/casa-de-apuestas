<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    /**
     * Verifica si el usuario ya tiene este logro desbloqueado.
     * @param User $user
     * @return bool
     */
    public function isUnlockedBy(User $user): bool
    {
        return $user->achievements()->where('achievements.id', $this->id)->exists();
    }

    /**
     * Verifica si el usuario cumple los requisitos para este logro.
     * @param User $user
     * @return bool
     */
    public function checkRequirements(User $user): bool
    {
        switch ($this->type) {
            case 'bets_count':
                return $user->bets()->count() >= $this->requirement_value;
            case 'win_streak':
                return $user->getWinningStreak() >= $this->requirement_value;
            case 'total_wagered':
                return $user->getTotalWagered() >= $this->requirement_value;
            case 'win_rate':
                return $user->getWinRate() >= $this->requirement_value;
            case 'parlay_wins':
                return $user->parlays()->where('status', 'won')->count() >= $this->requirement_value;
            default:
                return false;
        }
    }

    /**
     * Relación many-to-many con usuarios que han desbloqueado este logro.
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_achievements')
            ->withPivot('unlocked_at');
    }
}
