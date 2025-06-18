<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['module_id'])) {
    redirect("view_courses.php");
}

$module_id = intval($_GET['module_id']);

// Fetch module details
$module_sql = "SELECT module_id, course_id, title, overview, audio, description, video_link FROM modules WHERE module_id = $module_id";
$module_result = $conn->query($module_sql);
if (!$module_result || $module_result->num_rows == 0) {
    redirect("view_courses.php"); // module not found
}
$module = $module_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST["title"]);
    $description = sanitize_input($_POST["description"]);
    $video_link = sanitize_input($_POST["video_link"]);
    $module_overview = sanitize_input($_POST['overview']);

    $audio_path = '';
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {
        $allowed_types = ['audio/mpeg', 'audio/wav', 'audio/ogg'];
        if (in_array($_FILES['audio']['type'], $allowed_types)) {
            $upload_dir = '../uploads/audio/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $audio_name = uniqid() . '_' . $_FILES['audio']['name'];
            $audio_path = $upload_dir . $audio_name;
            if (!move_uploaded_file($_FILES['audio']['tmp_name'], $audio_path)) {
                $error = 'Error uploading audio file.';
            } else {
                $audio_path = 'uploads/audio/' . $audio_name; // Store relative path in DB
            }
        } else {
            $error = 'Invalid audio file type. Allowed types: MP3, WAV, OGG.';
        }
    }


    $errors = [];
    if (empty($title)) {
        $errors[] = "module title is required.";
    }

    if (empty($errors)) {
        $sql = "UPDATE modules SET title='$title', overview='$module_overview'  ,  audio='$audio_path' ,  description='$description', video_link='$video_link' WHERE module_id=$module_id";
        if ($conn->query($sql) === TRUE) {
            $show_update_modal = true;
        } else {
            $error_message = "Error updating module: " . $conn->error;
        }
        
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard - Edit Modules</title>
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
        <h5 class="text-grey mt-5">Welcome Admin, this page is dedicated for <span class="text-danger"> editing existing Modules </span></h5>
        <a href='admindashboard.php' class='btn btn-sm btn-outline-danger mt-2 mb-2' >Back to Dashboard</a>
        <a href='add_module.php' class='btn btn-sm btn-danger mt-2 mb-2' >Add New Module</a>
        <div class="shadow border-box">
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form method="post"  enctype="multipart/form-data"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?module_id=" . $module_id; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">You can EDIT the Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $module['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="overview" class="form-label">Overview:</label>
                <textarea type="text" class="form-control" name="overview" id="overview" rows="5" value="<?php echo $module['overview']; ?>" ></textarea>
            </div>
            <div class="mb-3">
                <label for="summernote" class="form-label">You can EDIT the content:</label>
                <textarea id="summernote" name="description" class="form-control" value="<?php echo $module['description']; ?>"></textarea>
            </div>
            <div class="mb-3">
                <label for="video_link" class="form-label">You can EDIT the Video Link (YouTube Iframe URL):</label>
                <input type="text" class="form-control"  id="inputText" oninput="replaceText()" >
            </div>
            <div class="mb-3">
                <input type="url" id="video_link" name="video_link" class="form-control" >
            </div>
           
            <div class="mb-3">
                <label for="audio" class="form-label">You can EDIT the Audio (MP3, WAV, OGG):</label>
                <input type="file" name="audio" id="audio" class="form-control" accept="audio/mpeg, audio/wav, audio/ogg, audio/mp3" value="<?php echo $module['audio']; ?>">
            </div>

                <button type="submit" class="btn btn-danger">Update module</button>
            </form>
        </div>
    </div>
<!-- Update Success Modal -->
<div class="modal fade" id="updateSuccessModal" tabindex="-1" aria-labelledby="updateSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <img src="source/img/success1.gif" alt="Success!" style="width: 400px; height: 400px;" class="mx-auto mt-2" />
      <h5 class="mt-3 text-success">Module updated successfully!</h5>
      <p class="text-muted">What would you like to do next?</p>
      <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="edit_module.php?module_id=<?php echo $module_id; ?>" class="btn btn-outline-success">Edit Again</a>
        <a href="view_modules.php" class="btn btn-success">View All Modules</a>
      </div>
    </div>
  </div>
</div>
<?php if (!empty($show_update_modal)): ?>
<script>
  window.onload = function () {
    const modal = new bootstrap.Modal(document.getElementById('updateSuccessModal'));
    modal.show();
  };
</script>
<?php endif; ?>

<script>
        function replaceText() {
            const input = document.getElementById("inputText").value;
            const search = "https://youtu.be/"; // Word to be replaced
            const replacement = "http://www.youtube.com/embed/"; // Replacement word

            // Perform the replacement
            const updated = input.replaceAll(search, replacement);

            // Set the updated text in the output input box
            document.getElementById("video_link").value = updated;
        }
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