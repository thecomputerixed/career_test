<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$sql = "SELECT cc.completed_id, s.email AS student_email, s.student_id, c.title AS course_title, cc.completion_date
        FROM completed_courses cc
        JOIN students s ON cc.student_id = s.student_id
        JOIN courses c ON cc.course_id = c.course_id
        ORDER BY cc.completion_date DESC";
$result = $conn->query($sql);
$completed_courses = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Completed Courses</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .save-button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .save-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
     <?php include'header3.php'?>
    <h2>Completed Courses</h2>
    <p><a href="dashboard.php">Back to Dashboard</a></p>

    <?php if ($completed_courses): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Email</th>
                    <th>Student ID</th>
                    <th>Course Title</th>
                    <th>Completion Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($completed_courses as $completed_course): ?>
                    <tr>
                        <td><?php echo $completed_course['completed_id']; ?></td>
                        <td><?php echo $completed_course['student_email']; ?></td>
                        <td><?php echo $completed_course['student_id']; ?></td>
                        <td><?php echo $completed_course['course_title']; ?></td>
                        <td><?php echo $completed_course['completion_date']; ?></td>
                        <td><a href="#" class="save-button" onclick="alert('Functionality to save result as image needs further implementation.')">Save as Image</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No courses have been completed yet.</p>
    <?php endif; ?>

    <script>
        // In a real implementation, you would likely use a library like html2canvas
        // and handle the server-side saving or client-side download of the image.
        // This is a placeholder alert.
    </script>
</body>
</html>
