@extends('layouts.app')

@section('content')
<style>
.sidebar {
    background: rgba(21, 25, 40, 0.98);
    border-radius: 18px;
    padding: 24px 0 24px 0;
    min-height: 700px;
    box-shadow: 0 2px 12px 0 rgba(0,0,0,0.10);
}

.sidebar .menu-title {
    color: #fff;
    font-family: 'Outfit', sans-serif;
    font-weight: 700;
    margin-bottom: 22px;
    font-size: 1.15rem;
    padding-left: 28px;
    letter-spacing: 1px;
}

.sidebar .league-item {
    color: #fff;
    background: transparent;
    padding: 12px 28px;
    border-radius: 14px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    font-size: 1.08rem;
    font-weight: 500;
    transition: background 0.2s, color 0.2s;
    text-decoration: none !important;
    border: none;
}

.sidebar .league-item.active, .sidebar .league-item:hover {
    background: #2FD35D;
    color: #232733 !important;
    font-weight: 700;
    box-shadow: 0 2px 8px 0 rgba(47,211,93,0.10);
    text-decoration: none !important;
}
</style>
<div class="betting-container">
    <div class="row justify-content-center">
        <!-- Sidebar de Ligas -->
        <div class="col-lg-2 col-md-3 mb-3">
            <div class="sidebar">
                <a href="{{ route('betting.index') }}" class="league-item{{ !request('league') ? ' active' : '' }}">🌐 Todas las ligas</a>
                <div class="menu-title">LIGAS PRINCIPALES</div>
                <a href="{{ route('betting.index', ['league' => 'Liga 1']) }}" class="league-item{{ request('league') == 'Liga 1' ? ' active' : '' }}">⚽ Liga 1</a>
                <a href="{{ route('betting.index', ['league' => 'La Liga']) }}" class="league-item{{ request('league') == 'La Liga' ? ' active' : '' }}">🇪🇸 La Liga</a>
                <a href="{{ route('betting.index', ['league' => 'Serie A']) }}" class="league-item{{ request('league') == 'Serie A' ? ' active' : '' }}">🇮🇹 Serie A</a>
                <a href="{{ route('betting.index', ['league' => 'Bundesliga']) }}" class="league-item{{ request('league') == 'Bundesliga' ? ' active' : '' }}">🇩🇪 Bundesliga</a>
                <a href="{{ route('betting.index', ['league' => 'Copa de Francia']) }}" class="league-item{{ request('league') == 'Copa de Francia' ? ' active' : '' }}">🏆 Copa de Francia</a>
                <a href="{{ route('betting.index', ['league' => 'Premier League']) }}" class="league-item{{ request('league') == 'Premier League' ? ' active' : '' }}">🏴 Premier League</a>
                <a href="{{ route('betting.index', ['league' => 'Champions']) }}" class="league-item{{ request('league') == 'Champions' ? ' active' : '' }}">⭐ Champions</a>
                <a href="{{ route('betting.index', ['league' => 'Europa League']) }}" class="league-item{{ request('league') == 'Europa League' ? ' active' : '' }}">🏅 Europa League</a>
                <a href="{{ route('betting.index', ['league' => 'MLS']) }}" class="league-item{{ request('league') == 'MLS' ? ' active' : '' }}">🇺🇸 MLS</a>
                <a href="{{ route('betting.index', ['league' => 'Liga Profesional']) }}" class="league-item{{ request('league') == 'Liga Profesional' ? ' active' : '' }}">🇦🇷 Liga Profesional</a>
            </div>
        </div>
        <!-- Contenido Principal -->
        <div class="col-lg-10 col-md-9">
            <!-- Banner principal -->
            <div class="main-banner mb-4" style="width:100%;max-width:1200px;margin:auto;">
                <!-- Reemplaza la siguiente línea con tu imagen -->
                <img src="/images/banner.png" alt="Banner" style="width:100%;height:180px;object-fit:cover;border-radius:12px;" />
            </div>

            <!-- Secciones de partidos -->
            <div class="match-sections">
                <h3 class="text-light mb-3">Partidos Próximamente</h3>
                <div class="betting-grid mb-4">
                    @php $hayProximos = false; @endphp
                    @foreach($events as $event)
                        @if($event->status === 'scheduled')
                            @php $hayProximos = true; @endphp
                            <div class="bet-card">
                                <div class="bet-header">
                                    <span class="league-name">{{ $event->league }}</span>
                                    <span class="bet-type">Próximo</span>
                                </div>
                                <div class="bet-teams">
                                    <span class="team">{{ $event->home_team }}</span>
                                    <span class="vs">vs</span>
                                    <span class="team">{{ $event->away_team }}</span>
                                </div>
                                <div class="bet-odds">
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->home_odds, 2) }}</span>
                                        <span class="odd-label">Local</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->draw_odds, 2) }}</span>
                                        <span class="odd-label">Empate</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->away_odds, 2) }}</span>
                                        <span class="odd-label">Visitante</span>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('betting.bet', $event) }}" class="btn btn-success">Apostar</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if(!$hayProximos)
                        <div class="col-12">
                            <div class="alert alert-info text-center">No hay partidos próximos.</div>
                        </div>
                    @endif
                </div>

                <h3 class="text-light mb-3 mt-4">Partidos En Vivo</h3>
                <div class="betting-grid mb-4">
                    @php $hayEnVivo = false; @endphp
                    @foreach($events as $event)
                        @if($event->status === 'live')
                            @php $hayEnVivo = true; @endphp
                            <div class="bet-card">
                                <div class="bet-header">
                                    <span class="league-name">{{ $event->league }}</span>
                                    <span class="bet-type">En Vivo</span>
                                </div>
                                <div class="bet-teams">
                                    <span class="team">{{ $event->home_team }}</span>
                                    <span class="vs">vs</span>
                                    <span class="team">{{ $event->away_team }}</span>
                                </div>
                                <div class="bet-odds">
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->home_odds, 2) }}</span>
                                        <span class="odd-label">Local</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->draw_odds, 2) }}</span>
                                        <span class="odd-label">Empate</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->away_odds, 2) }}</span>
                                        <span class="odd-label">Visitante</span>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('betting.bet', $event) }}" class="btn btn-success">Apostar</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if(!$hayEnVivo)
                        <div class="col-12">
                            <div class="alert alert-info text-center">No hay partidos en vivo.</div>
                        </div>
                    @endif
                </div>

                <h3 class="text-light mb-3 mt-4">Partidos Finalizados</h3>
                <div class="betting-grid mb-4">
                    @php $hayFinalizados = false; @endphp
                    @foreach($events as $event)
                        @if($event->status === 'finished')
                            @php $hayFinalizados = true; @endphp
                            <div class="bet-card">
                                <div class="bet-header">
                                    <span class="league-name">{{ $event->league }}</span>
                                    <span class="bet-type">Finalizado</span>
                                </div>
                                <div class="bet-teams">
                                    <span class="team">{{ $event->home_team }}</span>
                                    <span class="vs">vs</span>
                                    <span class="team">{{ $event->away_team }}</span>
                                </div>
                                <div class="bet-odds">
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->home_odds, 2) }}</span>
                                        <span class="odd-label">Local</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->draw_odds, 2) }}</span>
                                        <span class="odd-label">Empate</span>
                                    </div>
                                    <div class="odd-item">
                                        <span class="odd-value">{{ number_format($event->away_odds, 2) }}</span>
                                        <span class="odd-label">Visitante</span>
                                    </div>
                                </div>
                                <div class="mt-2 text-center small">
                                    @if($event->result)
                                        <div><b>Ganador:</b>
                                            @if($event->result === 'local') {{ $event->home_team }}
                                            @elseif($event->result === 'empate') Empate
                                            @elseif($event->result === 'visitante') {{ $event->away_team }}
                                            @endif
                                        </div>
                                    @endif
                                    @if($event->first_goal)
                                        <div><b>Primer Gol:</b> {{ $event->first_goal }}</div>
                                    @endif
                                    @if($event->both_score)
                                        <div><b>Ambos Marcan:</b> {{ $event->both_score }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if(!$hayFinalizados)
                        <div class="col-12">
                            <div class="alert alert-info text-center">No hay partidos finalizados.</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cupón de Apuestas -->
            <div class="betting-slip">
                <div class="slip-header">
                    <i class="fas fa-ticket-alt"></i>
                    <span>CUPÓN</span>
                </div>
                <div class="slip-content">
                    @if(count($recentBets))
                        <ul class="list-unstyled mb-0">
                            @foreach($recentBets as $bet)
                                <li class="mb-3" style="background:#1a1f35; color:#fff; border-radius:6px; padding:8px;">
                                    <div><b>{{ $bet->event->home_team }} vs {{ $bet->event->away_team }}</b></div>
                                    <div class="small">Monto: PEN {{ number_format($bet->amount, 2) }} | Estado:
                                        @if($bet->status === 'pending') <span class="badge bg-warning text-dark">Pendiente</span>
                                        @elseif($bet->status === 'won') <span class="badge bg-success">Ganada</span>
                                        @else <span class="badge bg-danger">Perdida</span>
                                        @endif
                                    </div>
                                    <div class="small">{{ $bet->created_at->format('d/m/Y H:i') }}</div>
                                    @if($bet->status === 'pending')
                                    <div class="mt-2 d-flex gap-2">
                                        @if($bet->event->status === 'live')
                                            <form method="POST" action="{{ route('betting.cashout', $bet) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-warning">Cashout (90%)</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('betting.cancel', $bet) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Cancelar</button>
                                            </form>
                                            <form method="POST" action="{{ route('betting.cashout', $bet) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-warning">Cashout (90%)</button>
                                            </form>
                                        @endif
                                    </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-muted">No tienes apuestas recientes.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Estilos Generales */
.betting-container {
    min-height: 100vh;
    background: linear-gradient(to bottom, #1a1f35 0%, #0d1117 100%);
    color: white;
    position: relative;
}

/* Main Content */
.main-content {
    padding: 2rem;
}

.featured-matches {
    margin-bottom: 2rem;
}

.match-card {
    background: rgba(21, 25, 40, 0.95);
    border: 1px solid rgba(47, 211, 93, 0.2);
    border-radius: 10px;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.teams {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.team {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.team-logo {
    width: 50px;
    height: 50px;
    background: rgba(47, 211, 93, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.team-logo i {
    font-size: 1.5rem;
    color: #2FD35D;
}

.vs {
    color: #2FD35D;
    font-weight: 600;
}

.match-info {
    text-align: right;
}

.match-time {
    display: block;
    font-size: 1.2rem;
    color: #2FD35D;
}

/* Betting Grid */
.betting-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.bet-card {
    background: rgba(21, 25, 40, 0.95);
    border: 1px solid rgba(47, 211, 93, 0.2);
    border-radius: 10px;
    padding: 1rem;
}

.bet-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.league-name {
    color: #2FD35D;
    font-weight: 500;
}

.bet-type {
    color: rgba(255, 255, 255, 0.6);
}

.bet-teams {
    text-align: center;
    margin-bottom: 1rem;
}

.bet-odds {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.5rem;
}

.odd-item {
    background: rgba(47, 211, 93, 0.1);
    border-radius: 5px;
    padding: 0.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.odd-item:hover {
    background: rgba(47, 211, 93, 0.2);
}

.odd-value {
    display: block;
    color: #2FD35D;
    font-weight: 600;
}

.odd-label {
    display: block;
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.6);
}

/* Betting Slip */
.betting-slip {
    position: fixed;
    right: 0;
    bottom: 0;
    width: 300px;
    background: rgba(13, 17, 23, 0.95);
    border-top: 2px solid #2FD35D;
}

.slip-header {
    padding: 1rem;
    background: rgba(47, 211, 93, 0.1);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.slip-header i {
    color: #2FD35D;
}

.slip-content {
    padding: 1rem;
    max-height: 400px;
    overflow-y: auto;
}

.sidebar .league-item {
    color: #fff;
    background: transparent;
    padding: 12px 28px;
    border-radius: 12px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    font-size: 1.08rem;
    transition: background 0.2s;
    text-decoration: none !important;
}
.sidebar .league-item.active, .sidebar .league-item:hover {
    background: #3a4a6a;
    color: #2FD35D !important;
    text-decoration: none !important;
}

/* Responsive */
@media (max-width: 768px) {
    .betting-grid {
        grid-template-columns: 1fr;
    }

    .betting-slip {
        width: 100%;
        height: auto;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aquí irá la lógica de las apuestas
});
</script>
@endsection
