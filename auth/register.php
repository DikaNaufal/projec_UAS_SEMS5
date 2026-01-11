<?php
include "../config/database.php";
if ($_POST) {
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare(
        "INSERT INTO users(username,email,faculty,password) VALUES(?,?,?,?)"
    );
    $stmt->bind_param(
        "ssss",
        $_POST['username'],
        $_POST['email'],
        $_POST['faculty'],
        $pass
    );
    $stmt->execute();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../assets/css/auth.css">
<body>
<form method="post">
<h2>Register – The Catalyst</h2>
<input name="username" placeholder="Username" required>
<input name="email" placeholder="Email" required>
<input name="faculty" placeholder="Faculty">
<input type="password" name="password" placeholder="Password" required>
<button>Register</button>
</form>
</body>
</html>
