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
    }
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../assets/css/auth.css">
<body>
<form method="post">
<h2>Login – The Catalyst</h2>
<input name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<button>Login</button>
</form>
</body>
</html>
