<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <span class="logo-text">
                <span class="tec">Tec</span><span class="bet">Bet</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if(auth()->check())
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('betting.index') ? 'active' : '' }}" href="{{ route('betting.index') }}">Apuestas Deportivas</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center ms-auto gap-3">
                    <div class="user-wallet">
                        <div class="dropdown">
                            <a href="#" class="user-avatar" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user"></i> Mi Perfil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('betting.history') }}">
                                        <i class="fas fa-history"></i> Mis Apuestas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" id="notification-bell">
                                        <i class="fas fa-bell"></i> Notificaciones
                                        <span id="notification-dot" style="display:none;position:absolute;top:15px;right:15px;width:8px;height:8px;background:#bfa46b;border-radius:50%;"></span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chart-line"></i> Estadísticas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.wallet') }}">
                                        <i class="fas fa-wallet"></i> Billetera
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('user.deposits.index') }}" class="add-funds">
                            <i class="fas fa-plus"></i>
                        </a>
                        <div class="balance">
                            <i class="fas fa-coins"></i>
                            <span class="amount">PEN {{ number_format(auth()->user()->balance ?? 0.00, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('user.deposits.index') }}" class="btn-deposit-styled">Depositar</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout-styled">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="navbar-nav ms-auto">
                    <a href="{{ route('login') }}" class="btn-login me-3">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn-register">Registrarse</a>
                </div>
            @endif
        </div>
    </div>
</nav>

<style>
.navbar {
    box-shadow: 0 4px 30px rgba(47, 211, 93, 0.1);
}

.logo-text {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
}

.logo-text .tec {
    color: white;
}

.logo-text .bet {
    color: #2FD35D;
}

.nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 8px 16px !important;
}

.nav-link:hover, .nav-link.active {
    color: #2FD35D !important;
}

.btn-login, .btn-register, .btn-logout {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 8px 24px;
    border-radius: 50px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-login {
    color: white;
    background-color: transparent;
    border: 1px solid #2FD35D;
}

.btn-login:hover {
    background-color: rgba(47, 211, 93, 0.1);
    color: #2FD35D;
    border-color: #2FD35D;
}

.btn-register {
    background: linear-gradient(45deg, #2FD35D, #28b850);
    color: white;
    border: none;
}

.btn-register:hover {
    background: linear-gradient(45deg, #28b850, #2FD35D);
    color: white;
    transform: translateY(-1px);
}

.btn-logout {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.btn-logout:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.4);
    color: white;
}

@media (max-width: 991px) {
    .navbar-collapse {
        background: rgba(0, 0, 0, 0.95);
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 10px;
        border: 1px solid rgba(47, 211, 93, 0.2);
    }

    .nav-link {
        padding: 12px 16px !important;
    }

    .d-flex {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch !important;
    }

    .btn-login, .btn-register, .btn-logout {
        display: block;
        text-align: center;
        margin: 0.5rem 0;
    }
}

/* Betting Info Styles */
.betting-info {
    display: flex;
    align-items: center;
    margin-right: 2rem;
}

.balance-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.balance-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #2FD35D;
    font-weight: 500;
}

.balance-item i {
    font-size: 1.2rem;
}

.btn-deposit {
    background: #2FD35D;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 500;
}

.btn-deposit:hover {
    background: #28b850;
    transform: translateY(-1px);
}

/* User Dropdown Styles */
.user-dropdown {
    position: relative;
}

.user-trigger {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.user-trigger:hover {
    background: rgba(255, 255, 255, 0.1);
}

.user-trigger i {
    color: #2FD35D;
}

.user-trigger .fa-chevron-down {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.6);
}

.dropdown-menu {
    background: #232b47 !important;
    color: #fff !important;
    border: 1px solid rgba(47, 211, 93, 0.2);
    border-radius: 10px;
    margin-top: 0.5rem;
    padding: 0.5rem;
    min-width: 200px;
}

.dropdown-item {
    color: #fff !important;
    padding: 0.7rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.dropdown-item i {
    color: #2FD35D;
    width: 20px;
    text-align: center;
}

.dropdown-item:hover {
    background: rgba(47, 211, 93, 0.1);
    color: #2FD35D;
}

.dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1);
    margin: 0.5rem 0;
}

