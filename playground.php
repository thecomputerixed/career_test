<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareerPath</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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
      transition: background-color 0.3s ease;
    }
    .btn-red:hover {
      background-color: #a10c22;
    }

    .feature-box, .course-card, .step-box {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      padding: 1rem;
      background-color: #fff;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .feature-box:hover, .course-card:hover, .step-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
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
    .carousel-caption h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .carousel-caption p {
      font-size: 1.2rem;
    }

    @media (max-width: 768px) {
      .carousel-caption {
        bottom: 50%;
        text-align: center;
      }
      .carousel-caption h1 {
        font-size: 2rem;
      }
      .carousel-caption p {
        font-size: 1rem;
      }
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

    .swiper {
      width: 100%;
      padding-bottom: 40px;
    }
    .swiper-slide {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 1rem;
      margin: 10px;
    }
  </style>
</head>
<body>
<?php include('header1.php'); ?>
<!-- Hero Video Section -->
<div class="position-relative overflow-hidden" style="height: 90vh;">
    <!-- Background Video -->
    <video autoplay muted loop playsinline class="w-100 h-100 object-fit-cover">
      <source src="source/video/Herovideo.mp4" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>

    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

    <!-- Caption Content -->
    <!-- Hero Text Overlay -->
    <div class="position-absolute top-50 start-0 translate-middle-y text-white px-4 px-md-5" style="z-index: 10;">
      <h1 id="hero-title" class="display-4 fw-bold"></h1>
      <p id="hero-subtitle" class="lead"></p>
    </div>

</div>

<!-- Hero Section -->
<section  class="py-5 fade-transition">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 fade-transition">
        <h1 class="fw-bold">Take the Test, <span class="text-danger"> Discover Your Edge.</span></h1>
        <p class="lead text-muted">Spend just 10 minutes on our assessment and unlock exclusive access to a transformative course designed to help you stand out professionally.</p>
        <div class="d-flex gap-3">
          <a href="test2.php" class="btn btn-danger btn-lg">Start Your Assessment →</a>
          <p href="#" class="text-danger mt-3">Thank Us Later</p>
        </div>
        <div class="mt-4 d-flex align-items-center gap-2">
          <span class="badge rounded-pill bg-danger">JD</span>
          <small class="text-muted ms-2">Join 2,500+ professionals who unlocked their potential</small>
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

<div class='container my-5'>
  <div class='row align-items-center'>
    <!-- Left: Form Section -->
    <div class='col-md-6'>
      <h2><span class='text-dark'>Career Path</span> <span class='text-danger'>Assessment</span></h2>
      <p class='text-muted'>Start by entering your details to personalize your experience.</p>

      <div class='assessment-card' style='position: relative;'>
        <!-- Step 1 -->
        <div class='step fade-step' id='step1'>
          <h5 class='text-start mb-3'>What's your full name?</h5>
          <input type='text' class='form-control' required>
          <div class='d-flex justify-content-end mt-4'>
            <button type='button' class='btn btn-danger' onclick='showStep(2)'>
              Next <i class='bi bi-arrow-right'></i>
            </button>
          </div>
        </div>

        <!-- Step 2 -->
        <div class='step fade-step d-none' id='step2'>
          <h5 class='text-start mb-3'>Enter your email address</h5>
          <input type='email' class='form-control' required>
          <div class='d-flex justify-content-end mt-4'>
            <button type='button' class='btn btn-danger' onclick='showStep(3)'>
              Next <i class='bi bi-arrow-right'></i>
            </button>
          </div>
        </div>

        <!-- Step 3 -->
        <div class='step fade-step d-none' id='step3'>
          <h5 class='text-start mb-3'>Enter your phone number</h5>
          <input type='tel' class='form-control' required>
          <div class='d-flex justify-content-end mt-4'>
            <button type='submit' class='btn btn-danger'>
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Right: Dynamic Image Section -->
    <div class='col-md-6 text-center mt-3'>
      <img id='stepImage' style='width: 400px; height: 400px; object-fit: cover;' src='source/img/HrHr.png' alt='Step Image' class='img-fluid'>
    </div>
  </div>
</div>
<!-- Success Stories -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold">Success <span class="text-danger">Stories</span></h2>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="p-4 bg-danger text-white rounded">
          <h5>Real results from real professionals</h5>
          <p>Join thousands who have transformed their career trajectory with our assessment and course.</p>
          <a href="#" class="btn btn-light">Take Assessment →</a>
        </div>
      </div>
      <div class="col-md-8 mt-3">
        <div class="feature-box">
          <p class="mb-3">"This assessment helped me recognize my strengths and focus on what matters. The course that followed was exactly what I needed to advance my career."</p>
          <div class="d-flex align-items-center">
            <div class="bg-danger text-white rounded-circle p-2 me-3">JR</div>
            <div>
              <strong>Jessica R.</strong><br>
              <small class="text-muted">Marketing Director, Tech Solutions Inc.</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
      threshold: 0.1
    });

    fadeElements.forEach(el => observer.observe(el));
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   

    function showStep(step) {
      // Hide all steps
      document.querySelectorAll('.step').forEach(div => {
        div.classList.add('d-none');
        div.style.opacity = 0;
      });

      // Show current step
      const current = document.getElementById(`step${step}`);
      current.classList.remove('d-none');
      setTimeout(() => {
        current.style.opacity = 1;
      }, 50);

      // Change image
      const stepImage = document.getElementById('stepImage');
      const images = {
        1: 'source/img/HrHr.png',
        2: 'source/img/sample.png',
        3: 'source/img/cac1.png',
      };
      stepImage.src = images[step] || images[1];
    }
  const heroTexts = [
    {
      title: "EVER WONDERED WHERE YOU TRULY BELONG?,",
      subtitle: "Let your strengths guide the way! ."
    },
    {
      title: "FIND CLARITY AND EMBRACE PURPOSE.",
      subtitle: "Guided by experts, tailored for you."
    },
    {
      title: "DISCOVER YOUR DIRECTION.",
      subtitle: "Take the test, Take the lead."
    }
  ];

  let currentIndex = 0;
  const heroTitle = document.getElementById("hero-title");
  const heroSubtitle = document.getElementById("hero-subtitle");

  function typeEffect(element, text, callback) {
    element.innerHTML = "";
    let i = 0;
    const interval = setInterval(() => {
      element.innerHTML += text.charAt(i);
      i++;
      if (i === text.length) {
        clearInterval(interval);
        if (callback) callback();
      }
    }, 50);
  }

  function showHeroText(index) {
    const titleHTML = heroTexts[index].title.replace(/<br>/g, "\n"); // For typing effect
    const subtitle = heroTexts[index].subtitle;

    typeEffect(heroTitle, titleHTML, () => {
      typeEffect(heroSubtitle, subtitle);
    });
  }

  function cycleHeroText() {
    showHeroText(currentIndex);
    currentIndex = (currentIndex + 1) % heroTexts.length;
  }

  // Start
  cycleHeroText();
  setInterval(cycleHeroText, 10000);

</script>
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
      <small>© 2025 CareerPath. All rights reserved.</small>
      <div>
        <a href="#" class="text-white text-decoration-none me-3">Privacy</a>
        <a href="#" class="text-white text-decoration-none me-3">Terms</a>
        <a href="#" class="text-white text-decoration-none">Back to Top</a>
      </div>
  </div>
</footer>
</body>
</html>