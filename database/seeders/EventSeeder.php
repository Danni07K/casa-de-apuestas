<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        $leagues = [
            'LaLiga' => [
                'Real Madrid', 'Barcelona', 'Atlético Madrid', 'Sevilla', 'Villarreal',
                'Real Sociedad', 'Athletic Bilbao', 'Valencia', 'Betis', 'Celta'
            ],
            'Premier League' => [
                'Manchester City', 'Liverpool', 'Arsenal', 'Manchester United', 'Chelsea',
                'Tottenham', 'Newcastle', 'Aston Villa', 'Brighton', 'West Ham'
            ],
            'Serie A' => [
                'Inter', 'Milan', 'Juventus', 'Napoli', 'Roma',
                'Lazio', 'Atalanta', 'Fiorentina', 'Bologna', 'Torino'
            ],
            'Bundesliga' => [
                'Bayern Munich', 'Borussia Dortmund', 'RB Leipzig', 'Bayer Leverkusen', 'Stuttgart',
                'Frankfurt', 'Wolfsburg', 'Freiburg', 'Hoffenheim', 'Union Berlin'
            ],
            'Ligue 1' => [
                'PSG', 'Marseille', 'Lyon', 'Monaco', 'Lille',
                'Nice', 'Rennes', 'Lens', 'Strasbourg', 'Montpellier'
            ],
            'Liga MX' => [
                'América', 'Chivas', 'Cruz Azul', 'Tigres', 'Monterrey',
                'Pachuca', 'Santos', 'Pumas', 'Toluca', 'León'
            ],
            'MLS' => [
                'LA Galaxy', 'NYCFC', 'Seattle Sounders', 'Atlanta United', 'Portland Timbers',
                'Toronto FC', 'LAFC', 'Chicago Fire', 'DC United', 'Sporting KC'
            ],
            'Brasileirão' => [
                'Flamengo', 'Palmeiras', 'Santos', 'São Paulo', 'Corinthians',
                'Grêmio', 'Internacional', 'Cruzeiro', 'Vasco', 'Botafogo'
            ]
        ];

        $startDate = Carbon::now()->addHours(2);
        
        foreach ($leagues as $league => $teams) {
            // Crear 5 partidos por liga
            for ($i = 0; $i < 5; $i++) {
                $homeTeam = $teams[array_rand($teams)];
                do {
                    $awayTeam = $teams[array_rand($teams)];
                } while ($awayTeam === $homeTeam);

                $matchDate = $startDate->copy()->addHours(rand(2, 48));
                
                Event::create([
                    'home_team' => $homeTeam,
                    'away_team' => $awayTeam,
                    'league' => $league,
                    'status' => 'scheduled',
                    'date' => $matchDate->format('Y-m-d'),
                    'start_time' => $matchDate,
                    'home_odds' => number_format(rand(150, 300) / 100, 2),
                    'draw_odds' => number_format(rand(200, 350) / 100, 2),
                    'away_odds' => number_format(rand(150, 300) / 100, 2)
                ]);
            }
        }
    }
} 