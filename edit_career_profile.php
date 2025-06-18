<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

$career = [];
$id = $_GET['id'] ?? null;

// Fetch existing career data
if ($id) {
    $stmt = $conn->prepare("SELECT * FROM career_profiles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $career = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = sanitize_input($_POST["code"]);
    $title = sanitize_input($_POST["title"]);
    $meaning = sanitize_input($_POST["meaning"]);
    $ideal_careers = sanitize_input($_POST["ideal_careers"]);
    $strengths = sanitize_input($_POST["strengths"]);
    $watch_out = sanitize_input($_POST["watch_out"]);
    $career_personality = sanitize_input($_POST["career_personality"]);

    if ($id) {
        $stmt = $conn->prepare("UPDATE career_profiles SET code=?, title=?, meaning=?, ideal_careers=?, strengths=?, watch_out=?, career_personality=? WHERE id=?");
        $stmt->bind_param("sssssssi", $code, $title, $meaning, $ideal_careers, $strengths, $watch_out, $career_personality, $id);

        if ($stmt->execute()) {
            $success_message = "Edited successfully";
        } else {
            $error_message = "Error updating career profile: " . $stmt->error;
        }
    } else {
        $error_message = "Invalid ID.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Edit Career Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .border-box { border: 1px solid #ddd; border-radius: 10px; padding: 20px; margin-bottom: 30px; }
    .form-label { font-weight: 500; }
  </style>
</head>
<body>

<?php include 'header3.php'; ?>

<div class="container mt-5">
  <h4 class="mb-4">Edit <span class="text-danger">Career Profile</span></h4>
  <a href='admindashboard.php' class='btn btn-sm btn-outline-secondary mb-2'>Back to Dashboard</a>
  <a href='view_career_profile.php' class='btn btn-sm btn-danger mb-2'>View All Profiles</a>

  <div class="shadow border-box">
    <?php if (isset($error_message)): ?>
      <div class="alert alert-danger"><?= $error_message ?></div>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
      <div class="alert alert-success"><?= $success_message ?></div>
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
          $value = htmlspecialchars($career[$name] ?? '');
          $isTextArea = in_array($name, ['meaning', 'ideal_careers', 'strengths', 'watch_out', 'career_personality']);
      ?>
        <div class="mb-3">
          <label class="form-label"><?= $label ?></label>
          <?php if ($isTextArea): ?>
            <textarea id="summernote-<?= $name ?>" name="<?= $name ?>" class="form-control summernote" rows="4"><?= $value ?></textarea>
          <?php else: ?>
            <input type="text" name="<?= $name ?>" class="form-control" value="<?= $value ?>" required>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

      <button type="submit" class="btn btn-danger">Update Career Profile</button>
    </form>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script>
  $(document).ready(function() {
    $('.summernote').summernote({
      height: 150
    });
  });
</script>

</body>
</html>
