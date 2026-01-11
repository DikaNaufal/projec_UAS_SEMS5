<?php
include "../config/database.php";

$today = date("Y-m-d");
$q = $conn->query("SELECT content FROM trivia WHERE day='$today'");

if ($q->num_rows == 0) {
  $facts = [
    "Di balik IPK yang tinggi dan revisi skripsi yang lancar, ada pahlawan tak terlihat bernama 
    C8 H10 N4 O2.
    Ya, itu adalah Kafein. Zat yang bekerja keras memblokir reseptor adenosin di otakmu agar kamu tidak ketiduran saat deadline menyerang. Hormati kopimu hari ini!",
  ];
  $fact = $facts[array_rand($facts)];
  $conn->query(
    "INSERT INTO trivia(content,day) VALUES('$fact','$today')"
  );
  echo $fact;
} else {
  echo $q->fetch_assoc()['content'];
}
