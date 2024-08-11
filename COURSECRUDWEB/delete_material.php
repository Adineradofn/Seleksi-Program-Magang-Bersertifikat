<?php
$mysqli = new mysqli("localhost:3307", "root", "", "online_course");
$stmt = $mysqli->prepare("DELETE FROM materials WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
header("Location: view_course.php?id=" . $_GET['course_id']);
?>
