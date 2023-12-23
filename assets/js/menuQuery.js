function showFood() {
  // Показуємо елемент foodPrice та приховуємо drinkPrice
  document.getElementById('foodPrice').style.display = 'block';
  document.getElementById('drinkPrice').style.display = 'none';
}

function showDrink() {
  // Показуємо елемент drinkPrice та приховуємо foodPrice
  document.getElementById('drinkPrice').style.display = 'block';
  document.getElementById('foodPrice').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
  // Id of the section you want to load
  var sectionId = 'foods';

  // Path to the page containing the section
  var pageUrl = '/zumlandwirt.html';

  // Use fetch to load the content
  fetch(pageUrl)
    .then(response => response.text())
    .then(data => {
      // Create a temporary container element
      var tempContainer = document.createElement('div');
      tempContainer.innerHTML = data;

      // Extract the section content using the provided id
      var sectionContent = tempContainer.querySelector('#' + sectionId);

      if (sectionContent) {
        // Inject the loaded content into the placeholder
        document.getElementById('foodPrice').innerHTML =
          sectionContent.innerHTML;
      } else {
        console.error('Section not found in the loaded content.');
      }
    })
    .catch(error => console.error('Error loading content:', error));
});

document.addEventListener('DOMContentLoaded', function () {
  // Id of the section you want to load
  var sectionId = 'drinks';

  // Path to the page containing the section
  var pageUrl = '/zumlandwirt.html';

  // Use fetch to load the content
  fetch(pageUrl)
    .then(response => response.text())
    .then(data => {
      // Create a temporary container element
      var tempContainer = document.createElement('div');
      tempContainer.innerHTML = data;

      // Extract the section content using the provided id
      var sectionContent = tempContainer.querySelector('#' + sectionId);

      if (sectionContent) {
        // Inject the loaded content into the placeholder
        document.getElementById('drinkPrice').innerHTML =
          sectionContent.innerHTML;
      } else {
        console.error('Section not found in the loaded content.');
      }
    })
    .catch(error => console.error('Error loading content:', error));
});
