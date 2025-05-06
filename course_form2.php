<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Course</title>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
  <style>
    .step-section { display: none; }
    .step-section.active { display: block; }
    .border-box { border: 1px solid #ddd; border-radius: 10px; padding: 15px; margin-bottom: 15px; }
    .form-label { font-weight: 500; }
  </style>
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="text-center mb-4">Create New Course</h2>
    <form id="courseForm" method="POST" enctype="multipart/form-data" action="save_course.php">

      <!-- Step 1: Course Info -->
      <div class="step-section active" id="step1">
        <h4 class="mb-3">Step 1: Course Information</h4>

        <div class="mb-3">
          <label class="form-label">Course Title</label>
          <input type="text" name="course_title" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Course Overview</label>
          <textarea name="course_overview" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Course Cover Image</label>
          <input type="file" name="course_image" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Number of Modules</label>
          <input type="number" name="module_count" id="moduleCount" class="form-control" min="1" max="20" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Include Final Exam?</label>
          <select name="has_final_exam" class="form-select">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Number of Final Exam Questions</label>
          <input type="number" id="finalExamCount" class="form-control" min="0" onchange="generateFinalExamQuestions(this.value)">
        </div>

        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
      </div>

      <!-- Step 2: Modules -->
      <div class="step-section" id="step2">
        <h4>Step 2: Module Content</h4>
        <div id="modulesContainer"></div>
        <button type="button" class="btn btn-secondary" onclick="nextStep(1)">Back</button>
        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
      </div>

      <!-- Step 3: Exam Questions -->
      <div class="step-section" id="step3">
        <h4>Step 3: Final Exam Questions</h4>
        <div id="examContainer" class="mb-3">
          <p class="text-muted">Add your exam questions below.</p>
        </div>
        <button type="button" class="btn btn-secondary" onclick="nextStep(2)">Back</button>
        <button type="button" class="btn btn-success" onclick="generatePreview()">Preview</button>
      </div>

      <!-- Step 4: Preview -->
      <div class="step-section" id="step4">
        <h4>Step 4: Preview & Confirm</h4>
        <div id="previewContent" class="mb-4"></div>
        <button type="button" class="btn btn-secondary" onclick="nextStep(3)">Back</button>
        <button type="submit" class="btn btn-danger">Submit Course</button>
      </div>

    </form>
  </div>

  <script>
    function nextStep(step) {
      document.querySelectorAll('.step-section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById('step' + step).classList.add('active');

      if (step === 2) {
        const count = parseInt(document.getElementById('moduleCount').value);
        const container = document.getElementById('modulesContainer');
        container.innerHTML = '';
        for (let i = 1; i <= count; i++) {
          container.innerHTML += `
            <div class="border-box">
              <h5>Module ${i}</h5>
              <input type="hidden" name="module_index[]" value="${i}">
              <div class="mb-2"><label class="form-label">Title</label><input type="text" name="module_title[]" class="form-control" required></div>
              <div class="mb-2"><label class="form-label">Learning Objectives</label><textarea name="module_objectives[]" class="form-control" required></textarea></div>
              <div class="mb-2"><label class="form-label">Video Embed URL</label><input type="text" name="module_video[]" class="form-control"></div>
              <div class="mb-2"><label class="form-label">Audio Upload (mp3)</label><input type="file" name="module_audio_${i}" accept="audio/mp3" class="form-control"></div>
              <div class="mb-2">
                <label class="form-label">How many Quiz Questions?</label>
                <input type="number" min="1" class="form-control" onchange="generateQuizQuestions(${i}, this.value)">
              </div>
              <div id="quizContainer_${i}"></div>
            </div>`;
        } 
        for (let i = 1; i <= count; i++) {
          const editorId = `summernote_${i}`;
          container.innerHTML += `
            <div class="card-body">
              <div class="mb-3">
                <label for="${editorId}" class="form-label">Type or Paste course content here</label>
                <textarea id="${editorId}" name="module_content[]" required></textarea>
              </div>
            </div>
          `;

          // After adding the HTML, initialize Summernote
          setTimeout(() => {
            $('#' + editorId).summernote({
              height: 300,
              minHeight: null,
              maxHeight: null,
              focus: true
            });
          }, 0);
        }

      }
    }

    function generateQuizQuestions(moduleIndex, questionCount) {
      const container = document.getElementById(`quizContainer_${moduleIndex}`);
      container.innerHTML = '';
      for (let q = 0; q < questionCount; q++) {
        container.innerHTML += `
          <div class="border p-2 mb-2">
            <label>Question ${q + 1}</label>
            <input type="text" name="quiz_question_${moduleIndex}[]" class="form-control mb-1" placeholder="Question">
            <input type="text" name="quiz_a_${moduleIndex}[]" class="form-control mb-1" placeholder="Option A">
            <input type="text" name="quiz_b_${moduleIndex}[]" class="form-control mb-1" placeholder="Option B">
            <input type="text" name="quiz_c_${moduleIndex}[]" class="form-control mb-1" placeholder="Option C">
            <input type="text" name="quiz_d_${moduleIndex}[]" class="form-control mb-1" placeholder="Option D">
            <input type="text" name="quiz_correct_${moduleIndex}[]" class="form-control mb-1" placeholder="Correct Option">
          </div>`;
      }
    }

    function generateFinalExamQuestions(count) {
      const container = document.getElementById('examContainer');
      container.innerHTML = '';
      for (let i = 0; i < count; i++) {
        container.innerHTML += `
          <div class="mb-3">
            <label>Question ${i + 1}</label>
            <input type="text" name="exam_question[]" class="form-control mb-2">
            <input type="text" name="exam_a[]" class="form-control mb-1" placeholder="Option A">
            <input type="text" name="exam_b[]" class="form-control mb-1" placeholder="Option B">
            <input type="text" name="exam_c[]" class="form-control mb-1" placeholder="Option C">
            <input type="text" name="exam_d[]" class="form-control mb-1" placeholder="Option D">
            <input type="text" name="exam_correct[]" class="form-control mb-1" placeholder="Correct Option">
          </div>`;
      }
    }

    function generatePreview() {
      const preview = document.getElementById("previewContent");
      preview.innerHTML = '';

      const courseTitle = document.querySelector('[name="course_title"]').value;
      const courseOverview = document.querySelector('[name="course_overview"]').value;
      const moduleCount = document.getElementById('moduleCount').value;

      let html = `<h5>Course Title:</h5><p>${courseTitle}</p>`;
      html += `<h5>Overview:</h5><p>${courseOverview}</p>`;
      html += `<h5>Modules (${moduleCount}):</h5>`;

      const videos = document.querySelectorAll('[name="module_video[]"]');
      const titles = document.querySelectorAll('[name="module_title[]"]');
      const objectives = document.querySelectorAll('[name="module_objectives[]"]');
      const contents = document.querySelectorAll('[name="module_content[]"]');
      

      titles.forEach((_, i) => {
        const formattedContent = contents[i].value.replace(/\n/g, '<br>');
        html += `
          <div class="border-box container">
            <h6>Module ${i + 1}</h6>
            <p><strong>Title:</strong> ${titles[i].value}</p>
            <p><strong>Objectives:</strong> ${objectives[i].value}</p>
            <p><strong>Content:</strong><br>${formattedContent}</p>`;

        const url = videos[i].value.trim();
        let embedUrl = '';
        if (url.includes('youtube.com/watch?v=')) {
          embedUrl = `https://www.youtube.com/embed/${url.split('v=')[1].split('&')[0]}`;
        } else if (url.includes('youtu.be/')) {
          embedUrl = `https://www.youtube.com/embed/${url.split('youtu.be/')[1].split('?')[0]}`;
        }

        if (embedUrl) {
          html += `<p><strong>Video:</strong><br><iframe width="560" height="315" src="${embedUrl}" frameborder="0" allowfullscreen></iframe></p>`;
        }

        html += `</div>`;
      });

      preview.innerHTML = html;
      nextStep(4);
    }
  </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

<!-- Initialize Summernote -->

</body>
</html>
