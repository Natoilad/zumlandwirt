let notifText = document.getElementById("notificationText");
const loading = document.getElementById("loading");
const stickyNotification = document.getElementById("stickyNotification");

document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("scroll", function () {
    if (
      window.scrollY + window.innerHeight >=
      document.documentElement.scrollHeight
    ) {
      loading.style.opacity = "0";
    } else {
      loading.style.opacity = "1";
    }
  });
  function fetchWorkload() {
    fetch("showroom/php/getWorkload.php")
      .then((response) => response.json())
      .then((data) => {
        var status = data.workload;
        updateNotification(status);
      })
      .catch((error) => {
        console.error("Error fetching workload:", error);
        updateNotification(0);
      });
  }
  function updateNotification(status) {
    const tempStatus = `${status * 2}`;
    if (tempStatus == 0) {
      renderSquares(0, 0, 0, 10);
      updateLevel(tempStatus);
    } else if (tempStatus >= 1 && tempStatus <= 10) {
      renderSquares(1, 0, 0, 9);
      updateLevel(tempStatus);
    } else if (tempStatus >= 11 && tempStatus <= 20) {
      renderSquares(2, 0, 0, 8);
      updateLevel(tempStatus);
    } else if (tempStatus >= 21 && tempStatus <= 30) {
      renderSquares(3, 0, 0, 7);
      updateLevel(tempStatus);
    } else if (tempStatus >= 31 && tempStatus <= 40) {
      renderSquares(0, 4, 0, 6);
      updateLevel(tempStatus);
    } else if (tempStatus >= 41 && tempStatus <= 50) {
      renderSquares(0, 5, 0, 5);
      updateLevel(tempStatus);
    } else if (tempStatus >= 51 && tempStatus <= 60) {
      renderSquares(0, 6, 0, 4);
      updateLevel(tempStatus);
    } else if (tempStatus >= 61 && tempStatus <= 70) {
      renderSquares(0, 7, 0, 3);
      updateLevel(tempStatus);
    } else if (tempStatus >= 71 && tempStatus <= 80) {
      renderSquares(0, 0, 8, 2);
      updateLevel(tempStatus);
    } else if (tempStatus >= 81 && tempStatus <= 90) {
      renderSquares(0, 0, 9, 1);
      updateLevel(tempStatus);
    } else if (tempStatus >= 91 && tempStatus <= 100) {
      renderSquares(0, 0, 10, 0);
      updateLevel(tempStatus);
    } else {
      renderSquares(0, 0, 10, 0);
      updateLevel(tempStatus);
    }
  }
  function updateLevel(level) {
    notifText.innerText = `${level}% Momentane Besucher`;
  }
  function renderSquares(greenCount, yellowCount, redCount, whiteCount) {
    stickyNotification.innerHTML = "";
    for (let i = 0; i < greenCount; i++) {
      const greenSquare = document.createElement("div");
      greenSquare.classList.add("square", "green-square");
      stickyNotification.appendChild(greenSquare);
    }
    for (let i = 0; i < yellowCount; i++) {
      const yellowSquare = document.createElement("div");
      yellowSquare.classList.add("square", "yellow-square");
      stickyNotification.appendChild(yellowSquare);
    }
    for (let i = 0; i < redCount; i++) {
      const redSquare = document.createElement("div");
      redSquare.classList.add("square", "red-square");
      stickyNotification.appendChild(redSquare);
    }
    for (let i = 0; i < whiteCount; i++) {
      const whiteSquare = document.createElement("div");
      whiteSquare.classList.add("square", "white-square");
      stickyNotification.appendChild(whiteSquare);
    }
  }
  fetchWorkload();
});
