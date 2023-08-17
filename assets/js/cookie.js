const cookieRichtlinie = document.querySelector('.cookieRichtlinie-js');
const cookieBtn = document.querySelector('.cookieRichtlinie_btn-js');
const cookie_btn = document.querySelector('.cookie_btn-js');

const getCookies = () => {
  if (document.cookie) {
    cookieRichtlinie.style.display = 'none';
  } else {
    cookieRichtlinie.style.display = 'block';
  }
};

const setCookie = (name, value, days) => {
  var date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  var expires = 'expires=' + date.toUTCString();

  document.cookie = name + '=' + value + ';' + expires + ';path=/';

  console.log('hello');
};
cookieBtn.onclick = function () {
  setCookie('cookie', 'cookie', 30); //30days
  cookieRichtlinie.style.display = 'none';
};
cookie_btn.onclick = function () {
  cookieRichtlinie.style.display = 'block';
};
getCookies();
