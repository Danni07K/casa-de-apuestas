@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background: radial-gradient(circle at 50% 20%, #232b47 60%, #0d1117 100%); min-height: 100vh;">
    <div class="row justify-content-center pt-4">
        <div class="col-lg-10">
            <div class="mb-4">
                <h4 class="text-light">Consulta tickets</h4>
            </div>
            <div class="card bg-transparent border-0 mb-4" style="box-shadow:none;">
                <div class="card-header border-0 pb-0 bg-transparent" style="border-bottom:2px solid #bfa46b;">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button class="tab-top btn btn-dark active" id="tab-top-apuestas" onclick="showTopTab('apuestas')">Consulta de apuestas deportivas</button>
                        <button class="tab-top btn btn-dark" id="tab-top-informes" onclick="showTopTab('informes')">Informes de otras apuestas</button>
                        <button class="tab-top btn btn-dark" id="tab-top-depositos" onclick="showTopTab('depositos')">Consultar depósitos</button>
                        <button class="tab-top btn btn-dark" id="tab-top-retiros" onclick="showTopTab('retiros')">Consultar retiros</button>
                    </div>
                </div>
                <div class="card-body" style="background: transparent;">
                    <div id="panel-top-apuestas">
                        <div class="card bg-dark text-light mb-4" style="border-radius:18px;">
                            <div class="card-header border-0 pb-0 bg-transparent">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-light active" id="tab-abierto" onclick="showTab('abierto')">Abierto</button>
                                    <button class="btn btn-sm btn-outline-light" id="tab-resuelto" onclick="showTab('resuelto')">Resuelto</button>
                                    <div class="ms-auto d-flex gap-2">
                                        <input type="date" class="form-control form-control-sm" id="from" value="{{ $from }}" placeholder="Desde">
                                        <input type="date" class="form-control form-control-sm" id="to" value="{{ $to }}" placeholder="Hasta">
                                        <button class="btn btn-sm btn-success" onclick="filtrarFechas()">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="background: transparent;">
                                <div id="panel-abierto">
                                    @if($openBets->count())
                                        <ul class="list-unstyled">
                                            @foreach($openBets as $bet)
                                                <li class="mb-3 p-3 rounded" style="background:rgba(47,211,93,0.05); color:#fff;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <b>{{ $bet->event->home_team }} vs {{ $bet->event->away_team }}</b>
                                                            <span class="badge bg-primary ms-2">{{ strtoupper($bet->bet_type) }}</span>
                                                        </div>
                                                        <span class="small">{{ $bet->created_at->format('d/m/Y H:i') }}</span>
                                                    </div>
                                                    <div class="small">Selección: <b>{{ $bet->selection }}</b> | Monto: PEN {{ number_format($bet->amount,2) }} | Cuota: {{ number_format($bet->odds,2) }}</div>
                                                    <div class="small mt-1">Estado: 
                                                        @if($bet->status === 'pending') <span class="badge bg-warning text-dark">Pendiente</span>
                                                        @elseif($bet->status === 'cashed_out') <span class="badge bg-info text-dark">Cashout</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="text-center text-muted py-4">No tienes tickets abiertos</div>
                                    @endif
                                </div>
                                <div id="panel-resuelto" style="display:none;">
                                    @if($resolvedBets->count())
                                        <ul class="list-unstyled">
                                            @foreach($resolvedBets as $bet)
                                                <li class="mb-3 p-3 rounded" style="background:rgba(47,211,93,0.05); color:#fff;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <b>{{ $bet->event->home_team }} vs {{ $bet->event->away_team }}</b>
                                                            <span class="badge bg-primary ms-2">{{ strtoupper($bet->bet_type) }}</span>
                                                        </div>
                                                        <span class="small">{{ $bet->created_at->format('d/m/Y H:i') }}</span>
                                                    </div>
                                                    <div class="mt-1" style="font-size:1em;">
                                                        <b>Resultado del evento:</b>
                                                        @if($bet->event->result)
                                                            @if($bet->event->result === 'local')
                                                                Ganador: {{ $bet->event->home_team }}
                                                            @elseif($bet->event->result === 'visitante')
                                                                Ganador: {{ $bet->event->away_team }}
                                                            @elseif($bet->event->result === 'empate')
                                                                Empate
                                                            @endif
                                                        @endif
                                                        @if($bet->event->first_goal)
                                                            | Primer Gol: {{ $bet->event->first_goal }}
                                                        @endif
                                                        @if($bet->event->both_score)
                                                            | Ambos Marcan: {{ $bet->event->both_score }}
                                                        @endif
                                                    </div>
                                                    <div class="small">Selección: <b>{{ $bet->selection }}</b> | Monto: PEN {{ number_format($bet->amount,2) }} | Cuota: {{ number_format($bet->odds,2) }}</div>
                                                    <div class="small mt-1">Estado: 
                                                        @if($bet->status === 'won') <span class="badge bg-success">Ganada</span>
                                                        @elseif($bet->status === 'lost') <span class="badge bg-danger">Perdida</span>
                                                        @elseif($bet->status === 'cancelled') <span class="badge bg-secondary">Cancelada</span>
                                                        @elseif($bet->status === 'cashed_out') <span class="badge bg-info text-dark">Cashout</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="text-center text-muted py-4">No tienes tickets resueltos</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel-top-informes" style="display:none;">
                        <div class="text-center text-muted py-5">Próximamente: informes de otras apuestas</div>
                    </div>
                    <div id="panel-top-depositos" style="display:none;">
                        <div class="text-center text-muted py-5">Próximamente: consulta de depósitos</div>
                    </div>
                    <div id="panel-top-retiros" style="display:none;">
                        <div class="text-center text-muted py-5">Próximamente: consulta de retiros</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <img src="/img/historial-banner.png" alt="banner" class="img-fluid rounded" style="max-width: 500px;">
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.tab-top.active, .tab-top:active, .tab-top:focus {
    background: #bfa46b !important;
    color: #232b47 !important;
    border: none;
}
.tab-top {
    border-radius: 10px 10px 0 0;
    margin-right: 6px;
    background: #181c2f;
    color: #fff;
    border: none;
    font-weight: 500;
}
</style>
@endsection

@section('scripts')
<script>
function showTab(tab) {
    document.getElementById('panel-abierto').style.display = tab === 'abierto' ? '' : 'none';
    document.getElementById('panel-resuelto').style.display = tab === 'resuelto' ? '' : 'none';
    document.getElementById('tab-abierto').classList.toggle('active', tab === 'abierto');
    document.getElementById('tab-resuelto').classList.toggle('active', tab === 'resuelto');
}
function filtrarFechas() {
    const from = document.getElementById('from').value;
    const to = document.getElementById('to').value;
    let url = new URL(window.location.href);
    url.searchParams.set('from', from);
    url.searchParams.set('to', to);
    window.location.href = url.toString();
}
function showTopTab(tab) {
    ['apuestas','informes','depositos','retiros'].forEach(function(t) {
        document.getElementById('panel-top-' + t).style.display = (t === tab) ? '' : 'none';
        document.getElementById('tab-top-' + t).classList.toggle('active', t === tab);
    });
    if(tab === 'apuestas') {
        showTab('abierto');
    }
}
showTopTab('apuestas');
</script>
@endsection 