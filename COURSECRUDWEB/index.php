<?php
$mysqli = new mysqli("localhost:3307", "root", "", "online_course");
$result = $mysqli->query("SELECT * FROM courses");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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
            width: 80%;
            margin: auto;
        }
        h1 {
            color: #FFD700;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #3A3A50;
        }
        th {
            background-color: #2E2E48;
        }
        tr:nth-child(even) {
            background-color: #2E2E48;
        }
        .btn {
            display: inline-block;
            background-color: #FFD700;
            color: #1E1E2F;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
            text-align: center;
        }
        .btn:hover {
            background-color: #FFC107;
        }
        .button-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="button-container">
            <a href="create_course.php" class="btn">Create New Course</a>
        </div>
        <h1>Courses</h1>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
            <?php while($course = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($course['title']); ?></td>
                <td><?php echo htmlspecialchars($course['description']); ?></td>
                <td><?php echo htmlspecialchars($course['duration']); ?></td>
                <td>
                    <a href="view_course.php?id=<?php echo $course['id']; ?>" class="btn">View</a>
                    <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="btn">Edit</a>
                    <a href="delete_course.php?id=<?php echo $course['id']; ?>" onclick="return confirm('Are you sure?')" class="btn">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
