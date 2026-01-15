<?php
session_start();
include "../config/database.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $username = trim($_POST['username']);
  $email    = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // 🔍 CEK USERNAME / EMAIL SUDAH ADA
  $check = $conn->prepare(
    "SELECT id FROM users WHERE username = ? OR email = ?"
  );
  $check->bind_param("ss", $username, $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    $error = "🧪 Username atau Email sudah dipakai di lab ini!";
  } else {
    // ✅ INSERT USER BARU
    $q = $conn->prepare(
      "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
    );
    $q->bind_param("sss", $username, $email, $password);

    if ($q->execute()) {
      $success = "✅ Akun berhasil dibuat! Silakan login.";
    } else {
      $error = "❌ Gagal membuat akun. Coba lagi.";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/auth.css">
<title>Register – The Catalyst</title>
</head>

<body class="dark">

<form method="post" class="auth-card">
  <h2>🧬 Join The Lab</h2>

  <?php if ($error): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert success">
      <?= $success ?><br>
      <a href="login.php">➡ Login sekarang</a>
    </div>
  <?php endif; ?>

  <input name="username" placeholder="Username" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="password" type="password" placeholder="Password" required>

  <button>🧪 Create Account</button>

  <p class="small">
    Sudah punya akun?
    <a href="login.php">Login</a>
  </p>
</form>

</body>
</html>
