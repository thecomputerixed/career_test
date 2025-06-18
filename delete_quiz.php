<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['quiz_id'])) {
    redirect("admindashboard.php");
}

$exam_id = intval($_GET['quiz_id']);

// Perform the deletion
$sql = "DELETE FROM quizzes WHERE quiz_id = $exam_id";
if ($conn->query($sql) === TRUE) {
    $success_message = "Course deleted successfully!";
} else {
    $error_message = "Error deleting quiz: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Delete Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
<?php include'header3.php'?>
  
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - Deletion</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_quizzes.php' class='btn btn-sm btn-danger mt-2 mb-2' >View all Quiz </a>
    <div class="container">
        <img src="source/img/deleted.gif" alt="Oops!" style="width: 400px; height:400px;" class="mx-auto mt-3" />
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p> 
        <?php else: ?>
            <p>There was an error deleting the quiz.</p>
            <p><a href="view_quizzes.php">Try Again</a></p>
        <?php endif; ?>
    </div>
</body>
</html>