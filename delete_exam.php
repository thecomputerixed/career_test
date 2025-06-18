<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['exam_id'])) {
    redirect("view_exams.php");
}

$exam_id = intval($_GET['exam_id']);

// Perform the deletion
$sql = "DELETE FROM exams WHERE exam_id = $exam_id";
if ($conn->query($sql) === TRUE) {
    $success_message = "Exam deleted successfully!";
} else {
    $error_message = "Error deleting Exam: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Delete Exam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
</head>
<body>
<?php include'header3.php'?>
  
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - Delete Exam</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_exams.php' class='btn btn-sm btn-danger mt-2 mb-2' >View all Exam</a>
    <div class="container">
        <img src="source/img/delalert.png" alt="Oops!" style="width: 400px; height:400px;" class="mx-auto mt-3" />
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
            <p><a href="view_exams.php" class="btn btn-danger">Return to All Exam</a></p>
        <?php else: ?>
            <p>There was an error deleting the Topic.</p>
            <p><a href="view_exams.php">Try Again</a></p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>