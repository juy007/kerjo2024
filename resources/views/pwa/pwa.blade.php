<link rel="manifest" href="{{ asset('pwa/manifest.json') }}">
<meta name="theme-color" content="#4CAF50">

<script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/pwa/serviceworker.js')
      .then(() => console.log('Service Worker Registered'));
  }
</script>
