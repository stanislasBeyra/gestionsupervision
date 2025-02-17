// const CACHE_NAME = 'v1';
// const urlsToCache = [
//     '/',
//     '/index.html',  // Page principale
//     '/dashboard',  // Route Dashboard
//     '/created',    // Route Vue d'ensemble
//     '/environnementElement',  // Route Élément environnement
//     '/conpetanceElement',  // Route Élément compétence
//     '/etablissementsanitaire', // Route Établissement sanitaire
//     '/identifiantsuperviser', // Route Identifiants supervisés
//     '/idenfiantsuperviseurs',  // Route Identifiants superviseurs
//     '/synthesesupervision',  // Route Synthèse supervision
//     '/problemeprioritaire',  // Route Problèmes prioritaires
//     '/css/app.css',  // CSS
//     '/js/app.js',   // JavaScript
//     '/icons/icon-192x192.png',  // Icône 192x192
//     '/icons/icon-512x512.png',  // Icône 512x512
//     // Ajoutez ici toutes les autres pages ou ressources nécessaires
// ];

// // Installation du service worker
// self.addEventListener('install', (event) => {
//     event.waitUntil(
//         caches.open(CACHE_NAME)
//             .then((cache) => {
//                 console.log('Service Worker: Caching Files');
//                 return cache.addAll(urlsToCache);
//             })
//     );
// });

// // Activation du service worker et nettoyage des vieux caches
// self.addEventListener('activate', (event) => {
//     const cacheWhitelist = [CACHE_NAME];
//     event.waitUntil(
//         caches.keys().then((cacheNames) => {
//             return Promise.all(
//                 cacheNames.map((cacheName) => {
//                     if (!cacheWhitelist.includes(cacheName)) {
//                         return caches.delete(cacheName);
//                     }
//                 })
//             );
//         })
//     );
// });

// // Interception des requêtes et réponse depuis le cache ou réseau
// self.addEventListener('fetch', (event) => {
//     event.respondWith(
//         caches.match(event.request)
//             .then((cachedResponse) => {
//                 // Si une ressource est trouvée dans le cache, la retourner
//                 if (cachedResponse) {
//                     return cachedResponse;
//                 }
//                 // Sinon, tenter de récupérer depuis le réseau
//                 return fetch(event.request);
//             })
//     );
// });


const CACHE_NAME = 'v1';
const urlsToCache = [
    '/',
    '/index.html',  // Page principale
    '/dashboard',  // Route Dashboard
    '/created',    // Route Vue d'ensemble
    '/environnementElement',  // Route Élément environnement
    '/conpetanceElement',  // Route Élément compétence
    '/etablissementsanitaire', // Route Établissement sanitaire
    '/identifiantsuperviser', // Route Identifiants supervisés
    '/idenfiantsuperviseurs',  // Route Identifiants superviseurs
    '/synthesesupervision',  // Route Synthèse supervision
    '/problemeprioritaire',  // Route Problèmes prioritaires
    '/css/app.css',  // Votre CSS personnalisé
    '/js/app.js',   // Votre JS personnalisé
    '/icons/icon-192x192.png',  // Icône 192x192
    '/icons/icon-512x512.png',  // Icône 512x512
    // Vous pouvez ajouter d'autres ressources ici si nécessaire
];

// Installation du service worker
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('Service Worker: Caching Files');
                return cache.addAll(urlsToCache);
            })
    );
});

// Activation du service worker et nettoyage des vieux caches
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Interception des requêtes et réponse depuis le cache ou réseau
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
            .then((cachedResponse) => {
                // Si la ressource est dans le cache, la retourner
                if (cachedResponse) {
                    return cachedResponse;
                }

                // Si la ressource n'est pas dans le cache, essayer de la récupérer depuis le réseau
                return fetch(event.request).catch(() => {
                    // Si hors ligne, retourner un fallback
                    if (event.request.url.includes('.html')) {
                        return caches.match('/index.html');  // Fallback page
                    }

                    if (event.request.url.includes('.png') || event.request.url.includes('.jpg')) {
                        return caches.match('/icons/icon-192x192.png');  // Fallback image
                    }
                });
            })
    );
});

 




// const CACHE_NAME = 'v1-cache';
// const CACHE_URLS = [
//     '/', 
//     '/index.html', 
//     '/css/app.css',
//     '/js/app.js',
//     '/icons/icon-192x192.png',
//     '/icons/icon-512x512.png',
//     '/favicon.ico'
// ];

// // Installation du Service Worker et mise en cache des ressources
// self.addEventListener('install', (event) => {
//     console.log('Service Worker: Installation');

//     // Installation et ajout des ressources dans le cache
//     event.waitUntil(
//         caches.open(CACHE_NAME)
//             .then((cache) => {
//                 console.log('Service Worker: Mise en cache des ressources');
//                 return cache.addAll(CACHE_URLS);
//             })
//     );
// });

// // Activation du Service Worker
// self.addEventListener('activate', (event) => {
//     console.log('Service Worker: Activation');
//     // Supprimez les anciens caches si nécessaire
//     event.waitUntil(
//         caches.keys().then((cacheNames) => {
//             return Promise.all(
//                 cacheNames.map((cacheName) => {
//                     if (cacheName !== CACHE_NAME) {
//                         console.log('Service Worker: Suppression du cache obsolète', cacheName);
//                         return caches.delete(cacheName);
//                     }
//                 })
//             );
//         })
//     );
// });

// // Gestion des requêtes réseau (fetch) pour servir les fichiers depuis le cache
// self.addEventListener('fetch', (event) => {
//     console.log('Service Worker: Interception de la requête', event.request.url);
    
//     event.respondWith(
//         caches.match(event.request)
//             .then((cachedResponse) => {
//                 // Si la requête est dans le cache, on la retourne
//                 if (cachedResponse) {
//                     console.log('Service Worker: Réponse depuis le cache', event.request.url);
//                     return cachedResponse;
//                 }
//                 // Sinon, on fait une requête réseau normale
//                 return fetch(event.request);
//             })
//     );
// });
