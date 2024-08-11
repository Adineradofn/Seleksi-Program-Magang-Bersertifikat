<?php
$mysqli = new mysqli("localhost:3307", "root", "", "online_course");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch course
$course_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($course_id) {
    $stmt = $mysqli->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();

    if (!$course) {
        echo "<p>No course found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid course ID.</p>";
    exit;
}

// Fetch materials
$materials = $mysqli->prepare("SELECT * FROM materials WHERE course_id = ?");
$materials->bind_param("i", $course_id);
$materials->execute();
$material_list = $materials->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?></title>
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
            position: relative;
        }
        h1 {
            color: #FFD700;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #2E2E48;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
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
    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
    <p><?php echo htmlspecialchars($course['description']); ?></p>
    <p>Duration: <?php echo htmlspecialchars($course['duration']); ?></p>
    <a href="create_material.php?course_id=<?php echo htmlspecialchars($course['id']); ?>" class="btn">Add Material</a>
    <h2>Materials</h2>
    <ul>
        <?php if ($material_list->num_rows > 0): ?>
            <?php while($material = $material_list->fetch_assoc()): ?>
            <li>
                <strong><?php echo htmlspecialchars($material['title']); ?></strong><br>
                <?php echo htmlspecialchars($material['description']); ?><br>
                <a href="<?php echo htmlspecialchars($material['embed_link']); ?>" class="btn">View</a>
                <a href="edit_material.php?id=<?php echo htmlspecialchars($material['id']); ?>&course_id=<?php echo htmlspecialchars($course['id']); ?>" class="btn">Edit</a>
                <a href="delete_material.php?id=<?php echo htmlspecialchars($material['id']); ?>&course_id=<?php echo htmlspecialchars($course['id']); ?>" onclick="return confirm('Are you sure?')" class="btn">Delete</a>
            </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No materials found.</li>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
