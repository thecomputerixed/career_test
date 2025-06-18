<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

// Fetch all courses for the dropdown
$courses_sql = "SELECT course_id, title FROM courses";
$courses_result = $conn->query($courses_sql);
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);

// Initialize course ID
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Fetch course title for display
$course_title = '';
if ($course_id > 0) {
    $course_sql = "SELECT title FROM courses WHERE course_id = $course_id";
    $course_result = $conn->query($course_sql);
    if ($course_result && $course_result->num_rows > 0) {
        $course_title = $course_result->fetch_assoc()['title'];
    }
}

// Fetch modules for the selected course
$modules = [];
if ($course_id > 0) {
    $sql = "SELECT module_id, title FROM modules WHERE course_id = $course_id";
    $result = $conn->query($sql);
    $modules = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - View Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
        .filter-form {
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: 10px 10px;
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
        .actions a {
            margin-right: 10px;
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <?php include'header3.php'?>
<div class="container">
    <h5 class="text-grey mt-5">Welcome Admin, this page is dedicated for <span class="text-danger"> viewing, editing, and adding new Modules </span></h5>
    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
    <a href='add_module.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add New Module</a>
    <div class="filter-form">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="course_id" class="text-danger fw-bold">Select Course:</label>
            <select name="course_id" id="course_id" class="form-select col-md-6" onchange="this.form.submit()">
                <option value="0">-- Select a Course --</option>
                <?php if ($courses): ?>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['course_id']; ?>" <?php if ($course_id == $course['course_id']) echo 'selected'; ?>><?php echo htmlspecialchars($course['title']); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </form>
    </div>

    <?php if ($course_title): ?>
        <h5 class="fw-bold">Modules for Course: <span class="text-danger fw-bold"><?php echo htmlspecialchars($course_title); ?></span></h3>
        <?php if ($modules): ?>
            <table class="container my-3">
                <thead class="text-danger fw-bold">
                    <tr>
                        <th>module ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                        <tr>
                            <td><?php echo $module['module_id']; ?></td>
                            <td><?php echo html_entity_decode($module['title']); ?></td>
                            <td class="actions">
                               <a class="text-danger" href="edit_module.php?module_id=<?php echo $module['module_id']; ?>">Edit</a>
                               <a href="#" class="btn-delete" data-id="<?php echo $module['module_id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No modules found for this course.</p>
        <?php endif; ?>
    <?php elseif ($course_id > 0): ?>
        <p>Course not found.</p>
    <?php else: ?>
        <p>Please select a course to view its modules.</p>
    <?php endif; ?>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      <img src="source/img/delalert.png" alt="Oops!" style="width: 300px; height:300px;" class="mx-auto mt-3" />
      <h5 class="mt-3">Are you sure you want to delete this module?</h5>
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
      const deleteUrl = `delete_module.php?module_id=${selectedId}`;
      confirmDeleteBtn.setAttribute('href', deleteUrl);

      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
</script>

</body>
</html>