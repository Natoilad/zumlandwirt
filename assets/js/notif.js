document.addEventListener('DOMContentLoaded', function () {
  const stickyNotification = document.getElementById('stickyNotification');
  window.addEventListener('scroll', function () {
    if (
      window.scrollY + window.innerHeight >=
      document.documentElement.scrollHeight
    ) {
      stickyNotification.style.opacity = '0';
    } else {
      stickyNotification.style.opacity = '0.8';
    }
  });
  setTimeout(function () {
    updateNotification('busy');
    setTimeout(function () {
      updateNotification('full');
    }, 3000);
  }, 3000);
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
    updateNotification('busy');
  }, 9000);
});
