<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Tour - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #121212; /* Dark theme base */
            color: #f1f1f1;
        }
        .hero-section {
            height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url('assets/images/freepik__talk__2731.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .feature-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #0dcaf0;
        }
        .icon-box {
            font-size: 3rem;
            color: #0dcaf0;
        }
    </style>
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- HERO SECTION -->
<section class="hero-section text-center text-white">
    <div class="container pb-5">

        <h1 class="display-3 fw-bold text-white mb-3 shadow-lg" style="letter-spacing: 2px;">Welcome to Atlas Tour</h1>
        <p class="lead mb-4 fw-light text-light">Explore the world's most beautiful destinations with confidence and comfort.</p>
        <a href="modules/about.php" class="btn btn-outline-info btn-lg px-4 me-2 rounded-pill">Discover More</a>
        <a href="modules/booking.php" class="btn btn-info btn-lg px-4 rounded-pill text-dark">Book Now</a>
    </div>
</section>

<!-- WHY CHOOSE US SECTION -->
<section class="py-5 bg-dark">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="color: #0dcaf0;">Why Choose Atlas Tours?</h2>
            <div class="mx-auto bg-info mt-2" style="height:3px; width:70px;"></div>
            <p class="text-secondary mt-3">We provide the best experiences for your vacation.</p>
        </div>
        
        <div class="row g-4 text-center">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded shadow-sm text-center">
                    <div class="icon-box mb-3">
                        <i class="bi bi-compass"></i>
                    </div>
                    <h4 class="fw-bold text-light">Expert Guides</h4>
                    <p class="text-secondary">Our knowledgeable guides ensure you never miss out on hidden gems and the rich history of your destinations.</p>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded shadow-sm text-center">
                    <div class="icon-box mb-3">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="fw-bold text-light">Safe & Secure</h4>
                    <p class="text-secondary">Your safety is our top priority. We partner with trusted local authorities and top-rated hotels exclusively.</p>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded shadow-sm text-center">
                    <div class="icon-box mb-3">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h4 class="fw-bold text-light">Affordable Pricing</h4>
                    <p class="text-secondary">Explore more while spending less! We offer premium packages that fit beautifully within your budget.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION OVERVIEW -->
<section class="py-5 text-center" style="background-color: #1a1a1a;">
    <div class="container">
        <h3 class="fw-bold text-light mb-3">Ready to start your adventure?</h3>
        <p class="text-secondary mb-4">View our hand-picked holiday packages and exclusive destinations today.</p>
        <a href="package.php" class="btn btn-info px-5 py-2 rounded-pill fw-bold text-dark">View Packages</a>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include "includes/footer.php"; ?>

</body>
</html>
