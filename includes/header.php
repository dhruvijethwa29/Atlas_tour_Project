<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$base_url = "/Atlast";

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
  .navbar-brand {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
  }
  .brand-icon {
      font-size: 1.6rem;
      color: #0dcaf0;
      display: inline-block;
      transition: transform 0.5s ease;
  }
  .navbar-brand:hover .brand-icon {
      transform: rotate(360deg);
  }
  .brand-atlas {
      font-size: 1.25rem;
      font-weight: 800;
      letter-spacing: 2px;
      color: #ffffff;
      text-transform: uppercase;
  }
  .brand-tours {
      font-size: 1.25rem;
      font-weight: 400;
      letter-spacing: 4px;
      color: #0dcaf0;
      text-transform: uppercase;
  }
  .nav-link { position: relative; overflow: hidden; transition: color 0.2s; }
  .nav-link::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 0; height: 2px; background-color: #0dcaf0; transition: width 0.3s; }
  .nav-link:hover::after { width: 80%; }
  .nav-link:active { transform: scale(0.93); }
  .ripple-effect { position: absolute; width: 80px; height: 80px; margin-left: -40px; margin-top: -40px; border-radius: 50%; background-color: rgba(13,202,240,0.45); animation: ripple-anim 0.55s linear; pointer-events: none; }
  @keyframes ripple-anim { from { transform: scale(0); opacity: 1; } to { transform: scale(3); opacity: 0; } }
</style>

<!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #060606;">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-globe-central-south-asia brand-icon"></i>
      <span><span class="brand-atlas">Atlas</span>&nbsp;<span class="brand-tours">Tours</span></span>
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/about.php">About us </a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/modules/packages/package.php">Packages</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/modules/destinations/destination.php">Destinations</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/modules/bookings/booking.php">Booking</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle d-flex align-items-center gap-1" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-5" style="color: #0dcaf0;"></i> 
                <?php 
                  $firstName = explode(' ', trim($_SESSION['user_name']))[0];
                  echo "<span class='text-white'>Hi, " . htmlspecialchars($firstName) . "</span>"; 
                ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" aria-labelledby="navbarDropdown" style="background-color: #1e1e1e; border: 1px solid #333;">
                <li><h6 class="dropdown-header text-info">Profile Menu</h6></li>
                <li><a class="dropdown-item text-light" href="<?php echo $base_url; ?>/modules/bookings/my_bookings.php"><i class="bi bi-ticket-perforated me-2"></i>My Bookings</a></li>
                <li><hr class="dropdown-divider border-secondary"></li>
                <li><a class="dropdown-item text-danger" href="<?php echo $base_url; ?>/modules/admin/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
              </ul>
            </li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link active" href="<?php echo $base_url; ?>/login.php">Login/Register</a></li>
        <?php endif; ?>
      </ul>
    </div> 
    

  </div>
</nav>

<script>
 
 var navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)'); 

  // Step 2: Loop through each nav link
  for (var i = 0; i < navLinks.length; i++) {

    // Step 3: Add a click event listener to each link
    navLinks[i].addEventListener('click', function(e) {

      // Step 4: Create a new empty <span> element
      var ripple = document.createElement('span');

      // Step 5: Add the ripple CSS class to it
      ripple.classList.add('ripple-effect');

      // Step 6: Find where the user clicked (x and y position)
      var rect = this.getBoundingClientRect();
      var clickX = e.clientX - rect.left;  // X position inside the link
      var clickY = e.clientY - rect.top;   // Y position inside the link

      // Step 7: Position the ripple at the click point
      ripple.style.left = clickX + 'px';
      ripple.style.top  = clickY + 'px';

      // Step 8: Add the ripple inside the clicked link
      this.appendChild(ripple);

      // Step 9: Remove the ripple after animation is done (600ms)
      setTimeout(function() {
        ripple.remove();
      }, 600);
    });
  }
</script>

<!-- Bootstrap Bundle JS to make dropdowns work -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
