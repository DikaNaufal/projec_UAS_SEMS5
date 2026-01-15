<?php
session_start();
include "../config/database.php";

if ($_POST) {
    $q = $conn->prepare("SELECT * FROM users WHERE username=?");
    $q->bind_param("s", $_POST['username']);
    $q->execute();
    $u = $q->get_result()->fetch_assoc();

    if ($u && password_verify($_POST['password'], $u['password'])) {
        $_SESSION['user'] = $u;
        header("Location: ../pages/dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/auth.css">
<title>Login – The Catalyst</title>
</head>

<body class="cute-bg">

<div class="login-card">
  <h2>🧪The Catalyst</h2>
  <center><p class="subtitle">Lab Survival Simulator</p></center>

  <form method="post">
    <input name="username" placeholder="👤 Username" required>
    <input type="password" name="password" placeholder="🔒 Password" required>
    <button>Login</button>
  </form>

  <p class="hint">
    <center>Belum punya akun?  
    <a href="register.php">Daftar dulu</a></center>
  </p>
</div>

</body>
</html>
