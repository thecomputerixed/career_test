<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>ETBS | User - Career Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    .hero {
      position: relative;
      height: 50vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .hero-img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      top: 0;
      left: 0;
      z-index: 0;
    }

    .overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7); /* adjust darkness here */
      top: 0;
      left: 0;
      z-index: 1;
    }

    .hero-text {
      position: relative;
      z-index: 2;
      font-size: 5rem;
      font-weight: bold;
      text-align: center;
    }
    @media (max-width: 768px) {
          .hero-text {
            font-size: 2.5rem;
          }
        }

    .feature-section {
      padding: 80px 0;
    }
    .dashboard {
        padding: 2rem 1rem;
      }
      .tabs {
        flex-wrap: wrap;
      }
      .tab {
        cursor: pointer;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        background-color: #e9ecef;
        transition: background-color 0.2s;
        margin-bottom: 0.5rem;
      }
      .tab.active {
        background-color: #c1121f;
        color: white;
      }
      .tab:hover {
        background-color: #d4d4d4;
      }
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
      }
      .course-card {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
      }
      .status {
        font-weight: bold;
        color: #767372;
      }
      .btn-etbs {
        background-color: #c1121f;
        color: white;
      }
      .btn-etbs:hover {
        background-color: #a10e19;
      }
      .feature-image {
        max-width: 100%;
        height: auto;
      }

      .step-number {
        font-size: 1.5rem;
        font-weight: bold;
        background: #f1f1f1;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
      }

      .feature-title {
        font-weight: bold;
        font-size: 1.8rem;
        color: #1b2a4e;
      }

      .feature-text {
        font-size: 1rem;
        color: #4a4a4a;
      }

      .btn-custom {
        background-color: #0052d9;
        color: #fff;
      }

      .btn-custom:hover {
        background-color: #003ea8;
      }

      @media (max-width: 767.98px) {
        .desktop-only {
          display: none !important;
        }
      }

      @media (min-width: 768px) {
        .mobile-only {
          display: none !important;
        }
      }
  </style>
</head>
<body>
  <!-- Hero Section -->
<div class="hero position-relative text-white">
  <img src="source/img/HrHr.png" alt="Hero Background" class="hero-img">
  <div class="overlay"></div>
  <div class="hero-text">HELLO, <?= htmlspecialchars($name) ?> !</div>
</div>
<div class="dashboard">
<h2 class="container mb-3">Welcome, To the Result 
  <span class="text-danger">Corner</span></h2>
<hr class="container">
  <div class="d-flex tabs flex-wrap gap-2 container mb-3">
      <div class="tab" onclick="showTab('summary')">Summary</div>
      <div class="tab active" onclick="showTab('meaning')">What it Means: </div>
      <div class="tab" onclick="showTab('icareer')">Your Ideal Careers : </div>
      <div class="tab" onclick="showTab('strength')">Your Strengths : </div>
      <div class="tab" onclick="showTab('watchout')">Watch Out For : </div>
      <div class="tab" onclick="showTab('careerp')">Career Personality :</div>
  
  </div>

  <!-- Desktop Version -->
