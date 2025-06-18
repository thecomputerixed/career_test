<?php
require_once 'config.php';
require_once 'functions.php';

if (!isset($_SESSION['admin_id'])) {
    redirect("adminlogin.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ETBS | Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .dashboard {
      padding: 2rem 1rem;
    }
    .tabs {
      flex-wrap: wrap;
    }
    .tab { 
      cursor: pointer;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      background-color: #e9ecef;
      transition: background-color 0.2s;
      margin-bottom: 0.5rem;
    }
    .tab.active {
      background-color: #c1121f;
      color: white;
    }
    .tab:hover {
      background-color: #d4d4d4;
    }
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .course-card {
      background-color: white;
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin-bottom: 1rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    .status {
      font-weight: bold;
      color: #767372;
    }
    .btn-etbs {
      background-color: #c1121f;
      color: white;
    }
    .btn-etbs:hover {
      background-color: #a10e19;
    }
  </style>
</head>
<?php include('header3.php'); ?>
<body>
<!-- Desktop View -->
<div class="dashboard">
<h2 class="container mb-3">Welcome, your ID no is <?php echo $_SESSION['admin_id']; ?> 
  <span class="text-danger">Dashboard</span></h2>
<hr class="container">
  <div class="d-flex tabs flex-wrap gap-2 container mb-3">
      <div class="tab active" onclick="showTab('enroll')">Manage Enrollment</div>
      <div class="tab" onclick="showTab('courses')">Manage Courses</div>
      <div class="tab" onclick="showTab('module')">Manage Modules</div>
      <div class="tab" onclick="showTab('quiz')">Modules Quiz</div>
      <div class="tab" onclick="showTab('exams')">Course Exams</div>
      <div class="tab" onclick="showTab('career')">Career Test Q & A</div>
      <div class="tab" onclick="showTab('outcome')">Career Outcome</div>
  </div>
<hr class="container">
    <div class="container">
        <div id="enroll" class="tab-content active">
          <h5 class="text-danger">Manage All Who Have Enrolled Here</h5>
          <!-- Wishlist Item -->
          <div class='col-lg-8'>
            <hr>
            <!-- Item 1 -->
            <div class='d-flex mb-4 course-card'>
              <img src='source/img/vstudents.png' class='me-3' alt='Course 1' style='width: 200px; height: 200px; object-fit: cover;'>
              <div class='flex-grow-1'>
                <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                <p class='mb-1 text-muted'></p>
                <div class='d-flex align-items-center small'>
                  <span class='me-2 fw-bold text-danger'>1 ★</span>
                  <span class='me-4 text-muted'>View All who had enrolled for any course</span>
                </div>
                <div class='d-flex justify-content-between align-items-center mt-2'>
                  <div>
                    <a href='view_students.php' class='me-5 text-danger'>Click to View</a>     
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
  

        <div id="courses" class="tab-content">
        <h5 class="text-danger">Manage All Course Here</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <!-- Item 1 -->
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                  <p class='mb-1 text-muted'></p>
                  <div class='d-flex align-items-center small'>
                    <span class='me-2 fw-bold text-danger'>1 ★</span>
                    <span class='me-4 text-muted'>View Course</span>
                    <span class='me-1 fw-bold text-danger'>2 ★</span>
                    <span class='me-2 text-muted'>Add New Course</span>
                    
                  </div>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                    <div>
                      <a href='view_courses.php' class='me-3 fw-bold text-danger'>View All Courses</a>
                      <a href='new_course.php' class='me-3 fw-bold text-secondary'>Add New Course</a>
                      <a href='completed_courses.php' class='me-3 fw-bold text-secondary'>Completed Courses</a>
                    </div>
                  
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangcourse.png' class='bg-light p-4 rounded shadow-sm me-3' alt='Course 1' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>
        
            
        <div id="module" class="tab-content">
          <h5 class="text-danger">Manage All Modules Here</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                  <p class='mb-1 text-muted'></p>
                  <div class='d-flex align-items-center small'>
                    <span class='me-2 fw-bold text-danger'>1 ★</span>
                    <span class='me-4 text-muted'>View All Modules</span>
                    <span class='me-1 fw-bold text-danger'>2 ★</span>
                    <span class='me-2 text-muted'>Add New Module</span>
                    
                  </div>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                    <div>
                      <a href='view_modules.php' class='fw-bold me-5 text-danger'>View Module</a>
                      <a href='add_module.php' class='fw-bold me-3 text-secondary'>Add New Module</a>
                    </div>
                  
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangmod.png' class='bg-light rounded shadow-sm ' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>

        <div id="quiz" class="tab-content">
          <h5 class="text-danger">Quiz for all Modules are Managed Here</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                  <p class='mb-1 text-muted'></p>
                    <div class='d-flex align-items-center small'>
                      <span class='me-2 fw-bold text-danger'>1 ★</span>
                      <span class='me-4 text-muted'>View All Quiz</span>
                      <span class='me-4 text-muted'></span>
                      <span class='me-4 text-muted'></span>
                      <span class='me-1 fw-bold text-danger'>2 ★</span>
                      <span class='me-2 text-muted'>Add New Quiz</span>
                      
                    </div>
                    <div class='d-flex justify-content-between align-items-center mt-2'>
                      <div>
                        <a href='view_quizzes.php' class='fw-bold me-5 text-danger'>Click to View Quiz</a>
                        <a href='add_quiz.php' class='fw-bold me-3 text-secondary'>Add New Quiz</a>
                      </div>
                    </div>
                </div>
              </div>
              <hr>
            </div> 
            <div class='col-lg-6'>
              <img src='source/img/mangquiz.png' class='bg-light rounded shadow-sm mb-3' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
            <hr>
          </div>
        </div>
        <div id="exams" class="tab-content">
          <h5 class="text-danger">Manage All Exams for Courses Here</h5>
              
          <div class='row'>
            <div class='col-lg-4'>
              <img src='source/img/mangexam.png' class='bg-light rounded shadow-sm mb-3' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
            <div class='col-lg-6'>
              <hr>
              <!-- Item 1 -->
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                  <p class='mb-1 text-muted'></p>
                  <div class='d-flex align-items-center small'>
                    <span class='me-2 fw-bold text-danger'>1 ★</span>
                    <span class='me-4 text-muted'>View All Exam Questions</span>
                    <span class='me-1 fw-bold text-danger'>2 ★</span>
                    <span class='me-2 text-muted'>Add New Exam Question</span>
                  </div>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                    <div>
                      <a href='view_exams.php' class='fw-bold me-5 text-danger'>View Exam Question</a>
                      <a href='add_exam.php' class='fw-bold me-3 text-secondary'>Add New Exam</a>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <hr>
        </div>
      
        <div id="career" class="tab-content">
          <h5 class="text-danger">View and Add More Career Questions</h5>
             
          <div class="row">
              <div class="col-lg-3">
                <img src='source/img/mangcar.png' class='me-3 mb-3' alt='Course 1' style='width: 400px; height: 400px; object-fit: cover;'>
              </div>
              <div class='col-lg-8'>
                <hr>
                <!-- Item 1 -->
                <div class='d-flex mb-4 course-card'>
                  <div class='flex-grow-1'>
                    <h5 class='mb-1'>The link below would help you alter any of the career questions</h5>
                    <p class='mb-1 text-muted'></p>
                    <div class='d-flex align-items-center small'>
                      <span class='me-2 fw-bold text-danger'>1 ★</span>
                      <span class='me-4  text-muted'>View All Career Test Question</span>
                      <span class='me-1 fw-bold text-danger'>2 ★</span>
                      <span class='me-2 text-muted'>Add New Test Question</span>
                    </div>
                    <div class='d-flex justify-content-between align-items-center mt-2'>
                      <div>
                        <a href='view_test_questions.php' class='fw-bold me-5 text-danger'>View Existing Career Question</a>
                        <a href='add_test_questions.php' class='fw-bold me-3 text-secondary'>Add New New</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
          </div>
        </div>
        <div id="outcome" class="tab-content">
          <h5 class="text-danger">Manage All Modules Here</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'>Admins are expected to follow the links below to </h5>
                  <p class='mb-1 text-muted'></p>
                  <div class='d-flex align-items-center small'>
                    <span class='me-2 fw-bold text-danger'>1 ★</span>
                    <span class='me-4 text-muted'>View Career Outcome</span>
                    <span class='me-1 fw-bold text-danger'>2 ★</span>
                    <span class='me-2 text-muted'>Add New Outcomes</span>
                    
                  </div>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                    <div>
                      <a href='view_career_profile.php' class='fw-bold me-5 text-danger'>View Career Outcome</a>
                      <a href='edit_career_profile.php' class='fw-bold me-3 text-secondary'>Add New Outcomes</a>
                    </div>
                  
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangmod.png' class='bg-light rounded shadow-sm ' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>
    </div>

<!-- Optional: include footer -->
<?php include('footer1.php'); ?>

<script>
  function showTab(tabId) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
    document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
    document.getElementById(tabId).classList.add('active');
  }
</script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


