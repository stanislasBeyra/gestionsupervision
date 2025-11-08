// Nom du cache
const STATIC_CACHE = 'static-v2';
const API_CACHE = 'api-v1';
const PAGES_CACHE = 'pages-v1';

// Fichiers à pré-cacher (assets statiques)
const STATIC_ASSETS = [
  '/',
  '/manifest.json',
  '/css/app.css',
  '/js/app.js',
  '/favicon.ico',
];

// Pages importantes à pré-cacher pour le mode offline
const IMPORTANT_PAGES = [
  '/dashboard',
  '/etablissementsanitaire',
  '/identifiantsuperviser',
  '/identifiantsuperviseurs',
  '/synthesesupervision',
  '/problemeprioritaire',
  '/environnementElement',
  '/conpetanceElement',
  '/created',
  '/profile',
  '/login',
  '/register',
];

// Installation : pré-cache les assets statiques et les pages importantes
self.addEventListener('install', event => {
  self.skipWaiting();
  event.waitUntil(
    Promise.all([
      // Cache des assets statiques
      caches.open(STATIC_CACHE).then(cache => {
        return Promise.allSettled(
          STATIC_ASSETS.map(url => {
            return cache.add(url).catch(err => {
              console.warn(`Impossible de mettre en cache ${url}:`, err);
              return null;
            });
          })
        );
      }),
      // Cache des pages importantes
      caches.open(PAGES_CACHE).then(cache => {
        return Promise.allSettled(
          IMPORTANT_PAGES.map(url => {
            return cache.add(url).catch(err => {
              console.warn(`Impossible de mettre en cache la page ${url}:`, err);
              return null;
            });
          })
        );
      })
    ])
  );
  
  // Notification de mise à jour
  self.clients.matchAll().then(clients => {
    clients.forEach(client => {
      client.postMessage({ type: 'SW_UPDATE_AVAILABLE' });
    });
  });
});

// Activation : nettoyage des anciens caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.filter(key => key !== STATIC_CACHE && key !== API_CACHE && key !== PAGES_CACHE)
          .map(key => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

// Fetch :
// - Network first pour les API (cache fallback)
// - Network first avec cache fallback pour les pages HTML (permet de voir les pages non visitées en offline)
// - Cache first pour les assets statiques
self.addEventListener('fetch', event => {
  const req = event.request;
  const url = new URL(req.url);

  // Ignorer les requêtes non-GET
  if (req.method !== 'GET') {
    return;
  }

  // API dynamique
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(networkFirst(req));
  } 
  // Pages HTML (routes de l'application)
  else if (req.headers.get('accept')?.includes('text/html')) {
    event.respondWith(networkFirstWithPagesCache(req));
  }
  // Assets statiques (CSS, JS, images, etc.)
  else {
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

// Stratégie network first avec cache fallback pour les pages HTML
// Permet d'accéder aux pages pré-cachées même si jamais visitées
async function networkFirstWithPagesCache(req) {
  try {
    // Essayer d'abord le réseau
    const fresh = await fetch(req);
    // Mettre en cache la réponse
    const cache = await caches.open(PAGES_CACHE);
    cache.put(req, fresh.clone());
    return fresh;
  } catch (e) {
    // Si offline, chercher dans le cache des pages
    const pagesCache = await caches.open(PAGES_CACHE);
    const cached = await pagesCache.match(req);
    if (cached) {
      return cached;
    }
    // Si pas dans le cache des pages, chercher dans le cache statique
    const staticCache = await caches.open(STATIC_CACHE);
    const staticCached = await staticCache.match(req);
    return staticCached || new Response('Page non disponible en mode offline', {
      status: 503,
      headers: { 'Content-Type': 'text/html' }
    });
  }
}

// Stratégie cache first pour les assets
async function cacheFirst(req) {
  const cache = await caches.open(STATIC_CACHE);
  const cached = await cache.match(req);
  return cached || fetch(req);
}
