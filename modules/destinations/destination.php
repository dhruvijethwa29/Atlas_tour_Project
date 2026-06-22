<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atlas Tour | Destinations</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-light" style="background-color: #eeedede2;">
</body>

<?php include "../../includes/header.php"; ?>

  <!-- Header -->
  <div class="container text-center py-5">
    <h1 class="fw-bold text-dark">Explore Stunning Destinations</h1>
    <p class="text-secondary">Discover the most beautiful places in the world with Atlas Tour.</p>
  </div>

  <!-- Destination Cards -->
  <div class="container">
    <div class="row">
      <!-- Destination Card 1 -->
      <div class="col-md-6 col-lg-3">
        <div class="card destination-card">
        <img src="<?php echo $base_url; ?>/assets/images/Taj Mahal.jpg" class="card-img-top">
          <div class="card-body text-center">
            <h5 class="card-title">Taj mahal</h5>
            <p class="card-text">The Taj Mahal is an iconic white marble mausoleum located in Agra.the best place for visit.</p>
            <a href="#" class="btn btn-explore btn-dark">Explore</a>
          </div>
        </div>
      </div>

      <!-- Destination Card 2 -->
      <div class="col-md-6 col-lg-3">
        <div class="card destination-card">
          <img src="<?php echo $base_url; ?>/assets/images/kerala.jpg" class="card-img-top" alt="kerala">
          <div class="card-body text-center">
            <h5 class="card-title">Kerala</h5>
            <p class="card-text">Kerala is known for its beautiful backwaters, lush greenery,and rich cultural heritage.</p>
            <a href="#" class="btn btn-explore btn-dark">Explore</a>
          </div>
        </div>
      </div>

      <!-- Destination Card 3 -->
      <div class="col-md-6 col-lg-3">
        <div class="card destination-card">
          <img src="<?php echo $base_url; ?>/assets/images/Hampi.jpg" class="card-img-top" alt="hampi">
            <div class="card-body text-center">
            <h5 class="card-title">Hampi</h5>
            <p class="card-text">Hampi is a UNESCO world heritage site known for its ancient temples and ruins.</p>
            <a href="#" class="btn btn-explore btn-dark">Explore</a>
          </div>
        </div>
      </div>

      <!-- Destination Card 4 -->
      <div class="col-md-6 col-lg-3">
        <div class="card destination-card">
          <img src="<?php echo $base_url; ?>/assets/images/Goa.jpg" class="card-img-top" alt="goa">
          <div class="card-body text-center">
            <h5 class="card-title">Goa</h5>
            <p class="card-text">Famous for its beaches, vibrant nightlife, and Portuguese heritage.the best place for visit.+</p>
            <a href="#" class="btn btn-explore btn-dark">Explore</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Call to Action -->
  <section class="py-5 text-center" style="background-color: #99979792;">
    <div class="container">
      <h2 class="fw-bold text-dark mb-3">Ready to Explore?</h2>
      <p class="text-dark mb-4">Contact Atlas Tour today to plan your next unforgettable adventure!</p>
      <a href="<?php echo $base_url; ?>/contact.php" class="btn btn-light btn-lg">Contact Us</a>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <?php
include "../../includes/footer.php";
?>

</body>
</html>
