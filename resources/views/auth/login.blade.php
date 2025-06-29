@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="background-overlay"></div>
    <div class="static-images">
        <img src="/images/messi-left.png" alt="Messi Back" class="player-left">
        <img src="/images/messi-right.png" alt="Messi Front" class="player-right">
    </div>

    <div class="form-wrapper">
        <div class="form-container">
            <div class="glow-effect"></div>
            <h2 class="login-title">BIENVENIDO A<br>TECBET</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">CORREO:</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="form-control-custom" placeholder="ejemplo@correo.com" required>
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

                <button type="submit" class="login-submit-btn">
                    <span class="btn-text">INICIAR SESIÓN</span>
                </button>

                <div class="links-container">
                    <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="register-link">
                    <span class="register-text">¿No tienes una cuenta?</span>
                    <a href="{{ route('register') }}" class="btn-register-link">Regístrate aquí</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .login-container {
        position: relative;
        width: 100%;
        min-height: 90vh;
        background: linear-gradient(to bottom, #344473 0%, #000000 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
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
        pointer-events: none;
        z-index: 1;
    }

    .player-left, .player-right {
        position: absolute;
        height: 90%;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .player-left {
        left: 0;
        bottom: 0;
    }

    .player-right {
        right: 0;
        bottom: 0;
    }

    .form-wrapper {
        width: 100%;
        max-width: 450px;
        margin: 0 20px;
        position: relative;
        z-index: 2;
    }

    .form-container {
        background: rgba(0, 0, 0, 0.75);
        padding: 40px;
        border-radius: 20px;
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

    .login-title {
        font-family: 'Outfit', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #2FD35D;
        text-align: center;
        margin-bottom: 35px;
        letter-spacing: -0.02em;
        line-height: 1.2;
        position: relative;
        text-shadow: 0 0 20px rgba(47, 211, 93, 0.3);
    }

    .login-title::after {
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
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        color: #2FD35D;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
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
        padding: 16px 20px;
        background: transparent;
        border: none;
        color: white;
        font-size: 15px;
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

    .login-submit-btn {
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

    .login-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(47, 211, 93, 0.4),
                    0 0 60px rgba(47, 211, 93, 0.2);
    }

    .login-submit-btn:active {
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

    .login-submit-btn:hover .arrow {
        transform: translateX(5px);
    }

    .links-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .forgot-link {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .forgot-link:hover {
        color: #2FD35D;
        text-shadow: 0 0 10px rgba(47, 211, 93, 0.3);
    }

    .register-link {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .register-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
        margin-right: 8px;
    }

    .btn-register-link {
        color: #2FD35D;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-register-link:hover {
        text-shadow: 0 0 10px rgba(47, 211, 93, 0.5);
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

    @media (max-width: 768px) {
        .player-left, .player-right {
            opacity: 0.3;
        }

        .form-container {
            padding: 30px 20px;
        }

        .login-title {
            font-size: 28px;
        }
    }
</style>
@endsection
