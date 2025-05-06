<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login-Tutor</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .bg-image {
      background: url('school.jpg') no-repeat center center/cover;
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
    a {
      text-decoration: none;
      color:red;
    }

    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 8px;
      background: #fff;
      cursor: pointer;
    }

    .google-btn img {
      height: 20px;
    }

    .divider {
      text-align: center;
      margin: 1rem 0;
      position: relative;
    }

    .divider::before, .divider::after {
      content: "";
      position: absolute;
      top: 50%;
      width: 45%;
      height: 1px;
      background: #ccc;
    }

    .divider::before {
      left: 0;
    }

    .divider::after {
      right: 0;
    }

    .divider span {
      padding: 0 10px;
      background: #fff;
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
            <p class="lead">
              Where your dream destinations become reality.
            </p>
            <p>
              Embark on a journey where every corner of the world is within your reach.
            </p>
          </div>

          <!-- Login Box -->
          <div class="col-md-6">
            <div class="form-box shadow-lg">
              <h4 class="mb-3 text-center">Sign In</h4>
              <form>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter your email" required />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required />
                    <button class="btn btn-danger" type="button" id="togglePassword">
                      <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                  </div>
                  <div class="text-end mt-1">
                    <a href="#" class="small">Forgot password?</a>
                  </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">Sign In</button>
              </form>

              <div class="divider"><span>or</span></div>

              <!-- Google Login Button -->
              <div class="google-btn" id="google-signin">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo" />
                <span>Sign in with Google</span>
              </div>

              <p class="text-center mt-3 text-white">
                Are you new? <a href="#">Create an Account</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Google Identity API -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script>
    // You will set up this part after getting your client ID from Google
    window.onload = function () {
      google.accounts.id.initialize({
        client_id: "YOUR_GOOGLE_CLIENT_ID",
        callback: handleCredentialResponse
      });
      google.accounts.id.renderButton(
        document.getElementById("google-signin"),
        { theme: "outline", size: "large" }
      );
    };

    function handleCredentialResponse(response) {
      console.log("Encoded JWT ID token: " + response.credential);
      // Send this token to your server for verification
    }
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
