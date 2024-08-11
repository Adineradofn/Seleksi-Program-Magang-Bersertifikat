<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = new mysqli("localhost:3307", "root", "", "online_course");
    $stmt = $mysqli->prepare("INSERT INTO materials (course_id, title, description, embed_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $_POST['course_id'], $_POST['title'], $_POST['description'], $_POST['embed_link']);
    $stmt->execute();
    header("Location: view_course.php?id=" . $_POST['course_id']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Material</title>
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
    <div class="container">
        <h1>Create Material</h1>
        <form method="post">
            <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
            <label>Title:</label>
            <input type="text" name="title" required><br>
            <label>Description:</label>
            <textarea name="description" required></textarea><br>
            <label>Embed Link:</label>
            <input type="text" name="embed_link" required><br>
            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</body>
</html>
