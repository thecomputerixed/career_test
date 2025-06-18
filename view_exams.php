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

// Fetch exam questions for the selected course
$exams = [];
if ($course_id > 0) {
    $sql = "SELECT exam_id, question FROM exams WHERE course_id = $course_id";
    $result = $conn->query($sql);
    $exams = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - View Exam Questions</title>
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
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Exam</h2>
    <hr>
    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='add_exam.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add More Question </a>

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
        </form>
    </div>
<hr style="color:red;">
    <?php if ($course_title): ?>
        <h5 class="fw-bold">Exam Questions for Course: <span class="text-danger"><?php echo htmlspecialchars($course_title); ?></span></h3>
        <?php if ($exams): ?>
            <table class="container">
                <thead class="text-danger">
                    <tr>
                        <th>Exam ID</th>
                        <th>Question</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exams as $exam): ?>
                        <tr>
                            <td><?php echo $exam['exam_id']; ?></td>
                            <td><?php echo html_entity_decode($exam['question']); ?></td>
                            <td class="actions">
                                <a class="btn btn-danger" href="edit_exam.php?exam_id=<?php echo $exam['exam_id']; ?>">Edit</a>
                              
                                <a href="#" class="btn-delete" data-id="<?php echo $exam['exam_id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-danger">No exam questions found for this course.</p>
        <?php endif; ?>
    <?php elseif ($course_id > 0): ?>
        <p class="text-danger">Course not found.</p>
    <?php else: ?>
        <p class="text-danger">Please select a course to view its exam questions.</p>
    <?php endif; ?>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      <img src="source/img/delalert.png" alt="Oops!" style="width: 300px; height:300px;" class="mx-auto mt-3" />
      <h5 class="mt-3">Are you sure you want to delete this questionz?</h5>
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
      const deleteUrl = `delete_exam.php?exam_id=${selectedId}`;
      confirmDeleteBtn.setAttribute('href', deleteUrl);

      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
    });
  });
  </script>
</div>
</body>
</html>