<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
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

    <!-- Step 1 -->
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
      <button type="button" class="btn btn-danger" onclick="nextStep(2)">Next</button>
    </div>

    <!-- Step 2 -->
    <div class="step-section" id="step2">
      <h4>Step 2: Module Content</h4>
      <div id="modulesContainer"></div>
      <button type="button" class="btn btn-secondary" onclick="nextStep(1)">Back</button>
      <button type="button" class="btn btn-outline-danger" onclick="nextStep(3)">Next</button>
    </div>

    <!-- Step 3 -->
    <div class="step-section" id="step3">
      <h4>Step 3: Final Exam Questions</h4>
      <div id="examContainer" class="mb-3">
        <p class="text-muted">Add your exam questions below.</p>
      </div>
      <button type="button" class="btn btn-secondary" onclick="nextStep(2)">Back</button>
      <button type="button" class="btn btn-success" onclick="generatePreview()">Preview</button>
    </div>

    <!-- Step 4 -->
    <div class="step-section" id="step4">
      <h4>Step 4: Preview & Confirm</h4>
      <div id="previewContent" class="mb-4"></div>
      <button type="button" class="btn btn-secondary" onclick="nextStep(3)">Back</button>
      <button type="submit" class="btn btn-danger">Submit Course</button>
    </div>

  </form>
</div>

<script>
const formData = {
  step1: {},
  modules: [],
  finalExam: []
};

