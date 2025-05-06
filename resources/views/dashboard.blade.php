@extends('layoutsapp.master')

@section('title', 'Dashboard')

@section('styles')
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .full-height-centered {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        overflow: hidden;
        position: relative;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes neonPulse {
        0%, 100% {
            text-shadow:
                0 0 10px #fff,
                0 0 20px #fff,
                0 0 30px #ff00de,
                0 0 40px #ff00de,
                0 0 50px #ff00de,
                0 0 60px #ff00de,
                0 0 70px #ff00de;
        }
        50% {
            text-shadow:
                0 0 5px #fff,
                0 0 10px #fff,
                0 0 15px #ff00de,
                0 0 20px #ff00de,
                0 0 25px #ff00de,
                0 0 35px #ff00de,
                0 0 40px #ff00de;
        }
    }

    .welcome-text {
        animation: fadeInDown 1.5s ease-out, neonPulse 3s ease-in-out infinite;
        transform-origin: center;
        transition: all 0.3s ease;
    }

    .welcome-text:hover {
        transform: scale(1.1) rotate(5deg);
    }

    .bg-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        animation: particleMove linear infinite;
    }

    .logo-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        max-width: 900px;
        margin: 0 auto 30px;
        z-index: 1;
    }

    .logo-grid img {
        flex: 0 0 calc(33.333% - 20px);
        max-width: 80px;
        height: auto;
        object-fit: contain;
    }
</style>
@endsection

@section('content')
<div class="full-height-centered">
    <div class="bg-particles" id="particlesContainer"></div>

    <svg width="80%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Bienvenue">
        <text x="50%" y="50%"
              text-anchor="middle"
              dominant-baseline="middle"
              font-family="Arial, Helvetica, sans-serif"
              font-size="100"
              class="welcome-text"
              fill="#2f18de">
        </text>
    </svg>
</div>

<div class="logo-grid">
    <img src="{{ asset('images/usaidT.png') }}" alt="Logo USAID">
    <img src="{{ asset('images/anesvadT.png') }}" alt="Logo Anesvad">
    <img src="{{ asset('images/coptimentT.png') }}" alt="Logo Coptiment">
    <img src="{{ asset('images/hoperisesT.png') }}" alt="Logo Hope Rises">
    <img src="{{ asset('images/pnelT.png') }}" alt="Logo PNEL">
    <img src="{{ asset('images/pnethaT.png') }}" alt="Logo PNETHA">
    <img src="{{ asset('images/pnevgT.png') }}" alt="Logo PNEVG">
    <img src="{{ asset('images/pnlmtncpT.png') }}" alt="Logo PNLMNCP">
    <img src="{{ asset('images/pnlubT.png') }}" alt="Logo PNLUB">
</div>

<script>
    function createParticles() {
        const container = document.getElementById('particlesContainer');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            const size = Math.random() * 5 + 1;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;

            particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
            particle.style.animationDelay = `${Math.random() * 5}s`;

            particle.style.animation = `particleMove ${Math.random() * 20 + 10}s linear infinite`;

            container.appendChild(particle);
        }
    }

    const particleMoveKeyframes = `
        @keyframes particleMove {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.7;
            }
            100% {
                transform: translate(${Math.random() * 200 - 100}vw, ${Math.random() * 200 - 100}vh) rotate(360deg);
                opacity: 0;
            }
        }
    `;

    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerText = particleMoveKeyframes;
    document.head.appendChild(styleSheet);

    document.addEventListener('DOMContentLoaded', createParticles);
</script>
@endsection
