@extends('layouts.app')

@section('title', 'Clasificación')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Clasificación Global</h1>
                <p class="text-blue-200">Los mejores apostadores de TecBet</p>
            </div>

            <!-- Current User Position -->
            @php
                $currentUserPosition = collect($leaderboard)->search(function($item) {
                    return $item['user']->id === auth()->id();
                });
            @endphp

            @if($currentUserPosition !== false)
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl p-6 mb-8 border border-yellow-400/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <span class="text-yellow-600 font-bold text-lg">#{{ $currentUserPosition + 1 }}</span>
                        </div>
                        <div>
                            <div class="text-white font-bold text-lg">{{ auth()->user()->name }}</div>
                            <div class="text-yellow-100 text-sm">Tu posición actual</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-white font-bold text-lg">Nivel {{ $leaderboard[$currentUserPosition]['level'] }}</div>
                        <div class="text-yellow-100 text-sm">{{ number_format($leaderboard[$currentUserPosition]['experience']) }} XP</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Leaderboard -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                <div class="space-y-4">
                    @foreach($leaderboard as $index => $player)
                    <div class="leaderboard-item bg-white/5 rounded-xl p-4 border border-white/10 transition-all duration-300 hover:bg-white/10 {{ $player['user']->id === auth()->id() ? 'ring-2 ring-yellow-400' : '' }}">
                        <div class="flex items-center justify-between">
                            <!-- Position and User Info -->
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 {{ $index === 0 ? 'bg-yellow-500' : ($index === 1 ? 'bg-gray-400' : ($index === 2 ? 'bg-orange-600' : 'bg-blue-500')) }}">
                                    @if($index < 3)
                                        <i class="fas fa-trophy text-white text-lg"></i>
                                    @else
                                        <span class="text-white font-bold">#{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-white font-semibold">{{ $player['user']->name }}</div>
                                    <div class="text-blue-200 text-sm">
                                        @if($index < 3)
                                            @switch($index)
                                                @case(0)
                                                    🥇 Campeón
                                                    @break
                                                @case(1)
                                                    🥈 Subcampeón
                                                    @break
                                                @case(2)
                                                    🥉 Tercer Lugar
                                                    @break
                                            @endswitch
                                        @else
                                            Nivel {{ $player['level'] }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center space-x-6">
                                <div class="text-center">
                                    <div class="text-white font-bold">{{ number_format($player['experience']) }}</div>
                                    <div class="text-blue-200 text-xs">XP</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-white font-bold">{{ number_format($player['win_rate'], 1) }}%</div>
                                    <div class="text-blue-200 text-xs">Win Rate</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-white font-bold">{{ $player['level'] }}</div>
                                    <div class="text-blue-200 text-xs">Nivel</div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mt-3">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="text-blue-200">Progreso al siguiente nivel</span>
                                <span class="text-blue-200">
                                    @php
                                        $currentLevel = $player['level'];
                                        $currentXP = $player['experience'];
                                        $nextLevelXP = $currentLevel * 1000; // XP requerida para el siguiente nivel
                                        $progress = min(100, ($currentXP / $nextLevelXP) * 100);
                                    @endphp
                                    {{ number_format($progress, 1) }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-600 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-crown text-white"></i>
                    </div>
                    <div class="text-2xl font-bold text-white mb-2">{{ $leaderboard[0]['user']->name ?? 'N/A' }}</div>
                    <div class="text-blue-200 text-sm">Líder Actual</div>
                </div>

                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <div class="text-2xl font-bold text-white mb-2">{{ number_format($leaderboard[0]['experience'] ?? 0) }}</div>
                    <div class="text-blue-200 text-sm">XP Máximo</div>
                </div>

                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div class="text-2xl font-bold text-white mb-2">{{ count($leaderboard) }}</div>
                    <div class="text-blue-200 text-sm">Jugadores Activos</div>
                </div>
            </div>

            <!-- Rewards Info -->
            <div class="mt-8 bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                <h3 class="text-xl font-bold text-white mb-4 text-center">Recompensas por Posición</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-yellow-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-trophy text-white text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">🥇 1er Lugar</h4>
                        <p class="text-blue-200 text-sm">+500 XP • Badge Especial • Cashback 10%</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-gray-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-medal text-white text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">🥈 2do Lugar</h4>
                        <p class="text-blue-200 text-sm">+300 XP • Badge Plata • Cashback 7%</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-3 bg-orange-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-award text-white text-xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">🥉 3er Lugar</h4>
                        <p class="text-blue-200 text-sm">+200 XP • Badge Bronce • Cashback 5%</p>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('dashboard.index') }}"
                   class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-full transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
