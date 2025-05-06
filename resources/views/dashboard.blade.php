@extends('layoutsapp.master')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Style de centrage total */
    html, body {
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

    /* Animations SVG */
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

    @keyframes backgroundMove {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .welcome-text {
        animation: 
            fadeInDown 1.5s ease-out, 
            neonPulse 3s ease-in-out infinite;
        transform-origin: center;
        transition: all 0.3s ease;
    }

    .welcome-text:hover {
        transform: scale(1.1) rotate(5deg);
    }

    /* Effet particules en arrière-plan */
    .bg-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .particle {
        position: absolute;
        background: rgba(255,255,255,0.5);
        border-radius: 50%;
        animation: particleMove linear infinite;
    }
</style>
@endsection

@section('content')
<div class="full-height-centered">
    <!-- Conteneur des particules en arrière-plan -->
    <div class="bg-particles" id="particlesContainer"></div>

    <!-- SVG Bienvenue centré -->
    <svg width="80%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Bienvenue">
        <text x="50%" y="50%" 
              text-anchor="middle" 
              dominant-baseline="middle"
              font-family="Arial, Helvetica, sans-serif" 
              font-size="100" 
              class="welcome-text" 
              fill="#2f18de">Bienvenue</text>
    </svg>
</div>


<script>
    // Animation des particules en arrière-plan
    function createParticles() {
        const container = document.getElementById('particlesContainer');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            // Taille aléatoire
            const size = Math.random() * 5 + 1;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            // Position aléatoire
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;

            // Animation personnalisée
            particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
            particle.style.animationDelay = `${Math.random() * 5}s`;

            // Direction et vitesse aléatoires
            particle.style.animation = `particleMove ${Math.random() * 20 + 10}s linear infinite`;

            container.appendChild(particle);
        }
    }

    // Animation de déplacement des particules
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

    // Ajouter les keyframes dynamiques
    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerText = particleMoveKeyframes;
    document.head.appendChild(styleSheet);

    // Créer les particules au chargement
    document.addEventListener('DOMContentLoaded', createParticles);
</script>
@endsection
