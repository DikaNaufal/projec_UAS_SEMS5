<?php
include "../config/database.php";

$data = [];

$q = $conn->query("
  SELECT faculty, MAX(score) AS score
  FROM scores
  GROUP BY faculty
  ORDER BY score DESC
");

while ($row = $q->fetch_assoc()) {
  $data[] = [
    "faculty" => $row['faculty'],
    "score"   => (int)$row['score']
  ];
}

header("Content-Type: application/json");
echo json_encode($data);
