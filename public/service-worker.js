// Nom du cache
const STATIC_CACHE = 'static-v1';
const API_CACHE = 'api-v1';

// Fichiers à pré-cacher (adapter selon ton projet)
const STATIC_ASSETS = [
  '/',
  '/manifest.json',
  '/css/app.css',
  '/js/app.js',
  '/favicon.ico',
  // Ajoute ici d'autres assets importants
];

// Installation : pré-cache les assets statiques
self.addEventListener('install', event => {
  self.skipWaiting();
  event.waitUntil(
    caches.open(STATIC_CACHE).then(cache => cache.addAll(STATIC_ASSETS))
  );
});

// Activation : nettoyage des anciens caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.filter(key => key !== STATIC_CACHE && key !== API_CACHE)
          .map(key => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

// Fetch :
// - Network first pour les API (cache fallback)
// - Cache first pour les assets statiques
self.addEventListener('fetch', event => {
  const req = event.request;
  const url = new URL(req.url);

  // API dynamique (adapter le chemin si besoin)
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(networkFirst(req));
  } else {
    event.respondWith(cacheFirst(req));
  }
});

// Stratégie network first pour les API
async function networkFirst(req) {
  try {
    const fresh = await fetch(req);
    const cache = await caches.open(API_CACHE);
    cache.put(req, fresh.clone());
    return fresh;
  } catch (e) {
    const cache = await caches.open(API_CACHE);
    const cached = await cache.match(req);
    return cached || new Response(JSON.stringify({ success: false, message: 'Offline' }), { status: 503, headers: { 'Content-Type': 'application/json' } });
  }
}

// Stratégie cache first pour les assets
async function cacheFirst(req) {
  const cache = await caches.open(STATIC_CACHE);
  const cached = await cache.match(req);
  return cached || fetch(req);
}

// Notification de mise à jour
self.addEventListener('install', event => {
  self.skipWaiting();
  self.clients.matchAll().then(clients => {
    clients.forEach(client => {
      client.postMessage({ type: 'SW_UPDATE_AVAILABLE' });
    });
  });
});