<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>ETBS Shopping Cart</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    .etbs-color { color: red !important; }
    .etbs-bg { background-color: red !important; }
    .btn-etbs {
      background-color: red;
      color: white;
      border: none;
    }
    .btn-etbs:hover {
      background-color: darkred;
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

<!-- Shopping Cart -->
<div class='container py-5'>
  <h2 class='fw-bold'>Shopping Cart</h2>
  <p class='mb-4'>2 Courses in Cart</p>

  <div class='row'>
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
      <hr>
      <!-- Item 2 -->
      <div class='d-flex mb-4'>
        <img src='digital.jpg' class='me-3' alt='Course 2' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='flex-grow-1'>
          <h5 class='mb-1'>The Complete AI-Powered Copywriting Course & ChatGPT Course</h5>
          <p class='mb-0 text-muted'>By Ing. Tomas Moravek and 1 other</p>
          <div class='d-flex align-items-center small'>
            <span class='badge bg-success me-2'>Updated Recently</span>
            <span class='me-2 fw-bold text-warning'>4.2 ★</span>
            <span class='me-2 text-muted'>(1,854 ratings)</span>
            <span class='me-2 text-muted'>• 26.5 total hours</span>
            <span class='me-2 text-muted'>• 190 lectures</span>
            <span class='text-muted'>• All Levels</span>
          </div>
          <div class='d-flex justify-content-between align-items-center mt-2'>
            <div>
              <a href='#' class='me-3 text-danger'>Remove</a>
              <a href='#' class='text-secondary'>Save for Later</a>
            </div>
            <strong>₦57,900</strong>
          </div>
        </div>
      </div>

    </div>

    <!-- Cart Summary -->
    <div class='col-lg-4'>
      <div class='bg-light p-4 rounded shadow-sm'>
        <h5 class='fw-bold mb-3'>Total:</h5>
        <h4 class='fw-bold mb-4'>₦112,800</h4>
        <button class='btn btn-etbs w-100 mb-2'>Proceed to Checkout →</button>
        <small class='text-muted'>You won't be charged yet</small>
        <hr>
        <h6>Promotions</h6>
        <div class='input-group'>
          <input type='text' class='form-control' placeholder='Enter Coupon'>
          <button class='btn btn-etbs'>Apply</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class='container mb-5'>
  <h4 class='fw-bold mb-4'>You might also like</h4>
  <div class='row g-4'>

    <!-- Course 1 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='school.jpg' class='card-img-top' alt='AI Marketing' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>AI for Marketing: Build & implement an AI Marketing...</p>
        </div>
      </div>
    </div>

    <!-- Course 2 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='sample.png' class='card-img-top' alt='SEO Course' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>Complete Search Engine Optimization (SEO) & ChatGPT...</p>
        </div>
      </div>
    </div>

    <!-- Course 3 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='digital.jpg' class='card-img-top' alt='AI in Marketing' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>AI in Marketing</p>
        </div>
      </div>
    </div>

    <!-- Course 4 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='HrHr.png' class='card-img-top' alt='DeepSeek Course' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>ChatGPT, DeepSeek, Grok and 30+ More AI Marketing...</p>
        </div>
      </div>
    </div>

    <!-- Course 5 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='school.jpg' class='card-img-top' alt='Digital Job Interview' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>Learn How To Ace Your Digital Marketing Job Interview</p>
        </div>
      </div>
    </div>

    
    <!-- Course 5 -->
    <div class='col-md-2'>
      <div class='card h-100 border-0'>
        <img src='HrHr.png' class='card-img-top' alt='DeepSeek Course' style='width: 200px; height: 200px; object-fit: cover;'>
        <div class='card-body px-0'>
          <p class='fw-semibold mb-0 small'>ChatGPT, DeepSeek, Grok and 30+ More AI Marketing...</p>
        </div>
      </div>
    </div>

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

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
