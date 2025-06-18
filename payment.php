<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Checkout - ETBS</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            overflow: hidden;
        }
        .btn-etbs {
            background-color: #c00;
            color: white;
        }
        .btn-etbs:hover {
            background-color: #a00;
        }
        .etbs-logo {
            font-weight: bold;
            font-size: 1.5rem;
            color: #c00;
        }
        .scroll-less::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
<div class='container py-4'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
        <div class='etbs-logo'>ETBS</div>
        <a href='#' class='text-danger text-decoration-none'>Cancel</a>
    </div>

    <div class='row'>
        <div class='col-md-7'>
            <h2 class='mb-3'>Checkout</h2>
            <hr>

            <h5>1. Log in or create an account</h5>
            <p>Enter your email to access your purchased courses. We'll email your receipt and course access.</p>
            <form class='mb-4'>
                <div class='mb-3'>
                    <input type='email' class='form-control' placeholder='Email'>
                </div>
                <div class='d-flex align-items-center mb-3'>
                    <button class='btn btn-outline-secondary me-2'><img src='https://img.icons8.com/color/24/000000/google-logo.png'/> Google</button>
                    <button class='btn btn-outline-secondary me-2'><img src='https://img.icons8.com/color/24/000000/facebook-new.png'/> Facebook</button>
                    <button class='btn btn-outline-secondary'><img src='https://img.icons8.com/ios-filled/24/000000/mac-os.png'/> Apple</button>
                </div>
                <button type='submit' class='btn btn-etbs w-100'>Continue</button>
            </form>

            <h5>2. Billing address & Payment method</h5>
            <p class='text-muted'><i class='bi bi-lock'></i> Secured after login</p>

            <h6>Order details (2 courses)</h6>
            <div class='d-flex align-items-start mb-2'>
            <img src='HrHr.png' class='card-img-top' alt='Digital Job Interview' style='width: 100px; height: 100px; object-fit: cover;'>
                <div>
                    <div> <p class='fw-semibold mb-0 small'>Artificial Intelligence AI Marketing to Grow your Business</p></div>
                    <div class='text-muted'>₦54,900</div>
                </div>
            </div>
            <div class='d-flex align-items-start'>
            <img src='HrHr.png' class='card-img-top p' alt='Digital Job Interview' style='width: 100px; height: 100px; object-fit: cover;'>
                <div>
                    <div> <p class='fw-semibold mb-0 small'>The Complete AI-Powered Copywriting Course & ChatGPT Course</p></div>
                    <div class='text-muted'>₦57,900</div>
                </div>
            </div>
        </div>

        <div class='col-md-5 bg-light p-4 rounded'>
            <h4>Order summary</h4>
            <div class='d-flex justify-content-between'>
                <span>Original Price:</span>
                <strong>₦112,800</strong>
            </div>
            <hr>
            <div class='d-flex justify-content-between mb-4'>
                <span>Total (2 courses):</span>
                <strong>₦112,800</strong>
            </div>
            <button class='btn btn-etbs w-100'>Proceed to Payment</button>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html>
