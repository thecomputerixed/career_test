<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ETBS | My Learning</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .dashboard {
      padding: 2rem;
    }
    .dashboard h1 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
    }
    .tabs {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    .tab {
      cursor: pointer;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      background-color: #e9ecef;
      transition: background-color 0.2s;
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
<body>
<!-- Navbar -->
<nav class='navbar navbar-expand-lg navbar-light bg-light px-4'>
  <a class='navbar-brand fw-bold etbs-color' href='#'>ETBS</a>
  <form class='d-flex mx-auto w-50'>
    <input class='form-control' type='search' placeholder='Find expert-led courses to boost your career'>
  </form>
  <div class='d-flex align-items-center gap-3'>
    <button class='btn btn-outline-secondary'>Log in</button>
    <button class='btn btn-etbs'>Sign up</button>
    <div class='position-relative'>
      <i class='bi bi-cart-fill fs-5'></i>
      <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill etbs-bg'>2</span>
    </div>
  </div>
</nav>
<div class="dashboard container">
  <h1>My Learning</h1>

  <div class="tabs">
    <div class="tab active" onclick="showTab('all')">All Courses</div>
    <div class="tab" onclick="showTab('lists')">My Lists</div>
    <div class="tab" onclick="showTab('wishlist')">Wishlist</div>
    <div class="tab" onclick="showTab('archived')">Archived</div>
    <div class="tab" onclick="showTab('tools')">Learning Tools</div>
  </div>

  <!-- All Courses -->
  <div id="all" class="tab-content active">
    <div class="course-card">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5>Digital Marketing Masterclass</h5>
          <p class="mb-1">Master the essentials of SEO, email marketing, and more.</p>
          <div class="status">In Progress</div>
        </div>
        <button class="btn btn-etbs">Resume Course</button>
      </div>
    </div>

    <div class="course-card">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5>Python Programming for Beginners</h5>
          <p class="mb-1">Learn to build applications from scratch using Python.</p>
          <div class="status">Completed</div>
        </div>
        <button class="btn btn-outline-secondary">View Certificate</button>
      </div>
    </div>
  </div>

  <!-- Other Tabs -->
  <div id="lists" class="tab-content">
    <p>You haven’t created any lists yet.</p>
  </div>
  <div id="wishlist" class="tab-content">
    <p>Your wishlist currently has {dynamic} item.</p>
    <div class='col-lg-8'>
      <hr>
      <!-- Item 1 -->
      <div class='d-flex mb-4'>
        <img src='sample.png' class='me-3' alt='Course 1' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='flex-grow-1'>
          <h5 class='mb-1'>Artificial Intelligence AI Marketing to Grow your Business</h5>
          <p class='mb-0 text-muted'>By Diego Davila • 1,000,000+ Students and 1 other</p>
          <div class='d-flex align-items-center small'>
            <span class='me-2 fw-bold text-warning'>4.5 ★</span>
            <span class='me-2 text-muted'>(1,041 ratings)</span>
            <span class='me-2 text-muted'>• 4.5 total hours</span>
            <span class='me-2 text-muted'>• 46 lectures</span>
            <span class='text-muted'>• All Levels</span>
          </div>
          <div class='d-flex justify-content-between align-items-center mt-2'>
            <div>
              <a href='#' class='me-3 text-danger'>Remove</a>
              <a href='#' class='text-secondary'>Save for Later</a>
            </div>
            <strong>₦54,900</strong>
          </div>
        </div>
      </div>
  </div>
  <div id="archived" class="tab-content">
    <p>No archived courses.</p>
  </div>
  <div id="tools" class="tab-content">
    <p>Explore productivity tools for better learning!</p>
  </div>
</div>

<footer class="bg-danger text-white py-5">
  <div class="container">
    <h5 class="fw-bold mb-4">Explore top skills and certifications</h5>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">

      <div>
        <h6 class="fw-bold">In-demand Careers</h6>
        <ul class="list-unstyled">
          <li>Data Scientist</li>
          <li>Full Stack Web Developer</li>
          <li>Cloud Engineer</li>
          <li>Project Manager</li>
          <li>Game Developer</li>
          <li><a href="#" class="text-white text-decoration-underline">See all Career Academies</a></li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Web Development</h6>
        <ul class="list-unstyled">
          <li>Web Development</li>
          <li>JavaScript</li>
          <li>React JS</li>
          <li>Angular</li>
          <li>Java</li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">IT Certifications</h6>
        <ul class="list-unstyled">
          <li>Amazon AWS</li>
          <li>AWS Certified Cloud Practitioner</li>
          <li>AZ-900: Azure Fundamentals</li>
          <li>AWS Solutions Architect</li>
          <li>Kubernetes</li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Leadership</h6>
        <ul class="list-unstyled">
          <li>Leadership</li>
          <li>Management Skills</li>
          <li>Project Management</li>
          <li>Productivity</li>
          <li>Emotional Intelligence</li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Certifications by Skill</h6>
        <ul class="list-unstyled">
          <li>Cybersecurity Certification</li>
          <li>Project Mgmt Certification</li>
          <li>Cloud Certification</li>
          <li>Data Analytics Certification</li>
          <li>HR Certification</li>
          <li><a href="#" class="text-white text-decoration-underline">See all Certifications</a></li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Data Science</h6>
        <ul class="list-unstyled">
          <li>Data Science</li>
          <li>Python</li>
          <li>Machine Learning</li>
          <li>ChatGPT</li>
          <li>Deep Learning</li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Communication</h6>
        <ul class="list-unstyled">
          <li>Communication Skills</li>
          <li>Presentation Skills</li>
          <li>Public Speaking</li>
          <li>Writing</li>
          <li>PowerPoint</li>
        </ul>
      </div>

      <div>
        <h6 class="fw-bold">Business Analytics & Intelligence</h6>
        <ul class="list-unstyled">
          <li>Microsoft Excel</li>
          <li>SQL</li>
          <li>Power BI</li>
          <li>Data Analysis</li>
          <li>Business Analysis</li>
        </ul>
      </div>

    </div>

    <hr class="border-light my-4">

    <div class="row row-cols-2 row-cols-md-4 g-4">
      <div>
        <h6 class="fw-bold">About</h6>
        <ul class="list-unstyled">
          <li>About us</li>
          <li>Careers</li>
          <li>Contact us</li>
          <li>Blog</li>
          <li>Investors</li>
        </ul>
      </div>
      <div>
        <h6 class="fw-bold">Discover</h6>
        <ul class="list-unstyled">
          <li>Get the app</li>
          <li>Teach on Platform</li>
          <li>Plans and Pricing</li>
          <li>Affiliate</li>
          <li>Help and Support</li>
        </ul>
      </div>
      <div>
        <h6 class="fw-bold">For Business</h6>
        <ul class="list-unstyled">
          <li>Business Platform</li>
        </ul>
      </div>
      <div>
        <h6 class="fw-bold">Legal & Accessibility</h6>
        <ul class="list-unstyled">
          <li>Accessibility Statement</li>
          <li>Privacy Policy</li>
          <li>Sitemap</li>
          <li>Terms</li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script>
  function showTab(tabId) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));

    document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
    document.getElementById(tabId).classList.add('active');
  }
</script>

</body>
</html>
