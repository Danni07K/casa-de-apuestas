<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $level
 * @property int $experience_points
 * @property int $total_points_earned
 * @property \Illuminate\Support\Carbon|null $last_level_up
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereExperiencePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereLastLevelUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereTotalPointsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLevel whereUserId($value)
 * @mixin \Eloquent
 */
class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'experience_points',
        'total_points_earned',
        'last_level_up',
    ];

    protected $casts = [
        'last_level_up' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addExperience(int $points): void
    {
        $this->experience_points += $points;
        $this->total_points_earned += $points;

        // Calcular si sube de nivel
        $requiredExp = $this->calculateRequiredExp();

        if ($this->experience_points >= $requiredExp) {
            $this->levelUp();
        }

        $this->save();
    }

    private function calculateRequiredExp(): int
    {
        // Fórmula: 100 * nivel^1.5
        return (int) (100 * pow($this->level, 1.5));
    }

    private function levelUp(): void
    {
        $this->level++;
        $this->last_level_up = now();

        // Notificar al usuario
        $this->user->notifications()->create([
            'message' => "¡Felicidades! Has alcanzado el nivel {$this->level}",
            'type' => 'level_up',
        ]);
    }
}
