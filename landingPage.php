<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareerPath</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <style>
    :root {
      --primary-color: #C8102E;
      --secondary-color: #666666;
      --accent-color: #ffffff;
    }

    body {
      background-color: #f3f6fb;
      font-family: 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
    }

    .btn-red {
      background-color: var(--primary-color);
      color: #fff;
    }
    .btn-red:hover {
      background-color: #a10c22;
    }

    .feature-box, .course-card, .step-box {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      padding: 1rem;
      background-color: #fff;
    }

    .footer {
      background-color: #000;
      color: white;
      padding: 2rem 0;
    }

    .carousel-caption {
      bottom: 75%;
      z-index: 2;
    }

    .fade-transition {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    .fade-transition.visible {
      opacity: 1;
      transform: translateY(0);
    }

    #emailExistsModal {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 999;
    }
    .modal{
      
    }
    .modal-content {
      background: #fff;
      padding: 2em;
      border-radius: 10px;
      text-align: center;
      max-width: 400px;
    }
    .modal-content img {
      width: 60px;
      margin-bottom: 1em;
    }
    .modal-content .btn {
      margin-top: 1em;
      color: white;
    }
  @media (max-width: 768px) {
  .mobile-hide {
    display: none !important;
  }
}
 @media (min-width: 768px) {
  .desktop-hide {
    display: none !important;
  }
}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="source/img/etbs Logo.png" alt="ETBS Logo" height="45" class="me-2">
    </a>

    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span id="toggler-icon">☰</span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About Test</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#faq">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Hero Section -->
<div class="position-relative overflow-hidden" style="height: 90vh;">
  <video autoplay muted loop playsinline class="w-100 h-100 object-fit-cover">
    <source src="source/video/Herovideo.mp4" type="video/mp4">
  </video>
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>
  <div class="position-absolute top-50 start-0 translate-middle-y text-white px-4 px-md-5" style="z-index: 10;">
    <h1 id="hero-title" class="display-4 fw-bold"></h1>
    <p id="hero-subtitle" class="lead"></p>
  </div>
</div>
 
<!-- Assessment Intro Section -->
<section  class="py-5 fade-transition">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 fade-transition">
        <h1 class="fw-bold">Take This Career Test, <span class="text-danger"> Discover Your Career Path.</span></h1>
        <p class="lead text-muted">Spend just 10 minutes on our assessment and unlock exclusive access to a transformative course designed to help you stand out professionally.</p>
        <div class="d-flex gap-3">
          <h5 class="class="text-danger fw-bold"" >Look Below To Start Your CareerPath Assessment, Thank Us Later!</h5>
        </div>
        <div class="mt-4 d-flex align-items-center gap-2">
          <span class="badge rounded-pill bg-danger">YOU CAN</span>
          <small class="text-muted ms-2">Join 2,500+ Professionals Who Unlocked Their Career Potential</small>
        </div>
      </div>
      <div class="col-md-6 fade-transition"> 
        <div class="feature-box">
          <ul class="list-unstyled">
            <li class="mb-2"><span class="fw-bold text-danger me-2">1</span>Quick, tailored career assessment</li>
            <li class="mb-2"><span class="fw-bold text-danger me-2">2</span>Personalized career insights</li>
            <li class="mb-2"><span class="fw-bold text-danger me-2">3</span>Exclusive access to transformation course</li>
            <li><span class="fw-bold text-danger me-2">4</span>Advance your career with confidence</li>
          </ul>
        </div>
      </div>
    </div> 
  </div>
</section>
<hr style="color: red;">

