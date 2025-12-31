@props(['size' => 'medium', 'overlay' => false, 'id' => 'loadingSpinner'])

@php
    $sizeClasses = [
        'small' => 'spinner-small',
        'medium' => 'spinner-medium',
        'large' => 'spinner-large'
    ];
    $spinnerClass = $sizeClasses[$size] ?? $sizeClasses['medium'];
@endphp

<div class="loading-container {{ $overlay ? 'loading-overlay' : 'stat-spinner' }}" id="{{ $id }}" style="{{ $overlay ? 'display: none;' : '' }}">
    <div class="spinner-wrapper">
        <div class="spinner {{ $spinnerClass }}">
            @for($i = 0; $i < 36; $i++)
                <div class="spinner-segment" style="--segment-index: {{ $i }};"></div>
            @endfor
        </div>
    </div>
</div>

<style>
    .loading-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        min-height: 200px;
    }

    /* Pour les petits spinners dans les cartes */
    .stat-loading .loading-container {
        min-height: 40px;
        height: auto;
    }

    /* Afficher le spinner quand le conteneur parent est visible */
    .stat-loading:not([style*="display: none"]) .loading-container.stat-spinner:not(.hidden) {
        display: flex !important;
    }

    /* Spinner dans les cartes - affiché par défaut si le parent est visible */
    .stat-spinner {
        display: flex !important;
    }

    .stat-loading[style*="display: none"] .stat-spinner {
        display: none !important;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        z-index: 100;
        backdrop-filter: blur(2px);
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Masquer le loading - cette règle doit avoir la priorité */
    .loading-container[style*="display: none"],
    .loading-container.hidden {
        display: none !important;
    }

    /* Afficher le loading */
    .loading-container:not([style*="display: none"]):not(.hidden) {
        display: flex !important;
    }

    .spinner-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0;
        padding: 0;
    }

    .spinner {
        position: relative;
        width: 60px;
        height: 60px;
    }

    .spinner-small {
        width: 40px;
        height: 40px;
    }

    .spinner-medium {
        width: 60px;
        height: 60px;
    }

    .spinner-large {
        width: 80px;
        height: 80px;
    }

    .spinner-segment {
        position: absolute;
        width: 4px;
        height: 20%;
        border-radius: 2px;
        background: linear-gradient(to bottom, #60a5fa, #3b82f6, #2563eb);
        transform-origin: center bottom;
        left: 50%;
        top: 50%;
        margin-left: -2px;
        margin-top: -50%;
        opacity: 0.1;
        animation: spinner-segment-fade 1.2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        transform: rotate(calc(var(--segment-index) * 10deg)) translateY(-150%);
        animation-delay: calc(var(--segment-index) * 0.033s);
    }

    /* Arrêter l'animation quand le loading est masqué */
    .loading-container[style*="display: none"] .spinner-segment,
    .loading-container.hidden .spinner-segment {
        animation: none !important;
    }

    .spinner-small .spinner-segment {
        width: 3px;
        height: 18%;
        margin-left: -1.5px;
    }

    .spinner-large .spinner-segment {
        width: 5px;
        height: 22%;
        margin-left: -2.5px;
    }

    @keyframes spinner-segment-fade {
        0% {
            opacity: 0.1;
        }
        20% {
            opacity: 0.3;
        }
        40% {
            opacity: 0.7;
        }
        60% {
            opacity: 1;
        }
        80% {
            opacity: 0.5;
        }
        100% {
            opacity: 0.1;
        }
    }
</style>

