document.addEventListener('DOMContentLoaded', function () {
  const stickyNotification = document.getElementById('stickyNotification');
  const loadingPlaceholder = document.getElementById('loadingPlaceholder');

  // Моделюємо завантаження через певний час
  setTimeout(function () {
    updateNotification('busy');
    setTimeout(function () {
      updateNotification('full');
    }, 3000); // Затримка для ефекту
  }, 3000); // Затримка для ефекту

  function updateNotification(status) {
    stickyNotification.classList.remove('free', 'busy', 'full');
    stickyNotification.classList.add(status);

    switch (status) {
      case 'free':
        stickyNotification.innerText = 'Geringe Wartezeit';
        break;
      case 'busy':
        stickyNotification.innerText = 'Mittlere Wartezeit';
        break;
      case 'full':
        stickyNotification.innerText = 'Lange Wartezeit';
        break;
    }
  }
  setTimeout(function () {
    updateNotification('free');
  }, 9000);
});
