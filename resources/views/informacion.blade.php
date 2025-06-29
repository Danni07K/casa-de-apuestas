@extends('layouts.app')

@section('title', 'Información - TecBet')

@section('content')
<div class="info-page-container">
    <div class="info-content">
        <div class="info-header">
            <h1>Información</h1>
        </div>
        <div class="info-body">
            <div class="info-text-section">
                <div class="info-card">
                    <h3>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#2FD35D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#2FD35D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Nuestra Misión
                    </h3>
                    <p>
                        Nuestra misión como página web de apuestas es ser una pagina facil y sencilla de entender para el público nuevo en este mundo, somos una pagina muy segura y sofisticada.
                    </p>
                </div>
                <div class="info-card">
                    <h3>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#2FD35D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 6V12L16 14" stroke="#2FD35D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Nuestra Historia
                    </h3>
                    <p>
                        Todo comenzó como un proyecto para nuestro queridísimo profesor Vergel Polo, Paul.
                    </p>
                </div>
            </div>
            <div class="info-image-section">
                <div class="image-wrapper">
                    <img src="{{ asset('images/about-us.png') }}" alt="Nuestro equipo">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap');

    .info-page-container {
        width: 100%;
        min-height: 90vh;
        padding: 60px 20px;
        background: linear-gradient(to bottom, #344473 0%, #000000 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Outfit', sans-serif;
    }

    .info-content {
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
    }
    
    .info-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .info-header h1 {
        font-size: 48px;
        font-weight: 700;
        color: #2FD35D;
        display: inline-block;
        position: relative;
        padding-bottom: 15px;
    }
    
    .info-header h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 5px;
        background-color: #4A90E2;
        border-radius: 3px;
    }

    .info-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .info-text-section {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .info-card {
        background-color: #0D0D0D;
        border-radius: 16px;
        padding: 35px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
    }

    .info-card h3 {
        color: white;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .info-card h3 svg {
        flex-shrink: 0;
    }

    .info-card p {
        color: #aeb9c7;
        font-size: 16px;
        line-height: 1.7;
    }

    .info-image-section {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-wrapper {
        position: relative;
        z-index: 2;
    }

    .image-wrapper img {
        width: 100%;
        max-width: 450px;
        border-radius: 16px;
        object-fit: cover;
    }

    .info-image-section::before,
    .info-image-section::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background-color: rgba(74, 144, 226, 0.1);
        z-index: 1;
    }

    .info-image-section::before {
        width: 120px;
        height: 120px;
        top: -20px;
        right: 20px;
    }
    
    .info-image-section::after {
        width: 300px;
        height: 300px;
        top: 50%;
        left: 50%;
        transform: translate(-40%, -60%);
        background-color: rgba(52, 68, 115, 0.2);
        filter: blur(20px);
    }

    @media (max-width: 992px) {
        .info-body {
            grid-template-columns: 1fr;
        }
        .info-image-section {
            order: -1;
            margin-bottom: 40px;
        }
    }

</style>
@endsection 