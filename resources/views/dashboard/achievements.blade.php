@extends('layouts.app')

@section('title', 'Logros')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Logros y Recompensas</h1>
                <p class="text-blue-200">Desbloquea logros para ganar experiencia y recompensas</p>
            </div>

            <!-- Progress Overview -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 mb-8 border border-white/20">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">{{ auth()->user()->achievements()->count() }}</div>
                        <div class="text-blue-200 text-sm">Logros Desbloqueados</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">{{ $achievements->count() }}</div>
                        <div class="text-blue-200 text-sm">Total de Logros</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-400">{{ auth()->user()->userLevel->experience_points ?? 0 }}</div>
                        <div class="text-blue-200 text-sm">Puntos de Experiencia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-400">{{ auth()->user()->userLevel->level ?? 1 }}</div>
                        <div class="text-blue-200 text-sm">Nivel Actual</div>
                    </div>
                </div>
            </div>

            <!-- Achievements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($achievements as $achievement)
                <div class="achievement-card bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 transition-all duration-300 hover:scale-105 {{ $achievement->users->count() > 0 ? 'ring-2 ring-yellow-400' : '' }}">
                    <!-- Achievement Icon -->
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full flex items-center justify-center {{ $achievement->users->count() > 0 ? 'bg-yellow-500' : 'bg-gray-600' }}">
                            <i class="fas {{ $achievement->icon }} text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">{{ $achievement->name }}</h3>
                    </div>

                    <!-- Achievement Description -->
                    <div class="text-center mb-4">
                        <p class="text-blue-200 text-sm">{{ $achievement->description }}</p>
                    </div>

                    <!-- Achievement Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-green-400">{{ $achievement->points_reward }}</div>
                            <div class="text-blue-200 text-xs">XP</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-purple-400">{{ $achievement->users->count() }}</div>
                            <div class="text-blue-200 text-xs">Usuarios</div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    @if($achievement->users->count() > 0)
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-green-400">Desbloqueado</span>
                            <span class="text-blue-200">{{ $achievement->pivot->unlocked_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="w-full bg-gray-600 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                    @else
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-gray-400">Progreso</span>
                            <span class="text-blue-200">0%</span>
                        </div>
                        <div class="w-full bg-gray-600 rounded-full h-2">
                            <div class="bg-gray-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    @endif

                    <!-- Requirements -->
                    <div class="text-center">
                        <div class="text-xs text-blue-200 mb-2">Requisitos:</div>
                        <div class="text-xs text-gray-300">
                            @switch($achievement->type)
                                @case('bets_count')
                                    {{ $achievement->requirement_value }} apuestas realizadas
                                    @break
                                @case('win_streak')
                                    Racha de {{ $achievement->requirement_value }} victorias
                                    @break
                                @case('total_wagered')
                                    PEN {{ number_format($achievement->requirement_value, 2) }} apostados
                                    @break
                                @case('win_rate')
                                    {{ $achievement->requirement_value }}% de tasa de victoria
                                    @break
                                @case('parlay_wins')
                                    {{ $achievement->requirement_value }} parlays ganados
                                    @break
                                @default
                                    {{ $achievement->requirement_value }}
                            @endswitch
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="text-center mt-4">
                        @if($achievement->users->count() > 0)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Desbloqueado
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-lock mr-1"></i>Bloqueado
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Achievement Categories -->
            <div class="mt-12 bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                <h3 class="text-2xl font-bold text-white mb-6 text-center">Categorías de Logros</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-dice text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Apuestas</h4>
                        <p class="text-blue-200 text-sm">Logros por cantidad y calidad de apuestas</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-trophy text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Victorias</h4>
                        <p class="text-blue-200 text-sm">Logros por rachas y tasas de victoria</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Especiales</h4>
                        <p class="text-blue-200 text-sm">Logros únicos y eventos especiales</p>
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
