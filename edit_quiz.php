<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['quiz_id'])) {
    redirect("adminlogin.php");
}

$quiz_id = intval($_GET['quiz_id']);

// Fetch quiz question details
$quiz_sql = "SELECT quiz_id, module_id, question, option_a, option_b, option_c, option_d, correct_answer FROM quizzes WHERE quiz_id = $quiz_id";
$quiz_result = $conn->query($quiz_sql);
if (!$quiz_result || $quiz_result->num_rows == 0) {
    redirect("view_courses.php"); // Quiz question not found
}
$quiz = $quiz_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = sanitize_input($_POST["question"]);
    $option_a = sanitize_input($_POST["option_a"]);
    $option_b = sanitize_input($_POST["option_b"]);
    $option_c = sanitize_input($_POST["option_c"]);
    $option_d = sanitize_input($_POST["option_d"]);
    $correct_answer = sanitize_input($_POST["correct_answer"]);

    $errors = [];
    if (empty($question) || empty($option_a) || empty($option_b) || empty($option_c) || empty($option_d) || empty($correct_answer)) {
        $errors[] = "All fields are required.";
    }
    if (!in_array(strtolower($correct_answer), ['a', 'b', 'c', 'd'])) {
        $errors[] = "Correct answer must be 'a', 'b', 'c', or 'd'.";
    }

    if (empty($errors)) {
        $sql = "UPDATE quizzes SET question='$question', option_a='$option_a', option_b='$option_b', option_c='$option_c', option_d='$option_d', correct_answer='$correct_answer' WHERE quiz_id=$quiz_id";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Quiz question updated successfully! <a href='add_quiz.php'>Add More Quiz</a>";
        } else {
            $error_message = "Error updating quiz question: " . $conn->error;
        }
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Edit Quiz Question</title>
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
   
    <h2 class="fw-bold text-danger mt-3 text-center">Admin - View Quizzes</h2>
    <hr>

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2 mr-5' >Back to Dashboard</a>
    <a href='view_quizzes.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Quiz </a>
    <hr>
    <div class="shadow border-box"> 
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?quiz_id=" . $quiz_id; ?>">

        <div class="mb-3">
            <label for="summernote" class="form-label">Edit Question:</label>
            <textarea id="summernote" name="question" required><?php echo $quiz['question']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="option_a" class="form-label">Option A:</label>
            <input type="text" id="option_a" class="form-control" name="option_a" value="<?php echo $quiz['option_a']; ?>" required>
        </div>
         <div class="mb-3">
            <label for="option_b" class="form-label">Option B:</label>
            <input type="text" id="option_b" class="form-control" name="option_b" value="<?php echo $quiz['option_b']; ?>" required>
        </div>
         <div class="mb-3">
            <label for="option_c" class="form-label">Option C:</label>
            <input type="text" id="option_c" class="form-control" name="option_c" value="<?php echo $quiz['option_c']; ?>" required>
        </div>
         <div class="mb-3">
            <label for="option_d" class="form-label">Option D:</label>
            <input type="text" id="option_d" class="form-control" name="option_d" value="<?php echo $quiz['option_d']; ?>" required>
        </div>
         <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer (a, b, c, or d):</label>
            <input type="text" id="correct_answer" class="form-control" name="correct_answer" value="<?php echo $quiz['correct_answer']; ?>" required>
        </div>
            <button type="submit" class="btn btn-danger">Update Quiz Question</button>
        </form>
    </div>
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