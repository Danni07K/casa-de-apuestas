@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="background-overlay"></div>
    <div class="static-images">
        <img src="/images/player-left.png" alt="Jugador" class="player-left">
        <img src="/images/players-right.png" alt="Jugadores" class="player-right">
    </div>

    <div class="form-wrapper">
        <div class="form-container">
            <div class="glow-effect"></div>
            <h2 class="register-title">BIENVENIDO A<br>TECBET</h2>
            <p class="register-subtitle">Únete a la comunidad</p>
            
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">NOMBRE COMPLETO:</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" class="form-control-custom" placeholder="Tu nombre completo" required>
                        <div class="input-highlight"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">CORREO:</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="form-control-custom" placeholder="ejemplo@correo.com" required>
                        <div class="input-highlight"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">TELÉFONO:</label>
                    <div class="input-wrapper">
                        <input type="text" name="phone" class="form-control-custom" placeholder="+51 999 999 999" required>
                        <div class="input-highlight"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">CONTRASEÑA:</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="form-control-custom" placeholder="********" required>
                        <div class="input-highlight"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">CONFIRMAR CONTRASEÑA:</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" class="form-control-custom" placeholder="********" required>
                        <div class="input-highlight"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="birthdate">FECHA DE NACIMIENTO:</label>
                    <div class="input-wrapper">
                        <input type="date" 
                               id="birthdate" 
                               name="birthdate" 
                               class="form-control-custom" 
                               required
                               max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                               onchange="validateAge(this)">
                    </div>
                    <span id="age-error" class="error-message" style="color: #ff4444; font-size: 12px; margin-top: 5px; display: none;">
                        Debes ser mayor de 18 años para registrarte.
                    </span>
                </div>

                <div class="terms-check">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Acepto los <a href="{{ route('terms') }}" onclick="window.open(this.href, 'Términos y Condiciones', 'width=800,height=600,scrollbars=yes'); return false;" class="terms-link">Términos y Condiciones</a></label>
                </div>

                <button type="submit" class="register-submit-btn">
                    <span class="btn-text">CREAR CUENTA</span>
                    <span class="arrow">→</span>
                </button>

                <div class="login-link">
                    <span class="login-text">¿Ya tienes una cuenta?</span>
                    <a href="login" class="btn-login-link">Inicia sesión aquí</a>
                </div>
            </form>
        </div>

        <div class="payment-section">
            <h4 class="section-title">MÉTODOS DE PAGO</h4>
            <div class="payment-logos">
                <img src="/images/plin.png" alt="Plin">
                <img src="/images/yape.png" alt="Yape">
                <img src="/images/bcp.png" alt="BCP">
                <img src="/images/visa.png" alt="Visa">
                <img src="/images/niubiz.png" alt="Niubiz">
                <img src="/images/bbva.png" alt="BBVA">
            </div>
        </div>

        <div class="age-restriction">
            <img src="/images/18plus.png" alt="18+" class="age-icon">
            <p>¿Estás listo para apostar?</p>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .register-container {
        position: relative;
        width: 100%;
        min-height: 90vh;
        background: linear-gradient(to bottom, #344473 0%, #000000 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
        padding: 40px 20px;
    }

    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(52, 68, 115, 0.95) 0%, rgba(0, 0, 0, 0.98) 100%);
        z-index: 1;
    }

    .static-images {
        position: absolute;
        width: 100%;
        height: 100%;
        max-height: 600px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        pointer-events: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .player-left, .player-right {
        position: relative;
        height: 500px;
        object-fit: contain;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .player-left {
        margin-left: -50px;
    }

    .player-right {
        margin-right: -50px;
    }

    .register-container:hover .player-left {
        transform: translateX(0);
    }

    .register-container:hover .player-right {
        transform: translateX(0);
    }

    .form-wrapper {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-container {
        background: rgba(0, 0, 0, 0.75);
        padding: 35px;
        border-radius: 20px;
        width: 100%;
        max-width: 420px;
        margin: 20px auto;
        border: 1px solid rgba(47, 211, 93, 0.3);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 40px rgba(47, 211, 93, 0.15),
                    0 0 80px rgba(47, 211, 93, 0.1);
        position: relative;
        overflow: hidden;
    }

    .glow-effect {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(47, 211, 93, 0.1) 0%, transparent 70%);
        pointer-events: none;
        animation: glow 10s infinite linear;
    }

    @keyframes glow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .register-title {
        font-family: 'Outfit', sans-serif;
        font-size: 28px;
        font-weight: 800;
        color: #2FD35D;
        text-align: center;
        margin-bottom: 10px;
        letter-spacing: -0.02em;
        line-height: 1.2;
        position: relative;
        text-shadow: 0 0 20px rgba(47, 211, 93, 0.3);
    }

    .register-subtitle {
        color: white;
        text-align: center;
        font-size: 16px;
        margin-bottom: 30px;
        font-family: 'Outfit', sans-serif;
        position: relative;
    }

    .register-subtitle::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -15px;
        width: 60px;
        height: 3px;
        background: #2FD35D;
        transform: translateX(-50%);
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(47, 211, 93, 0.5);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #2FD35D;
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 1px;
        text-shadow: 0 0 10px rgba(47, 211, 93, 0.3);
    }

    .input-wrapper {
        position: relative;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(47, 211, 93, 0.2);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .input-wrapper:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .input-highlight {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(47, 211, 93, 0.1),
            transparent
        );
        transition: 0.5s;
    }

    .input-wrapper:hover .input-highlight {
        left: 100%;
    }

    .form-control-custom {
        width: 100%;
        padding: 14px 18px;
        background: transparent;
        border: none;
        color: white;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
    }

    .form-control-custom:focus {
        outline: none;
    }

    .input-wrapper:focus-within {
        border-color: #2FD35D;
        box-shadow: 0 0 0 2px rgba(47, 211, 93, 0.2);
    }

    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .form-control-custom[type="date"] {
        color-scheme: dark;
    }

    .terms-check {
        margin: 25px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .terms-check input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #2FD35D;
        cursor: pointer;
    }

    .terms-check label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
    }

    .terms-link {
        color: #2FD35D;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .terms-link:hover {
        color: #28b850;
        text-decoration: underline;
    }

    .register-submit-btn {
        background: linear-gradient(45deg, #2FD35D, #28b850);
        color: white;
        width: 100%;
        padding: 16px 38px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 0 20px rgba(47, 211, 93, 0.3),
                    0 0 40px rgba(47, 211, 93, 0.1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        margin: 10px 0 20px;
    }

    .register-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(47, 211, 93, 0.4),
                    0 0 60px rgba(47, 211, 93, 0.2);
    }

    .register-submit-btn:active {
        transform: translateY(1px);
    }

    .btn-text {
        position: relative;
        z-index: 1;
    }

    .arrow {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .register-submit-btn:hover .arrow {
        transform: translateX(5px);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .login-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
        margin-right: 8px;
    }

    .btn-login-link {
        color: #2FD35D;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-login-link:hover {
        text-shadow: 0 0 10px rgba(47, 211, 93, 0.5);
    }

    .payment-section {
        text-align: center;
        margin-top: 25px;
        background: rgba(14, 14, 14, 0.8);
        padding: 25px;
        border-radius: 20px;
        width: 100%;
        max-width: 700px;
        position: relative;
        z-index: 2;
        border: 1px solid rgba(47, 211, 93, 0.3);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 40px rgba(47, 211, 93, 0.15);
        overflow: hidden;
    }

    .payment-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(52, 68, 115, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%);
        pointer-events: none;
    }

    .section-title {
        color: #2FD35D;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 25px;
        letter-spacing: 1px;
        font-family: 'Outfit', sans-serif;
        text-shadow: 0 0 10px rgba(47, 211, 93, 0.3);
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -8px;
        width: 40px;
        height: 2px;
        background: #2FD35D;
        transform: translateX(-50%);
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(47, 211, 93, 0.5);
    }

    .payment-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 20px;
        position: relative;
    }

    .payment-logos img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        filter: brightness(1);
        background: rgba(20, 20, 20, 0.8);
        padding: 12px;
        border-radius: 14px;
        border: 1px solid rgba(47, 211, 93, 0.1);
    }

    .payment-logos img:hover {
        transform: scale(1.05);
        filter: brightness(1.2);
        border-color: rgba(47, 211, 93, 0.5);
        box-shadow: 0 0 20px rgba(47, 211, 93, 0.2);
        background: rgba(30, 30, 30, 0.9);
    }

    .age-restriction {
        margin-top: 30px;
        text-align: center;
        color: white;
        display: flex;
        align-items: center;
        gap: 15px;
        background: rgba(0, 0, 0, 0.75);
        padding: 15px 30px;
        border-radius: 50px;
        border: 1px solid rgba(47, 211, 93, 0.3);
        backdrop-filter: blur(20px);
    }

    .age-icon {
        width: 30px;
        height: 30px;
    }

    .age-restriction p {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
    }

    .alert {
        background: rgba(255, 0, 0, 0.1);
        border: 1px solid rgba(255, 0, 0, 0.3);
        color: #ff4444;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 14px;
    }

    @media (max-width: 1200px) {
        .player-left, .player-right {
            height: 450px;
        }

        .payment-logos {
            gap: 25px;
        }

        .payment-logos img {
            width: 80px;
            height: 80px;
        }
    }

    @media (max-width: 992px) {
        .player-left, .player-right {
            height: 400px;
            opacity: 0.6;
        }

        .form-container {
            max-width: 400px;
        }

        .payment-section {
            max-width: 600px;
        }
    }

    @media (max-width: 768px) {
        .player-left {
            margin-left: -80px;
        }

        .player-right {
            margin-right: -80px;
        }

        .player-left, .player-right {
            height: 350px;
            opacity: 0.4;
        }

        .form-container {
            max-width: 380px;
            padding: 25px;
        }

        .register-title {
            font-size: 24px;
        }

        .payment-section {
            padding: 20px;
            max-width: 500px;
        }

        .payment-logos img {
            width: 60px;
            height: 60px;
            padding: 10px;
        }

        .age-restriction {
            padding: 12px 20px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .static-images {
            display: none;
        }

        .form-container {
            margin: 10px;
            padding: 20px;
        }

        .payment-logos img {
            width: 55px;
            height: 55px;
        }

        .age-restriction {
            flex-direction: column;
            padding: 15px;
        }
    }

    @media (max-height: 800px) {
        .player-left, .player-right {
            height: 80vh;
        }
    }
</style>

<script>
function validateAge(input) {
    const birthDate = new Date(input.value);
    const today = new Date();
    const minAge = 18;
    
    // Calcular edad
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    const errorElement = document.getElementById('age-error');
    const submitButton = document.querySelector('.register-submit-btn');
    
    if (age < minAge) {
        errorElement.style.display = 'block';
        input.setCustomValidity('Debes ser mayor de 18 años');
        submitButton.disabled = true;
        submitButton.style.opacity = '0.5';
    } else {
        errorElement.style.display = 'none';
        input.setCustomValidity('');
        submitButton.disabled = false;
        submitButton.style.opacity = '1';
    }
}

// Establecer la fecha máxima al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    const birthDateInput = document.getElementById('birthdate');
    
    // Formato YYYY-MM-DD para el atributo max
    birthDateInput.max = maxDate.toISOString().split('T')[0];
});
</script>
@endsection