<hr class="container">
    <div class="container">
        <div id="summary" class="tab-content active">
          <h5 class="text-danger">This is a Summary of the test you took : </h5>
          <!-- Wishlist Item -->
          <div class='col-lg-8'>
            <hr>
            <!-- Item 1 -->
            <div class='d-flex mb-4 course-card'>
              <img src='source/img/vstudents.png' class='me-3' alt='Course 1' style='width: 200px; height: 200px; object-fit: cover;'>
              <div class='flex-grow-1'>
                <ul>
                    <li>Thinker (A): <?= $percentages['A'] ?>%</li>
                    <li>Helper (B): <?= $percentages['B'] ?>%</li>
                    <li>Doer (C): <?= $percentages['C'] ?>%</li>
                    <li>Leader (D): <?= $percentages['D'] ?>%</li>
                </ul>

                <div class="mt-4">
                    <a href="take_test.php" class="btn btn-outline-danger">Retake Test</a>
                    <a href="../dashboard.php" class="btn btn-success">Go to Dashboard</a>
                </div>
              </div>
            </div>
            <hr>
          </div>
        </div>
  
        <div id="meaning" class="tab-content">
        <h5 class="text-danger">This is what it Means : </h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <!-- Item 1 -->
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1 text-muted'><?= nl2br(htmlspecialchars($outcome['meaning'])) ?> </h5>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangcourse.png' class='bg-light p-4 rounded shadow-sm me-3' alt='Course 1' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>
            
        <div id="icareer" class="tab-content">
          <h5 class="text-danger">Your Ideal Careers would be: </h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'><?= nl2br(htmlspecialchars($outcome['ideal_careers'])) ?> </h5>
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangmod.png' class='bg-light rounded shadow-sm ' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>

       <div id="strength" class="tab-content">
          <h5 class="text-danger">Now these are your Area of Strength :</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'><?= nl2br(htmlspecialchars($outcome['strengths'])) ?> </h5>
                
                  <div class='d-flex justify-content-between align-items-center mt-2'>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class='col-lg-6'>
              <img src='source/img/mangmod.png' class='bg-light rounded shadow-sm ' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
          </div>
          <hr>
        </div>

        <div id="watchout" class="tab-content">
        <h5 class='mb-1'>You Must Watch Out for the Following :</h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                  <h5 class='mb-1'><?= nl2br(htmlspecialchars($outcome['watch_out'])) ?> </h5>
                    <div class='d-flex justify-content-between align-items-center mt-2'>
                      
                    </div>
                </div>
              </div>
              <hr>
            </div> 
            <div class='col-lg-6'>
              <img src='source/img/mangquiz.png' class='bg-light rounded shadow-sm mb-3' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
            <hr>
          </div>
        </div>

        <div id="careerp" class="tab-content">
        <h5 class='mb-1'>Your Career Personality :  </h5>
          <div class='row'>
            <div class='col-lg-6'>
              <hr>
              <div class='d-flex mb-4 course-card'>
                <div class='flex-grow-1'>
                      <p><em><?= htmlspecialchars($outcome['career_personality']) ?></em></p>
                    <div class='d-flex justify-content-between align-items-center mt-2'>
                      
                    </div>
                </div>
              </div>
              <hr>
            </div> 
            <div class='col-lg-6'>
              <img src='source/img/mangquiz.png' class='bg-light rounded shadow-sm mb-3' alt='manage modules' style='width: 360px; height: 300px; object-fit: cover;'>
            </div>
            <hr>
          </div>
        </div> 
    </div>

  <!-- Mobile Carousel Version -->
  <section class="mobile-only">
    <div id="mobileCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="text-center p-4">
            <img src="source/img/mangmod.png" class="d-block mx-auto mb-3" style="width: 500px; height: 300px; object-fit: cover;" alt="...">
            <h5 class="feature-title">All-in-one dashboard</h5>
            <p class="feature-text">Simple, clear, efficient proxy management and APIs.</p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="text-center p-4">
            <img src="source/img/mangmod.png" class="d-block mx-auto mb-3" style="width: 500px; height: 300px; object-fit: cover;" alt="...">
            <h5 class="feature-title">Flexible Integration</h5>
            <p class="feature-text">Robust APIs for seamless automation and system connection.</p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="text-center p-4">
            <img src="source/img/mangmod.png" class="d-block mx-auto mb-3" style="width: 500px; height: 300px; object-fit: cover;" alt="...">
            <h5 class="feature-title">Usage Analytics</h5>
            <p class="feature-text">Real-time insights into proxy usage for smart decisions.</p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="text-center p-4">
            <img src="source/img/mangmod.png" class="d-block mx-auto mb-3" style="width: 500px; height: 300px; object-fit: cover;" alt="...">
            <h5 class="feature-title">Usage Analytics</h5>
            <p class="feature-text">Real-time insights into proxy usage for smart decisions.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#mobileCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#mobileCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
  function showTab(tabId) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
    document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
    document.getElementById(tabId).classList.add('active');
  }
