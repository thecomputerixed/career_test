<?php
require_once 'config.php';
require_once 'functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Optional: redirect to form if user jumps here directly
    header("Location: taketest.php");  
    exit();
}
 
$sql = "SELECT user_id, email, phone_number, name FROM user_details";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8' />
  <title>ETBS | Career - Result</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' />
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css' rel='stylesheet' />
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
<style>
        body {
          font-family: Arial, sans-serif;

          background: #f0f0f5;
        }
        
        .dashboard {
          display: flex;
          gap: 40px;
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
</style>
    </head>
    <body>
        <!-- Hero Section -->
        <section>
            <div class='container py-5'>
                
              
                <h1 class='display-5 fw-bold'>CAREER <span class='text-danger'> TEST STAT</span></h1>
                
                <div class='d-flex justify-content-between align-items-center mb-4'>
                    
                    <div class='mt-5 row align-items-center'>
                        <div class='dashboard'>
                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['A']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['A']}%</div>
                                </div>
                                <div class='label'>Thinker</div>
                                <div class='subtext'>{$counts['A']} </div>
                            </div>

                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['B']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['B']}%</div>
                                </div>
                                <div class='label'>Helper</div>
                                <div class='subtext'>{$counts['B']}</div>
                            </div>

                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['C']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['C']}%</div>
                                </div>
                                <div class='label'>Doer</div>
                                <div class='subtext'>{$counts['C']}</div>
                            </div>
                            <div class='circle-container'>
                                 <div class='circle' style='--percent:{$percentages['D']}; --color: #FF0000;'>
                                  <div class='percentage'> {$percentages['D']}%</div>
                                </div>
                                <div class='label'>Leader</div>
                                <div class='subtext'>{$counts['D']}</div>
                            </div>
                        </div>
                    
                    </div>
                    <div class='col-md-6 mb-4 mb-md-0 text-center'>
                        <img src='source/img/cac1.png' alt='Hero Image' style='max-width: 60%; height: auto;' />
                    </div>
                </div>
            </div>
        </section>
        <section class='py-5'>
          <div class='container'>
            <div class='row align-items-center'>
              <div class='col-md-12'>
              <h3 class='fw-bold'>Hello <span class='text-danger'> $name,</span></h3>
                <h4 class='fw-bold'>Your Primary Career Type is :   <span class='text-danger'> {$primary}.</span> while your Secondary Trait is :   <span class='text-danger'> {$secondary}.</h4>
                
               <h5 class='text-danger'>What it means: </h5> <p class='lead text-muted'>{$outcome['meaning']}</p>
              </div>

            </div>
          </div>
        </section>

       
        <div class='container py-5'>
          <div class='text-center mb-5'>
            <h2 class='fw-bold'>Read Carefully,  <span class='text-danger'>Take the Next Big Step</span></h2>
            <p class='mx-auto' style='max-width: 700px;'>
              Based on the sincere answers you gave, below is the result - Your Personality
             </p>
          </div>

          <div class='row text-start'>
            <div class='col-md-6 mb-4 d-flex'>
              <div class='me-3 icon-box'>
                🛡️
              </div>
              <div>
                <h5 class='fw-bold'>Ideal Career Paths</h5>
                <p>{$outcome['ideal_careers']}</p>
              </div>
            </div>

            <div class='col-md-6 mb-4 d-flex'>
              <div class='me-3 icon-box'>
                🧠
              </div>
              <div>
                <h5 class='fw-bold'>Strengths</h5>
                <p>{$outcome['strengths']}</p>
              </div>
            </div>

            <div class='col-md-6 mb-4 d-flex'>
              <div class='me-3 icon-box'>
                📄
              </div>
              <div>
                <h5 class='fw-bold'>Watch Out</h5>
                <p>{$outcome['watch_out']}</p>
              </div>
            </div>

            <div class='col-md-6 mb-4 d-flex'>
              <div class='me-3 icon-box'>
                🎯
              </div>
              <div>
                <h5 class='fw-bold'>Career Personality</h5>
                <p>{$outcome['career_personality']}</p>
              </div>
            </div>
          </div>
        </div>
        <section class='py-5 bg-light'>
            <div class='container'>
                <h2 class='text-center fw-bold mb-4'>Ready to reimagine your career?</h2>
                <p class='text-center text-muted mb-5'>Get the skills and real-world experience employers want with Career Accelerators.</p>

                <div class='row g-4'>
                <!-- Card 1 -->
                <div class='col-md-4'>
                    <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='source/img/HrHr.png' class='card-img-top' alt='Full Stack Web Developer'>
                      <div class='card-body'>
                          <h5 class='card-title'>Full Stack Web Developer</h5>
                          <p class='card-text text-muted mb-2'> Standard</p>
                         
                      </div>
                       <div class='hover-overlay shadow'style='width: 80%; height: 415px;'>
                          <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                          <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                          <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                           <div class='d-flex align-items-center small text-muted'>
                              <span class='me-2 text-white'>⭐ 3.7</span>
                              <span class='me-2 text-white'>• 440K ratings</span>
                              <span>• 87 total hours</span>
                              
                           </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>
                      </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class='col-md-4'>
                  <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='source/img/mangcar.png' class='card-img-top' alt='Digital Marketer'>
                      <div class='card-body'>
                          <h5 class='card-title'>Digital Marketer</h5>
                          <p class='card-text text-muted mb-2'>Professional</p>
                      </div>
                      <div class='hover-overlay shadow'>
                            <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                            <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                            <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                            <div class='d-flex align-items-center small text-muted'>
                                <span class='me-2 text-white'>⭐ 3.7</span>
                                <span class='me-2 text-white'>• 440K ratings</span>
                                <span>• 87 total hours</span>
                                
                            </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>
                    </div>
                   </div>
                </div>

                <!-- Card 3 -->
                <div class='col-md-4'>
                    <div class='card h-100 shadow-sm border-0 position-relative hover-info-card'>
                      <img src='source/img/sample.png' class='card-img-top' alt='Data Scientist'>
                      <div class='card-body'>
                          <h5 class='card-title'>Data Scientist</h5>
                          <p class='card-text text-muted mb-2'>Executive</p>
                        
                      </div>
                      <div class='hover-overlay shadow'>
                            <p class='mb-1 text-white'><strong>Updated:</strong> March 2025</p>
                            <p class='mb-1 text-white'>Master Figma, prototyping, and user research.</p>
                            <p class='mb-1 text-white'>Create intuitive and beautiful user experiences.</p>
                            <div class='d-flex align-items-center small text-muted'>
                                <span class='me-2 text-white'>⭐ 3.7</span>
                                <span class='me-2 text-white'>• 440K ratings</span>
                                <span>• 87 total hours</span>
                            </div>
                            <a href='#' class='btn btn-sm btn-light mt-2' id='addToBasket'>Add to course Basket</a>

                      </div>
                    </div>
                </div>
                </div>

                <!-- BACKDROP -->
                <div id='overlay' class='position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-none' style='z-index: 1040;'></div>
                

                <!-- CART MODAL -->
            
                <!-- CART MODAL -->
                <div id='cartPopup' class='card position-fixed top-50 start-50 translate-middle shadow d-none' style='width: 90%; max-width: 600px; z-index: 1050; max-height: 90vh; overflow-y: auto;'>

                    <div class='card-header bg-white d-flex justify-content-between align-items-center'>
                      <h5 class='mb-0'>Added to cart</h5>
                      <button type='button' class='btn-close' id='closeCart' aria-label='Close'></button>
                    </div>
                    <div class='card-body'>
                          <div class='d-flex align-items-center mb-3'>
                            <img src='sample.png' class='me-3' alt='Course 1' style='width: 100px; height: 100px; object-fit: cover;'>
                            <div class=''>
                                <h6 class='mb-0'>Artificial Intelligence AI Marketing to Grow your Business</h6>
                                <small>Diego Davila • 1,000,000+ Students</small>
                                <p class='mb-0 text-muted'>₦54,900</p>
                            </div>
                          </div>
                          <div>
                            <a href='#' class='btn btn-danger mt-3 w-100'>Go to Course Basket</a>
                          </div>
                  
                      <hr>
                      <h6 class='mb-3 text-danger'>Get Specialized by Taking these other Courses</h6>
                       <hr>
                      <div class='d-flex align-items-center mb-3'>
                        <img src='HrHr.png' class='me-3' alt='Course 2' style='width: 150px; height: 150px; object-fit: cover;'>
                        <div>
                          <h6 class='mb-0'>Neuromarketing: Applied Neuroscience to Grow...</h6>
                          <small>Diego Davila • 1,000,000+ Students</small>
                          <p class='mb-0 text-muted'>₦27,900</p>
                        </div>
                      </div>

                      <div class='d-flex align-items-center mb-3'>
                        <img src='sample.png' class='me-3' alt='Course 3' style='width: 150px; height: 150px; object-fit: cover;'>
                        <div>
                          <h6 class='mb-0'>Email Marketing Masterclass: Start &...</h6>
                          <small>Diego Davila • 1,000,000+ Students</small>
                          <p class='mb-0 text-muted'>₦35,900</p>
                        </div>
                      </div>

                      <hr>
                      <div class='d-flex justify-content-between'>
                      <div>
                        <strong>Total:</strong>
                        <strong>₦118,700</strong>
                      </div>
                      <a href='#' class='btn btn-danger mt-3 w-100'>Add all to Course Basket</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class='text-center mt-4'>
                  <a href='#' class='btn btn-outline-danger'>View Other Courses</a>
                </div>
            </div>

        </section>
      <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
      <script>
          const showBtn = document.getElementById('addToBasket');
          const cartPopup = document.getElementById('cartPopup');
          const overlay = document.getElementById('overlay');
          const closeBtn = document.getElementById('closeCart');

          showBtn.addEventListener('click', function(e) {
            e.preventDefault();
            cartPopup.classList.remove('d-none');
            overlay.classList.remove('d-none');
          });

          closeBtn.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
          });

          // Optional: Click outside to close
          overlay.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
          });
          showBtn.addEventListener('click', function(e) {
            e.preventDefault();
            cartPopup.classList.remove('d-none');
            overlay.classList.remove('d-none');
            document.body.style.overflow = 'hidden'; // Prevent background scroll
          });

          closeBtn.addEventListener('click', function() {
            cartPopup.classList.add('d-none');
            overlay.classList.add('d-none');
            document.body.style.overflow = ''; // Re-enable scroll
          });

      </script>

    </body>
    </html>
