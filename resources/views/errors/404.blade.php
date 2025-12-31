@extends('layoutsapp.master')

@section('title', 'Page Introuvable')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(45deg, #2962ff 0%, #1976d2 100%);
        --secondary-gradient: linear-gradient(45deg, #4a5568 0%, #2d3748 100%);
        --warning-gradient: linear-gradient(45deg, #ed8936 0%, #dd6b20 100%);
        --success-gradient: linear-gradient(45deg, #48bb78 0%, #2f855a 100%);
        --hover-overlay: rgba(255, 255, 255, 0.1);
    }

    .error-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        padding: 2rem;
    }

    .error-card {
        background: white;
        border-radius: 20px;
        /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); */
        padding: 3rem;
        max-width: 600px;
        width: 100%;
        text-align: center;
        animation: slideUp 0.5s ease-out forwards;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .error-number {
        font-size: 120px;
        font-weight: bold;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 1rem;
    }

    .error-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.5rem;
    }

    .error-message {
        font-size: 1.1rem;
        color: #4a5568;
        margin-bottom: 2rem;
    }

    .btn-home {
        background: var(--primary-gradient);
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-size: 1.1rem;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-home:hover {
        transform: translateY(-3px);
        /* box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); */
        color: white;
    }

    .error-icon {
        margin-bottom: 2rem;
    }

    .error-icon svg {
        width: 80px;
        height: 80px;
        fill: url(#gradient);
    }
</style>

<div class="error-container">
    <div class="error-card">
        <svg width="0" height="0">
            <defs>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#e66a0a" />
                    <stop offset="100%" style="stop-color:#17a204" />
                </linearGradient>
            </defs>
        </svg>

        <div class="error-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z"/>
            </svg>
        </div>

        <div class="error-number">404</div>
        <h1 class="error-title">Page Introuvable</h1>
        <p class="error-message">
            Désolé, la page que vous recherchez semble avoir disparu ou n'existe pas. 
            Vous pouvez retourner à la page d'accueil et reprendre votre navigation.
        </p>
        <a href="{{ url('/') }}" class="btn-home">
            <i class="bi bi-house-door me-2"></i>
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection