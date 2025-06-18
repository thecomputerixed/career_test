<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['module_id'])) {
    redirect("view_modules.php");
}

$module_id = intval($_GET['module_id']);

// Perform the deletion
$sql = "DELETE FROM modules WHERE module_id = $module_id";
if ($conn->query($sql) === TRUE) {
    $success_message = "Course deleted successfully!";
} else {
    $error_message = "Error deleting module: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Delete Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?php include'header3.php'?>
    <div class="container">
        <img src="source/img/deleted.gif" alt="Oops!" style="width: 400px; height:400px;" class="mx-auto mt-3" />
            <h5 class="text-grey mt-5">You just <span class="text-danger"> deleted a Module </span></h5>
            <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
            <a href='add_module.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add New Module</a>
            <a href='view_modules.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Modules</a>
            <div class="form-container">
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if (isset($success_message)): ?>
                    <p class="success"><?php echo $success_message; ?></p>
                
                <?php else: ?>
                    <p>There was an error deleting the module.</p>
                    <p><a href="view_modules.php">Try Again</a></p>
                <?php endif; ?>
            </div>
    </div>
</body>
</html>