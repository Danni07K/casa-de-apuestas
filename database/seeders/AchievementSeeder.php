<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'name' => 'Primera Apuesta',
                'description' => 'Realiza tu primera apuesta',
                'icon' => '🎯',
                'points_reward' => 50,
                'type' => 'betting',
                'requirements' => [
                    ['type' => 'total_bets', 'value' => 1]
                ],
            ],
            [
                'name' => 'Apuesta Ganadora',
                'description' => 'Gana tu primera apuesta',
                'icon' => '🏆',
                'points_reward' => 100,
                'type' => 'betting',
                'requirements' => [
                    ['type' => 'total_bets', 'value' => 1]
                ],
            ],
            [
                'name' => 'Racha Ganadora',
                'description' => 'Gana 3 apuestas consecutivas',
                'icon' => '🔥',
                'points_reward' => 200,
                'type' => 'streak',
                'requirements' => [
                    ['type' => 'winning_streak', 'value' => 3]
                ],
            ],
            [
                'name' => 'Parlay Maestro',
                'description' => 'Gana un parlay de 3 o más selecciones',
                'icon' => '🎰',
                'points_reward' => 500,
                'type' => 'parlay',
                'requirements' => [
                    ['type' => 'parlay_wins', 'value' => 1]
                ],
            ],
            [
                'name' => 'Apostador Frecuente',
                'description' => 'Realiza 10 apuestas',
                'icon' => '📊',
                'points_reward' => 150,
                'type' => 'betting',
                'requirements' => [
                    ['type' => 'total_bets', 'value' => 10]
                ],
            ],
            [
                'name' => 'Gran Apostador',
                'description' => 'Aposta un total de PEN 1000',
                'icon' => '💰',
                'points_reward' => 300,
                'type' => 'betting',
                'requirements' => [
                    ['type' => 'total_wagered', 'value' => 1000]
                ],
            ],
            [
                'name' => 'Cashout Pro',
                'description' => 'Realiza 5 cashouts exitosos',
                'icon' => '⚡',
                'points_reward' => 250,
                'type' => 'cashout',
                'requirements' => [
                    ['type' => 'cashouts', 'value' => 5]
                ],
            ],
            [
                'name' => 'Leyenda',
                'description' => 'Gana 10 apuestas consecutivas',
                'icon' => '👑',
                'points_reward' => 1000,
                'type' => 'streak',
                'requirements' => [
                    ['type' => 'winning_streak', 'value' => 10]
                ],
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
