<?php

namespace Database\Seeders;

use App\Models\VipLevel;
use Illuminate\Database\Seeder;

class VipLevelSeeder extends Seeder
{
    public function run(): void
    {
        $vipLevels = [
            [
                'name' => 'Bronce',
                'description' => 'Nivel inicial VIP',
                'level' => 1,
                'min_deposits' => 0,
                'cashback_percentage' => 2.0,
                'bonus_percentage' => 5.0,
                'free_bets_monthly' => 0,
                'priority_support' => false,
                'exclusive_events' => false,
                'badge_color' => '#CD7F32',
            ],
            [
                'name' => 'Plata',
                'description' => 'Nivel Plata VIP',
                'level' => 2,
                'min_deposits' => 1000,
                'cashback_percentage' => 3.0,
                'bonus_percentage' => 7.0,
                'free_bets_monthly' => 2,
                'priority_support' => false,
                'exclusive_events' => false,
                'badge_color' => '#C0C0C0',
            ],
            [
                'name' => 'Oro',
                'description' => 'Nivel Oro VIP',
                'level' => 3,
                'min_deposits' => 5000,
                'cashback_percentage' => 5.0,
                'bonus_percentage' => 10.0,
                'free_bets_monthly' => 5,
                'priority_support' => true,
                'exclusive_events' => false,
                'badge_color' => '#FFD700',
            ],
            [
                'name' => 'Platino',
                'description' => 'Nivel Platino VIP',
                'level' => 4,
                'min_deposits' => 15000,
                'cashback_percentage' => 7.0,
                'bonus_percentage' => 15.0,
                'free_bets_monthly' => 10,
                'priority_support' => true,
                'exclusive_events' => true,
                'badge_color' => '#E5E4E2',
            ],
            [
                'name' => 'Diamante',
                'description' => 'Nivel Diamante VIP',
                'level' => 5,
                'min_deposits' => 50000,
                'cashback_percentage' => 10.0,
                'bonus_percentage' => 20.0,
                'free_bets_monthly' => 20,
                'priority_support' => true,
                'exclusive_events' => true,
                'badge_color' => '#B9F2FF',
            ],
        ];

        foreach ($vipLevels as $level) {
            VipLevel::create($level);
        }
    }
}
