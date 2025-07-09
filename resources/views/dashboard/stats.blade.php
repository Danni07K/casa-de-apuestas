@extends('layouts.app')

@section('title', 'Estadísticas')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<style>
    .stat-card {
        background: linear-gradient(135deg, #1e293b 60%, #2fd35d 100%);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        border: 1px solid rgba(255,255,255,0.08);
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 16px 40px 0 rgba(47, 211, 93, 0.25);
    }
    .chart-container {
        background: rgba(30,41,59,0.85);
        border-radius: 1.5rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 24px 0 rgba(47, 211, 93, 0.08);
    }
    .kpi-label {
        color: #2fd35d;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .kpi-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #fff;
        text-shadow: 0 2px 12px #2fd35d33;
    }
    .kpi-desc {
        color: #cbd5e1;
        font-size: 1rem;
    }
</style>
@endsection

@section('content')
<div class="relative w-full min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
      <div class="pt-44 md:pt-56" style="position:relative; z-index:20;">
        <div class="text-center mb-10" data-aos="fade-down">
          <h1 class="text-5xl font-extrabold text-white mb-2 tracking-tight drop-shadow-lg" style="margin-top:-2.5rem; position:relative; z-index:30;">Estadísticas Ultra Pro</h1>
          <p class="text-blue-200 text-lg">Tu rendimiento, evolución y logros al nivel de las mejores casas de apuestas</p>
        </div>
      </div>
            <!-- KPIs Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="stat-card p-8 text-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="kpi-label mb-2">Apuestas Totales</div>
                    <div class="kpi-value">{{ number_format($monthlyStats->sum('total_bets')) }}</div>
                    <div class="kpi-desc">Últimos 6 meses</div>
                </div>
                <div class="stat-card p-8 text-center" data-aos="zoom-in" data-aos-delay="200">
                    <div class="kpi-label mb-2">Victorias</div>
                    <div class="kpi-value">{{ number_format($monthlyStats->sum('won_bets')) }}</div>
                    <div class="kpi-desc">Apuestas ganadas</div>
                </div>
                <div class="stat-card p-8 text-center" data-aos="zoom-in" data-aos-delay="300">
                    <div class="kpi-label mb-2">Total Apostado</div>
                    <div class="kpi-value">PEN {{ number_format($monthlyStats->sum('total_wagered'), 2) }}</div>
                    <div class="kpi-desc">Monto jugado</div>
                </div>
                <div class="stat-card p-8 text-center" data-aos="zoom-in" data-aos-delay="400">
                    <div class="kpi-label mb-2">Win Rate</div>
                    <div class="kpi-value">{{ $monthlyStats->sum('total_bets') > 0 ? number_format(($monthlyStats->sum('won_bets') / $monthlyStats->sum('total_bets')) * 100, 1) : 0 }}%</div>
                    <div class="kpi-desc">Efectividad</div>
                </div>
            </div>
            <!-- Gráficos avanzados -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="chart-container" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold text-white mb-4">Rendimiento Mensual</h3>
                    <canvas id="betsLineChart" height="120"></canvas>
                </div>
                <div class="chart-container" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold text-white mb-4">Win Rate por Mes</h3>
                    <canvas id="winRateBarChart" height="120"></canvas>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="chart-container" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold text-white mb-4">Distribución por Tipo de Apuesta</h3>
                    <canvas id="betTypePieChart" height="120"></canvas>
                </div>
                <div class="chart-container" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold text-white mb-4">Ganancias y Pérdidas</h3>
                    <canvas id="profitLossChart" height="120"></canvas>
                </div>
            </div>
            <!-- Ranking y detalles -->
            <div class="stat-card flex flex-col items-center justify-center p-8 mb-12" data-aos="zoom-in" data-aos-delay="500">
              <div class="flex flex-col items-center mb-6">
                <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-tr from-yellow-400 to-yellow-200 shadow-lg mb-2"><i class="fas fa-crown text-3xl text-white"></i></span>
                <span class="text-5xl font-extrabold text-green-400">#1</span>
                <span class="text-lg text-blue-200 font-semibold mt-2">Ranking Personal</span>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-6">
                <div class="flex flex-col items-center">
                  <i class="fas fa-chart-line text-2xl text-green-400 mb-1"></i>
                  <span class="text-sm text-blue-200">Promedio apuestas/mes</span>
                  <span class="text-xl font-bold text-white">{{ number_format($monthlyStats->avg('total_bets'), 1) }}</span>
                </div>
                <div class="flex flex-col items-center">
                  <i class="fas fa-dice text-2xl text-yellow-400 mb-1"></i>
                  <span class="text-sm text-blue-200">Tipo favorito</span>
                  <span class="text-xl font-bold text-white">{{ $betTypeStats->sortByDesc('win_rate')->first()->bet_type ?? 'N/A' }}</span>
                </div>
                <div class="flex flex-col items-center">
                  <i class="fas fa-fire text-2xl text-purple-400 mb-1"></i>
                  <span class="text-sm text-blue-200">Mejor racha</span>
                  <span class="text-xl font-bold text-white">{{ $monthlyStats->max('won_bets') }} victorias</span>
                </div>
              </div>
              <div class="text-center text-blue-100 text-base font-medium">¡Estás en el top de tu liga! Sigue apostando para mantener tu posición.</div>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
// Datos para los gráficos
const months = @json($monthlyStats->pluck('month'));
const totalBets = @json($monthlyStats->pluck('total_bets'));
const wonBets = @json($monthlyStats->pluck('won_bets'));
const winRates = @json($monthlyStats->map(fn($m) => $m['total_bets'] > 0 ? round(($m['won_bets'] / $m['total_bets']) * 100, 1) : 0));
const betTypeLabels = @json($betTypeStats->pluck('bet_type'));
const betTypeTotals = @json($betTypeStats->pluck('total'));
const profitLossLabels = @json(array_column($profitLoss, 'date'));
const profitLossData = @json(array_column($profitLoss, 'profit_loss'));

// Gráfico de línea: Apuestas totales y ganadas por mes
new Chart(document.getElementById('betsLineChart'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Apuestas Totales',
                data: totalBets,
                borderColor: '#2fd35d',
                backgroundColor: 'rgba(47,211,93,0.15)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#2fd35d',
            },
            {
                label: 'Ganadas',
                data: wonBets,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.15)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#6366f1',
            }
        ]
    },
    options: {
        plugins: {
            legend: { labels: { color: '#fff', font: { weight: 'bold' } } }
        },
        scales: {
            x: { ticks: { color: '#cbd5e1' } },
            y: { ticks: { color: '#cbd5e1' } }
        }
    }
});
// Gráfico de barras: Win Rate por mes
new Chart(document.getElementById('winRateBarChart'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Win Rate (%)',
            data: winRates,
            backgroundColor: '#2fd35d',
            borderRadius: 8,
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
        },
        scales: {
            x: { ticks: { color: '#cbd5e1' } },
            y: { ticks: { color: '#cbd5e1' } }
        }
    }
});
// Gráfico de pastel: Distribución por tipo de apuesta
new Chart(document.getElementById('betTypePieChart'), {
    type: 'pie',
    data: {
        labels: betTypeLabels,
        datasets: [{
            data: betTypeTotals,
            backgroundColor: ['#2fd35d','#6366f1','#facc15','#f43f5e','#06b6d4','#a21caf'],
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: '#fff', font: { weight: 'bold' } } }
        }
    }
});
// Gráfico de línea: Ganancias y pérdidas acumuladas
new Chart(document.getElementById('profitLossChart'), {
    type: 'line',
    data: {
        labels: profitLossLabels,
        datasets: [{
            label: 'Profit/Loss',
            data: profitLossData,
            borderColor: '#facc15',
            backgroundColor: 'rgba(250,204,21,0.15)',
            tension: 0.4,
            fill: true,
            pointRadius: 4,
            pointBackgroundColor: '#facc15',
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: '#fff', font: { weight: 'bold' } } }
        },
        scales: {
            x: { ticks: { color: '#cbd5e1' } },
            y: { ticks: { color: '#cbd5e1' } }
        }
    }
});
</script>
@endsection
