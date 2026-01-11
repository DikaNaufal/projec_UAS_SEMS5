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
<title>Predict Your Academic Future</title>

<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/science-bg-predict.css">

<style>
.predict-container {
  position: relative;
  z-index: 2;
  max-width: 900px;
  margin: auto;
  padding: 60px 30px;
  text-align: center;
}

.predict-box {
  background: rgba(25, 20, 40, 0.85);
  border-radius: 22px;
  padding: 35px;
  box-shadow: 0 0 35px rgba(168,85,247,.25);
}

.predict-box h1 {
  color: #c084fc;
  margin-bottom: 10px;
}

.predict-box p {
  color: #cbd5f5;
  font-size: 14px;
  margin-bottom: 25px;
}

.predict-inputs {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
  gap: 15px;
}

.predict-inputs input,
.predict-inputs select {
  padding: 12px;
  border-radius: 10px;
  border: none;
  outline: none;
}

.predict-box button {
  margin-top: 20px;
  padding: 12px 26px;
  border-radius: 12px;
  border: none;
  font-weight: bold;
  background: linear-gradient(135deg,#a855f7,#22d3ee);
  color: #000;
  cursor: pointer;
}

.result-card {
  margin-top: 30px;
  padding: 20px;
  border-radius: 16px;
  background: rgba(0,0,0,.4);
  color: #e9d5ff;
  display: none;
}
</style>
</head>

<body>
<div class="science-bg"></div>

<div class="predict-container">
  <div class="predict-box">
    <h1>🔮 Academic Future Predictor</h1>
    <p>Berbasis statistik, realita kampus, dan sedikit humor.</p>

    <div class="predict-inputs">
      <input type="number" id="gpa" step="0.01" placeholder="IPK Saat Ini">
      <input type="number" id="sks" placeholder="Total SKS">
      <select id="sleep">
        <option value="low">Sering Begadang</option>
        <option value="mid">Tidur Normal</option>
        <option value="high">Tidur Ideal</option>
      </select>
    </div>

    <button onclick="predict()">Predict</button>

    <div class="result-card" id="result"></div>
  </div>
</div>

<script>
function predict() {
  const gpa = parseFloat(document.getElementById("gpa").value);
  const sleep = document.getElementById("sleep").value;

  if (!gpa) return alert("Masukkan IPK dulu.");

  let msg = "";
  if (gpa >= 3.75) msg = "🧠 Kamu tipe researcher elite. Dosen mulai ingat namamu.";
  else if (gpa >= 3.3) msg = "📊 Stabil dan menjanjikan. Tinggal jaga konsistensi.";
  else if (gpa >= 2.8) msg = "⚠️ Masih aman, tapi masa depan butuh strategi.";
  else msg = "🔥 Banyak plot twist, tapi masih bisa sukses.";

  if (sleep === "low") msg += "<br>😴 Catatan: Begadang menurunkan performa kognitif.";
  if (sleep === "high") msg += "<br>💤 Tidur ideal meningkatkan memori & fokus.";

  result.style.display = "block";
  result.innerHTML = msg;
}
</script>

</body>
</html>
