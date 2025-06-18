<?php
session_start();

// Enable error reporting (disable in production)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// DB connection
require_once 'config.php';
require_once 'functions.php'; // Must include sanitize_input()

$error = '';
$success = '';

if (isset($_POST['register'])) {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validations
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Check if email exists
        $check_stmt = $conn->prepare("SELECT admin_id FROM admins WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Email address already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $email, $hashed_password);

            if ($insert_stmt->execute()) {
                $success = "Admin registered successfully! You can now <a href='adminlogin.php'>login</a>.";
            } else {
                $error = "Error during registration. Please try again.";
            }

            $insert_stmt->close();
        }

        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body, html { height: 100%; margin: 0; font-family: 'Segoe UI', sans-serif; }
    .bg-image {
      background: url('source/img/login.png') no-repeat center center/cover;
      height: 100vh;
      position: relative;
    }
    .overlay {
      background: rgba(0, 0, 0, 0.5);
      height: 100%;
      padding: 2rem;
      color: white;
    }
    .form-box {
      background-color: rgba(165, 161, 161, 0.6);
      border-radius: 15px;
      padding: 2rem;
      max-width: 400px;
      margin: auto;
    }
    a { text-decoration: none; color: red; }
    .google-btn {
      display: flex; align-items: center; justify-content: center;
      gap: 8px; border: 1px solid #ccc;
      border-radius: 5px; padding: 8px; background: #fff;
      cursor: pointer;
    }
    .google-btn img { height: 20px; }
    .divider {
      text-align: center; margin: 1rem 0; position: relative;
    }
    .divider::before, .divider::after {
      content: ""; position: absolute; top: 50%;
      width: 45%; height: 1px; background: #ccc;
    }
    .divider::before { left: 0; }
    .divider::after { right: 0; }
    .divider span {
      padding: 0 10px; background: #fff;
    }
  </style>
</head>
<body>
  <div class="bg-image">
    <div class="overlay d-flex align-items-center">
      <div class="container">
        <div class="row">
          <!-- Left Side -->
          <div class="col-md-6 text-start d-none d-md-block">
            <h1 class="display-4 fw-bold">EarthTab Business School</h1>
            <p class="lead">Where your dream destinations become reality.</p>
            <p>Embark on a journey where every corner of the world is within your reach.</p>
          </div>

          <!-- Registration Box -->
          <div class="col-md-6">
            <div class="form-box shadow-lg">
              <h4 class="mb-3 text-center">Admin | Registration</h4>

              <!-- Show alerts -->
              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>
              <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
              <?php endif; ?>

              <form method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required />
                    <button class="btn btn-danger" type="button" id="togglePassword1">
                      <i class="bi bi-eye" id="eyeIcon1"></i>
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="confirm_password" class="form-label">Confirm Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required />
                    <button class="btn btn-danger" type="button" id="togglePassword2">
                      <i class="bi bi-eye" id="eyeIcon2"></i>
                    </button>
                  </div>
                </div>
                <button name="register" type="submit" class="btn btn-danger w-100">Register</button>
              </form>

              <div class="divider"><span>or</span></div>

              <div class="google-btn" id="google-signin">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo" />
                <span>Sign in with Google</span>
              </div>

              <p class="text-center mt-3 text-white">
                Already have an account? <a href="adminlogin.php">Login here</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Password Toggle Script -->
  <script>
    document.getElementById("togglePassword1").addEventListener("click", function () {
      const input = document.getElementById("password");
      const icon = document.getElementById("eyeIcon1");
      const type = input.getAttribute("type") === "password" ? "text" : "password";
      input.setAttribute("type", type);
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    });

    document.getElementById("togglePassword2").addEventListener("click", function () {
      const input = document.getElementById("confirm_password");
      const icon = document.getElementById("eyeIcon2");
      const type = input.getAttribute("type") === "password" ? "text" : "password";
      input.setAttribute("type", type);
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    });
  </script>
</body>
</html>
