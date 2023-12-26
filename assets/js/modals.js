var modal = document.getElementById('modal');
var bookingModal = document.getElementById('myModal');
var menuModal = document.getElementById('menuModal');

window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  } else if (event.target === bookingModal) {
    bookingModal.style.display = 'none';
  } else if (event.target === menuModal) {
    menuModal.style.display = 'none';
  }
};

function escCloseModal(modal) {
  modal.style.display = 'none';
}
window.addEventListener('keydown', function (event) {
  if (event.key === 'Escape') {
    escCloseModal(modal);
    escCloseModal(bookingModal);
    escCloseModal(menuModal);
  }
});
