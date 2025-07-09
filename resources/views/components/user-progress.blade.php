@php
    $user = auth()->user();
    $userLevel = $user->userLevel;
    $userVip = $user->userVip;
@endphp

<div class="user-progress-container">
    @if($userLevel)
        <div class="level-info">
            <div class="level-badge" style="background: linear-gradient(45deg, #2FD35D, #28b850);">
                <span class="level-number">{{ $userLevel->level }}</span>
            </div>
            <div class="level-details">
                <div class="level-text">Nivel {{ $userLevel->level }}</div>
                <div class="xp-bar">
                    @php
                        $requiredExp = 100 * pow($userLevel->level, 1.5);
                        $progress = ($userLevel->experience_points / $requiredExp) * 100;
                    @endphp
                    <div class="xp-progress" style="width: {{ $progress }}%"></div>
                </div>
                <small class="xp-text">{{ $userLevel->experience_points }}/{{ (int)$requiredExp }} XP</small>
            </div>
        </div>
    @endif

    @if($userVip)
        <div class="vip-info">
            <div class="vip-badge" style="background: {{ $userVip->vipLevel->badge_color }};">
                <i class="fas fa-crown"></i>
            </div>
            <div class="vip-details">
                <div class="vip-text">{{ $userVip->vipLevel->name }}</div>
                <small class="vip-cashback">{{ $userVip->vipLevel->cashback_percentage }}% Cashback</small>
            </div>
        </div>
    @endif

    <div class="stats-info">
        <div class="stat-item">
            <i class="fas fa-trophy text-warning"></i>
            <span>{{ $user->getWinRate() }}%</span>
        </div>
        <div class="stat-item">
            <i class="fas fa-fire text-danger"></i>
            <span>{{ $user->getWinningStreak() }}</span>
        </div>
    </div>
</div>

<style>
.user-progress-container {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 8px 15px;
    background: rgba(47, 211, 93, 0.1);
    border-radius: 25px;
    border: 1px solid rgba(47, 211, 93, 0.2);
}

.level-info, .vip-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.level-badge, .vip-badge {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.vip-badge {
    background: linear-gradient(45deg, #FFD700, #FFA500) !important;
}

.level-details, .vip-details {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.level-text, .vip-text {
    font-size: 12px;
    font-weight: 600;
    color: #2FD35D;
}

.xp-text, .vip-cashback {
    font-size: 10px;
    color: rgba(255,255,255,0.7);
}

.xp-bar {
    width: 60px;
    height: 4px;
    background: rgba(255,255,255,0.2);
    border-radius: 2px;
    overflow: hidden;
}

.xp-progress {
    height: 100%;
    background: linear-gradient(90deg, #2FD35D, #28b850);
    border-radius: 2px;
    transition: width 0.3s ease;
}

.stats-info {
    display: flex;
    gap: 10px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .user-progress-container {
        flex-direction: column;
        gap: 10px;
        padding: 10px;
    }

    .stats-info {
        justify-content: center;
    }
}
</style>
