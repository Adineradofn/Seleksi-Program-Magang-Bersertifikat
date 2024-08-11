<?php
$mysqli = new mysqli("localhost:3307", "root", "", "online_course");
$stmt = $mysqli->prepare("DELETE FROM courses WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
header("Location: index.php");
?>
