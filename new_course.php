<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST["title"]);
    $description = sanitize_input($_POST["description"]);
    $price = sanitize_input($_POST["price"]);
    $teacher = sanitize_input($_POST["teacher"]);
    $image_path = '';
    $video_type = null;
    $video_value = null;
    $error_message = '';
    $success_message = '';

    $duration_value = intval($_POST["duration_value"]);
    $duration_unit = sanitize_input($_POST["duration_unit"]);

    // Validate unit
    $valid_units = ['weeks', 'months'];
    if (!in_array($duration_unit, $valid_units)) {
        $error_message = "Invalid duration unit selected.";
    }


    // Image Upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists($ext, $allowed) || !in_array($filetype, $allowed)) {
            $error_message = "Invalid image file type.";
        } elseif ($filesize > 2 * 1024 * 1024) {
            $error_message = "Image size exceeds 2MB.";
        } else {
            $new_filename = uniqid() . "." . $ext;
            $target_path = "uploads/image/" . $new_filename;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
                $image_path = "uploads/images/" . $new_filename;// Save this to DB
            } else {
                $error_message = "Failed to upload image.";
            }
        }
    }


    // Video Upload/Embed/Link
    if (!empty($_FILES['video_upload']['name'])) {
        $video_ext = pathinfo($_FILES['video_upload']['name'], PATHINFO_EXTENSION);
        $video_name = uniqid() . '.' . $video_ext;
        $target = 'uploads/videos/' . $video_name;
        if (!is_dir('uploads/videos')) mkdir('uploads/videos', 0755, true);
        if (move_uploaded_file($_FILES['video_upload']['tmp_name'], $target)) {
            $video_path = 'uploads/videos/' . $video_name;
        }
    } elseif (!empty($_POST['video_link'])) {
        $video_path = sanitize_input($_POST['video_link']);
    } elseif (!empty($_POST['video_embed'])) {
        $video_path = $_POST['video_embed'];
    }

    // Insert to DB
    if (empty($error_message)) {
      $stmt = $conn->prepare("INSERT INTO courses (title, description, price, teacher, image_path, video_type, video_value, duration_value, duration_unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssissssis", $title, $description, $price, $teacher, $image_path, $video_type, $video_value, $duration_value, $duration_unit);
      if ($stmt->execute()) {
                  $success_message = "Course added successfully!";
              } else {
                  $error_message = "Database error: " . $stmt->error;
              }
              $stmt->close();
          }
      }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Add Course</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header3.php'; ?>

<div class="container">
  <h2 class="fw-bold text-danger mt-3 text-center">Admin - Add Course</h2>
  <hr style="color:red;">
  <div class="form-container">

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mb-2'>Back to Dashboard</a>
    <a href='view_courses.php' class='btn btn-sm btn-danger mb-2'>View Courses</a>

    <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <?php if (!empty($success_message)): ?>
      <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" action="">
      <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="mb-3">
        <label for="summernote" class="form-label">Course Overview:</label>
        <textarea id="summernote" name="description" class="form-control"></textarea>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price ($):</label>
        <input type="number" id="price" class="form-control" name="price" step="0.01" required>
      </div>

      <div class="mb-3">
        <label for="teacher" class="form-label">Preceptor:</label>
        <input type="text" id="teacher" name="teacher" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Video Source:</label>
        <select id="videoSource" class="form-select">
          <option value="">-- Select Video Source --</option>
          <option value="upload">Upload from Device</option>
          <option value="link">Paste YouTube/Drive Link</option>
          <option value="embed">Paste YouTube Embed Code</option>
        </select>
      </div>

      <div class="mb-3 d-none" id="videoUploadBlock">
        <label class="form-label">Upload Video:</label>
        <input type="file" class="form-control" name="video_upload" accept="video/*">
      </div>

      <div class="mb-3 d-none" id="videoLinkBlock">
        <label class="form-label">Video URL:</label>
        <input type="text" class="form-control" name="video_link">
      </div>

      <div class="mb-3 d-none" id="videoEmbedBlock">
        <label class="form-label">Embed Code:</label>
        <textarea class="form-control" name="video_embed" rows="3" placeholder="<iframe ...>"></textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Course Image:</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
      </div>

      <div class="mb-3">
          <label for="duration_value" class="form-label">Course Duration Value:</label>
          <input type="number" name="duration_value" id="duration_value" class="form-control" min="1" required>
      </div>

      <div class="mb-3">
          <label for="duration_unit" class="form-label">Course Duration Unit:</label>
          <select name="duration_unit" id="duration_unit" class="form-select" required>
              <option value="weeks">Weeks</option>
              <option value="months">Months</option>
          </select>
      </div>

      <button type="submit" class="btn btn-danger mt-2">Add Course</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#summernote').summernote({ height: 300 });

    $('#videoSource').on('change', function () {
      let val = this.value;
      $('#videoUploadBlock, #videoLinkBlock, #videoEmbedBlock').addClass('d-none');
      if (val === 'upload') $('#videoUploadBlock').removeClass('d-none');
      else if (val === 'link') $('#videoLinkBlock').removeClass('d-none');
      else if (val === 'embed') $('#videoEmbedBlock').removeClass('d-none');
    });
  });
</script>
</body>
</html>
