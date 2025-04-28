<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareerPath Assessment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f6fb;
      font-family: 'Segoe UI', sans-serif;
    }
    .btn-red {
      background-color: #dc3545;
      color: #fff;
    }
    .btn-red:hover {
      background-color: #c82333;
    }
    .feature-box {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      padding: 1rem;
      background-color: #fff;
    }
    .footer {
      background-color: #2c3e50;
      color: white;
      padding: 2rem 0;
    }
  </style>
</head>
<body>

<!-- Hero Section -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h1 class="display-5 fw-bold">CAREER <span class="text-danger"> TEST</span></h1>
        <h4 class="fw-bold">Take the. <span class="text-danger"> Discover Your Edge.</span></h4>
        <p class="lead text-muted">Spend just 10 minutes on our assessment and unlock exclusive access to a transformative course designed to help you stand out professionally.</p>
        <div class="d-flex gap-3">
          <a href="test2.php" class="btn btn-red btn-lg">Start Your Assessment →</a>
          <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
        </div>
        <div class="mt-4 d-flex align-items-center gap-2">
          <span class="badge bg-primary">JD</span>
          <span class="badge bg-info">SK</span>
          <span class="badge bg-success">MR</span>
          <small class="text-muted ms-2">Join 2,500+ professionals who unlocked their potential</small>
        </div>
      </div>
      <div class="col-md-6">
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
<div class="container text-center mt-5">
  <h2><span class="text-dark">Career Path</span> <span class="text-danger">Assessment</span></h2>
  <p class="text-muted">Take this quick 5-question assessment to discover your career strengths and unlock your personalized path.</p>

  <div class="assessment-card">
    <div class="text-start mb-3">
      <small>Question 1 of 5</small>
      <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
      </div>
    </div>

    <form>
      <h5 class="text-start mb-4">How satisfied are you with your current career path?</h5>

      <div class="form-check text-start">
        <input class="form-check-input" type="radio" name="satisfaction" id="verySatisfied">
        <label class="form-check-label" for="verySatisfied">Very satisfied</label>
      </div>
      <div class="form-check text-start">
        <input class="form-check-input" type="radio" name="satisfaction" id="somewhatSatisfied">
        <label class="form-check-label" for="somewhatSatisfied">Somewhat satisfied</label>
      </div>
      <div class="form-check text-start">
        <input class="form-check-input" type="radio" name="satisfaction" id="neutral">
        <label class="form-check-label" for="neutral">Neutral</label>
      </div>
      <div class="form-check text-start">
        <input class="form-check-input" type="radio" name="satisfaction" id="somewhatDissatisfied">
        <label class="form-check-label" for="somewhatDissatisfied">Somewhat dissatisfied</label>
      </div>
      <div class="form-check text-start">
        <input class="form-check-input" type="radio" name="satisfaction" id="veryDissatisfied">
        <label class="form-check-label" for="veryDissatisfied">Very dissatisfied</label>
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="button" class="btn btn-danger">Take the Test</button>
      </div>
    </form>
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
      <div class="col-md-8">
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

<!-- Call to Action Footer -->
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
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
