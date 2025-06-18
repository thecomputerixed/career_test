<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("login.php");
}

// Fetch all courses for the dropdown
$courses_sql = "SELECT course_id, title FROM courses";
$courses_result = $conn->query($courses_sql);
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);

// Initialize course and module IDs
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$module_id = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;

// Fetch module title for display
$module_title = '';
if ($module_id > 0) {
    $module_sql = "SELECT title FROM modules WHERE module_id = $module_id";
    $module_result = $conn->query($module_sql);
    if ($module_result && $module_result->num_rows > 0) {
        $module_title = $module_result->fetch_assoc()['title'];
    }
}

// Fetch modules for the selected course (for the second dropdown)
$modules_for_course = [];
if ($course_id > 0) {
    $modules_sql = "SELECT module_id, title FROM modules WHERE course_id = $course_id";
    $modules_result = $conn->query($modules_sql);
    $modules_for_course = $modules_result->fetch_all(MYSQLI_ASSOC);
}

// Fetch quiz questions for the selected module
$quizzes = [];
if ($module_id > 0) {
    $sql = "SELECT quiz_id, question FROM quizzes WHERE module_id = $module_id";
    $result = $conn->query($sql);
    $quizzes = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - View Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
   
    <style>
        .filter-form {
            margin-bottom: 20px;
        }
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
        .actions a {
            margin-right: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
     <?php include'header3.php'?>
  
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Quizzes</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='add_quiz.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add New quiz </a>
      

    <div class="filter-form">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
            <label for="course_id" class="form-label">Select Course:</label>
            <select name="course_id" id="course_id" class="form-select" onchange="this.form.submit()">
                <option value="0">-- Select a Course --</option>
                <?php if ($courses): ?>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['course_id']; ?>" <?php if ($course_id == $course['course_id']) echo 'selected'; ?>><?php echo htmlspecialchars($course['title']); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            </div>
            <?php if ($modules_for_course): ?>
                <div class="mb-3">
                <label for="module_id" class="form-label">Select module:</label>
                <select name="module_id" id="module_id" class="form-select" onchange="this.form.submit()">
                    <option value="0">-- Select a module --</option>
                    <?php foreach ($modules_for_course as $module): ?>
                        <option value="<?php echo $module['module_id']; ?>" <?php if ($module_id == $module['module_id']) echo 'selected'; ?>><?php echo htmlspecialchars($module['title']); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($module_title): ?>
        <h5 class="fw-bold">These are the Quiz Questions for Module titled :<span class="text-danger"> <?php echo htmlspecialchars($module_title); ?></span></h5>
        <?php if ($quizzes): ?>
            <table>
                <thead class="text-danger">
                    <tr>
                        <th>Quiz ID</th>
                        <th>Question</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quizzes as $quiz): ?>
                        <tr>
                            <td><?php echo $quiz['quiz_id']; ?></td>
                            <td><?php echo html_entity_decode($quiz['question']); ?></td>
                            <td class="actions">
                                <a class="btn btn-danger" href="edit_quiz.php?quiz_id=<?php echo $quiz['quiz_id']; ?> ">Edit</a>
                                <a class="btn-delete btn btn-outline-danger" href="delete_quiz.php?quiz_id=<?php echo $quiz['quiz_id']; ?>" onclick="return confirm('Are you sure you want to delete this quiz question?')">Delete</a>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No quiz questions found for this module.</p>
        <?php endif; ?>
    <?php elseif ($module_id > 0): ?>
        <p>module not found.</p>
    <?php elseif ($course_id > 0): ?>
        <p>Please select a module to view its quizzes.</p>
    <?php else: ?>
        <p>Please select a course and then a module to view the quiz questions.</p>
    <?php endif; ?>

    </div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      <img src="source/img/delalert.png" alt="Oops!" style="width: 300px; height:300px;" class="mx-auto mt-3" />
      <h5 class="mt-3">Are you sure you want to delete this quiz?</h5>
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
      const deleteUrl = `delete_quiz.php?quiz_id=${selectedId}`;
      confirmDeleteBtn.setAttribute('href', deleteUrl);

      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
</body>
</html>