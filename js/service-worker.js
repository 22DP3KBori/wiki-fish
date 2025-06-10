self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open('ndarbs-cache').then(function(cache) {
      return cache.addAll([
        '/',
        '/html/main.php',
        '/css/style.css'
      ]);
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
});
