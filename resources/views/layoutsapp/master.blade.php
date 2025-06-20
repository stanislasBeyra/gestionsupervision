<!DOCTYPE html>
<html lang="en">

@include('layoutsapp.appconfig')

<body>
    @include('layoutsapp.partials.navbar')
    @include('layoutsapp.partials.sidebar')


    <main style="margin-top: 58px">
        <div class="container-fluid pt-4">
            @yield('content')
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
            <!-- Toast d'installation -->
            <div class="toast align-items-center text-white bg-info border-0" role="alert" id="installToast">
                <div class="d-flex">
                    <div class="toast-body">
                        <!-- Le message sera inséré dynamiquement -->
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-mdb-dismiss="toast"></button>
                </div>
            </div>
        </div>

        <!-- Bannière d'installation PWA -->
        <div id="installBanner" style="display:none; position:fixed; bottom:20px; left:0; right:0; background:#2979ff; color:white; padding:16px; text-align:center; z-index:9999;">
            <span id="installText">Voulez-vous installer l'application ?</span>
            <button id="installBtn" style="margin-left:10px; background:white; color:#2979ff; border:none; padding:8px 16px; border-radius:4px; cursor:pointer;">
                Installer
            </button>
            <button id="closeBanner" style="margin-left:10px; background:transparent; color:white; border:none; font-size:20px; cursor:pointer;">×</button>
        </div>
    </main>

    @include('layoutsapp.partials.script')
