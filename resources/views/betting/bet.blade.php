@extends('layouts.app')

@section('content')
<style>
    body {
        background: #181c23 !important;
    }
    .main-bg {
        background: linear-gradient(135deg, #26304a 0%, #2a3b5a 100%);
        border-radius: 18px;
        box-shadow: 0 4px 24px 0 rgba(0,0,0,0.2);
        padding: 0;
    }
    .sidebar {
        background: #232733;
        border-radius: 18px;
        padding: 24px 0 24px 0;
        min-height: 700px;
    }
    .sidebar .menu-ti   tle {
        color: #fff;
        font-weight: bold;
        margin-bottom: 18px;
        font-size: 1.1rem;
        padding-left: 24px;
    }
    .sidebar .league-item {
        color: #bfc9da;
        padding: 10px 24px;
        border-radius: 8px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .sidebar .league-item.active, .sidebar .league-item:hover {
        background: #2fd35d33;
        color: #fff;
    }
    .scoreboard {
        background: linear-gradient(90deg, #26304a 60%, #2a3b5a 100%);
        border-radius: 18px;
        padding: 24px 0 12px 0;
        margin-bottom: 18px;
        color: #fff;
        text-align: center;
        position: relative;
    }
    .scoreboard .team-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
        background: #232733;
        border-radius: 50%;
        border: 2px solid #2fd35d;
        margin-bottom: 8px;
    }
    .scoreboard .score {
        font-size: 2.8rem;
        font-weight: bold;
        margin: 0 18px;
    }
    .scoreboard .vs {
        font-size: 1.2rem;
        color: #bfc9da;
        margin: 0 10px;
    }
    .scoreboard .match-date {
        background: #232733;
        color: #bfc9da;
        border-radius: 8px;
        padding: 4px 16px;
        font-size: 0.95rem;
        margin-bottom: 10px;
        display: inline-block;
    }
    .bet-section {
        background: linear-gradient(135deg, #26304a 0%, #2a3b5a 100%);
        border-radius: 18px;
        margin-bottom: 18px;
        padding: 18px 18px 10px 18px;
        color: #fff;
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.08);
    }
    .bet-section .fw-bold {
        color: #2fd35d;
    }
    .bet-section .bet-helper-text {
        color: #fff !important;
        font-weight: 400;
    }
    .bet-section .btn-group .btn {
        min-width: 120px;
        font-size: 1.1rem;
        border-radius: 18px !important;
        margin-right: 12px;
        margin-bottom: 6px;
        background: #3a4a6a;
        color: #fff;
        border: none;
        font-weight: 500;
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
        transition: background 0.2s, color 0.2s;
    }
    .bet-section .btn-group .btn.active, .bet-section .btn-group .btn:active, .bet-section .btn-group .btn:focus, .bet-section .btn-group .btn:hover {
        background: #2fd35d;
        color: #232733;
    }
    .bet-section .btn-group .btn:last-child {
        margin-right: 0;
    }
    .bet-section input[type="number"] {
        background: #232733;
        color: #fff;
        border: 1px solid #2fd35d;
        border-radius: 8px;
        width: 120px;
        font-size: 1.1rem;
        margin-left: 10px;
    }
    .bet-section .btn-success {
        background: #2fd35d;
        border: none;
        border-radius: 18px;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 8px 32px;
        margin: 0 auto;
        display: block;
        margin-top: 12px;
    }
    .bet-section .btn-success:disabled {
        background: #bfc9da;
        color: #232733;
    }
    .live-panel {
        background: #232733;
        border-radius: 18px;
        padding: 18px;
        color: #fff;
        margin-bottom: 18px;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .live-panel .live-icon {
        font-size: 2.5rem;
        color: #2fd35d;
        margin-bottom: 10px;
    }
    .bets-panel {
        background: #232733;
        border-radius: 18px;
        padding: 18px;
        color: #fff;
        min-height: 180px;
    }
    @media (max-width: 991px) {
        .sidebar { min-height: auto; }
    }
</style>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <!-- Sidebar -->
        <div class="col-lg-2 col-md-3 mb-3">
            <div class="sidebar">
                <div class="menu-title">LIGAS PRINCIPALES</div>
                <div class="league-item active">⚽ Liga 1</div>
                <div class="league-item">🇪🇸 La Liga</div>
                <div class="league-item">🇮🇹 Serie A</div>
                <div class="league-item">🇩🇪 Bundesliga</div>
                <div class="league-item">🏆 Copa de Francia</div>
                <div class="league-item">🏴 Premier League</div>
                <div class="league-item">⭐ Champions</div>
                <div class="league-item">🏅 Europa League</div>
                <div class="league-item">🇺🇸 MLS</div>
                <div class="league-item">🇦🇷 Liga Profesional</div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-lg-7 col-md-9 mb-3">
            <div class="main-bg p-4">
                <!-- Scoreboard -->
                <div class="scoreboard d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
                    <div class="text-center flex-fill">
                        <img src="/images/player-left.png" class="team-logo mb-2" alt="local">
                        <div class="fw-bold">{{ $event->home_team }}</div>
                    </div>
                    <div class="d-flex flex-column align-items-center flex-fill">
                        <div class="match-date mb-2">{{ $event->start_time->format('l d \d\e F h:i a') }}</div>
                        <div class="d-flex align-items-center">
                            <span class="score">0</span>
                            <span class="vs">-</span>
                            <span class="score">0</span>
                        </div>
                    </div>
                    <div class="text-center flex-fill">
                        <img src="/images/players-right.png" class="team-logo mb-2" alt="visitante">
                        <div class="fw-bold">{{ $event->away_team }}</div>
                    </div>
                </div>
                <!-- 1x2 -->
                <div class="bet-section mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">1x2</span>
                        <span class="bet-helper-text">Elige el ganador</span>
                    </div>
                    <form method="POST" action="{{ route('betting.placeBet', $event) }}" id="form1x2">
                        @csrf
                        <input type="hidden" name="bet_type" value="1x2">
                        <div class="d-flex flex-wrap justify-content-center align-items-center mb-3 gap-3">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="selection" id="home1x2" value="{{ $event->home_team }}" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="home1x2">{{ $event->home_team }}<br><span class="small">{{ number_format($event->home_odds,2) }}</span></label>
                                <input type="radio" class="btn-check" name="selection" id="draw1x2" value="EMPATE" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="draw1x2">Empate<br><span class="small">{{ number_format($event->draw_odds,2) }}</span></label>
                                <input type="radio" class="btn-check" name="selection" id="away1x2" value="{{ $event->away_team }}" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="away1x2">{{ $event->away_team }}<br><span class="small">{{ number_format($event->away_odds,2) }}</span></label>
                            </div>
                            <input type="number" name="amount" class="form-control ms-3" placeholder="Monto" min="1" step="0.01" id="amount1x2" required style="max-width:120px;">
                        </div>
                        <input type="hidden" name="odds" id="odds1x2" value="">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2" id="btnApostar1x2" disabled style="font-size:1.1rem;">realizar apuesta</button>
                        </div>
                        <div class="col-12">
                            <div id="error1x2" class="text-danger mt-2" style="display:none;">Selecciona una opción y un monto válido.</div>
                        </div>
                    </form>
                </div>
                <!-- Primer Gol -->
                <div class="bet-section mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Primer GOL</span>
                        <span class="bet-helper-text">¿Quién marca primero?</span>
                    </div>
                    <form method="POST" action="{{ route('betting.placeBet', $event) }}">
                        @csrf
                        <input type="hidden" name="bet_type" value="primer_gol">
                        <div class="d-flex flex-wrap justify-content-center align-items-center mb-3 gap-3">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="selection" id="home_gol" value="{{ $event->home_team }}" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="home_gol">{{ $event->home_team }}</label>
                                <input type="radio" class="btn-check" name="selection" id="away_gol" value="{{ $event->away_team }}" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="away_gol">{{ $event->away_team }}</label>
                            </div>
                            <input type="number" name="amount" class="form-control ms-3" placeholder="Monto" min="1" step="0.01" required style="max-width:120px;">
                        </div>
                        <input type="hidden" name="odds" value="2.50">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2" style="font-size:1.1rem;">realizar apuesta</button>
                        </div>
                    </form>
                </div>
                <!-- Ambos Marcan -->
                <div class="bet-section mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Ambos equipos Marcan</span>
                        <span class="bet-helper-text">¿Marcan ambos?</span>
                    </div>
                    <form method="POST" action="{{ route('betting.placeBet', $event) }}">
                        @csrf
                        <input type="hidden" name="bet_type" value="ambos_marcan">
                        <div class="d-flex flex-wrap justify-content-center align-items-center mb-3 gap-3">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="selection" id="si" value="SI" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="si">SI</label>
                                <input type="radio" class="btn-check" name="selection" id="no" value="NO" autocomplete="off" required>
                                <label class="btn btn-outline-success" for="no">NO</label>
                            </div>
                            <input type="number" name="amount" class="form-control ms-3" placeholder="Monto" min="1" step="0.01" required style="max-width:120px;">
                        </div>
                        <input type="hidden" name="odds" value="1.80">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2" style="font-size:1.1rem;">realizar apuesta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="col-lg-3 col-md-12 mb-3">
            <div class="live-panel mb-3">
                <div class="live-icon">📺</div>
                <div class="fw-bold mb-2">Partido en vivo</div>
                <img src="/images/banner.png" alt="Partido en vivo" style="width:100%; border-radius:12px;">
            </div>
            <div class="bets-panel">
                <div class="fw-bold mb-2">Apuestas Realizadas:</div>
                <div class="text-muted">(Aquí aparecerán tus apuestas recientes)</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// 1x2
const radios1x2 = document.querySelectorAll('#form1x2 input[name="selection"]');
const oddsInput = document.getElementById('odds1x2');
const btnApostar1x2 = document.getElementById('btnApostar1x2');
const amountInput1x2 = document.getElementById('amount1x2');
const error1x2 = document.getElementById('error1x2');
function updateOddsAndButton1x2() {
    let selected = false;
    radios1x2.forEach(radio => {
        if(radio.checked) selected = true;
    });
    if(document.getElementById('home1x2').checked) oddsInput.value = {{ $event->home_odds }};
    else if(document.getElementById('draw1x2').checked) oddsInput.value = {{ $event->draw_odds }};
    else if(document.getElementById('away1x2').checked) oddsInput.value = {{ $event->away_odds }};
    else oddsInput.value = '';
    const valid = selected && amountInput1x2.value && parseFloat(amountInput1x2.value) > 0;
    btnApostar1x2.disabled = !valid;
    error1x2.style.display = valid ? 'none' : 'block';
}
radios1x2.forEach(radio => radio.addEventListener('change', updateOddsAndButton1x2));
amountInput1x2.addEventListener('input', updateOddsAndButton1x2);
updateOddsAndButton1x2();

document.getElementById('form1x2').addEventListener('submit', function(e) {
    // Forzar el valor de odds según la selección
    if(document.getElementById('home1x2').checked) oddsInput.value = {{ $event->home_odds }};
    else if(document.getElementById('draw1x2').checked) oddsInput.value = {{ $event->draw_odds }};
    else if(document.getElementById('away1x2').checked) oddsInput.value = {{ $event->away_odds }};
});
</script>
@endsection 