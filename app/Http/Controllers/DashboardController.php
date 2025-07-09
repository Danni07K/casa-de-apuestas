<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\UserLevel;
use App\Models\UserVip;
use App\Models\Parlay;
use App\Models\Bet;
use App\Services\GamificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $gamificationService;

    public function __construct(GamificationService $gamificationService)
    {
        $this->gamificationService = $gamificationService;
    }

    public function index()
    {
        $user = Auth::user();

        // Obtener estadísticas del usuario
        $stats = [
            'total_bets' => $user->bets()->count(),
            'won_bets' => $user->bets()->where('status', 'won')->count(),
            'win_rate' => $user->getWinRate(),
            'total_wagered' => $user->getTotalWagered(),
            'total_won' => $user->getTotalWon(),
            'winning_streak' => $user->getWinningStreak(),
            'balance' => $user->balance,
        ];

        // Obtener logros del usuario
        $achievements = $user->achievements()->withPivot('unlocked_at')->get();
        $unlockedAchievements = $achievements->count();
        $totalAchievements = \App\Models\Achievement::where('is_active', true)->count();

        // Obtener nivel y VIP
        $userLevel = $user->userLevel;
        $userVip = $user->userVip;

        // Obtener apuestas recientes
        $recentBets = $user->bets()
            ->with('event')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Obtener parlays recientes
        $recentParlays = $user->parlays()
            ->with(['selections.event'])
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        // Obtener leaderboard
        $leaderboard = $this->gamificationService->getLeaderboard(5);

        // Verificar logros nuevos
        $newAchievements = $this->gamificationService->checkAndAwardAchievements($user);

        return view('dashboard.index', compact(
            'stats',
            'achievements',
            'unlockedAchievements',
            'totalAchievements',
            'userLevel',
            'userVip',
            'recentBets',
            'recentParlays',
            'leaderboard',
            'newAchievements'
        ));
    }

    public function achievements()
    {
        $user = Auth::user();
        $achievements = \App\Models\Achievement::where('is_active', true)
            ->with(['users' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->get();

        return view('dashboard.achievements', compact('achievements'));
    }

    public function leaderboard()
    {
        $leaderboard = $this->gamificationService->getLeaderboard(20);

        return view('dashboard.leaderboard', compact('leaderboard'));
    }

    public function stats()
    {
        $user = Auth::user();

        // Estadísticas detalladas
        $monthlyStats = $this->getMonthlyStats($user);
        $betTypeStats = $this->getBetTypeStats($user);
        $profitLoss = $this->getProfitLossData($user);

        return view('dashboard.stats', compact('monthlyStats', 'betTypeStats', 'profitLoss'));
    }

    private function getMonthlyStats($user)
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthBets = $user->bets()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->get();

            $months->push([
                'month' => $date->format('M Y'),
                'total_bets' => $monthBets->count(),
                'won_bets' => $monthBets->where('status', 'won')->count(),
                'total_wagered' => $monthBets->sum('amount'),
                'total_won' => $monthBets->where('status', 'won')->sum('amount'),
            ]);
        }

        return $months;
    }

    private function getBetTypeStats($user)
    {
        return $user->bets()
            ->selectRaw('bet_type, COUNT(*) as total, SUM(CASE WHEN status = "won" THEN 1 ELSE 0 END) as won')
            ->groupBy('bet_type')
            ->get()
            ->map(function ($stat) {
                $stat->win_rate = $stat->total > 0 ? ($stat->won / $stat->total) * 100 : 0;
                return $stat;
            });
    }

    private function getProfitLossData($user)
    {
        $bets = $user->bets()
            ->where('status', '!=', 'pending')
            ->orderBy('created_at')
            ->get();

        $runningTotal = 0;
        $data = [];

        foreach ($bets as $bet) {
            if ($bet->status === 'won') {
                $runningTotal += ($bet->amount * $bet->odds) - $bet->amount;
            } else {
                $runningTotal -= $bet->amount;
            }

            $data[] = [
                'date' => $bet->created_at->format('Y-m-d'),
                'profit_loss' => $runningTotal,
            ];
        }

        return $data;
    }
}
