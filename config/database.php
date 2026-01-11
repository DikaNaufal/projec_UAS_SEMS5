<?php
$conn = new mysqli("localhost", "root", "", "the_catalyst");
if ($conn->connect_error) {
    die("DB Error");
}
?>
