@extends('layoutsapp.master')
@section('title', 'Dashboard')
@section('styles')
<!-- Intégration de MDB CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
<style>
    .logo-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.01) !important; /* Ombre plus légère par défaut */
    }
    
    .logo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1) !important; /* Ombre au survol plus légère également */
    }
    
    .logo-card .card-body {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    
    .logo-card img {
        max-height: 80px;
        width: auto;
        object-fit: contain;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        <!-- USAID -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/usaidT.png') }}" class="img-fluid" alt="Logo USAID">
                </div>
            </div>
        </div>
        <!-- Anesvad -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/anesvadT.png') }}" class="img-fluid" alt="Logo Anesvad">
                </div>
            </div>
        </div>
        <!-- Coptiment -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/coptimentT.png') }}" class="img-fluid" alt="Logo Coptiment">
                </div>
            </div>
        </div>
        <!-- Hope Rises -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/hoperisesT.png') }}" class="img-fluid" alt="Logo Hope Rises">
                </div>
            </div>
        </div>
        <!-- PNEL -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/pnelT.png') }}" class="img-fluid" alt="Logo PNEL">
                </div>
            </div>
        </div>
        <!-- PNETHA -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/pnethaT.png') }}" class="img-fluid" alt="Logo PNETHA">
                </div>
            </div>
        </div>
        <!-- PNEVG -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/pnevgT.png') }}" class="img-fluid" alt="Logo PNEVG">
                </div>
            </div>
        </div>
        <!-- PNLMNCP -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/pnlmtncpT.png') }}" class="img-fluid" alt="Logo PNLMNCP">
                </div>
            </div>
        </div>
        <!-- PNLUB -->
        <div class="col">
            <div class="card h-100 logo-card">
                <div class="card-body">
                    <img src="{{ asset('images/pnlubT.png') }}" class="img-fluid" alt="Logo PNLUB">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Intégration de MDB JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
<script>
    // Script pour les particules
    function createParticles() {
        const container = document.getElementById('particlesContainer');
        if (!container) {
            // Créer le conteneur s'il n'existe pas
            const newContainer = document.createElement('div');
            newContainer.id = 'particlesContainer';
            newContainer.style.position = 'fixed';
            newContainer.style.top = '0';
            newContainer.style.left = '0';
            newContainer.style.width = '100%';
            newContainer.style.height = '100%';
            newContainer.style.pointerEvents = 'none';
            newContainer.style.zIndex = '0';
            document.body.appendChild(newContainer);
            
            const particleCount = 50;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 5 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.position = 'absolute';
                particle.style.backgroundColor = 'rgba(0, 123, 255, 0.2)';
                particle.style.borderRadius = '50%';
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.opacity = '0.7';
                
                // Animation personnalisée pour chaque particule
                const randomX = Math.random() * 200 - 100;
                const randomY = Math.random() * 200 - 100;
                const duration = Math.random() * 20 + 10;
                
                particle.animate([
                    { transform: 'translate(0, 0) rotate(0deg)', opacity: 0.7 },
                    { transform: `translate(${randomX}vw, ${randomY}vh) rotate(360deg)`, opacity: 0 }
                ], {
                    duration: duration * 1000,
                    iterations: Infinity,
                    delay: Math.random() * 5000
                });
                
                newContainer.appendChild(particle);
            }
        }
    }
    
    document.addEventListener('DOMContentLoaded', createParticles);
</script>
@endsection