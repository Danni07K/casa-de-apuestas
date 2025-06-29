@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Apuestas seguras para<br>todos.<br>¡QUE ESPERAS!</h1>
            <a href="{{ route('register') }}" class="btn-register">
                Regístrate
                <span class="arrow">→</span>
            </a>
            <p class="promo-text">Los clientes nuevos provenientes de Tecsup tendrán un descuento en su primera recarga, vengan ya y apuesten con total seguridad.</p>
        </div>
        <div class="hero-image">
            <img src="/images/messi-double.png" alt="Messi" class="messi-double">
        </div>
    </div>
</div>

<div class="payment-section">
    <h4>MÉTODOS DE PAGO</h4>
    <div class="payment-logos">
        <div class="payment-logo-container">
            <img src="/images/plin.png" alt="Plin">
        </div>
        <div class="payment-logo-container">
            <img src="/images/yape.png" alt="Yape">
        </div>
        <div class="payment-logo-container">
            <img src="/images/bcp.png" alt="BCP">
        </div>
        <div class="payment-logo-container">
            <img src="/images/visa.png" alt="Visa">
        </div>
        <div class="payment-logo-container">
            <img src="/images/niubiz.png" alt="Niubiz">
        </div>
        <div class="payment-logo-container">
            <img src="/images/bbva.png" alt="BBVA">
        </div>
    </div>
    <div class="age-restriction">
        <img src="/images/18plus.png" alt="18+" class="age-icon">
        <p>¿Estás listo para apostar?</p>
        <a href="{{ route('informacion') }}" class="btn-info">Más información</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
    }

    .hero-container {
        position: relative;
        width: 100%;
        min-height: 90vh;
        background: linear-gradient(to bottom, #344473 0%, #000000 100%);
        overflow: hidden;
    }

    .hero-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 80px 40px 0 80px;
        position: relative;
        display: flex;
        align-items: flex-start;
        min-height: 90vh;
    }

    .hero-text {
        max-width: 650px;
        z-index: 2;
        position: relative;
        padding-top: 40px;
    }

    .hero-text h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 48px;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 35px;
        color: white;
        letter-spacing: -0.02em;
        text-transform: uppercase;
        position: relative;
    }

    .hero-text h1::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -15px;
        width: 80px;
        height: 4px;
        background: #2FD35D;
        border-radius: 2px;
    }

    .promo-text {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        margin-top: 35px;
        line-height: 1.7;
        max-width: 85%;
        font-weight: 400;
        position: relative;
        padding-left: 20px;
        border-left: 3px solid rgba(47, 211, 93, 0.5);
    }

    .btn-register {
        background: linear-gradient(45deg, #2FD35D, #28b850);
        color: white;
        padding: 16px 38px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 0 20px rgba(47, 211, 93, 0.5),
                    0 0 40px rgba(47, 211, 93, 0.2);
        position: relative;
        overflow: hidden;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .btn-register:hover::before {
        transform: translateX(100%);
    }

    .btn-register .arrow {
        margin-left: 12px;
        font-size: 20px;
        transition: transform 0.3s ease;
    }

    .btn-register:hover {
        background: linear-gradient(45deg, #28b850, #2FD35D);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
        box-shadow: 0 0 25px rgba(47, 211, 93, 0.6),
                    0 0 50px rgba(47, 211, 93, 0.3);
    }

    .btn-register:hover .arrow {
        transform: translateX(5px);
    }

    .hero-image {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 55%;
        height: 100%;
        display: flex;
        justify-content: flex-end;
        pointer-events: none;
    }

    .messi-double {
        height: 150%;
        width: 110%;
        object-fit: contain;
        position: absolute;
        bottom: 0;
        right: 15%;
        transform: translateX(10%);
        z-index: 1;
    }

    .payment-section {
        background: linear-gradient(to bottom, #344473 0%, #000000 100%);
        padding: 60px 20px;
        text-align: center;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .payment-section h4 {
        color: #2FD35D;
        font-family: 'Outfit', sans-serif;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 35px;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        display: inline-block;
    }

    .payment-section h4::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -10px;
        width: 40px;
        height: 3px;
        background: #2FD35D;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .payment-logos {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 20px;
        max-width: 1000px;
        margin: 0 auto 60px;
        padding: 30px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(47, 211, 93, 0.2);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37),
                    0 0 20px rgba(47, 211, 93, 0.2);
    }

    .payment-logo-container {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        padding: 15px;
        border: 1px solid rgba(47, 211, 93, 0.2);
        transition: all 0.3s ease;
        box-shadow: 0 0 10px rgba(47, 211, 93, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        aspect-ratio: 1;
    }

    .payment-logo-container:hover {
        transform: translateY(-4px);
        border-color: rgba(47, 211, 93, 0.5);
        box-shadow: 0 0 20px rgba(47, 211, 93, 0.3);
    }

    .payment-logo-container img {
        width: 80%;
        height: 80%;
        object-fit: contain;
        filter: brightness(1);
        display: block;
        margin: auto;
    }

    .age-restriction {
        text-align: center;
        margin: 40px auto 0;
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(47, 211, 93, 0.2);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37),
                    0 0 20px rgba(47, 211, 93, 0.2);
        padding: 25px;
        max-width: 400px;
    }

    .age-icon {
        width: 65px;
        margin-bottom: 15px;
    }

    .age-restriction p {
        color: #2FD35D;
        font-family: 'Outfit', sans-serif;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
    }

    .btn-info {
        background-color: #2FD35D;
        color: white;
        padding: 12px 28px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        font-weight: 600;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-info:hover {
        background-color: #28b850;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 0 20px rgba(47, 211, 93, 0.4);
    }

    @media (max-width: 1200px) {
        .messi-double {
            max-width: 650px;
            bottom: -20px;
        }
    }
    @media (max-width: 900px) {
        .hero-content {
            flex-direction: column;
            align-items: center;
            padding: 40px 10px 0 10px;
            min-height: 70vh;
        }
        .hero-text {
            max-width: 100%;
            padding-bottom: 0;
            text-align: center;
            align-items: center;
        }
        .hero-image {
            justify-content: center;
            align-items: flex-end;
            margin-top: 30px;
        }
        .messi-double {
            max-width: 320px;
            width: 90vw;
            right: 0;
            bottom: 0;
        }
    }
</style>
@endsection
