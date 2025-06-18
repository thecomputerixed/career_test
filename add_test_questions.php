<?php
require_once 'config.php';
session_start();

// Check admin authentication
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Handle form submission
if (isset($_POST['add_question'])) {
    $question_text = mysqli_real_escape_string($conn, $_POST['question_text']);
    $option_a = mysqli_real_escape_string($conn, $_POST['option_a']);
    $option_b = mysqli_real_escape_string($conn, $_POST['option_b']);
    $option_c = mysqli_real_escape_string($conn, $_POST['option_c']);
    $option_d = mysqli_real_escape_string($conn, $_POST['option_d']);
    $recommendation_a = mysqli_real_escape_string($conn, $_POST['recommendation_a']);
    $recommendation_b = mysqli_real_escape_string($conn, $_POST['recommendation_b']);
    $recommendation_c = mysqli_real_escape_string($conn, $_POST['recommendation_c']);
    $recommendation_d = mysqli_real_escape_string($conn, $_POST['recommendation_d']);

    // Insert new question into database
    $sql = "INSERT INTO test_questions (
        question_text, option_a, option_b, option_c, option_d,
        recommendation_a, recommendation_b, recommendation_c, recommendation_d
    ) VALUES (
        '$question_text', '$option_a', '$option_b', '$option_c', '$option_d',
        '$recommendation_a', '$recommendation_b', '$recommendation_c', '$recommendation_d'
    )";

    if (mysqli_query($conn, $sql)) {
        $message = "<p class='text-success'>✅ Question added successfully.</p>";
        $_POST = array(); // Clear form
    } else {
        $message = "<p class='text-danger'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch available courses for recommendation aid
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
    <title>ETBS | Add Test Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .border-box { border: 1px solid #ccc; border-radius: 10px; padding: 20px; margin-top: 20px; }
        .form-label { font-weight: 500; }
    </style>
</head>
<body>
    <?php include 'header3.php'; ?>

    <div class="container mt-4">
        <h4 class="text-secondary">Admin <span class="text-danger">- Add New Career Question</span></h4>
        <a href='admindashboard.php' class='btn btn-sm btn-outline-secondary mb-2'>Back to Dashboard</a>
        <a href='view_test_questions.php' class='btn btn-sm btn-danger mb-2'>View All Test Questions</a>

        <div class="border-box shadow-sm">
            <?php echo $message; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Question Text:</label>
                    <textarea name="question_text" class="form-control" required><?php echo isset($_POST['question_text']) ? htmlspecialchars($_POST['question_text']) : ''; ?></textarea>
                </div>

                <?php
                $options = ['a', 'b', 'c', 'd'];
                foreach ($options as $opt) {
                    echo '
                    <div class="mb-3">
                        <label class="form-label">Option ' . strtoupper($opt) . ':</label>
                        <input type="text" name="option_' . $opt . '" class="form-control" value="' . (isset($_POST['option_' . $opt]) ? htmlspecialchars($_POST['option_' . $opt]) : '') . '" required>
                    </div>';
                }
                ?>

                <hr>
                <h6>Recommendations (Course IDs, comma-separated):</h6>

                <?php
                foreach ($options as $opt) {
                    echo '
                    <div class="mb-3">
                        <label class="form-label">Recommendation for Option ' . strtoupper($opt) . ':</label>
                        <input type="text" name="recommendation_' . $opt . '" class="form-control" value="' . (isset($_POST['recommendation_' . $opt]) ? htmlspecialchars($_POST['recommendation_' . $opt]) : '') . '">
                    </div>';
                }
                ?>

                <button type="submit" name="add_question" class="btn btn-danger">Add Question</button>
            </form>
        </div>

        <?php if (!empty($courses)): ?>
            <div class="mt-5">
                <h5>Available Courses <span class="text-muted">(For Recommendation Reference)</span></h5>
                <table class="table table-bordered table-sm mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>Course ID</th>
                            <th>Course Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($course['course_id']); ?></td>
                                <td><?php echo htmlspecialchars($course['title']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
