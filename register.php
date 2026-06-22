 <?php
include "config/database.php";

$message = "";
if (isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already exists! Please Login.</div>";
    } else {
        $sql = "INSERT INTO users (full_name, email, phone, password) VALUES ('$full_name', '$email', '$phone', '$password')";
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success'>Registration Successful! <a href='login.php'>Click here to login</a></div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Atlas Tour - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<?php include "includes/header.php"; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white shadow p-4 rounded text-dark">
        <div>
          <h2 class="text-center mb-4">Register</h2>
          
          <?php echo $message; ?>

          <form action="" method="POST">
            <div class="mb-3">
              <label>Full Name</label>
              <input type="text" name="full_name" class="form-control" required placeholder="Your Name">
            </div>
            <div class="mb-3">
              <label>Phone Number</label>
              <input type="number" name="phone" class="form-control" required placeholder="Phone">
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required placeholder="Email Address">
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="mb-3">
              <label>Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm Password">
            </div>
            <button type="submit" name="register" class="btn btn-info rounded-pill fw-bold w-100 mt-3 text-dark">Register</button>
          </form>

          <p class="mt-4 text-center">Already have an account? <a href="login.php" class="text-primary">Login Here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