<!-- Assessment Form Section -->
<div class="container my-5">
  <div class="row align-items-center">
     <div class='col-lg-4 d-flex justify-content-lg-end justify-content-center mb-4 mb-lg-0'>
      <img class="mobile-hide" src="source/img/fillin.gif" alt="Step Image" style="width: 400px; height: 300px; object-fit: cover;">
      <img class="desktop-hide" src="source/img/fillin-mobile.gif" alt="Step Image" style="width: 400px; height: 400px; object-fit: cover;">
    </div>
    <div class="col-lg-8" id="leftSection">
      <h2 class="text-center">This is where Your Career Path <span class="text-danger">Assessment Starts</span></h2>
      <form onsubmit="event.preventDefault(); submitForm();" id="careerForm">

        <div class="row">
          <div class="col-md-4">
            <h5 class="text-danger fw-bold"><em>Full Name</em></h5>
            <input type="text" name="name" class="form-control" placeholder="Please enter your full name" required>
          </div>
          <div class="col-md-4">
            <h5 class="text-danger fw-bold"><em>Email</em></h5>
            <input type="email" name="email" class="form-control" placeholder="Please enter your emaill here" required>
          </div>
          <div class="col-md-4">
            <h5 class="text-danger fw-bold"><em>Phone Contact</em></h5>
            <input type="tel" name="phone_number" class="form-control" placeholder="Please enter your correct phone number" required>
          </div>
        </div>

        <button type="submit" class="btn btn-danger mt-4">Submit</button>
      </form>
    </div>

    <div class="col-md-6 d-none" id="confirmationSection">
      <div id="confirmationMessage" class="text-danger fw-bold fs-5"></div>
      <div class="mt-3">
        <a href="user/take_test.php" class="btn btn-danger">Start the Test</a>
      </div>
    </div>
  </div>
</div>

<hr style="color: red;">

<div class="modal fade " id="userExistsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <img src="source/img/Media.png" alt="Exists!" style="width: 300px;" class="mx-auto" />
      <h5 class="mt-3 text-danger">Welcome back, <span id="userNamePlaceholder"></span>!</h5>
      <p class="text-muted">Your email already exists. Please Continue your Test if not completed or login instead.</p>
      <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="user/login.php" class="btn btn-outline-danger text-danger">Login</a>
        <a href="user/take_test.php" class="btn btn-danger">Complete Test</a>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
<footer class="footer mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h5>Ready to transform your career?</h5>
        <p>Take the 10-minute assessment and unlock exclusive access to our transformative career course.</p>
        <a href="#" class="btn btn-red">Start Assessment →</a>
      </div>
      <div class="col-md-4 text-end">
        <h5><span class="text-danger">Career</span>Path</h5>
        <small>Unlocking Professional Potential</small>
      </div>
    </div>
    <div class="d-flex justify-content-between pt-4">
      <small>© 2025 ETBS-CareerPath. All rights reserved.</small>
      <div>
        <a href="#" class="text-white text-decoration-none me-3">Privacy</a>
        <a href="#" class="text-white text-decoration-none me-3">Terms</a>
        <a href="#" class="text-white text-decoration-none">Back to Top</a>
      </div>
    </div>
  </div>
</footer>
<script>
    function submitForm() {
      const form = document.getElementById('careerForm');
      const formData = new FormData(form);

      fetch('acceptdetails.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'exists') {
          document.getElementById('userNamePlaceholder').innerText = data.name;
          const modal = new bootstrap.Modal(document.getElementById('userExistsModal'));
          modal.show();
        } else if (data.status === 'new') {
          document.getElementById('leftSection').classList.add('d-none');
          document.getElementById('confirmationSection').classList.remove('d-none');
          document.getElementById('confirmationMessage').innerText = 'You’re all set to begin!';
        } else {
          alert(data.message || 'Unexpected error.');
        }
      })
      .catch(err => {
        alert('Something went wrong, Ensure your phone Number or Email have not been used by another User. Check and Please try again');
        console.error(err);
      });
    }
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toggler Icon Script -->
<script>
  const navbarCollapse = document.getElementById('navbarNav');
  const togglerIcon = document.getElementById('toggler-icon');

  navbarCollapse.addEventListener('show.bs.collapse', () => {
    togglerIcon.textContent = '✖';
  });

  navbarCollapse.addEventListener('hide.bs.collapse', () => {
    togglerIcon.textContent = '☰';
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const fadeElements = document.querySelectorAll('.fade-transition');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, {
      threshold: 0.5
    });

    fadeElements.forEach(el => observer.observe(el));
  });
</script>
</body>
</html>
