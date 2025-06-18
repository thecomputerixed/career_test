<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "careerpath";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper: sanitize input
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admindashboard.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $stmt = $conn->prepare("SELECT admin_id, email, password FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['admin_email'] = $row['email'];
                header("Location: admindashboard.php");
                exit;
            } else {
                // Fallback to plaintext check (NOT for production)
                if ($password === $row['password']) {
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['admin_email'] = $row['email'];
                    error_log("WARNING: Plaintext password login allowed for '{$email}'. HASH passwords!");
                    header("Location: admindashboard.php");
                    exit;
                } else {
                    $error = "Invalid password.";
                }
            }
        } else {
            $error = "Invalid email address.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body, html { height: 100%; margin: 0; font-family: 'Segoe UI', sans-serif; }
    .bg-image {
      background: url('source/img/login.png') no-repeat center center/cover;
      height: 100vh; position: relative;
    }
    .overlay {
      background: rgba(0, 0, 0, 0.5); height: 100%;
      padding: 2rem; color: white;
    }
    .form-box {
      background-color: rgba(165, 161, 161, 0.6);
      border-radius: 15px; padding: 2rem;
      max-width: 400px; margin: auto;
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
          <!-- Left Side Text -->
          <div class="col-md-6 text-start d-none d-md-block">
            <h1 class="display-4 fw-bold">EarthTab Business School</h1>
            <p class="lead">Where your dream destinations become reality.</p>
            <p>Embark on a journey where every corner of the world is within your reach.</p>
          </div>

          <!-- Login Form -->
          <div class="col-md-6">
            <div class="form-box shadow-lg">
              <h4 class="mb-3 text-center">Admin | Sign In</h4>

              <!-- Error message -->
              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
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
                    <button class="btn btn-danger" type="button" id="togglePassword">
                      <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                  </div>
                  <div class="text-end mt-1">
                    <a href="#" class="small">Forgot password?</a>
                  </div>
                </div>
                <button name="login" type="submit" class="btn btn-danger w-100">Sign In</button>
              </form>

              <div class="divider"><span>or</span></div>

              <!-- Google Login Button -->
              <div class="google-btn" id="google-signin">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo" />
                <span>Sign in with Google</span>
              </div>

              <p class="text-center mt-3 text-white">
                Are you new? <a href="register_admin.php">Create an Account</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Password Toggle Script -->
  <script>
    const passwordInput = document.getElementById("password");
    const toggleBtn = document.getElementById("togglePassword");
    const eyeIcon = document.getElementById("eyeIcon");

    toggleBtn.addEventListener("click", function () {
      const isPassword = passwordInput.type === "password";
      passwordInput.type = isPassword ? "text" : "password";
      eyeIcon.classList.toggle("bi-eye");
      eyeIcon.classList.toggle("bi-eye-slash");
    });
  </script>
</body>
</html>
