<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$sql = "SELECT course_id, title, price, teacher FROM courses";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>ETBS | Admin Dashboard - View Course</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Courses</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='new_course.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add New Course</a>
    <?php if ($courses): ?>
        <table>
            <thead class="text-danger fw-bold">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo $course['course_id']; ?></td>
                        <td><?php echo $course['title']; ?></td>
                        <td>$<?php echo $course['price']; ?></td>
                        <td><?php echo $course['teacher']; ?></td>
                        <td>
                            <a class="btn btn-danger" href="course_preview.php?course_id=<?php echo $course['course_id']; ?>">Preview</a>
                            <a href="edit_course.php?course_id=<?php echo $course['course_id']; ?>" class='btn btn-sm btn-success mt-2 mb-2'>Edit</a>
                            <a href="#" class="btn-delete btn btn-sm btn-outline-danger mt-2 mb-2" data-id="<?php echo $course['course_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No courses available.</p>
    <?php endif; ?>
   
</div>
 <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      <img src="source/img/delalert.png" alt="Oops!" style="width: 400px; height:400px;" class="mx-auto mt-3" />
      <h5 class="mt-3">Are you sure you want to delete this course?</h5>
      <div class="d-flex justify-content-center mt-4 mb-2 gap-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</a>
      </div>
    </div>
  </div>
</div>
<script>
  const deleteLinks = document.querySelectorAll('.btn-delete');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  let selectedId = null;

  deleteLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      selectedId = this.getAttribute('data-id');
      const deleteUrl = `delete_course.php?course_id=${selectedId}`;
      confirmDeleteBtn.setAttribute('href', deleteUrl);

      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
</script>
</body>
</html>