<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_id = isset($_POST["module_id"]) ? intval($_POST["module_id"]) : 0;
    $question = sanitize_input($_POST["question"]);
    $option_a = sanitize_input($_POST["option_a"]);
    $option_b = sanitize_input($_POST["option_b"]);
    $option_c = sanitize_input($_POST["option_c"]);
    $option_d = sanitize_input($_POST["option_d"]);
    $correct_answer = sanitize_input($_POST["correct_answer"]);

    $errors = [];
    if ($module_id <= 0) {
        $errors[] = "Please select a module.";
    }
    if (empty($question) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer)) {
        $errors[] = "All fields are required.";
    }
    if (!in_array(strtolower($correct_answer), ['a', 'b', 'c', 'd'])) {
        $errors[] = "Correct answer must be 'a', 'b', 'c', or 'd'.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO quizzes (module_id, question, option_a, option_b, option_c, option_d, correct_answer)
                VALUES ($module_id, '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_answer')";
        $showSuccessModal = false;
        $showErrorModal = false;

        if ($conn->query($sql) === TRUE) {
            $showSuccessModal = true;
        } else {
            $showErrorModal = true;
            $errorDetails = $conn->error;
        }
            } else {
                $error_message = implode("<br>", $errors);
            }
        }

// Fetch all courses for the dropdown
$courses_sql = "SELECT course_id, title FROM courses";
$courses_result = $conn->query($courses_sql);
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);

$modules = [];
if (isset($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']);
    $modules_sql = "SELECT module_id, title FROM modules WHERE course_id = $course_id";
    $modules_result = $conn->query($modules_sql);
    $modules = $modules_result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz Question</title>
      <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <style>
         .border-box { border: 1px solid red; border-radius: 10px; padding: 15px; margin-bottom: 15px; }
         .form-label { font-weight: 500; }
    </style>
</head>
<body>
<?php include'header3.php'?>
  
<div class="container">
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - Add Quizzes</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_quizzes.php' class='btn btn-sm btn-danger mt-2 mb-2' >View quiz </a>
    <hr>
    <div class="shadow border-box"> 

        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
             <div class="mb-3">
                <label for="course_id" class="form-label">Course:</label>
                <select name="course_id" class="form-select" id="course_id" onchange="window.location.href='add_quiz.php?course_id=' + this.value" required>
                    <option value="">Select a Course</option>
                    <?php if ($courses): ?>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?php echo $course['course_id']; ?>" <?php if (isset($_GET['course_id']) && $_GET['course_id'] == $course['course_id']) echo 'selected'; ?>><?php echo $course['title']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
             <div class="mb-3">
                <label for="module_id" class="form-label">Module:</label>
                <select name="module_id" class="form-select" id="module_id" required <?php if (!isset($_GET['course_id'])) echo 'disabled'; ?>>
                    <option value="">Select a Module</option>
                    <?php if ($modules): ?>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?php echo $module['module_id']; ?>"><?php echo $module['title']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
             <div class="mb-3">
                <label for="summernote" class="form-label">Enter Question:</label>
                <textarea id="summernote"  class="form-control" name="question" placeholder="Your questions are to be written here..." required></textarea>
            </div>
            <div class="mb-3">
                <label for="option_a" class="form-label">Option A:</label>
                <input type="text" class="form-control" id="option_a" name="option_a" required>
            </div>
             <div class="mb-3">
                <label for="option_b" class="form-label">Option B:</label>
                <input type="text" class="form-control" id="option_b" name="option_b" required>
            </div>
             <div class="mb-3">
                <label for="option_c" class="form-label">Option C:</label>
                <input type="text" class="form-control" id="option_c" name="option_c" required>
            </div>
             <div class="mb-3">
                <label for="option_d" class="form-label">Option D:</label>
                <input type="text" class="form-control" id="option_d" name="option_d" required>
            </div>
             <div class="mb-3">
                <label for="correct_answer" class="form-label">Correct Answer (a, b, c, or d):</label>
                <input type="text" id="correct_answer" class="form-control" name="correct_answer" required>
            </div>
                <button type="submit" class="btn btn-danger">Add Quiz Question</button>
        </form>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
        <img src="source/img/success.png" alt="Success!" style="width: 300px; height:300px;" class="mx-auto mt-3" />
        <h5 class="mt-3">Quiz question added successfully!</h5>
        <div class="d-flex justify-content-center mt-4 mb-2">
            <a href="view_quizzes.php" class="btn btn-success">View All Quizzes</a> |  <a href="add_quiz.php" class="btn btn-danger">Add More Quiz</a>
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
        <img src="source/img/error.png" alt="Error!" style="width: 300px; height:300px;" class="mx-auto mt-3" />
        <h5 class="mt-3">Error adding quiz question.</h5>
        <p class="text-danger"><?php echo isset($errorDetails) ? $errorDetails : ''; ?></p>
        <div class="d-flex justify-content-center mt-4 mb-2">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    </div>
 <script>
  window.addEventListener('DOMContentLoaded', () => {
    <?php if ($showSuccessModal): ?>
      let successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
    <?php elseif ($showErrorModal): ?>
      let errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      errorModal.show();
    <?php endif; ?>
  });
</script>
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

<!-- Initialize Summernote -->
<script>
$(document).ready(function() {
    $('#summernote').summernote({
    height: 300,   // set editor height
    minHeight: null,
    maxHeight: null,
    focus: true    // set focus to editable area after initializing summernote
    });
});
</script>
</body>
</html>