window.onload = function () {
  var modal = document.getElementById('modal');
  var closeButton = document.querySelector('.close-button');
  var modalShownTime = localStorage.getItem('modalShownTime');
  var resimoBtn = document.querySelector('.resimoBtn');
  var resimoContainer = document.querySelector('.resimoContainer');

  if (modalShownTime === null || modalShownTime < Date.now() - 86400000) {
    modal.style.display = 'block';
    localStorage.setItem('modalShownTime', Date.now());
  }

  closeButton.addEventListener('click', function () {
    modal.style.display = 'none';
  });
  resimoBtn.addEventListener('click', function () {
    if (resimoContainer.style.display === 'block') {
      resimoContainer.style.display = 'none';
    } else {
      resimoContainer.style.display = 'block';
    }
  });
};
