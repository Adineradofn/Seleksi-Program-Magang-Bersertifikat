<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = new mysqli("localhost:3307", "root", "", "online_course");
    $stmt = $mysqli->prepare("INSERT INTO courses (title, description, duration) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['title'], $_POST['description'], $_POST['duration']);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
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
            position: relative;
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
        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn back-btn">Back</a>
        <h1>Create Course</h1>
        <form method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" required><br>
            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</body>
</html>
