<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password = $password . "system";

  $con = mysqli_connect("localhost", "batch1", "batch1", "db_webdev", "3306");

  $sql = "SELECT * FROM `tbl_accounts` WHERE `email` = '$email'";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row["password"])) {
      $_SESSION['name'] = $row["firstname"];
      $_SESSION['email'] = $row["email"];
      $_SESSION['admin'] = $row["admin_privileges"];
      
      header("Location: http://localhost/webdevproject/index.php");
    } else {
      echo "Login Error";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="stylesheet/sign.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
  <?php include("view/header.html"); ?>

  <div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <form method="post">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <p class="recover">
        <a href="#">Recover Password</a>
      </p>
      <input type="submit" class="btns" value="Sign In" name="signIn">
    </form>
    <p class="or">
      OR
    </p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>
    <div class="links">
      <p>Don't have account yet?</p>
      <a href="Register.php"><button id="signUpButton">Sign Up</button></a>
    </div>
  </div>
  </div>

  <?php include("./view/footer.html"); ?>

  <script src="script/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>