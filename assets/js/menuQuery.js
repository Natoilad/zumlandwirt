function showFood() {
  document.getElementById('foodPrice').style.display = 'block';
  document.getElementById('drinkPrice').style.display = 'none';
  document.getElementById('foodBtn').style.backgroundColor =
    'rgb(103, 169, 74)';
  document.getElementById('drinkBtn').style.backgroundColor =
    'rgb(70, 160, 73)';
}
function showDrink() {
  document.getElementById('drinkPrice').style.display = 'block';
  document.getElementById('foodPrice').style.display = 'none';
  document.getElementById('drinkBtn').style.backgroundColor =
    'rgb(103, 169, 74)';
  document.getElementById('foodBtn').style.backgroundColor = 'rgb(70, 160, 73)';
}

function showSections(sectionIds, targetElementIds) {
  var pageUrl = '/zumlandwirt.html';
  fetch(pageUrl)
    .then(response => response.text())
    .then(data => {
      var tempContainer = document.createElement('div');
      tempContainer.innerHTML = data;
      for (var i = 0; i < sectionIds.length; i++) {
        var sectionContent = tempContainer.querySelector('#' + sectionIds[i]);
        var targetElement = document.getElementById(targetElementIds[i]);

        if (sectionContent && targetElement) {
          targetElement.innerHTML = sectionContent.innerHTML;
        } else {
          console.error(
            'Section or target element not found in the loaded content.'
          );
        }
      }
    })
    .catch(error => console.error('Error loading content:', error));
}

document.addEventListener('DOMContentLoaded', function () {
  showSections(['foods', 'drinks'], ['foodPrice', 'drinkPrice']);
});

// document.addEventListener('DOMContentLoaded', function () {
//   var sectionId = 'foods';
//   var pageUrl = '/zumlandwirt.html';
//   fetch(pageUrl)
//     .then(response => response.text())
//     .then(data => {
//       var tempContainer = document.createElement('div');
//       tempContainer.innerHTML = data;
//       var sectionContent = tempContainer.querySelector('#' + sectionId);
//       if (sectionContent) {
//         document.getElementById('foodPrice').innerHTML =
//           sectionContent.innerHTML;
//       } else {
//         console.error('Section not found in the loaded content.');
//       }
//     })
//     .catch(error => console.error('Error loading content:', error));
// });
// document.addEventListener('DOMContentLoaded', function () {
//   var sectionId = 'drinks';
//   var pageUrl = '/zumlandwirt.html';
//   fetch(pageUrl)
//     .then(response => response.text())
//     .then(data => {
//       var tempContainer = document.createElement('div');
//       tempContainer.innerHTML = data;
//       var sectionContent = tempContainer.querySelector('#' + sectionId);
//       if (sectionContent) {
//         document.getElementById('drinkPrice').innerHTML =
//           sectionContent.innerHTML;
//       } else {
//         console.error('Section not found in the loaded content.');
//       }
//     })
//     .catch(error => console.error('Error loading content:', error));
// });
