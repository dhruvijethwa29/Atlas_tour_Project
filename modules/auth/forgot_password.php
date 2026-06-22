<?php
include "../../config/database.php";
session_start();

$error = "";
$info = "";

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Check if both email and phone match a user in the database
    $sql = "SELECT * FROM users WHERE email='$email' AND phone='$phone'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // User verified! Save email in session to allow them to reset
        $_SESSION['reset_email'] = $email;
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Details do not match our records. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Atlas Tour - Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<?php include "header.php"; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white shadow p-4 rounded text-dark">
        <div>
          <h2 class="text-center mb-4">Forgot Password</h2>
          <p class="text-center text-muted mb-4">Enter your registered email and phone number to reset your password.</p>
          
          <?php if($error != "") { echo "<div class='alert alert-danger'>$error</div>"; } ?>

          <form action="" method="POST">
            <div class="mb-3">
              <label>Registered Email</label>
              <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            </div>
            <div class="mb-3">
              <label>Registered Phone Number</label>
              <input type="number" name="phone" class="form-control" required placeholder="Enter Phone Number">
            </div>
            <button type="submit" name="verify" class="btn btn-info rounded-pill fw-bold w-100 mt-3 text-dark">Verify & Next</button>
            <a href="login.php" class="btn btn-secondary w-100 mt-2">Back to Login</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
