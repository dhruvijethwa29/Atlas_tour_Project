<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /Atlast/login.php?msg=booking");
    exit();
}

include "../../config/database.php";
$message = "";
$booking_success = false;

// Pre-fetch user data to auto-fill the form
$user_id = $_SESSION['user_id'];
$u_sql = "SELECT * FROM users WHERE id='$user_id'";
$u_res = mysqli_query($conn, $u_sql);
$user_data = mysqli_fetch_assoc($u_res);

$preselected_pkg = isset($_GET['package']) ? $_GET['package'] : '';

if (isset($_POST['book_trip'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $destination = $_POST['destination'];
    $travelers = $_POST['travelers'];
    $travel_type = $_POST['travel_type'];
    $special_requests = $_POST['special_requests'];
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO bookings (user_id, full_name, email, phone, age, destination, travelers, travel_type, special_requests, payment_method) 
            VALUES ('$user_id', '$full_name', '$email', '$phone', '$age', '$destination', '$travelers', '$travel_type', '$special_requests', '$payment_method')";
    
    if (mysqli_query($conn, $sql)) {
        $booking_success = true;
        $ticket_id = mysqli_insert_id($conn);
        $booking_date = date('d M Y');
    } else {
        $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atlas Tour Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <style>
    /* When printing or saving as PDF, hide everything except the ticket */
    @media print {
      body * {
        visibility: hidden;
      }
      #ticket-area, #ticket-area * {
        visibility: visible;
      }
      #ticket-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      .no-print {
        display: none !important;
      }
    }
  </style>

</head>

<?php include "../../includes/header.php"; ?>

<body>

  <div class="text-center text-dark p-5">
    <h1 class="fw-bold"> Travel Booking Page</h1>
    <p>Fill your details and confirm your trip</p>
  </div>

  <div class="container p-4 bg-light rounded shadow mb-5" style="max-width:700px;">
    
    <?php if ($booking_success): ?>
        
        <!-- TICKET VIEW -->
        <div id="ticket-area" class="bg-white mx-auto rounded overflow-hidden shadow position-relative text-start" style="border: 2px dashed #0dcaf0;">
            <!-- Header -->
            <div class="bg-info text-dark p-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0"><i class="bi bi-globe-central-south-asia fs-4 align-middle me-1"></i> Atlas Tour e-Ticket</h5>
                <div class="text-end">
                    <span class="d-block fw-bold fs-5">PNR: AT-<?php echo str_pad((string)$ticket_id, 4, "0", STR_PAD_LEFT) . rand(10,99); ?></span>
                    <small class="fw-bold text-dark">Date: <?php echo $booking_date; ?></small>
                </div>
            </div>
            
            <div class="p-0 row g-0">
                <!-- Left Details -->
                <div class="col-md-9 p-4" style="border-right: 2px dashed #ccc;">
                    <div class="row mb-4 mt-2">
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Passenger Name</small>
                            <h5 class="fw-bold text-dark mb-0"><?php echo htmlspecialchars($full_name); ?></h5>
                        </div>
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Destination</small>
                            <h5 class="fw-bold text-primary mb-0"><?php echo htmlspecialchars($destination); ?></h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Travel Type</small>
                            <p class="mb-0 fw-bold fs-6"><?php echo htmlspecialchars($travel_type); ?></p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Travelers</small>
                            <p class="mb-0 fw-bold fs-6"><?php echo htmlspecialchars($travelers); ?> Person(s)</p>
                        </div>
                    </div>
                    <div class="row mb-2 d-flex align-items-end">
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Payment Method</small>
                            <p class="mb-0 mt-1 d-inline-block px-3 py-1 bg-success text-white rounded-pill small fw-bold shadow-sm" style="font-size:0.8rem;"><?php echo htmlspecialchars($payment_method); ?></p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing: 1px;">Status</small>
                            <br><span class="badge bg-dark mt-1 px-3 py-2 fs-6 shadow-sm">CONFIRMED</span>
                        </div>
                    </div>
                </div>
                <!-- Right Stub -->
                <div class="col-md-3 p-4 text-center d-flex flex-column justify-content-center align-items-center bg-light">
                 <?php
                  $qrData = "Atlas Tour\n";
                  $qrData .= "PNR: AT-" . str_pad((string)$ticket_id, 4, "0", STR_PAD_LEFT) . rand(10,99) . "\n";
                  $qrData .= "Name: " . $full_name . "\n";
                  $qrData .= "Destination: " . $destination . "\n";
                  $qrData .= "Travelers: " . $travelers . "\n";
                  ?>

                  <img
                  src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?php echo urlencode($qrData); ?>"
                  alt="QR Code"
                  class="img-fluid mb-2"
                  style="border: 1px solid #ccc; padding: 5px; background-color: #fff;"
                  >

                    
                    <p class="mt-2 mb-0 fw-bold text-muted text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">Atlas Tour</p>
                </div>
            </div>
            
            <div class="bg-dark text-white text-center p-2 small" style="letter-spacing: 1px;">
                <i class="bi bi-shield-check text-info me-1"></i> Thank you for choosing Atlas Tour. Wishing you a wonderful trip!
            </div>
        </div>

        <div class="no-print mt-4 text-center">
            <button onclick="window.print()" class="btn btn-info fw-bold mb-3 px-5 py-2 rounded-pill text-dark shadow-sm fs-5">
                <i class="bi bi-printer-fill me-2"></i> Save as PDF / Print Ticket
            </button>
            <br>
            <a href="booking.php" class="text-secondary fw-bold text-decoration-underline mt-2 d-inline-block">Book Another Trip</a>
        </div>

    <?php else: ?>

        <!-- BOOKING FORM VIEW -->
        <?php echo $message; ?>
        
        <form action="" method="POST">

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required placeholder="Enter your name" value="<?php echo isset($user_data['full_name']) ? htmlspecialchars($user_data['full_name']) : ''; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="example@email.com" value="<?php echo isset($user_data['email']) ? htmlspecialchars($user_data['email']) : ''; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="number" name="phone" class="form-control" required placeholder="Enter your phone" value="<?php echo isset($user_data['phone']) ? htmlspecialchars($user_data['phone']) : ''; ?>">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required placeholder="Enter your age">
          </div>

          <div class="mb-3">
            <label class="form-label">Destination</label>
            <select class="form-select" name="destination" required>
              <option value="">Select Destination</option>
              <option value="Goa" <?php echo ($preselected_pkg=='Goa') ? 'selected' : ''; ?>>Goa</option>
              <option value="Hampi" <?php echo ($preselected_pkg=='Hampi') ? 'selected' : ''; ?>>Hampi</option>
              <option value="Kerala" <?php echo ($preselected_pkg=='Kerala') ? 'selected' : ''; ?>>Kerala</option>
              <option value="Nepal" <?php echo ($preselected_pkg=='Nepal') ? 'selected' : ''; ?>>Nepal</option>
              <option value="Leh Ladakh" <?php echo ($preselected_pkg=='Ladakh') ? 'selected' : ''; ?>>Leh Ladakh</option>
              <option value="Manali" <?php echo ($preselected_pkg=='Manali') ? 'selected' : ''; ?>>Manali</option>
              <option value="Taj Mahal" <?php echo ($preselected_pkg=='Taj_Mahal') ? 'selected' : ''; ?>>Taj Mahal</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Number of Travelers</label>
            <input type="number" name="travelers" class="form-control" required placeholder="e.g., 2">
          </div>

          <div class="mb-3">
            <label class="form-label">Travel Type</label>
            <select class="form-select" name="travel_type">
              <option>Select Travel Type</option> 
              <option>Family Trip</option>
              <option>Couple/Honeymoon</option>
              <option>Friends Group</option>
              <option>Solo Trip</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select class="form-select border-info" name="payment_method" required>
              <option value="Debit/Credit Card">Debit/Credit Card</option>
              <option value="UPI / QR Scan">UPI / QR Scan</option>
              <option value="Net Banking">Net Banking</option>
              <option value="Cash on Arrival">Cash on Arrival</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Special Requests</label>
            <textarea class="form-control" name="special_requests" placeholder="Any special requirement?"></textarea>
          </div>
          
          <button type="submit" name="book_trip" class="btn btn-info rounded-pill fw-bold w-100 mt-3 text-dark">
            Proceed to Book
          </button>

        </form>

    <?php endif; ?>

  </div>

<?php include "../../includes/footer.php"; ?>

</body>
</html>
