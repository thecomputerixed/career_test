<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['course_id'])) {
    redirect("view_courses.php");
}

$course_id = intval($_GET['course_id']);

// Perform the deletion
$sql = "DELETE FROM courses WHERE course_id = $course_id";
if ($conn->query($sql) === TRUE) {
    $success_message = "Course deleted successfully!";
} else {
    $error_message = "Error deleting course: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Deletion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include'header3.php'?>
<div class="container">
<h5 class="text-grey mt-5">Opps!!! <span class="text-danger"> A deletion occured </span></h5>
    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
    <a href='view_courses.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Course</a>
    <div class="form-container">
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="text-success"><?php echo $success_message; ?></p>





            <p><a href="view_courses.php">Return to View Courses</a></p>
        <?php else: ?>
            <p>There was an error deleting the course.</p>
            <p><a href="view_courses.php">Try Again</a></p>
        <?php endif; ?>
    </div>

    
</body>
</html>