<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['question_id'])) {
    redirect("view_test_questions.php");
}

$question_id = intval($_GET['question_id']);

// Perform the deletion
$sql = "DELETE FROM test_questions WHERE question_id = $question_id";
if ($conn->query($sql) === TRUE) {
    $success_message = "Test deleted successfully!";
} else {
    $error_message = "Error deleting Test: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Delete Career Questions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
 
</head>
<body>
 <?php include'header3.php'?>
     
    <div class="container">
        <h5 class="text-grey mt-5">Admin<span class="text-danger">  - Edit Career Question</span></h5>
        <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
         <a href='view_test_questions.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >View All Career Question</a>
        
<hr style="color:red;">
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
            
        <?php else: ?>
            <p>There was an error deleting the Topic.</p>
            <p><a href="view_test_questions.php">Try Again</a></p>
        <?php endif; ?>
    </div>
</body>
</html>