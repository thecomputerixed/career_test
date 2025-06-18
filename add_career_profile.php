<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$success_message = $error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = sanitize_input($_POST["code"]);
    $title = sanitize_input($_POST["title"]);
    $meaning = sanitize_input($_POST["meaning"]);
    $ideal_careers = sanitize_input($_POST["ideal_careers"]);
    $strengths = sanitize_input($_POST["strengths"]);
    $watch_out = sanitize_input($_POST["watch_out"]);
    $career_personality = sanitize_input($_POST["career_personality"]);

    $sql = "INSERT INTO career_profiles (code, title, meaning, ideal_careers, strengths, watch_out, career_personality)
            VALUES ('$code', '$title', '$meaning', '$ideal_careers', '$strengths', '$watch_out', '$career_personality')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Career profile added successfully!";
    } else {
        $error_message = "Error adding career profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>ETBS | Admin Dashboard - Add Career Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .border-box { border: 1px solid red; border-radius: 10px; padding: 15px; margin-bottom: 15px; }
        .form-label { font-weight: 500; }
    </style>
</head>
<body>
    <?php include 'header3.php'; ?>

    <div class="container mt-5">
        <h5 class="text-grey mt-5"> Add<span class="text-danger"> Career Profile </span></h5>
        <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2'>Back to Dashboard</a>
        <a href='view_career_profiles.php' class='btn btn-sm btn-danger mt-2 mb-2'>View All Profiles</a>
        
        <div class="shadow border-box">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?= $success_message; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <?php
                $fields = [
                    'code' => 'Code',
                    'title' => 'Title',
                    'meaning' => 'Meaning',
                    'ideal_careers' => 'Ideal Careers',
                    'strengths' => 'Strengths',
                    'watch_out' => 'Watch Out',
                    'career_personality' => 'Career Personality',
                ];

                foreach ($fields as $name => $label):
                    $isTextArea = in_array($name, ['meaning', 'ideal_careers', 'strengths', 'watch_out', 'career_personality']);
                ?>
                    <div class="mb-3">
                        <label class="form-label"><?= $label ?></label>
                        <?php if ($isTextArea): ?>
                            <textarea name="<?= $name ?>" class="form-control summernote" rows="3"></textarea>
                        <?php else: ?>
                            <input type="text" name="<?= $name ?>" class="form-control" required>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-danger">Add Profile</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editors = document.querySelectorAll('.summernote');
            editors.forEach(editor => {
                new window.Summernote(editor, { height: 150 });
            });
        });
    </script>
</body>
</html>