.dropdown-item.text-danger {
    color: #dc3545;
}

.dropdown-item.text-danger:hover {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.dropdown-item.text-danger i {
    color: #dc3545;
}

.notification-toast {
    position: fixed;
    top: 80px;
    right: 30px;
    background: #232b47;
    color: #fff;
    border: 2px solid #bfa46b;
    border-radius: 10px;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    z-index: 9999;
    opacity: 0;
    transform: translateY(-30px);
    transition: all 0.4s;
    box-shadow: 0 4px 24px #0008;
}
.notification-toast.show {
    opacity: 1;
    transform: translateY(0);
}

/* New styles for user wallet */
.user-wallet {
    display: flex;
    align-items: center;
    background-color: #1f2122;
    border-radius: 50px;
    padding: 5px;
    border: 1px solid #333;
    gap: 8px;
}

.user-wallet .user-avatar {
    background-color: #6c757d;
    color: #fff;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: background-color 0.3s;
}

.user-wallet .user-avatar:hover {
    background-color: #5a6268;
}

.user-wallet .add-funds {
    background-color: #ffc107;
    color: #1f2122;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.user-wallet .add-funds:hover {
    background-color: #e0a800;
}

.user-wallet .balance {
    display: flex;
    align-items: center;
    color: white;
    font-weight: 500;
    padding-right: 15px;
    gap: 8px;
}

.user-wallet .balance .fa-coins {
    color: #ffc107;
    font-size: 18px;
}

.btn-deposit-styled {
    background: #2FD35D;
    color: #000;
    border: none;
    padding: 10px 25px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
}

.btn-deposit-styled:hover {
    background: #28b850;
    color: #000;
    transform: translateY(-1px);
}

.btn-logout-styled {
    background: transparent;
    border: none;
    color: #6c757d;
    cursor: pointer;
    font-size: 20px;
    transition: color 0.3s;
}

.btn-logout-styled:hover {
    color: #fff;
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />

@section('scripts')
<script>
let lastNotificationId = null;

function showNotificationToast(message) {
    let toast = document.createElement('div');
    toast.className = 'notification-toast';
    toast.innerHTML = '<i class="fas fa-trophy"></i> ' + message;
    document.body.appendChild(toast);
    setTimeout(() => { toast.classList.add('show'); }, 100);
    setTimeout(() => { toast.classList.remove('show'); setTimeout(()=>toast.remove(), 500); }, 5000);
}

async function fetchNotifications() {
    try {
        const res = await fetch('/betting/notifications');
        if (!res.ok) return;
        const notifications = await res.json();
        let unread = notifications.find(n => !n.read);
        
        const notificationDot = document.getElementById('notification-dot');
        if (unread) {
            notificationDot.style.display = 'block';
        } else {
            notificationDot.style.display = 'none';
        }
    } catch (error) {
        console.error('Error fetching notifications:', error);
    }
}

setInterval(fetchNotifications, 10000); // cada 10s
window.addEventListener('DOMContentLoaded', fetchNotifications);

document.addEventListener('click', function(e) {
    if (e.target.closest('#notification-bell')) {
        e.preventDefault();
        handleNotificationClick();
    }
});

async function handleNotificationClick() {
    try {
        const res = await fetch('/betting/notifications');
        if (!res.ok) return;
        const notifications = await res.json();
        let unread = notifications.find(n => !n.read);
        if (unread) {
            showNotificationToast(unread.message);
            // Marcar como leída
            fetch('/betting/notifications/mark-as-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }).then(response => response.json())
              .then(data => {
                  if(data.success){
                      document.getElementById('notification-dot').style.display = 'none';
                  }
              });
        }
    } catch (error) {
        console.error('Error handling notification click:', error);
    }
}
</script> 