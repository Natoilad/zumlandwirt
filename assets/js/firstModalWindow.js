window.onload = function () {
  var modal = document.getElementById('modal');
  var closeButton = document.querySelector('.close-button');
  var modalShownTime = localStorage.getItem('modalShownTime');

  if (modalShownTime === null || modalShownTime < Date.now() - 86400000) {
    modal.style.display = 'block';
    localStorage.setItem('modalShownTime', Date.now());
  }

  closeButton.addEventListener('click', function () {
    modal.style.display = 'none';
  });

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
};
