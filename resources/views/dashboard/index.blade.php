@extends('layouts.app')

@section('content')
<style>
    .dashboard-main-content {
        padding-top: 90px !important;
    }
    .sticky-top {
        z-index: 900 !important;
    }
</style>
<div class="container-fluid dashboard-main-content">
    <!-- Notificaciones de logros nuevos -->
    @if(count($newAchievements) > 0)
        <div class="achievement-notifications mb-4" id="achievement-toasts">
            @foreach($newAchievements as $achievement)
                <div class="alert alert-success achievement-alert animate__animated animate__fadeInRight" role="alert" style="position:relative;">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" aria-label="Cerrar"></button>
                    <div class="d-flex align-items-center">
                        <div class="achievement-icon me-3">{!! $achievement->icon !!}</div>
                        <div>
                            <h6 class="mb-1">¡Logro Desbloqueado!</h6>
                            <p class="mb-0">{{ $achievement->name }} - {{ $achievement->description }}</p>
                            <small class="text-success">+{{ $achievement->points_reward }} XP</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        <!-- Estadísticas principales -->
        <div class="col-lg-8">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="stat-card animate__animated animate__fadeInUp">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ number_format($stats['win_rate'], 1) }}%</h3>
                            <p class="stat-label">Win Rate</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="stat-card animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $stats['winning_streak'] }}</h3>
                            <p class="stat-label">Racha Ganadora</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="stat-card animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $stats['total_bets'] }}</h3>
                            <p class="stat-label">Total Apuestas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="stat-card animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">PEN {{ number_format($stats['balance'], 2) }}</h3>
                            <p class="stat-label">Saldo</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progreso del nivel -->
            @if($userLevel)
                <div class="card mb-4 animate__animated animate__fadeIn">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-star me-2"></i>
                            Nivel {{ $userLevel->level }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="level-progress">
                            @php
                                $requiredExp = 100 * pow($userLevel->level, 1.5);
                                $progress = ($userLevel->experience_points / $requiredExp) * 100;
                            @endphp
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small>{{ $userLevel->experience_points }} / {{ (int)$requiredExp }} XP</small>
                                <small>{{ number_format($progress, 1) }}%</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Apuestas recientes -->
            <div class="card mb-4 animate__animated animate__fadeIn">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Apuestas Recientes
                    </h5>
                    <a href="{{ route('betting.history') }}" class="btn btn-sm btn-outline-primary">Ver Todas</a>
                </div>
                <div class="card-body">
                    @if($recentBets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-dark table-bordered align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th>Evento</th>
                                        <th>Apuesta</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBets as $bet)
                                        <tr class="bet-row">
                                            <td>{{ $bet->event->home_team }} vs {{ $bet->event->away_team }}</td>
                                            <td><span class="badge bg-secondary">{{ ucfirst($bet->bet_type) }}</span>: <span class="fw-bold">{{ $bet->selection }}</span></td>
                                            <td><span class="badge bg-info">PEN {{ number_format($bet->amount, 2) }}</span></td>
                                            <td>
                                                @if($bet->status === 'won')
                                                    <span class="badge bg-success animate__animated animate__pulse animate__infinite">Ganada</span>
                                                @elseif($bet->status === 'lost')
                                                    <span class="badge bg-danger">Perdida</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                                @endif
                                            </td>
                                            <td>{{ $bet->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-3">No hay apuestas recientes</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar mejorado -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top:100px; z-index:1040;">
                <!-- Logros -->
                <div class="card mb-4 animate__animated animate__fadeInRight">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-medal me-2"></i>
                            Logros ({{ $unlockedAchievements }}/{{ $totalAchievements }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="achievements-grid">
                            @foreach($achievements->take(6) as $achievement)
                                <div class="achievement-item position-relative">
                                    <div class="achievement-icon" style="font-size:2rem;">{!! $achievement->icon !!}</div>
                                    <div class="achievement-info">
                                        <h6 class="achievement-name">{{ $achievement->name }}</h6>
                                        <small class="achievement-desc">{{ $achievement->description }}</small>
                                        <div class="achievement-date">
                                            @if($achievement->pivot && $achievement->pivot->unlocked_at)
                                                {{ \Illuminate\Support\Carbon::parse($achievement->pivot->unlocked_at)->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    @if($achievement->users->count() > 0)
                                        <span class="position-absolute top-0 end-0 badge bg-success">✔</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @if($achievements->count() > 6)
                            <div class="text-center mt-3">
                                <a href="{{ route('dashboard.achievements') }}" class="btn btn-sm btn-outline-primary">
                                    Ver Todos los Logros
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Leaderboard -->
                <div class="card mb-4 animate__animated animate__fadeInRight animate__delay-1s">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-crown me-2"></i>
                            Top Jugadores
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($leaderboard as $index => $entry)
                            <div class="leaderboard-item">
                                <div class="rank">{{ $index + 1 }}</div>
                                <div class="player-info">
                                    <div class="player-name">{{ $entry['user']->name }}</div>
                                    <div class="player-stats">
                                        Nivel {{ $entry['level'] }} • {{ number_format($entry['win_rate'], 1) }}% WR
                                    </div>
                                    <div class="player-xp">{{ number_format($entry['experience']) }} XP</div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center mt-3">
                            <a href="{{ route('dashboard.leaderboard') }}" class="btn btn-sm btn-outline-primary">
                                Ver Leaderboard Completo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="card animate__animated animate__fadeInRight animate__delay-2s">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>
                            Acciones Rápidas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('betting.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-futbol me-2"></i>
                                Hacer Apuesta
                            </a>
                            <a href="{{ route('parlays.create') }}" class="btn btn-warning btn-lg">
                                <i class="fas fa-layer-group me-2"></i>
                                Crear Parlay
                            </a>
                            <a href="{{ route('user.deposits.index') }}" class="btn btn-info btn-lg">
                                <i class="fas fa-plus me-2"></i>
                                Depositar
                            </a>
                            <a href="{{ route('dashboard.stats') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-chart-line me-2"></i>
                                Ver Estadísticas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
.stat-card {
    background: linear-gradient(135deg, #1a1f35 0%, #2a2f45 100%);
    border: 1px solid rgba(47, 211, 93, 0.2);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(47, 211, 93, 0.15);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.stat-value {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
    color: white;
}

.stat-label {
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
}

.achievement-notifications {
    position: fixed;
    top: 100px;
    right: 20px;
    z-index: 1050;
    max-width: 400px;
}

.achievement-alert {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.achievement-icon {
    font-size: 24px;
}

.achievements-grid {
    display: grid;
    gap: 10px;
}

.achievement-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border-left: 3px solid #2FD35D;
}

.achievement-name {
    margin: 0;
    font-size: 14px;
    color: white;
}

.achievement-desc {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
}

.achievement-date {
    color: #2FD35D;
    font-size: 11px;
    font-weight: 600;
}

.leaderboard-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.leaderboard-item:last-child {
    border-bottom: none;
}

.rank {
    width: 30px;
    height: 30px;
    background: linear-gradient(45deg, #2FD35D, #28b850);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 12px;
}

.player-info {
    flex: 1;
}

.player-name {
    font-weight: 600;
    color: white;
    font-size: 14px;
}

.player-stats {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
}

.player-xp {
    color: #2FD35D;
    font-weight: 600;
    font-size: 12px;
}

.card {
    background: linear-gradient(135deg, #1a1f35 0%, #2a2f45 100%);
    border: 1px solid rgba(47, 211, 93, 0.2);
    border-radius: 12px;
}

.card-header {
    background: rgba(47, 211, 93, 0.1);
    border-bottom: 1px solid rgba(47, 211, 93, 0.2);
    color: white;
}

.progress {
    background: rgba(255, 255, 255, 0.1);
    height: 8px;
    border-radius: 4px;
}

.progress-bar {
    background: linear-gradient(90deg, #2FD35D, #28b850);
    border-radius: 4px;
}
</style>
@endsection

@section('scripts')
<script>
// Toasts de logros: auto-ocultar y botón cerrar
window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.achievement-alert').forEach(function(alert) {
        // Auto-hide after 5s
        setTimeout(function() {
            alert.classList.add('animate__fadeOutRight');
            setTimeout(function() { alert.remove(); }, 1000);
        }, 5000);
        // Close button
        alert.querySelector('.btn-close').addEventListener('click', function() {
            alert.classList.add('animate__fadeOutRight');
            setTimeout(function() { alert.remove(); }, 1000);
        });
    });
});
</script>
@endsection
