const CACHE_NAME = 'kerjo-cache-v1';
const OFFLINE_URL = '/offline';

// File yang ingin dicache
const FILES_TO_CACHE = [
  '/',
  OFFLINE_URL,
  '/assets/css/bootstrap.min.css',
  '/assets/css/app.min.css',
  '/assets/js/app.js',
];

// Saat service worker di-install
self.addEventListener('install', event => {
  console.log('[ServiceWorker] Install');
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(FILES_TO_CACHE);
    })
  );
  self.skipWaiting();
});

// Saat service worker diaktifkan
self.addEventListener('activate', event => {
  console.log('[ServiceWorker] Activate');
  event.waitUntil(
    caches.keys().then(keyList =>
      Promise.all(
        keyList.map(key => {
          if (key !== CACHE_NAME) {
            console.log('[ServiceWorker] Removing old cache:', key);
            return caches.delete(key);
          }
        })
      )
    )
  );
  self.clients.claim();
});

// Saat fetch request
self.addEventListener('fetch', event => {
  event.respondWith(
    fetch(event.request)
      .then(response => {
        return response;
      })
      .catch(error => {
        return caches.match(event.request).then(cachedResponse => {
          return cachedResponse || caches.match(OFFLINE_URL);
        });
      })
  );
});
