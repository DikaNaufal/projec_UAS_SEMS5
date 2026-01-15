<?php include "../auth/auth_check.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/science-bg-chem-structure.css">
</head>

<body class="dark">
<div class="science-bg"></div>

<div class="app-container">

<h2>Welcome, <?= htmlspecialchars($_SESSION['user']['username']); ?> 🧪</h2> <a href="../auth/logout.php">Logout</a>

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
      <p><b>Email:</b> <?= $_SESSION['user']['email']; ?></p>
    </div>
  </div>
</div>

<h3>🧠 Daily Why?</h3>
<p><?php include "../api/trivia.php"; ?></p>
</div>
