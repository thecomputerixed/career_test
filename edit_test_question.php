<?php
require_once 'config.php';

// Check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit();
}

$message = "";
$question_data = null;

// Get the question ID from the URL
if (isset($_GET['question_id']) && is_numeric($_GET['question_id'])) {
    $question_id_to_edit = mysqli_real_escape_string($conn, $_GET['question_id']);

    // Fetch the question data
    $sql_select = "SELECT * FROM test_questions WHERE question_id = ?";
    $stmt_select = mysqli_prepare($conn, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "i", $question_id_to_edit);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);

    if ($result_select && mysqli_num_rows($result_select) > 0) {
        $question_data = mysqli_fetch_assoc($result_select);
    } else {
        $message = "<p class='error'>Question not found.</p>";
    }
    mysqli_stmt_close($stmt_select);
} else {
    $message = "<p class='error'>Invalid question ID.</p>";
}

// Handle form submission for updating the question
if (isset($_POST['update_question']) && $question_data) {
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
    $question_text = mysqli_real_escape_string($conn, $_POST['question_text']);
    $option_a = mysqli_real_escape_string($conn, $_POST['option_a']);
    $option_b = mysqli_real_escape_string($conn, $_POST['option_b']);
    $option_c = isset($_POST['option_c']) ? mysqli_real_escape_string($conn, $_POST['option_c']) : '';
    $option_d = isset($_POST['option_d']) ? mysqli_real_escape_string($conn, $_POST['option_d']) : '';
    $recommendation_a = isset($_POST['recommendation_a']) ? mysqli_real_escape_string($conn, $_POST['recommendation_a']) : '';
    $recommendation_b = isset($_POST['recommendation_b']) ? mysqli_real_escape_string($conn, $_POST['recommendation_b']) : '';
    $recommendation_c = isset($_POST['recommendation_c']) ? mysqli_real_escape_string($conn, $_POST['recommendation_c']) : '';
    $recommendation_d = isset($_POST['recommendation_d']) ? mysqli_real_escape_string($conn, $_POST['recommendation_d']) : '';

    // Validate correct option
    
        $sql_update = "UPDATE test_questions SET
                       question_text = ?,
                       option_a = ?,
                       option_b = ?,
                       option_c = ?,
                       option_d = ?,
                       recommendation_a = ?,
                       recommendation_b = ?,
                       recommendation_c = ?,
                       recommendation_d = ?
                       WHERE question_id = ?";

        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "sssssssssi", $question_text, $option_a, $option_b, $option_c, $option_d,  $recommendation_a, $recommendation_b, $recommendation_c, $recommendation_d, $question_id);

        if (mysqli_stmt_execute($stmt_update)) {
            $message = "<p class='success'>Question updated successfully.</p>";
            // Refetch the data to update the form with the latest changes
            $sql_select_refetch = "SELECT * FROM test_questions WHERE question_id = ?";
            $stmt_select_refetch = mysqli_prepare($conn, $sql_select_refetch);
            mysqli_stmt_bind_param($stmt_select_refetch, "i", $question_id);
            mysqli_stmt_execute($stmt_select_refetch);
            $result_select_refetch = mysqli_stmt_get_result($stmt_select_refetch);
            if ($result_select_refetch && mysqli_num_rows($result_select_refetch) > 0) {
                $question_data = mysqli_fetch_assoc($result_select_refetch);
            }
            mysqli_stmt_close($stmt_select_refetch);
        } else {
            $message = "<p class='error'>Error updating question: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt_update);
    }


// Fetch existing courses for recommendation selection (optional, but helpful)
$courses = [];
$courses_sql = "SELECT course_id, title FROM courses";
$courses_result = mysqli_query($conn, $courses_sql);
if ($courses_result && mysqli_num_rows($courses_result) > 0) {
    while ($row = mysqli_fetch_assoc($courses_result)) {
        $courses[] = $row;
    }
    mysqli_free_result($courses_result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Edit Career Questions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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
        <h5 class="text-grey mt-5">Admin<span class="text-danger">  - Edit Career Question</span></h5>
            <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
            <a href='view_test_questions.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Test Questions</a>
        <div class="shadow border-box">
                <?php echo $message; ?>

                <?php if ($question_data): ?>
            <form method="post">
            <div class="mb-3">
                <input type="hidden" name="question_id" value="<?php echo htmlspecialchars($question_data['question_id']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="question_text">Question Text:</label>
                <textarea class="form-control" id="question_text" name="question_text" required><?php echo htmlspecialchars($question_data['question_text']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="option_a">Option A:</label>
                <input class="form-control" type="text" id="option_a" name="option_a" value="<?php echo htmlspecialchars($question_data['option_a']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="option_b">Option B:</label>
                <input class="form-control" type="text" id="option_b" name="option_b" value="<?php echo htmlspecialchars($question_data['option_b']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="option_b">Option C:</label>
                <input class="form-control" type="text" id="option_c" name="option_c" value="<?php echo htmlspecialchars($question_data['option_c']); ?>" required>
            </div>            
            <div class="mb-3">
                <label class="form-label" for="option_b">Option D:</label>
                <input class="form-control" type="text" id="option_d" name="option_d" value="<?php echo htmlspecialchars($question_data['option_d']); ?>" required>
            </div>
            <hr>
            <div class="mb-3">
                    <label class="form-label" for="recommendation_a">Recommendation for Option A (comma-separated Course IDs):</label>
                    <input class="form-control" type="text" id="recommendation_a" name="recommendation_a" class="recommendation-input" value="<?php echo htmlspecialchars($question_data['recommendation_a']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="recommendation_b">Recommendation for Option B (comma-separated Course IDs):</label>
                    <input class="form-control" type="text" id="recommendation_b" name="recommendation_b" class="recommendation-input" value="<?php echo htmlspecialchars($question_data['recommendation_b']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="recommendation_c">Recommendation for Option C (comma-separated Course IDs):</label>
                    <input class="form-control" type="text" id="recommendation_c" name="recommendation_c" class="recommendation-input" value="<?php echo htmlspecialchars($question_data['recommendation_c']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="recommendation_d">Recommendation for Option D (comma-separated Course IDs):</label>
                    <input class="form-control" type="text" id="recommendation_d" name="recommendation_d" value="<?php echo htmlspecialchars($question_data['recommendation_d']); ?>">
                </div>
            <button class="btn btn-danger"  type="submit" name="update_question" value="Update Question"> Update Question </button>
        </form>
        </div>
    <?php else: ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (!empty($courses)): ?>
         <h5 class="text-grey mt-5">Available Courses<span class="text-danger">  - (for reference): </span></h5>
        
       <table class="container">
            <thead class="text-danger">
                <tr>
                    <th>Course ID</th>
                    <th>Course Title</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo $course['course_id']; ?></td>
                        <td>
                            <?php echo htmlspecialchars($course['title']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>

</body>
</html>
