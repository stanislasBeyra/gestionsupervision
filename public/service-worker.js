const CACHE_NAME = 'Mtn-v1';

const STATIC_RESOURCES = [
  '/',
  '/index.html',
  '/manifest.json',
  '/icons/icon-144.png',
  '/icons/icon-192.png',
  '/icons/icon-512.png',
  '/icons/maskable-192.png',
  '/icons/maskable-512.png',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
  'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
  'https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js'
];

// Installation du Service Worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    (async () => {
      const cache = await caches.open(CACHE_NAME);
      await cache.addAll(STATIC_RESOURCES);
      await self.skipWaiting();
    })()
  );
});

// Activation du Service Worker
self.addEventListener('activate', (event) => {
  event.waitUntil(
    (async () => {
      // Nettoyage des anciens caches
      const keys = await caches.keys();
      await Promise.all(
        keys.map((key) => {
          if (key !== CACHE_NAME) {
            return caches.delete(key);
          }
        })
      );
      await self.clients.claim();
    })()
  );
});

// Stratégie de cache : Network First avec fallback sur le cache
self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') return;

  event.respondWith(
    (async () => {
      try {
        // On essaie d'abord avec le réseau
        const networkResponse = await fetch(event.request);
        const cache = await caches.open(CACHE_NAME);
        
        // On met en cache la nouvelle réponse
        cache.put(event.request, networkResponse.clone());
        
        return networkResponse;
      } catch (error) {
        // En cas d'erreur réseau, on utilise le cache
        const cachedResponse = await caches.match(event.request);
        if (cachedResponse) {
          return cachedResponse;
        }
        
        // Si la ressource n'est pas dans le cache et que c'est une navigation
        if (event.request.mode === 'navigate') {
          return caches.match('/');
        }
        
        throw error;
      }
    })()
  );
});