navigator.serviceWorker && navigator.serviceWorker.register('https://smashsdgs.me/sw.js').then(function(registration) {
  console.log('Excellent, registered with scope: ', registration.scope);
});
