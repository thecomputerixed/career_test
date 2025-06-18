<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

// --- Handle Registration ---
if (isset($_POST['register'])) {
    // Registration logic here
    // Example: $email = sanitize_input($_POST['email']);
}

// --- Handle Login ---
if (isset($_POST['login'])) {
    // Login logic here
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login/Register | EarthTab</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    * { transition: all 0.5s ease; }

    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .container-fluid {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .half {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.5s ease;
      position: relative;
    }

    .left, .right {
      padding: 2rem;
      height: 100%;
      background-size: cover;
      background-position: center;
    }

    .left {
      background: url('source/img/login.png') no-repeat center center/cover;
    }

    .right {
      background: url('source/img/login.png') no-repeat center center/cover;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 2rem;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
    }

    .form-box {
      background-color: rgba(255,255,255,0.9);
      border-radius: 10px;
      padding: 2rem;
      max-width: 400px;
      width: 100%;
      z-index: 2;
    }

    .toggle-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: red;
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 5px;
      cursor: pointer;
      z-index: 3;
    }

    .hidden { display: none; }

    .slide-container {
      display: flex;
      width: 200%;
      transition: transform 0.6s ease-in-out;
    }

    .slide-inner {
      width: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .swap-right .slide-container {
      transform: translateX(-50%);
    }

    .text-section {
      max-width: 400px;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container-fluid" id="authContainer">
    <!-- LEFT SECTION -->
    <div class="half left overlay">
      <div class="text-section d-none d-md-block text-start">
        <h1 class="fw-bold display-5">EarthTab Business School</h1>
        <p class="lead">Where your dream destinations become reality.</p>
        <p>Login and travel your way to success.</p>
      </div>
    </div>

    <!-- RIGHT SECTION (Slide Container) -->
    <div class="half right">
      <button class="toggle-btn" onclick="toggleForm()">Switch</button>

      <div class="slide-container" id="slider">
        <!-- Register Form -->
        <div class="slide-inner">
          <div class="form-box">
            <h4 class="text-center mb-3">Register</h4>
            <form method="POST">
              <input type="email" name="email" class="form-control mb-3" placeholder="Email" required />
              <input type="password" name="password" class="form-control mb-3" placeholder="Password" required />
              <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm Password" required />
              <button name="register" class="btn btn-danger w-100">Register</button>
            </form>
          </div>
        </div>

        <!-- Login Form -->
        <div class="slide-inner">
          <div class="form-box">
            <h4 class="text-center mb-3">Login</h4>
            <form method="POST">
              <input type="email" name="email" class="form-control mb-3" placeholder="Email" required />
              <input type="password" name="password" class="form-control mb-3" placeholder="Password" required />
              <button name="login" class="btn btn-danger w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleForm() {
      document.getElementById('authContainer').classList.toggle('swap-right');
    }
  </script>
</body>
</html>
