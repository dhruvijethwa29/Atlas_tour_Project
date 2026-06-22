<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Atlas Tour</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
        background-color: #fbfefdfc;
        color: #5e4444ff;
    }
    .about-header {
        background-color: #100f0fff;
        border-bottom: 1px solid #333;
        padding: 60px 0;
    }
    .content-card {
        background-color: #f4f4f4ff;
        border: 1px solid #333;
        border-radius: 12px;
    }
    .img-fluid {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }
    .text-highlight {
        color: #0dcaf0;
    }
  </style>

</head>
<body>

<?php include "includes/header.php"; ?>

<!-- Header Banner -->
<section class="about-header text-center">
    <div class="container">
        <h1 class="fw-bold text-uppercase text-light" style="letter-spacing:3px;">ABOUT <span class="text-info">ATLAS TOUR</span></h1>
        <p class="text-secondary mt-3 mx-auto" style="max-width: 600px;">
            Atlas Tour was created with a clear purpose — to make every journey meaningful, seamless and unforgettable. 
        </p>
    </div>
</section>

<!-- Main Details Section -->
<div class="container py-5" style="max-width:1000px;">  
  
  <!-- Main Image (Fallback image block if your file is moved) -->
  <div class="mb-5 text-center">
      <!-- Trying to load the specific screenshot, using an inline style to fix dimensions nicely -->
      <img src="<?php echo $base_url; ?>/assets/images/about.png" alt="Atlas Tour Travel Group" 
      class="img-fluid" style="width:100%; object-fit:cover; height:350px; background-color:#2a2a2a;"  onerror="this.src='https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=800&q=80'">
  </div>

  <!-- Two Column Section -->
  <div class="row py-4 g-4">
    <div class="col-md-6">
      <div class="content-card p-4 h-100">
          <h4 class="fw-bold text-highlight mb-3"><i class="bi bi-briefcase"></i> What We Offer</h4>
          <p style="line-height:1.7; font-size:16px;">We provide premium yet personalized travel packages across India and the World — from royal historical tours and peaceful nature retreats to cultural journeys and thrilling beach holidays.</p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="content-card p-4 h-100">
          <h4 class="fw-bold text-highlight mb-3"><i class="bi bi-eye"></i> Our Vision</h4>
          <p style="line-height:1.7; font-size:16px;">
            We believe travel should feel effortless and enriching. Our mission is to help people connect with the world's history, cultures, food, nature, and spiritual beauty — one destination at a time.
          </p>
      </div>
    </div>
  </div>

  <!-- Image + Story -->
  <div class="row g-5 mt-3 align-items-center">
    <div class="col-md-5">
      <img src="<?php echo $base_url; ?>/assets/images/pic.png" class="img-fluid" alt="Our Story Image" onerror="this.src='https://images.unsplash.com/photo-1503220317375-aaad61436b1b?auto=format&fit=crop&w=1200&q=80'">
    </div>
    
    <div class="col-md-7">
      <h3 class="fw-bold text-dark mb-3">Our Story</h3>
      <p style="line-height:1.8; font-size:17px;" class="text-secondary">
        What began as a small travel assistance service soon grew into a full experiential travel brand. 
        <br><br>
        We collaborate with trusted local guides, premium resorts, and reliable transport services to ensure every moment of your trip with **Atlas Tour** is smooth, safe, and entirely special.
      </p>
    </div>
  </div>

  <hr class="my-5" style="border-color: #656262ff;">

  <!-- Footer CTA -->
  <div class="text-center py-4 bg-dark rounded-3 border border-secondary shadow-sm">
    <h4 class="text-light fw-bold mb-3">Ready for your next journey?</h4>
    <p class="text-secondary px-3" style="font-size:16px;">
      We make every trip a blend of comfort, discovery and memory. Let's plan it together!
    </p>
    <a href="<?php echo $base_url; ?>/contact.php" class="btn btn-info px-4 py-2 mt-2 fw-bold text-dark rounded-pill">Get in Touch <i class="bi bi-arrow-right"></i></a>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include "includes/footer.php"; ?>
  
</body>
</html>
