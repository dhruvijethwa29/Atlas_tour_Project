<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?msg=contact");
    exit();
}

include "config/database.php";
$message_alert = "";

if (isset($_POST['send_message'])) {
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (user_id, full_name, email, message) VALUES ('$user_id', '$full_name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        $message_alert = "<div class='alert alert-success'>Your message has been sent successfully!</div>";
    } else {
        $message_alert = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Atlas Tour</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  </head>
<body class="bg-light text-dark">
<?php include "includes/header.php"; ?>

<section class="text-center py-5" style="background-color:#1C4E80;">
    <div class="container">
      <h1 class="fw-bold text-white">Contact Us</h1>
      <p class="text-light"> We would love to hear from you! Let's plan your next trip.</p>
    </div>
  </section>

<div class="container py-5">
  <div class="row align-items-center">

    <div class="col-md-6">
      <h2 class="fw-bold mb-4">Contact Us</h2>
      <p class="text-muted">Plan your dream vacation with us. Reach out for bookings or custom packages.</p>
      
      <h6 class="fw-bold mt-3">Email</h6>
      <p>travelworld@gmail.com</p>

      <h6 class="fw-bold">Phone</h6>
      <p>+91 98765 43210</p>

      <h6 class="fw-bold">Office</h6>
      <p>chhaya,porbandar</p>
    </div>

    <!-- Form -->
    <div class="col-md-6">
      <div class="bg-white shadow p-4 rounded">
        <h5 class="fw-semibold mb-3">Send a Message</h5>
        
        <?php echo $message_alert; ?>

        <form action="" method="POST">
            <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required placeholder="Your Name" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>">
            </div>

            <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="Your Email">
            </div>

            <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea class="form-control" name="message" rows="4" required placeholder="Write something..."></textarea>
            </div>
            <button type="submit" name="send_message" class="btn btn-custom btn-lg">Send Message</button>
        </form>
      </div>
    </div>

  </div>
</div>

<div class="container py-5">
  <h2 class="fw-bold text-center mb-4">FAQ</h2>

  <div class="accordion" id="faq">

    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
          How do I book a trip?
        </button>
      </h2>
      <div id="q1" class="accordion-collapse collapse show">
        <div class="accordion-body">You can contact us or fill out the form and our team will reach out.</div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
          Do you offer EMI or installment payments?
        </button>
      </h2>
      <div id="q2" class="accordion-collapse collapse">
        <div class="accordion-body">Yes, we provide EMI options on selected packages.</div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
          What documents do I need for international travel?
        </button>
      </h2>
      <div id="q3" class="accordion-collapse collapse">
        <div class="accordion-body">A valid passport, ID, and sometimes visa depending on the country.</div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include "includes/footer.php"; ?>

</body>
</html>