if (step === 1 && formData.step1.course_title) {
  document.querySelector('input[name="course_title"]').value = formData.step1.course_title;
  document.querySelector('textarea[name="course_overview"]').value = formData.step1.course_overview;
  document.querySelector('input[name="module_count"]').value = formData.step1.module_count;
  document.querySelector('select[name="has_final_exam"]').value = formData.step1.has_final_exam;
  document.getElementById('finalExamCount').value = formData.step1.final_exam_count;
}


  function saveFormData() {
    const form = document.getElementById('courseForm');
    const inputs = form.querySelectorAll('.step-section input, .step-section textarea, .step-section select');
    inputs.forEach(input => {
      if (input.type === 'file') return; // Skip files
      formData[input.name] = input.value;
    });
  }

  function restoreFormData() {
    const form = document.getElementById('courseForm');
    for (const name in formData) {
      const input = form.querySelector(`[name="${name}"]`);
      if (input) input.value = formData[name];
    }
  }

  function nextStep(step) {
    saveFormData();

    document.querySelectorAll('.step-section').forEach(section => {
      section.classList.remove('active');
    });
    document.getElementById('step' + step).classList.add('active');

    restoreFormData();

    if (step === 2) generateModules();
  }

  if (step === 2) {
  // Save step 1 data
  formData.step1 = {
    course_title: document.querySelector('input[name="course_title"]').value,
    course_overview: document.querySelector('textarea[name="course_overview"]').value,
    module_count: document.querySelector('input[name="module_count"]').value,
    has_final_exam: document.querySelector('select[name="has_final_exam"]').value,
    final_exam_count: document.getElementById('finalExamCount').value
  };
}


  function generateModules() {
    const count = parseInt(document.getElementById('moduleCount').value);
    const container = document.getElementById('modulesContainer');
    container.innerHTML = '';

    for (let i = 1; i <= count; i++) {
      const moduleHTML = `
        <div class="border-box module" id="module_${i}">
          <h5>Module ${i}</h5>
          <input type="hidden" name="module_index[]" value="${i}">
          <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" name="module_title[]" class="form-control" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Learning Objectives</label>
            <textarea name="module_objectives[]" class="form-control" required></textarea>
          </div>
          <div class="mb-2">
            <label class="form-label">Lesson Content (PDF)</label>
            <input type="file" name="module_content[]" accept="application/pdf" class="form-control module-pdf" data-index="${i}">
            <iframe id="pdfPreview_${i}" class="pdf-preview mt-2" style="display:none; width:100%; height:300px;"></iframe>
          </div>
          <div class="mb-2">
            <label class="form-label">Video Embed URL</label>
            <input type="text" name="module_video[]" class="form-control module-video" data-index="${i}">
            <img id="videoThumb_${i}" class="video-thumbnail" style="display:none; width:500px; margin-top:10px;">
          </div>
         <div class="mb-2">
            <label class="form-label">Audio Upload (mp3)</label>
            <input type="file" name="module_audio_${i}" accept="audio/mp3" class="form-control module-audio" data-index="${i}">
            <audio id="audioPreview_${i}" controls style="display:none; margin-top: 10px; width: 100%;"></audio>
          </div>

          <div class="mb-2">
            <label class="form-label">How many Quiz Questions?</label>
            <input type="number" min="1" class="form-control" onchange="generateQuizQuestions(${i}, this.value)">
          </div>
          <div id="quizContainer_${i}"></div>
        </div>`;
      container.insertAdjacentHTML('beforeend', moduleHTML);
    }

    document.querySelectorAll('.module-pdf').forEach(input => {
      input.addEventListener('change', function () {
        const file = this.files[0];
        const index = this.getAttribute('data-index');
        if (file && file.type === 'application/pdf') {
          const reader = new FileReader();
          reader.onload = function (e) {
            const iframe = document.getElementById(`pdfPreview_${index}`);
            iframe.src = e.target.result;
            iframe.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    });

    document.querySelectorAll('.module-video').forEach(input => {
      input.addEventListener('input', function () {
        const url = this.value;
        const index = this.getAttribute('data-index');
        const match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]{11})/);
        if (match) {
          const videoId = match[1];
          const thumbnailUrl = `https://img.youtube.com/vi/${videoId}/0.jpg`;
          const img = document.getElementById(`videoThumb_${index}`);
          img.src = thumbnailUrl;
          img.style.display = 'block';
        }
      });
    });
  }
  document.querySelectorAll('.module-audio').forEach(input => {
  input.addEventListener('change', function () {
    const file = this.files[0];
    const index = this.getAttribute('data-index');
    if (file && file.type.startsWith('audio/')) {
      const audio = document.getElementById(`audioPreview_${index}`);
      audio.src = URL.createObjectURL(file);
      audio.style.display = 'block';
    }
  });
});


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
        </div>
      `;
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
        </div>
      `;
    }
  }

  function generatePreview() {
    const preview = document.getElementById("previewContent");
    preview.innerHTML = "";

    // Course Info
    const courseTitle = document.querySelector('[name="course_title"]').value;
    const courseOverview = document.querySelector('[name="course_overview"]').value;
    const hasFinalExam = document.querySelector('[name="has_final_exam"]').value;
    const moduleCount = document.querySelector('[name="module_count"]').value;

    const courseImage = document.querySelector('[name="course_image"]').files[0];
    const courseImagePreview = courseImage ? URL.createObjectURL(courseImage) : '';

    preview.innerHTML += `
      <h5>Course Title: ${courseTitle}</h5>
      <p><strong>Overview:</strong> ${courseOverview}</p>
      <p><strong>Modules:</strong> ${moduleCount}</p>
      <p><strong>Final Exam:</strong> ${hasFinalExam}</p>
      ${courseImagePreview ? `<img src="${courseImagePreview}" style="max-width: 300px;" class="mb-3">` : ''}
      <hr>
    `;

    // Modules
    const modules = document.querySelectorAll(".module");
    modules.forEach((module, index) => {
      const title = module.querySelector('[name="module_title[]"]').value;
      const objectives = module.querySelector('[name="module_objectives[]"]').value;
      preview.innerHTML += `
        <div class="mb-3">
          <h6>Module ${index + 1}: ${title}</h6>
          <p><strong>Objectives:</strong> ${objectives}</p>
        </div>
      `;
    });

    nextStep(4);
  }
</script>

</body>
</html>
