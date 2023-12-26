var modal = document.getElementById('myModal');
var btn = document.getElementById('stickyBtn');
var closebtn = document.querySelector('.close');
btn.onclick = function () {
  modal.style.display = 'block';
};
closebtn.onclick = function () {
  modal.style.display = 'none';
};