</script>
</body>
</html>



 <style>
            body, html {
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            overflow-x: hidden;
            }

            .hero {
            position: relative;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            }

            .hero-img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            top: 0;
            left: 0;
            z-index: 0;
            }

            .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* adjust darkness here */
            top: 0;
            left: 0;
            z-index: 1;
            }

            .hero-text {
            position: relative;
            z-index: 2;
            font-size: 5rem;
            font-weight: bold;
            text-align: center;
            }
            @media (max-width: 768px) {
                .hero-text {
                    font-size: 2.5rem;
                }
                }

            .feature-section {
            padding: 80px 0;
            }
            .dashboard {
                
            }
            .tabs {
                flex-wrap: wrap;
            }
            .tab {
                cursor: pointer;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                background-color: #e9ecef;
                transition: background-color 0.2s;
                margin-bottom: 0.5rem;
            }
            .tab.active {
                background-color: #c1121f;
                color: white;
            }
            .tab:hover {
                background-color: #d4d4d4;
            }
            .tab-content {
                display: none;
            }
            .tab-content.active {
                display: block;
            }
            .course-card {
                background-color: white;
                border-radius: 0.5rem;
                padding: 1.5rem;
                margin-bottom: 1rem;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            }
            .status {
                font-weight: bold;
                color: #767372;
            }
            .btn-etbs {
                background-color: #c1121f;
                color: white;
            }
            .btn-etbs:hover {
                background-color: #a10e19;
            }
            .feature-image {
                max-width: 100%;
                height: auto;
            }

            .step-number {
                font-size: 1.5rem;
                font-weight: bold;
                background: #f1f1f1;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
            }

            .feature-title {
                font-weight: bold;
                font-size: 1.8rem;
                color: #1b2a4e;
            }

            .feature-text {
                font-size: 1rem;
                color: #4a4a4a;
            }

            .btn-custom {
                background-color: #0052d9;
                color: #fff;
            }

            .btn-custom:hover {
                background-color: #003ea8;
            }

            @media (max-width: 767.98px) {
                .desktop-only {
                display: none !important;
                }
            }

            @media (min-width: 768px) {
                .mobile-only {
                display: none !important;
                }
            }
                .circle-container {
                text-align: center;
                }

                .circle {
                width: 120px;
                height: 120px;
                background: conic-gradient(
                    var(--color) calc(var(--percent) * 1%),
                    #e0e0e0 0%
                );
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: auto;
                position: relative;
                }

                .circle::before {
                content: '';
                position: absolute;
                width: 80px;
                height: 80px;
                background: #fff;
                border-radius: 50%;
                z-index: 1;
                }

                .percentage {
                position: absolute;
                font-size: 20px;
                font-weight: bold;
                z-index: 2;
                }

                .label {
                margin-top: 10px;
                font-size: 16px;
                font-weight: bold;
                }

                .subtext {
                font-size: 12px;
                color: #666;
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
                .hover-info-card {
                position: relative;
                overflow: hidden;
            }

            .hover-overlay {
                position: absolute;
                top: 0;
                left: 100;
                right: 0;
                bottom: 0;
                background-color: rgba(231, 11, 11, 0.7);
                padding: 1rem;
                display: none;
                z-index: 10;
                font-size: 0.875rem;
                color: #333;
            }

            .hover-info-card:hover .hover-overlay {
                display: block;
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            /* Background transition */
            .animated-section {
            animation: bgTransition 10s ease-in-out forwards;
            }

            @keyframes bgTransition {
            0% { background-color: white; }
            100% { background-color: #dc3545; /* Bootstrap red */ }
            }

            /* Card animation */
            .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .feature-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .animated-section {
            animation: bgTransition 10s ease-in-out forwards;
        }

        @keyframes bgTransition {
            0% { background-color: white; }
            100% { background-color: #dc3545; }
        }

        .carousel-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            overflow: hidden;
        }

        .feature-card {
            flex: 1 1 300px;
            max-width: 100%;
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 300px;
        }

        .feature-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* On mobile: horizontal scroll + swipe */
        @media (max-width: 768px) {
            .carousel-wrapper {
            flex-wrap: nowrap;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            }

            .feature-card {
            flex: 0 0 80%;
            scroll-snap-align: start;
            }

            .carousel-wrapper::-webkit-scrollbar {
            display: none;
            }
            .carousel-wrapper {
            scrollbar-width: none;
            }
        }
        @media (max-width: 768px) {
        .mobile-hide {
            display: none !important;
        }
        }
        @media (max-width: 768px) {
        #summary img {
            display: none !important;
        }
        }
  </style> 