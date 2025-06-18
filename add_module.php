<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST["title"]);
    $description = sanitize_input($_POST["description"]);
    $video_type = null;
    $video_value = null;
    $course_id = isset($_POST["course_id"]) ? intval($_POST["course_id"]) : 0;
    $overview = sanitize_input($_POST['overview']);
    $audio = '';
    $error_message = '';
    $success_message = '';

    if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {
        $allowed_types = ['audio/mpeg', 'audio/wav', 'audio/ogg'];
        if (in_array($_FILES['audio']['type'], $allowed_types)) {
            $upload_dir = 'uploads/audio/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $audio_name = uniqid() . '_' . $_FILES['audio']['name'];
            $audio = $upload_dir . $audio_name;
            if (!move_uploaded_file($_FILES['audio']['tmp_name'], $audio)) {
                $error = 'Error uploading audio file.';
            } else {
                $audio = 'uploads/audio/' . $audio_name; // Store relative path in DB
            }
        } else {
            $error = 'Invalid audio file type. Allowed types: MP3, WAV, OGG.';
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

        $errors = [];
        if (empty($title)) {
            $errors[] = "module title is required.";
        }
        if ($course_id <= 0) {
            $errors[] = "Please select a course.";
        }

        if (empty($overview)) {
                $errors[] = "Please  add a overview";
            }

        if (empty($audio)) {
                $errors[] = "Please  add a audio";
            }

    // Insert to DB
        if (empty($error_message)) {
        $stmt = $conn->prepare("INSERT INTO modules (course_id, title, audio, overview,  description, video_type, video_value)  VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $course_id, $title, $audio, $overview, $description, $video_type, $video_value);
        if ($stmt->execute()) {
                    $success_message = "Module added successfully!";
                } else {
                    $error_message = "Database error: " . $stmt->error;
                }
                $stmt->close();
            }
        }

$courses_sql = "SELECT course_id, title FROM courses";
$courses_result = $conn->query($courses_sql);
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Add Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <style>
         .border-box { border: 1px solid red; border-radius: 10px; padding: 15px; margin-bottom: 15px; }
         .form-label { font-weight: 500; }
    </style>
</head>

<body class="bg-light">
     <?php include'header3.php'?>
     <div class="container my-5">

    <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
    <a href='view_modules.php' class='btn btn-sm btn-danger mt-2 mb-2' >View All Module</a>

    <div class="shadow border-box">
            <div class="form-container">
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if (isset($success_message)): ?>
                    <p class="success"><?php echo $success_message; ?></p>
                <?php endif; ?>

            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h5 class="text-center mb-4 text-danger fw-bold">ADD NEW MODULE TO COURSE</h5>
                
                <div class="mb-3">
                    <label for="course_id" class="form-label">This module is for which Course? :</label>
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
                    <label for="title" class="form-label">Add Module Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="overview" class="form-label">Add Module Overview:</label>
                    <textarea class="form-control" name="overview" id="overview"></textarea>
                </div>
                <div class="mb-3">
                    <label for="summernote" class="form-label">Add Module Content:</label>
                    <textarea id="summernote" class="form-control" name="description"></textarea>
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
                    <label for="audio" class="form-label">Upload Audio (MP3, WAV, OGG):</label>
                    <input type="file" class="form-control" name="audio" id="audio" accept="audio/mpeg, audio/wav, audio/ogg, audio/mp3">
                </div>
                
                    <button type="submit" class="btn btn-danger">Click to Add Module</button>
                    
            </form>
        </div>
    </div>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <img src="source/img/success1.gif" alt="Success!" style="width: 300px; height:300px;" class="mx-auto mt-2" />
      <h5 class="mt-3 text-danger">Module added successfully!</h5>
      <p class="text-muted">What would you like to do next?</p>
      <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="add_module.php" class="btn btn-outline-danger">Add Another Module</a>
        <a href="view_modules.php" class="btn btn-danger">View All Modules</a>
      </div>
    </div>
  </div>
</div>
<?php if (!empty($show_success_modal)): ?>
<script>
  window.onload = function () {
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
  };
</script>
<?php endif; ?>

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