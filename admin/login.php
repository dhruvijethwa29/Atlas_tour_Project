<?php
include "config/database.php";

$error = "";
$info_msg = "";

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'booking') {
        $info_msg = "You need to do login, you cannot book without logging in.";
    } elseif ($_GET['msg'] == 'contact') {
        $info_msg = "You need to do login to contact us.";
    } elseif ($_GET['msg'] == 'password_reset') {
        $info_msg = "Password reset successfully! Please log in with your new password.";
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Atlas Tour - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
<?php include "includes/header.php"; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="bg-white shadow p-4 rounded text-dark">
        <div>
          <h2 class="text-center mb-4">Login</h2>
          
          <?php if($info_msg != "") { echo "<div class='alert alert-warning text-center fw-bold'>$info_msg</div>"; } ?>
          <?php if($error != "") { echo "<div class='alert alert-danger'>$error</div>"; } ?>

          <form action="" method="POST">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required placeholder="Enter Email">
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required placeholder="Enter Password">
            </div>
            <button type="submit" name="login" class="btn btn-info rounded-pill fw-bold w-100 mt-3 text-dark">Login</button>
            <div class="text-end mt-2">
              <a href="forgot_password.php" class="text-warning text-decoration-none small">Forgot Password?</a>
            </div>
          </form>

          <p class="mt-4 text-center">Don't have an account? <a href="register.php" class="text-primary">Register Here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
