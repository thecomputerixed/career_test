<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Career Test Landing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
    }
    .nav-link {
      font-weight: 500;
      margin-right: 1rem;
    }
    .btn-cta {
      background-color: #0066ff;
      color: white;
      font-weight: bold;
      padding: 0.5rem 1rem;
      border-radius: 25px;
    }
    .btn-cta:hover {
      background-color: #0052cc;
    }
    .custom-toggler {
      border: none;
      font-size: 1.5rem;
      background: none;
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
          <a class="nav-link" href="#benefits">Benefits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#faq">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

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

</body>
</html>
