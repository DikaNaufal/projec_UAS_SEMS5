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
<title>Science Tools</title>

<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/science-bg-physics.css">

<style>
.tools-container {
  position: relative;
  z-index: 2;
  max-width: 1100px;
  margin: auto;
  padding: 40px;
}

.tools-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
}

.tool-card {
  background: rgba(20, 25, 40, 0.85);
  border-radius: 18px;
  padding: 25px;
  box-shadow: 0 0 25px rgba(0,191,255,.15);
  transition: transform .3s;
}

.tool-card:hover {
  transform: translateY(-6px);
}

.tool-card h2 {
  color: #00bfff;
  margin-bottom: 10px;
}

.tool-card input,
.tool-card select,
.tool-card button {
  width: 100%;
  padding: 10px;
  margin-top: 8px;
  border-radius: 8px;
  border: none;
  outline: none;
}

.tool-card button {
  background: linear-gradient(135deg, #00bfff, #00ffe1);
  color: #000;
  font-weight: bold;
  cursor: pointer;
}

.result {
  margin-top: 12px;
  color: #00ffe1;
  font-size: 14px;
}
</style>
</head>

<body>
<div class="science-bg"></div>

<div class="tools-container">
  <h1>🛠 Science Tools for Students</h1>
  <p>Alat bantu sains ringan untuk survive di lab & kampus.</p>

  <div class="tools-grid">

    <!-- ☕ COFFEE TIMER -->
    <div class="tool-card">
      <h2>☕ Science Coffee Timer</h2>
      <label>Suhu Air (°C)</label>
      <input type="number" id="temp" placeholder="Contoh: 90">

      <label>Metode</label>
      <select id="method">
        <option value="pour">Pour Over</option>
        <option value="french">French Press</option>
        <option value="espresso">Espresso</option>
      </select>

      <button onclick="brewCoffee()">Brew</button>
      <div class="result" id="coffeeResult"></div>
    </div>

    <!-- ⚡ PHYSICS CALC -->
    <div class="tool-card">
      <h2>⚡ Physics Quick Calc</h2>
      <label>Energi (Joule)</label>
      <input type="number" id="energy">

      <label>Waktu (detik)</label>
      <input type="number" id="time">

      <button onclick="calcPower()">Hitung Daya</button>
      <div class="result" id="physicsResult"></div>
    </div>

    <!-- 🧪 CHEMISTRY -->
    <div class="tool-card">
      <h2>🧪 Chemistry Helper</h2>
      <label>pH Larutan</label>
      <input type="number" step="0.1" id="ph">

      <button onclick="checkPH()">Analisis</button>
      <div class="result" id="chemResult"></div>
    </div>

    <!-- 🧠 FUN FACT -->
    <div class="tool-card">
      <h2>🧠 Science Insight</h2>
      <p id="fact"></p>
      <button onclick="newFact()">Insight Baru</button>
    </div>

  </div>
</div>

<script>
/* ☕ COFFEE */
function brewCoffee() {
  const t = parseFloat(temp.value);
  const m = method.value;
  if (!t) return coffeeResult.innerText = "Masukkan suhu air.";

  let base = m === "espresso" ? 25 : m === "french" ? 240 : 180;
  let adj = Math.max(0, (95 - t) * 2);

  coffeeResult.innerText =
    `⏱ Waktu seduh: ${base + adj} detik\n📐 Berdasarkan kinetika reaksi ekstraksi kopi`;
}

/* ⚡ PHYSICS */
function calcPower() {
  const e = energy.value;
  const t = time.value;
  if (!e || !t) return physicsResult.innerText = "Data belum lengkap.";

  physicsResult.innerText =
    `⚡ Daya = ${(e / t).toFixed(2)} Watt`;
}

/* 🧪 CHEM */
function checkPH() {
  const p = ph.value;
  let type = "Netral";
  if (p < 7) type = "Asam";
  if (p > 7) type = "Basa";

  chemResult.innerText =
    `🧪 Larutan bersifat ${type}`;
}

/* 🧠 FACT */
const facts = [
  "Belajar malam meningkatkan dopamin, bukan fokus.",
  "Otak butuh glukosa, bukan kopi berlebihan.",
  "Air panas mengekstraksi kafein lebih cepat.",
  "Begadang menurunkan memori kerja hingga 40%."
];

function newFact() {
  fact.innerText = facts[Math.floor(Math.random() * facts.length)];
}
newFact();
</script>

</body>
</html>
