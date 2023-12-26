var modalwin = document.getElementById('menuModal');
var menuBtn = document.getElementById('menuBtn');
var closeBtn = document.querySelector('.closeBtn');
menuBtn.onclick = function () {
  modalwin.style.display = 'block';
};
closeBtn.onclick = function () {
  modalwin.style.display = 'none';
};
