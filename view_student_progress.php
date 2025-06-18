<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['student_id'])) {
    redirect("view_students.php");
}

$studentId = sanitize_input($_GET['student_id']);

// Fetch student details
$student_sql = "SELECT student_id, email FROM students WHERE student_id = $studentId";
$student_result = $conn->query($student_sql);
$student = $student_result->fetch_assoc();

// Fetch courses the student is taking with their progress
$progress_sql = "SELECT sc.student_course_id, c.title, sc.progress
                 FROM student_courses sc
                 JOIN courses c ON sc.course_id = c.course_id
                 WHERE sc.student_id = $studentId";
$progress_result = $conn->query($progress_sql);
$student_courses_progress = $progress_result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - View Students' Progress</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        table {
            width: 80%;
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
    </style>
</head>
<body>
<?php include'header3.php'?>
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Students' Progress</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_students.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Students</a>

    <h5 class="text-danger fw-bold mt-2">Progress for: <?php echo $student['email']; ?> (ID: <?php echo $student['student_id']; ?>)</h3>

    <?php if ($student_courses_progress): ?>
        <table class="container">
            <thead class="text-danger">
                <tr>
                    <th>Course Title</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student_courses_progress as $progress_item): ?>
                    <tr>
                        <td><?php echo $progress_item['title']; ?></td>
                        <td>
                            <?php
                                $progress_array = json_decode($progress_item['progress'], true);
                                $completed_modules = is_array($progress_array) ? count(array_filter($progress_array, function($status) { return $status === 'completed'; })) : 0;
                                $module_count_sql = "SELECT COUNT(*) as total FROM modules WHERE course_id = (SELECT course_id FROM student_courses WHERE student_course_id = " . $progress_item['student_course_id'] . ")";
                                $module_count_result = $conn->query($module_count_sql);
                                $total_modules = $module_count_result->fetch_assoc()['total'] ?? 0;
                                $progress_percentage = ($total_modules > 0) ? round(($completed_modules / $total_modules) * 100) : 0;
                                echo $progress_percentage; ?>%
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>This student is not enrolled in any courses yet.</p>
    <?php endif; ?>

</div>
</body>
</html>