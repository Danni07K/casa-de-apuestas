<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use App\Models\UserLevel;
use App\Models\UserVip;
use App\Models\VipLevel;

class GamificationService
{
    public function checkAndAwardAchievements(User $user): array
    {
        $newAchievements = [];
        $achievements = Achievement::where('is_active', true)->get();

        foreach ($achievements as $achievement) {
            if (!$achievement->isUnlockedBy($user) && $achievement->checkRequirements($user)) {
                $this->awardAchievement($user, $achievement);
                $newAchievements[] = $achievement;
            }
        }

        return $newAchievements;
    }

    public function awardAchievement(User $user, Achievement $achievement): void
    {
        // Asignar logro al usuario
        $user->achievements()->attach($achievement->id, [
            'unlocked_at' => now(),
        ]);

        // Agregar puntos de experiencia
        $this->addExperience($user, $achievement->points_reward);

        // Notificar al usuario
        $user->notifications()->create([
            'message' => "¡Logro desbloqueado: {$achievement->name}! +{$achievement->points_reward} XP",
            'type' => 'achievement_unlocked',
        ]);
    }

    public function addExperience(User $user, int $points): void
    {
        $userLevel = $user->userLevel;

        if (!$userLevel) {
            $userLevel = UserLevel::create([
                'user_id' => $user->id,
                'level' => 1,
                'experience_points' => 0,
                'total_points_earned' => 0,
            ]);
        }

        $userLevel->addExperience($points);
    }

    public function checkVipLevelUp(User $user, float $depositAmount): void
    {
        $userVip = $user->userVip;

        if (!$userVip) {
            // Crear VIP inicial
            $firstLevel = VipLevel::orderBy('level')->first();
            if ($firstLevel) {
                $userVip = UserVip::create([
                    'user_id' => $user->id,
                    'vip_level_id' => $firstLevel->id,
                    'total_deposits' => 0,
                    'total_wagered' => 0,
                    'level_up_at' => now(),
                    'last_activity_at' => now(),
                ]);
            }
        }

        if ($userVip) {
            $userVip->addDeposit($depositAmount);
        }
    }

    public function processBetResult(User $user, float $betAmount, bool $won): void
    {
        // Agregar experiencia por apuesta
        $experience = $won ? 10 : 5;
        $this->addExperience($user, $experience);

        // Actualizar estadísticas VIP
        if ($user->userVip) {
            $user->userVip->addWagered($betAmount);
        }

        // Procesar cashback si perdió
        if (!$won && $user->userVip) {
            $cashbackAmount = $user->userVip->getCashbackAmount($betAmount);
            if ($cashbackAmount > 0) {
                $user->balance += $cashbackAmount;
                $user->save();

                $user->notifications()->create([
                    'message' => "Cashback VIP: PEN " . number_format($cashbackAmount, 2),
                    'type' => 'vip_cashback',
                ]);
            }
        }

        // Verificar logros
        $this->checkAndAwardAchievements($user);
    }

    public function getLeaderboard(int $limit = 10): array
    {
        $topUsers = User::select('users.*')
            ->join('user_levels', 'users.id', '=', 'user_levels.user_id')
            ->orderByDesc('user_levels.experience_points')
            ->with('userLevel')
            ->limit($limit)
            ->get();

        return $topUsers->map(function ($user) {
            return [
                'user' => $user,
                'level' => $user->userLevel->level,
                'experience' => $user->userLevel->experience_points,
                'win_rate' => $user->getWinRate(),
            ];
        })->toArray();
    }
}