</body>
<script>
    // Variable globale pour stocker l'événement d'installation
    let deferredPrompt = null;

    // Fonction de diagnostic PWA
    async function diagnosticPWA() {
        console.log('=== DIAGNOSTIC PWA ===');

        // Vérification plus précise du protocole
        const isLocalhost = window.location.hostname === 'localhost' ||
            window.location.hostname === '127.0.0.1' ||
            window.location.hostname.includes('192.168.') ||
            window.location.hostname.endsWith('.loca.lt'); // Ajout de localtunnel

        console.log('1. Protocole :', window.location.protocol);
        console.log('2. Hostname :', window.location.hostname);

        if (window.location.protocol !== 'https:' && !isLocalhost) {
            console.error('❌ Le site doit être servi en HTTPS (sauf pour localhost/IP locale)');
            // Redirection automatique vers HTTPS si disponible
            if (!isLocalhost && window.location.protocol === 'http:') {
                window.location.href = window.location.href.replace('http:', 'https:');
            }
        } else {
            console.log('✅ Protocole OK');
        }

        // Vérification du manifest
        try {
            const manifestLink = document.querySelector('link[rel="manifest"]');
            if (!manifestLink) {
                console.error('❌ Pas de lien vers le manifest.json');
            } else {
                console.log('✅ Lien manifest présent');
                try {
                    const manifestResponse = await fetch(manifestLink.href);
                    const manifest = await manifestResponse.json();
                    console.log('Manifest chargé :', manifest);

                    // Vérification des critères du manifest
                    const checks = {
                        name: !!manifest.name || !!manifest.short_name,
                        display: ['standalone', 'fullscreen', 'minimal-ui'].includes(manifest.display),
                        icons: manifest.icons && manifest.icons.some(icon =>
                            icon.sizes === '192x192' || icon.sizes === '512x512'),
                        startUrl: !!manifest.start_url
                    };

                    console.log('Vérifications manifest :', checks);
                } catch (e) {
                    console.error('❌ Erreur lors du chargement du manifest :', e);
                }
            }
        } catch (e) {
            console.error('❌ Erreur lors de la vérification du manifest :', e);
        }

        // Vérification du Service Worker améliorée
        // Dans la fonction diagnosticPWA
        if ('serviceWorker' in navigator) {
            try {
                // Force la réinstallation du Service Worker
                await navigator.serviceWorker.getRegistrations().then(function(registrations) {
                    for (let registration of registrations) {
                        registration.unregister();
                    }
                });

                const registration = await navigator.serviceWorker.register('/service-worker.js', {
                    scope: '/',
                    updateViaCache: 'none'
                });

                if (registration.active) {
                    console.log('✅ Service Worker actif');
                } else if (registration.installing) {
                    console.log('⏳ Service Worker en cours d\'installation');
                    registration.installing.addEventListener('statechange', (e) => {
                        if (e.target.state === 'activated') {
                            console.log('✅ Service Worker activé avec succès');
                        }
                    });
                }
                console.log('✅ Service Worker enregistré:', registration.scope);
            } catch (error) {
                console.error('❌ Erreur Service Worker:', {
                    message: error.message,
                    stack: error.stack
                });
            }
        } else {
            console.error('❌ Service Worker non supporté par ce navigateur');
            console.log('Navigateur:', navigator.userAgent);
        }

        // Vérification de l'installation
        const isStandalone = window.matchMedia('(display-mode: standalone)').matches;
        console.log('Application déjà installée ?', isStandalone);

        // Vérification de la compatibilité du navigateur
        console.log('User Agent:', navigator.userAgent);

        // État du deferredPrompt
        console.log('État deferredPrompt:', deferredPrompt);

        console.log('=== FIN DIAGNOSTIC ===');

        return isStandalone;
    }

    // Fonction pour vérifier si l'app est déjà installée
    async function checkInstallState() {
        if (window.matchMedia('(display-mode: standalone)').matches) {
            console.log('Application déjà installée');
            document.getElementById('installButton').style.display = 'none';
            return true;
        }
        return false;
    }

    // Fonction d'installation avec diagnostic et feedback
    async function installPWA() {
        console.log('Tentative d\'installation...');

        // Vérifications préalables
        if (!('serviceWorker' in navigator)) {
            const toast = new mdb.Toast(document.getElementById('errorToast'));
            document.querySelector('#errorToast .toast-body').innerHTML =
                '<i class="fas fa-exclamation-circle me-2"></i>Votre navigateur ne supporte pas les PWA';
            toast.show();
            return;
        }

        // Exécuter le diagnostic
        const isInstalled = await diagnosticPWA();

        if (isInstalled) {
            console.log('L\'application est déjà installée');
            return;
        }

        if (!deferredPrompt) {
            console.log('Raisons possibles de non-installabilité :');
            console.log('- Le navigateur ne supporte pas l\'installation PWA');
            console.log('- Les critères d\'installation ne sont pas tous remplis');
            console.log('- L\'utilisateur a récemment refusé l\'installation');

            const toast = new mdb.Toast(document.getElementById('errorToast'));
            document.querySelector('#errorToast .toast-body').innerHTML =
                '<i class="fas fa-exclamation-circle me-2"></i>Diagnostic disponible dans la console (F12)';
            toast.show();
            return;
        }

        try {
            // Afficher l'indicateur de chargement
            document.getElementById('loadingOverlay').classList.add('show');

            // Déclencher le prompt d'installation
            deferredPrompt.prompt();
            const result = await deferredPrompt.userChoice;

            if (result.outcome === 'accepted') {
                console.log('Installation acceptée');
                document.getElementById('installButton').style.display = 'none';
                const toast = new mdb.Toast(document.getElementById('successToast'));
                document.querySelector('#successToast .toast-body').innerHTML =
                    '<i class="fas fa-check-circle me-2"></i>Installation réussie !';
                toast.show();
            } else {
                console.log('Installation refusée');
                const toast = new mdb.Toast(document.getElementById('errorToast'));
                document.querySelector('#errorToast .toast-body').innerHTML =
                    '<i class="fas fa-info-circle me-2"></i>Installation annulée';
                toast.show();
            }
        } catch (error) {
            console.error('Erreur lors de l\'installation:', error);
            const toast = new mdb.Toast(document.getElementById('errorToast'));
            document.querySelector('#errorToast .toast-body').innerHTML =
                '<i class="fas fa-exclamation-circle me-2"></i>Erreur lors de l\'installation';
            toast.show();
        } finally {
            deferredPrompt = null;
            document.getElementById('loadingOverlay').classList.remove('show');
        }
    }

    // Écouteurs d'événements pour l'installation
    window.addEventListener('beforeinstallprompt', (e) => {
        console.log('🎉 Event beforeinstallprompt déclenché');
        e.preventDefault();
        deferredPrompt = e;
        document.getElementById('installButton').style.display = 'flex';
    });

    window.addEventListener('appinstalled', (e) => {
        console.log('✅ Application installée avec succès');
        document.getElementById('installButton').style.display = 'none';
    });

    // Initialisation au chargement
    window.addEventListener('load', async () => {
        console.log('📱 Chargement de l\'application...');

        if ('serviceWorker' in navigator) {
            try {
                // Enregistrer le Service Worker (ne plus désinscrire systématiquement)
                const registration = await navigator.serviceWorker.register('/service-worker.js', {
                    scope: '/',
                    updateViaCache: 'none'
                });
                console.log('✅ Service Worker enregistré avec succès:', registration.scope);

                // Gestion de la notification de mise à jour
                navigator.serviceWorker.addEventListener('message', function(event) {
                    if (event.data && event.data.type === 'SW_UPDATE_AVAILABLE') {
                        // Affiche le toast de mise à jour
                        const toast = document.getElementById('installToast');
                        toast.querySelector('.toast-body').innerHTML = `
                            <i class="fas fa-sync-alt me-2"></i>
                            Nouvelle version disponible&nbsp;!
                            <button class="btn btn-sm btn-light ms-2" onclick="location.reload()">Recharger</button>
                        `;
                        new mdb.Toast(toast).show();
                    }
                });
            } catch (error) {
                console.error('❌ Erreur d\'enregistrement du Service Worker:', error);
                console.error('Détails:', {
                    message: error.message,
                    stack: error.stack
                });
            }
        }

        await diagnosticPWA();
    });

    const collapseList = document.querySelectorAll('.collapse');
    collapseList.forEach((collapse) => {
        // Force la fermeture de tous les sous-menus au démarrage
        collapse.classList.remove('show');
        // Initialise le composant collapse de MDB
        new mdb.Collapse(collapse, {
            toggle: false
        });
    });

    let deferredPrompt;
    const installBanner = document.getElementById('installBanner');
    const installBtn = document.getElementById('installBtn');
    const closeBanner = document.getElementById('closeBanner');
    const installText = document.getElementById('installText');

    // Affichage pour Android/Chrome
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        installBanner.style.display = 'block';
        installBtn.style.display = 'inline-block';
        installText.textContent = "Voulez-vous installer l'application ?";
    });

    installBtn.addEventListener('click', () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                installBanner.style.display = 'none';
                deferredPrompt = null;
            });
        }
    });

    closeBanner.addEventListener('click', () => {
        installBanner.style.display = 'none';
    });

    // Affichage pour iOS/Safari
    function isIos() {
        return /iphone|ipad|ipod/.test(window.navigator.userAgent.toLowerCase());
    }
    function isInStandaloneMode() {
        return ('standalone' in window.navigator) && window.navigator.standalone;
    }
    if (isIos() && !isInStandaloneMode()) {
        installBanner.style.display = 'block';
        installBtn.style.display = 'none';
        installText.innerHTML = "Pour installer l'application, cliquez sur <img src='/icons/ios-share.png' style='height:1em;vertical-align:middle;'> puis 'Sur l'écran d'accueil'";
    }
</script>


</html>