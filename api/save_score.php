<?php
include "../config/database.php";
session_start();

$uid = $_SESSION['user']['id'];
$faculty = $_SESSION['user']['faculty'];
$score = intval($_POST['score']);

$conn->query("
  INSERT INTO scores (user_id, score, game_type, faculty)
  VALUES ($uid, $score, 'reaction', '$faculty')
");
