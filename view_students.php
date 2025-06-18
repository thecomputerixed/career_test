<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$sql = "SELECT student_id, email, phone_number, registration_date FROM students";
$result = $conn->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Registered Students</title>
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
        .progress-button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .progress-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include'header3.php'?>
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Enrolled Students</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>

    <?php if ($students): ?>
        <table class="container">
            <thead class="text-danger">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['student_id']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><?php echo $student['phone_number']; ?></td>
                        <td><?php echo $student['registration_date']; ?></td>
                        <td><a href="view_student_progress.php?student_id=<?php echo $student['student_id']; ?>" class="btn btn-outline-danger">View Progress</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No students registered yet.</p>
    <?php endif; ?>
</div>
</body>
</html>