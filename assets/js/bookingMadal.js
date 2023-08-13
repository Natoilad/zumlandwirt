var modal = document.getElementById('myModal');
var btn = document.getElementById('stickyBtn');
var closeBtn = document.querySelector('.close');

btn.onclick = function () {
  modal.style.display = 'block';
};

closeBtn.onclick = function () {
  modal.style.display = 'none';
  modalContent.style.transform = 'translateY(-100%)';
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = 'none';
    modalContent.style.transform = 'translateY(-100%)';
  }
};
