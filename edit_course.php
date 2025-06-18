<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id']) || !isset($_GET['course_id'])) {
    redirect("view_courses.php");
}

$course_id = intval($_GET['course_id']);

// Fetch course details
$course_sql = "SELECT * FROM courses WHERE course_id = $course_id";
$course_result = $conn->query($course_sql);
if (!$course_result || $course_result->num_rows == 0) {
    redirect("view_courses.php");
}
$course = $course_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST["title"]);
    $description = sanitize_input($_POST["description"]);
    $price = sanitize_input($_POST["price"]);
    $teacher = sanitize_input($_POST["teacher"]);
    $duration_value = sanitize_input($_POST["duration_value"]);
    $duration_unit = sanitize_input($_POST["duration_unit"]);

    $image_path = $course['image_path'];
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed) || !in_array($filetype, $allowed)) {
            $error_message = "Invalid image format.";
        } elseif ($filesize > 2 * 1024 * 1024) {
            $error_message = "Image size exceeds 2MB.";
        } else {
            $new_filename = uniqid() . "." . $ext;
            $target_path = "uploads/images/" . $new_filename;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
                if (!empty($course['image_path']) && file_exists("../" . $course['image_path'])) {
                    unlink("../" . $course['image_path']);
                }
                $image_path = "uploads/images/" . $new_filename;
            } else {
                $error_message = "Failed to upload image.";
            }
        }
    }

    $video_type = sanitize_input($_POST['video_type']);
    $video_value = $course['video_value'];

    if ($video_type === 'embed') {
        $video_value = $_POST['video_embed'] ?? '';
    } elseif ($video_type === 'link') {
        $video_value = $_POST['video_link'] ?? '';
    } elseif ($video_type === 'upload' && isset($_FILES['video_upload']) && $_FILES['video_upload']['error'] == 0) {
        $allowed_video_types = ["mp4" => "video/mp4"];
        $filename = $_FILES['video_upload']['name'];
        $filetype = $_FILES['video_upload']['type'];
        $filesize = $_FILES['video_upload']['size'];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed_video_types) || !in_array($filetype, $allowed_video_types)) {
            $error_message = "Invalid video format.";
        } elseif ($filesize > 100 * 1024 * 1024) {
            $error_message = "Video size exceeds 100MB.";
        } else {
            $new_filename = uniqid() . "." . $ext;
            $target_path = "uploads/" . $new_filename;
            if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_path)) {
                if (!empty($course['video_value']) && $course['video_type'] === 'upload' && file_exists($course['video_value'])) {
                    unlink($course['video_value']);
                }
                $video_value = "uploads/" . $new_filename;
            } else {
                $error_message = "Failed to upload video.";
            }
        }
    }

    if (!isset($error_message)) {
        $sql = "UPDATE courses SET title=?, description=?, price=?, teacher=?, image_path=?, video_type=?, video_value=?, duration_value=?, duration_unit=? WHERE course_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdsssssi", $title, $description, $price, $teacher, $image_path, $video_type, $video_value, $duration_value, $duration_unit, $course_id);

        if ($stmt->execute()) {
            $success_message = "Course updated successfully.";
            $course = array_merge($course, compact('title', 'description', 'price', 'teacher', 'image_path', 'video_type', 'video_value', 'duration_value', 'duration_unit'));
        } else {
            $error_message = "Error updating course: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ETBS | Admin Dashboard - Edit Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet" />
    <style>
        .border-box { border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px; }
        .form-label { font-weight: 500; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<?php include 'header3.php'; ?>

<div class="container">
    <h5 class="mt-5">Welcome Admin, this page is dedicated to <span class="text-danger">editing existing Courses</span></h5>
    <a href='admindashboard.php' class='btn btn-outline-danger mt-2 mb-2'>Back to Dashboard</a>
    <a href='add_course.php' class='btn btn-danger mt-2 mb-2'>Add New Course</a>
    <a href='view_courses.php' class='btn btn-danger mt-2 mb-2'>View All Courses</a>

    <div class="shadow border-box">
        <?php if (isset($error_message)): ?>
            <p class="error"><?= $error_message; ?></p>
        <?php elseif (isset($success_message)): ?>
            <p class="success"><?= $success_message; ?></p>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?course_id=" . $course_id; ?>">
            <div class="mb-3">
                <label class="form-label">Course Title:</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($course['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Course Overview:</label>
                <textarea name="description" id="summernote" class="form-control"><?= html_entity_decode($course['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Course Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($course['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Preceptor:</label>
                <input type="text" name="teacher" class="form-control" value="<?= html_entity_decode($course['teacher']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Course Image:</label>
                <?php if (!empty($course['image_path'])): ?>
                    <img src="../<?= $course['image_path'] ?>" alt="Course Image" style="max-width: 200px;" class="d-block mb-2">
                <?php endif; ?>
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Leave blank to retain current image.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Video Type:</label>
                <select name="video_type" class="form-select" id="video_type" onchange="toggleVideoInputs()" required>
                    <option value="">-- Select --</option>
                    <option value="embed" <?= $course['video_type'] === 'embed' ? 'selected' : '' ?>>Embed</option>
                    <option value="link" <?= $course['video_type'] === 'link' ? 'selected' : '' ?>>External Link</option>
                    <option value="upload" <?= $course['video_type'] === 'upload' ? 'selected' : '' ?>>Upload</option>
                </select>
            </div>

            <div class="mb-3 video-input" id="embed_input" style="display: none;">
                <label class="form-label">Embed Code</label>
                <textarea name="video_embed" class="form-control"><?= $course['video_type'] === 'embed' ? htmlspecialchars($course['video_value']) : '' ?></textarea>
            </div>

            <div class="mb-3 video-input" id="link_input" style="display: none;">
                <label class="form-label">Video Link</label>
                <input type="url" name="video_link" class="form-control" value="<?= $course['video_type'] === 'link' ? htmlspecialchars($course['video_value']) : '' ?>">
            </div>

            <div class="mb-3 video-input" id="upload_input" style="display: none;">
                <label class="form-label">Upload Video (MP4 only)</label>
                <input type="file" name="video_upload" accept="video/mp4" class="form-control">
                <?php if ($course['video_type'] === 'upload' && !empty($course['video_value'])): ?>
                    <video controls class="mt-2" style="max-width: 400px;">
                        <source src="<?= $course['video_value'] ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="duration_value" class="form-label">Course Duration Value:</label>
                <input type="number" value="<?= htmlspecialchars($course['duration_value']) ?>" name="duration_value" id="duration_value" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
                <label for="duration_unit" class="form-label">Course Duration Unit:</label>
                <select name="duration_unit" id="duration_unit" class="form-select" required>
                    <option value="weeks" <?= $course['duration_unit'] === 'weeks' ? 'selected' : '' ?>>Weeks</option>
                    <option value="months" <?= $course['duration_unit'] === 'months' ? 'selected' : '' ?>>Months</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Course</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            callbacks: {
                onPaste: function(e) {
                    e.preventDefault();
                    const text = (e.originalEvent || e).clipboardData.getData('text/plain');
                    document.execCommand("insertText", false, text);
                }
            }
        });
        toggleVideoInputs(); // Initialize correct video field on load
    });

    function toggleVideoInputs() {
        const type = document.getElementById("video_type").value;
        document.getElementById("embed_input").style.display = type === "embed" ? "block" : "none";
        document.getElementById("link_input").style.display = type === "link" ? "block" : "none";
        document.getElementById("upload_input").style.display = type === "upload" ? "block" : "none";
    }
</script>
</body>
</html>
