<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "../../config/database.php";
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM bookings WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Bookings - Atlas Tour</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
      body { background-color: #f1f1f1; }
      .booking-card {
          border-left: 5px solid #0dcaf0;
          transition: transform 0.2s;
      }
      .booking-card:hover {
          transform: translateY(-3px);
      }
  </style>
</head>
<body class="text-dark">
<?php include "../../includes/header.php"; ?>

<div class="container py-5 mt-3" style="min-height: 60vh;">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-person-circle display-4 text-info me-3"></i>
        <div>
            <h2 class="fw-bold mb-0">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
            <p class="text-muted mb-0">Manage your profile and booked tickets here.</p>
        </div>
    </div>

    <h4 class="mb-3 border-bottom pb-2">My Booked Tickets</h4>
    
    <div class="row g-4 mt-2">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100 booking-card bg-white">
                    <div class="card-header bg-white fw-bold border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-geo-alt-fill text-info me-1"></i> <?php echo htmlspecialchars($row['destination']); ?></span>
                            <span class="badge bg-success rounded-pill">Confirmed</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Passenger Name</span>
                                <strong><?php echo htmlspecialchars($row['full_name']); ?></strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Travelers</span>
                                <strong><?php echo htmlspecialchars($row['travelers']); ?> Person(s)</strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Travel Type</span>
                                <strong><?php echo htmlspecialchars($row['travel_type']); ?></strong>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <span class="text-muted small d-block">Contact</span>
                                <strong><?php echo htmlspecialchars($row['phone']); ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <small class="text-muted"><i class="bi bi-wallet2 me-1"></i> Payment Method: <strong class="text-dark"><?php echo htmlspecialchars($row['payment_method'] ?? 'Cash on Arrival'); ?></strong></small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5 bg-white shadow-sm rounded border">
                    <i class="bi bi-ticket-detailed display-1 text-muted mb-3 d-inline-block"></i>
                    <h4 class="text-muted fw-bold">You haven't booked any trips yet.</h4>
                    <p class="text-secondary">Explore our amazing packages and start your journey!</p>
                    <a href="package.php" class="btn btn-info mt-2 text-dark fw-bold rounded-pill px-4">Explore Packages</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>
</body>
</html>
