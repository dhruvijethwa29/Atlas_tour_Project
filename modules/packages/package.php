<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atlas Tour | Packages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .package-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    .img-wrapper {
        overflow: hidden;
    }
    .package-card img {
        transition: transform 0.5s ease;
    }
    .package-card:hover img {
        transform: scale(1.1);
    }
    .btn-custom {
        background: linear-gradient(45deg, #20c997, #008080);
        color: white;
        border: none;
        transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
    }
    .btn-custom:hover {
        background: linear-gradient(45deg, #008080, #20c997);
        color: white;
        box-shadow: 0 5px 15px rgba(32, 201, 151, 0.4);
        transform: scale(1.05);
    }
    .price-tag {
        background: rgba(32, 201, 151, 0.1);
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        color: #008080;
    }
  </style>
</head>
<body class="bg-light text-dark">

<?php include "../../includes/header.php"; ?>

<section class="text-center py-5" style="background-color:#008080;">
  <div class="container">
    <h1 class="fw-bold text-white">Our Best Travel Packages</h1>
    <p class="text-light">Choose from our handpicked destinations and make your travel dreams come true.</p>
  </div>
</section>

<div class="container py-5">
  <div class="row g-4">
    <!-- Goa -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/Goa.jpg" class="card-img-top" alt="Goa" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Goa Beach Holiday</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">4 Days / 3 Nights</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Relax on the beautiful sandy beaches and enjoy the vibrant nightlife of Goa.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹15,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Goa" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Hampi -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/Hampi.jpg" class="card-img-top" alt="Hampi" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Hampi Heritage Tour</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">3 Days / 2 Nights</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Explore the ancient ruins, temples, and beautiful landscapes of Hampi.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹12,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Hampi" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Nepal -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/Nepal.jpg" class="card-img-top" alt="Nepal" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Nepal Himalayan Trek</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">6 Days / 5 Nights</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Discover the majestic mountains, serene monasteries, and rich culture of Nepal.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹25,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Nepal" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Ladakh -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/la.jpg" class="card-img-top" alt="Ladakh" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Ladakh Adventure</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">7 Days / 6 Nights</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Experience the breathtaking beauty of Pangong Lake and the valleys of Ladakh.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹35,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Ladakh" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Taj Mahal -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/Taj Mahal.jpg" class="card-img-top" alt="Taj Mahal" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Taj Mahal & Agra Tour</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">2 Days / 1 Night</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Witness the majestic beauty of the iconic Taj Mahal and explore Agra Fort.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹8,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Taj_Mahal" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

  
    <!-- Manali -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-white border-0 shadow-sm package-card h-100">
        <div class="img-wrapper">
           <img src="<?php echo $base_url; ?>/assets/images/Manali.jpg" class="card-img-top" alt="Manali" style="height: 250px; object-fit: cover;">
        </div>
        <div class="card-body text-center d-flex flex-column mt-2">
          <h5 class="card-title fw-bold" style="color:#008080; font-size: 1.4rem;">Manali Mountain Retreat</h5>
          <p class="text-secondary mb-3 flex-grow-1">
             <span class="badge bg-secondary mb-2 opacity-75">4 Days / 3 Nights</span><br>
             <span style="font-size: 0.95rem; line-height: 1.5;">Enjoy the snow-capped peaks and adventurous activities in scenic Manali.</span>
          </p>
          <h6 class="fw-bold price-tag mb-4 mx-auto">₹18,000 per person</h6>
          <a href="<?php echo $base_url; ?>/modules/bookings/booking.php?package=Manali" class="btn btn-custom rounded-pill px-5 py-2 fw-bold mt-auto align-self-center">Book Now</a>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include "../../includes/footer.php"; ?>

</body>
</html>
