<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Deposit;
use App\Models\Achievement;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthdate',
        'password',
        'role',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthdate' => 'date',
        'role' => 'string',
    ];

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function bettings()
    {
        return $this->hasMany(Bet::class);
    }

    public function bets()
    {
        return $this->hasMany(\App\Models\Bet::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    /**
     * Relación many-to-many con logros (achievements).
     */
    public function achievements()
    {
        return $this->belongsToMany(\App\Models\Achievement::class, 'user_achievements')
            ->withPivot('unlocked_at');
    }

    /**
     * Relación uno a uno con el nivel del usuario.
     */
    public function userLevel()
    {
        return $this->hasOne(\App\Models\UserLevel::class);
    }

    /**
     * Calcula el porcentaje de apuestas ganadas sobre el total de apuestas.
     * @return float
     */
    public function getWinRate(): float
    {
        $total = $this->bets()->count();
        if ($total === 0) return 0;
        $won = $this->bets()->where('status', 'won')->count();
        return round(($won / $total) * 100, 1);
    }

    /**
     * Calcula la racha actual de apuestas ganadas consecutivas.
     * @return int
     */
    public function getWinningStreak(): int
    {
        $bets = $this->bets()->orderByDesc('created_at')->get();
        $streak = 0;
        foreach ($bets as $bet) {
            if ($bet->status === 'won') {
                $streak++;
            } else {
                break;
            }
        }
        return $streak;
    }

    /**
     * Devuelve el total apostado por el usuario (suma de amount de todas las apuestas).
     * @return float
     */
    public function getTotalWagered(): float
    {
        return (float) $this->bets()->sum('amount');
    }

    /**
     * Devuelve el total ganado por el usuario (suma de amount * odds de apuestas ganadas).
     * @return float
     */
    public function getTotalWon(): float
    {
        return (float) $this->bets()->where('status', 'won')->get()->sum(function($bet) {
            return $bet->amount * $bet->odds;
        });
    }

    /**
     * Relación con los parlays del usuario.
     */
    public function parlays()
    {
        return $this->hasMany(\App\Models\Parlay::class);
    }
}
