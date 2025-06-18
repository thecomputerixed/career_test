<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = isset($_POST["course_id"]) ? intval($_POST["course_id"]) : 0;
    $question = sanitize_input($_POST["question"]);
    $option_a = sanitize_input($_POST["option_a"]);
    $option_b = sanitize_input($_POST["option_b"]);
    $option_c = sanitize_input($_POST["option_c"]);
    $option_d = sanitize_input($_POST["option_d"]);
    $correct_answer = sanitize_input($_POST["correct_answer"]);

    $errors = [];
    if ($course_id <= 0) {
        $errors[] = "Please select a course.";
    }
    if (empty($question) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer)) {
        $errors[] = "All fields are required.";
    }
    if (!in_array(strtolower($correct_answer), ['a', 'b', 'c', 'd'])) {
        $errors[] = "Correct answer must be 'a', 'b', 'c', or 'd'.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO exams (course_id, question, option_a, option_b, option_c, option_d, correct_answer)
                VALUES ($course_id, '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_answer')";
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
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - Add Exam Questions</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_exams.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Exams </a>
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
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="">Select a Course</option>
                <?php if ($courses): ?>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course['course_id']; ?>"><?php echo $course['title']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            </div>
            <div class="mb-3">
                <label for="summernote" class="form-label">Question:</label>
                <textarea id="summernote" class="form-control" name="question" required></textarea>
            </div>
            <div class="mb-3">
                <label for="option_a" class="form-label">Option A:</label>
                <input type="text" id="option_a" name="option_a" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="option_b">Option B:</label>
                <input type="text" id="option_b" name="option_b" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="option_c">Option C:</label>
                <input type="text" id="option_c" name="option_c" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="option_d">Option D:</label>
                <input type="text" id="option_d" name="option_d" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correct_answer">Correct Answer (a, b, c, or d):</label>
                <input type="text" id="correct_answer" name="correct_answer"  class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger">Add Exam Question</button>
        </form>
    </div>
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