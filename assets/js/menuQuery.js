function showFood() {
  document.getElementById("foodPrice").style.display = "block";
  document.getElementById("drinkPrice").style.display = "none";
  document.getElementById("foodBtn").style.backgroundColor =
    "rgb(103, 169, 74)";
  document.getElementById("drinkBtn").style.backgroundColor =
    "rgb(70, 160, 73)";
}
function showDrink() {
  document.getElementById("drinkPrice").style.display = "block";
  document.getElementById("foodPrice").style.display = "none";
  document.getElementById("drinkBtn").style.backgroundColor =
    "rgb(103, 169, 74)";
  document.getElementById("foodBtn").style.backgroundColor = "rgb(70, 160, 73)";
}

function showSections(sectionIds, targetElementIds) {
  // var pageUrl = "/zumlandwirt.html";
  // var pageUrl = "http://showroom.zumlandwirt.biz/php/drinks.php";
  var pageUrl = "https://www.zumlandwirt.biz/showroom/";

  fetch(pageUrl)
    .then((response) => response.text())
    .then((data) => {
      var tempContainer = document.createElement("div");
      tempContainer.innerHTML = data;
      for (var i = 0; i < sectionIds.length; i++) {
        var sectionContent = tempContainer.querySelector("#" + sectionIds[i]);
        var targetElement = document.getElementById(targetElementIds[i]);

        if (sectionContent && targetElement) {
          targetElement.innerHTML = sectionContent.innerHTML;
        } else {
          console.error(
            "Section or target element not found in the loaded content."
          );
        }
      }
    })
    .catch((error) => console.error("Error loading content:", error));
}

document.addEventListener("DOMContentLoaded", function () {
  showSections(["foods", "drinks"], ["foodPrice", "drinkPrice"]);
});
