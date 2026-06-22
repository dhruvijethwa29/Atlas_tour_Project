<?php
include "../../config/database.php";
session_start();

// Ensure the user went through the forgot_password verification step
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$error = "";
$success_msg = "";

if (isset($_POST['reset'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $email = $_SESSION['reset_email'];
        // Update the password in database
        $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
        
        if (mysqli_query($conn, $sql)) {
            // Password updated successfully. Clear session so they have to log in naturally.
            unset($_SESSION['reset_email']);
            // Redirect to login page with a success message
            header("Location: login.php?msg=password_reset");
            exit();
        } else {
            $error = "Failed to update password. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Atlas Tour - Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<?php include "header.php"; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white shadow p-4 rounded text-dark">
        <div>
          <h2 class="text-center mb-4">Set New Password</h2>
          <p class="text-center text-primary mb-4">Resetting password for: <br><strong><?php echo $_SESSION['reset_email']; ?></strong></p>
          
          <?php if($error != "") { echo "<div class='alert alert-danger'>$error</div>"; } ?>

          <form action="" method="POST">
            <div class="mb-3">
              <label>New Password</label>
              <input type="password" name="new_password" class="form-control" required placeholder="Enter New Password">
            </div>
            <div class="mb-3">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm New Password">
            </div>
            <button type="submit" name="reset" class="btn btn-custom w-100 mt-3">Update Password</button>
            <a href="login.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
