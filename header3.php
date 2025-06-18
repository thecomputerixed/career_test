<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ETBS Header</title>
  <link rel="icon" type="image/png" sizes="32x32" href="source/fav/favicon-32x32.png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .navbar-sticky {
      position: sticky;
      top: 0;
      z-index: 1030;
      box-shadow: 0 2px 4px rgba(139, 0, 0, 0.2); /* dark red shadow */
      background-color: #fff;
    }
    .profile-circle {
      width: 36px;
      height: 36px;
      background-color: #dc3545; /* Red */
      color: white;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      cursor: pointer;
    }
    .navbar-nav .nav-link {
      font-weight: 500;
    }
  </style>
</head>
<body>

<!-- Header Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-sticky px-3 py-2">
  <div class="container-fluid">
    
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="source/img/etbs Logo.png" alt="ETBS Logo" height="36" class="me-2">
    </a>

    <!-- Search Bar -->
    <form class="d-none d-md-flex mx-auto w-50">
      <input class="form-control" type="search" placeholder="Find expert-led courses to boost your career">
    </form>

    <ul class="navbar-nav d-none d-lg-flex flex-row gap-4 ms-3">
      <li class="btn btn-danger nav-item"><a class="nav-link text-white " href="user/login.php">Continue to Dashboard</a></li>
    </ul>
    <!-- Icons & Profile -->
    <div class="d-flex align-items-center gap-3 ms-3">


      <!-- Bell Icon -->
      <a href="#" class="text-dark position-relative">
        <i class="bi bi-bell fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">1</span>
      </a>

  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
