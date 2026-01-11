<?php include "../auth/auth_check.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/science-bg-chem-structure.css">

<style>
.card {
  background: rgba(10, 30, 35, 0.85);
  border: 1px solid rgba(0, 255, 255, 0.15);
  border-radius: 14px;
  padding: 20px;
  margin: 20px 0;
  box-shadow: 0 0 18px rgba(0, 255, 255, 0.08);
}

.profile-box {
  display: flex;
  gap: 16px;
  align-items: center;
}

.avatar {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background: linear-gradient(135deg, #00ffe7, #0099ff);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  font-weight: bold;
  color: #002023;
}

.profile-info p {
  margin: 4px 0;
  font-size: 14px;
  opacity: 0.85;
}

.about-btn {
  display: inline-block;
  padding: 12px 22px;
  border-radius: 12px;
  background: linear-gradient(135deg, #00ffe7, #0099ff);
  color: #002023;
  font-weight: 600;
  border: none;
  cursor: pointer;
  box-shadow: 0 0 18px rgba(0,255,255,0.25);
}

.about-btn:hover {
  opacity: 0.9;
}

.modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.65);
  z-index: 999;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: rgba(10, 30, 35, 0.95);
  border: 1px solid rgba(0,255,255,0.2);
  border-radius: 14px;
  padding: 22px;
  width: 90%;
  max-width: 420px;
  box-shadow: 0 0 30px rgba(0,255,255,0.15);
}

.close-btn {
  float: right;
  cursor: pointer;
  font-size: 18px;
}
</style>
</head>

<body class="dark">
<div class="science-bg"></div>

<div class="app-container">

<h2>Welcome, <?= $_SESSION['user']['username']; ?> 🧪</h2>

<div class="bento">
  <a href="play.php">🧬 Play</a>
  <a href="tools.php">☕ Tools</a>
  <a href="predict.php">📈 Predict</a>
  <a href="vibe.php">🎧 Vibe</a>
  <a href="leaderboard.php">🏆 Leaderboard</a>
</div>

<div class="card">
  <h3>👤 Profile</h3>
  <div class="profile-box">
    <div class="avatar">
      <?= strtoupper(substr($_SESSION['user']['username'], 0, 1)); ?>
    </div>
    <div class="profile-info">
      <p><b>Username:</b> <?= $_SESSION['user']['username']; ?></p>
      <p><b>Email:</b> <?= $_SESSION['user']['email'] ?? '-'; ?></p>
      <p><b>Role:</b> <?= $_SESSION['user']['role'] ?? 'User'; ?></p>
    </div>
  </div>
</div>

<button class="about-btn" onclick="openAbout()">ℹ️ About</button>

<h3>🧠 Daily Why?</h3>
<p><?php include "../api/trivia.php"; ?></p>

<a href="../auth/logout.php">Logout</a>

</div>

<div class="modal" id="aboutModal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeAbout()">✖</span>
    <h3>About Dashboard</h3>
    <p style="line-height:1.6; font-size:15px;">
    Perkenalkan nama saya Dika Naufal dari Universitas Teknologi Bandung.
    Saya sekarang berada di tingkat semester 5
    saya juga sedang mengampu 3 mata kuliah pada web ini, yaitu kemanan informasi, pemograman web 1 dan keamanan jaringan.

      Dashboard ini merupakan pusat navigasi interaktif yang menggabungkan
      fitur Play, Tools, Predict, Vibe, dan Leaderboard dengan desain
      minimalis dan nuansa sains modern.
    </p>
  </div>
</div>

<script>
function openAbout() {
  document.getElementById('aboutModal').style.display = 'flex';
}
function closeAbout() {
  document.getElementById('aboutModal').style.display = 'none';
}
</script>

</body>
</html>
