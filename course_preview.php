<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Course Preview</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      margin-bottom: 20px;
      border-radius: 1rem;
    }
    .card-header {
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
  </style>
</head>
<body>
<div class="container py-5">

  <?php
  require_once 'config.php';

  function convertYouTubeToEmbed($url) {
      if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
          $videoId = '';
          if (preg_match('/(youtu\.be\/|v=)([^\&\?\/]+)/', $url, $matches)) {
              $videoId = $matches[2];
          }
          return "https://www.youtube.com/embed/$videoId";
      }
      return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
  }

  $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
  $course = null;
  $modules = [];
  $exams = [];

  if ($course_id > 0) {
      $stmt_course = $conn->prepare("SELECT * FROM courses WHERE course_id = ?");
      $stmt_course->bind_param("i", $course_id);
      $stmt_course->execute();
      $course = $stmt_course->get_result()->fetch_assoc();

      if ($course) {
          $stmt_modules = $conn->prepare("SELECT * FROM modules WHERE course_id = ?");
          $stmt_modules->bind_param("i", $course_id);
          $stmt_modules->execute();
          $modules = $stmt_modules->get_result()->fetch_all(MYSQLI_ASSOC);

          foreach ($modules as $index => $module) {
              $stmt_quiz = $conn->prepare("SELECT * FROM quizzes WHERE module_id = ?");
              $stmt_quiz->bind_param("i", $module['module_id']);
              $stmt_quiz->execute();
              $modules[$index]['quizzes'] = $stmt_quiz->get_result()->fetch_all(MYSQLI_ASSOC);
          }

          $stmt_exams = $conn->prepare("SELECT * FROM exams WHERE course_id = ?");
          $stmt_exams->bind_param("i", $course_id);
          $stmt_exams->execute();
          $exams = $stmt_exams->get_result()->fetch_all(MYSQLI_ASSOC);
      }
  }
  ?>

<?php if ($course): ?>
    <a href="view_courses.php" class="btn btn-secondary mb-4">← Back to Courses</a>

    <div class="mb-4">
        <h2 class="text-danger fw-bold"><?= htmlspecialchars($course['title']) ?></h2>
        <p class="lead">
            By <strong><?= htmlspecialchars($course['teacher']) ?></strong> |
            <span class="text-success fw-bold">$<?= number_format((float)$course['price'], 2) ?></span>
        </p>

        <div class="alert alert-secondary shadow-sm">
            <?= html_entity_decode($course['description']) ?>
        </div>

      <h2 class="accordion-header text-danger" id="heading">Course Overview Video</h2>

      <?php if (!empty($course['video_value'])): ?>
      <div class="mb-3">
          <?php
          $videoType = $course['video_type'];
          $videoVal = $course['video_value'];

          if ($videoType === 'embed') {
              // Embedded raw HTML (e.g. YouTube embed code)
              echo $videoVal;

          } elseif ($videoType === 'link') {
              // YouTube or Google Drive Link – use iframe
              echo '<div class="ratio ratio-16x9">';
              echo '<iframe src="' . htmlspecialchars(convertYouTubeToEmbed($videoVal)) . '" allowfullscreen></iframe>';
              echo '</div>';

          } elseif ($videoType === 'upload') {
              // Uploaded video file
              echo '<video class="w-100" controls>';
              echo '<source src="' . htmlspecialchars($videoVal) . '" type="video/mp4">';
              echo 'Your browser does not support the video tag.';
              echo '</video>';
          }
          ?>
    </div>
<?php else: ?>
    <p class="text-muted">No video available for this course.</p>
<?php endif; ?>




    <?php foreach ($modules as $module): ?>
      <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
          <h5 class="mb-0">Module: <?= htmlspecialchars($module['title']) ?></h5>
        </div>

        <div class="card-body">
          <?php if (!empty($module['video_link'])): ?>
            <div class="ratio ratio-16x9 mb-3">
              <iframe src="<?= convertYouTubeToEmbed($module['video_link']); ?>" allowfullscreen></iframe>
            </div>
          <?php endif; ?>

          <?php if (!empty($module['audio'])): ?>
            <div class="mb-3">
              <audio controls>
                <source src="<?= htmlspecialchars($module['audio']) ?>" type="audio/mpeg">
                Your browser does not support the audio element.
              </audio>
            </div>
          <?php endif; ?>

          <p><strong>Overview:</strong> <?= html_entity_decode($module['overview']) ?></p>
          <p><strong>Content:</strong> <?= html_entity_decode($module['description']) ?></p>

          <?php if (!empty($module['quizzes'])): ?>
            <h5 class="card-title text-danger mb-3">Test Questions</h5>
            <div class="accordion mt-3" id="quizAccordion<?= $module['module_id'] ?>">
              <?php foreach ($module['quizzes'] as $i => $quiz): ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading<?= $module['module_id'] . '_' . $i ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $module['module_id'] . '_' . $i ?>"
                            aria-expanded="false" aria-controls="collapse<?= $module['module_id'] . '_' . $i ?>">
                      <?= html_entity_decode($quiz['question']) ?>
                    </button>
                  </h2>
                  <div id="collapse<?= $module['module_id'] . '_' . $i ?>" class="accordion-collapse collapse"
                       aria-labelledby="heading<?= $module['module_id'] . '_' . $i ?>"
                       data-bs-parent="#quizAccordion<?= $module['module_id'] ?>">
                    <div class="accordion-body">
                      <ul class="list-group">
                        <li class="list-group-item">A. <?= $quiz['option_a'] ?></li>
                        <li class="list-group-item">B. <?= $quiz['option_b'] ?></li>
                        <li class="list-group-item">C. <?= $quiz['option_c'] ?></li>
                        <li class="list-group-item">D. <?= $quiz['option_d'] ?></li>
                      </ul>
                      <div class="mt-2 text-success"><strong>Correct Answer:</strong> <?= $quiz['correct_answer'] ?></div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <?php if (!empty($exams)): ?>
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h4 class="card-title text-danger mb-3">Final Exam</h4>
          <div class="accordion" id="examAccordion">
            <?php foreach ($exams as $index => $exam): ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="examHeading<?= $index ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#examCollapse<?= $index ?>" aria-expanded="false"
                          aria-controls="examCollapse<?= $index ?>">
                    <?= "Question " . ($index + 1) ?>: <?= strip_tags(html_entity_decode($exam['question'])) ?>
                  </button>
                </h2>
                <div id="examCollapse<?= $index ?>" class="accordion-collapse collapse"
                     aria-labelledby="examHeading<?= $index ?>" data-bs-parent="#examAccordion">
                  <div class="accordion-body">
                    <ul class="list-group">
                      <li class="list-group-item">A. <?= html_entity_decode($exam['option_a']) ?></li>
                      <li class="list-group-item">B. <?= html_entity_decode($exam['option_b']) ?></li>
                      <li class="list-group-item">C. <?= html_entity_decode($exam['option_c']) ?></li>
                      <li class="list-group-item">D. <?= html_entity_decode($exam['option_d']) ?></li>
                    </ul>
                    <div class="mt-2 text-success"><strong>Correct Answer:</strong> <?= strtoupper($exam['correct_answer']) ?></div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

  <?php else: ?>
    <div class="alert alert-warning">Course not found.</div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
