<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../auth/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Reaction Mixer</title>

<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/science-bg-chemistry.css">

<style>
.game-container {
  position: relative;
  z-index: 2;
  max-width: 700px;
  margin: auto;
  padding: 60px 20px;
  text-align: center;
}

.reactor {
  width: 140px;
  height: 340px;
  margin: 30px auto;
  border-radius: 30px;
  border: 3px solid rgba(255,255,255,.5);
  background: linear-gradient(to top, #111, #222);
  box-shadow: inset 0 0 25px rgba(0,0,0,.8);
  position: relative;
  overflow: hidden;
}

.liquid {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 0%;
  background: cyan;
  transition: all .4s;
}

.status {
  margin-top: 10px;
  font-size: 14px;
}

.controls {
  display: grid;
  grid-template-columns: repeat(2,1fr);
  gap: 12px;
  margin-top: 25px;
}

.controls button {
  padding: 12px;
  border-radius: 14px;
  border: none;
  font-weight: bold;
  cursor: pointer;
  background: rgba(255,255,255,.1);
  color: #fff;
}

.red { box-shadow: 0 0 15px rgba(255,0,0,.6); }
.blue { box-shadow: 0 0 15px rgba(0,150,255,.6); }
.green { box-shadow: 0 0 15px rgba(0,255,120,.6); }
.dark { box-shadow: 0 0 15px rgba(180,0,255,.6); }

.score {
  margin-top: 15px;
  font-size: 18px;
  color: #00ffe1;
}
</style>
</head>

<body>
<div class="science-bg"></div>

<div class="game-container">
  <h1>🧪 Reaction Mixer</h1>
  <p>Targetkan suhu stabil 45–55 tanpa meledak.</p>

  <div class="reactor">
    <div class="liquid" id="liquid"></div>
  </div>

  <div class="status" id="status">Suhu: 50</div>
  <div class="score">Score: <span id="score">0</span></div>

  <div class="controls">
    <button class="red" onclick="add('red')">+ Red</button>
    <button class="blue" onclick="add('blue')">+ Blue</button>
    <button class="green" onclick="add('green')">+ Stabilizer</button>
    <button class="dark" onclick="add('catalyst')">+ Catalyst</button>
  </div>
</div>

<script>
let temp = 50;
let score = 0;
let locked = false;

function updateUI() {
  liquid.style.height = temp + "%";
  liquid.style.background =
    temp > 70 ? "#ff0040" :
    temp < 30 ? "#00bfff" : "#00ffe1";

  status.innerText = `Suhu: ${temp}`;
}

function add(type) {
  if (locked) return;

  let delta = 0;

  if (type === "red") delta = Math.random() * 12 + 6;
  if (type === "blue") delta = -(Math.random() * 12 + 6);
  if (type === "green") delta = Math.random() * 6 - 3;
  if (type === "catalyst") delta *= 3 + 2;

  temp += Math.round(delta);

  // runaway
  if (temp >= 100 || temp <= 0) {
    explode();
    return;
  }

  // score window
  if (temp >= 45 && temp <= 55) {
    score += 10;
    scoreEl.innerText = score;
  }

  updateUI();
}

function explode() {
  locked = true;
  status.innerText = "💥 REACTION FAILED";
  liquid.style.background = "#ff003c";
  liquid.style.height = "100%";

  setTimeout(() => {
    temp = 50;
    locked = false;
    updateUI();
    status.innerText = "Reset Reaktor";
  }, 2000);
}

const liquid = document.getElementById("liquid");
const status = document.getElementById("status");
const scoreEl = document.getElementById("score");

updateUI();
</script>

</body>
</html>
