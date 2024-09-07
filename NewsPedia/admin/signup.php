<?php
session_start();
include('includes/config.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fullname = $_POST['username'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactno'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];


    // Validate passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO tblusers (fullName, emailId, contactno, password) VALUES ('$fullname', '$email', '$contact_number', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        // Optionally, redirect to login page after successful signup
        // header("Location: login.php");
        // exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="styles.css">
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="News Portal.">
        <meta name="author" content="PHPGurukul">
        <link rel="stylesheet" href="signup.css">

        <!-- App title -->
        <title>News Portal | Admin Panel</title>

        <!-- App css -->
        <link rel="stylesheet" href="../style.css">
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" /> -->

        <script src="assets/js/modernizr.min.js"></script>

</head>
<body>
<div class="login-container">
  <div class="login-form">
    <div class="wrapper-page">
      <div class="account-pages">
        <!-- <div class="text-center account-logo-box">
          <h2 class="text-uppercase">
            <a href="index.html" class="text-success">
              <span><img src="assets/images/logo.png" alt="" height="56"></span>
            </a>
          </h2>
        </div> -->
        <div class="account-content">
        <h1>CREATE ACCOUNT</h1>
          <form class="form-horizontal" method="post">
            <div class="options">
              <p>SIGN UP</p>
              <a href="index.php">LOGIN</a>
            </div>
            <div class="form-group">
            <label for="fullName">Full Name</label>
              <input class="form-control" type="text" required name="username" placeholder="Username or email" autocomplete="off">
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
            <label for="contactno">Contact Number</label>
            <input type="contactno" id="contactno" name="contactno" required placeholder="contactno" autocomplete="off">
            </div>
            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="password" autocomplete="off">
            </div>
            <div class="form-group">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required placeholder="confirmpassword" autocomplete="off">
            </div>
            
            <div class="form-group account-btn text-center m-t-10">
              <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="login">Log In</button>
            </div>
          </form>
          <div class="clearfix"></div>
          <a href="Home.php"><i class="mdi mdi-home"></i> Back Home</a>
        </div>
      </div>
    </div>
  </div>
  <div class="login-image">
    <img src="admin/logo.jpg" alt="" height="100%" width="100%">
  </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
</body>
</html>