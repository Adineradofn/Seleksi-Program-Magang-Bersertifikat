<?php
$mysqli = new mysqli("localhost:3307", "root", "", "online_course");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $mysqli->prepare("UPDATE materials SET title = ?, description = ?, embed_link = ? WHERE id = ?");
    $stmt->bind_param("sssi", $_POST['title'], $_POST['description'], $_POST['embed_link'], $_POST['id']);
    $stmt->execute();
    header("Location: view_course.php?id=" . $_POST['course_id']);
} else {
    $stmt = $mysqli->prepare("SELECT * FROM materials WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $material = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material</title>
    <style>
        body {
            background-color: #1E1E2F;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: #2A2A40;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            margin: auto;
        }
        h1 {
            color: #FFD700;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #FFD700;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #3A3A50;
            background-color: #1E1E2F;
            color: #FFFFFF;
        }
        .btn {
            background-color: #FFD700;
            color: #1E1E2F;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }
        .btn:hover {
            background-color: #FFC107;
        }
    </style>
</head>
<body>
    <h1>Edit Material</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $material['id']; ?>">
        <input type="hidden" name="course_id" value="<?php echo $material['course_id']; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $material['title']; ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?php echo $material['description']; ?></textarea><br>
        <label>Embed Link:</label>
        <input type="text" name="embed_link" value="<?php echo $material['embed_link']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
