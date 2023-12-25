document.addEventListener('DOMContentLoaded', function () {
  const stickyNotification = document.getElementById('stickyNotification');
  // const loadingPlaceholder = document.getElementById('loadingPlaceholder');
  window.addEventListener('scroll', function () {
    // Коли прокручено до кінця сторінки
    if (
      window.scrollY + window.innerHeight >=
      document.documentElement.scrollHeight
    ) {
      stickyNotification.style.opacity = '0';
    } else {
      stickyNotification.style.opacity = '0.8';
    }
  });

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
