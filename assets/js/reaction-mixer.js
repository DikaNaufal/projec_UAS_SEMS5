let red = 0;
let blue = 0;
let total = 0;

const liquid = document.getElementById("liquid");
const statusText = document.getElementById("status");

function updateLiquid() {
  total = red + blue;
  let height = Math.min(total * 10, 100);
  liquid.style.height = height + "%";

  if (red > 0 && blue > 0) {
    // mix color
    liquid.style.background = "purple";
  } else if (red > blue) {
    liquid.style.background = "red";
  } else if (blue > red) {
    liquid.style.background = "blue";
  }

  checkResult();
}

function addRed() {
  red++;
  updateLiquid();
}

function addBlue() {
  blue++;
  updateLiquid();
}

function checkResult() {
  if (red === blue && total >= 4) {
    statusText.innerText = "✅ Stable Reaction: PURPLE created!";
    saveScore(100);
    resetAfterDelay();
  }
  else if (total >= 10) {
    statusText.innerText = "💥 Overreaction! Mixture unstable";
    boom();
    resetAfterDelay();
  }
}

function resetAfterDelay() {
  setTimeout(() => {
    red = blue = total = 0;
    liquid.style.height = "0%";
    liquid.style.background = "transparent";
    statusText.innerText = "";
  }, 2000);
}

/* ---------- LOTTIE ---------- */
function boom() {
  document.getElementById("boom").innerHTML = "";
  lottie.loadAnimation({
    container: document.getElementById("boom"),
    renderer: "svg",
    loop: false,
    autoplay: true,
    path: "../assets/lottie/explosion.json"
  });
}

/* ---------- SAVE SCORE ---------- */
function saveScore(score) {
  fetch("../api/save_score.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "score=" + score
  });
}
