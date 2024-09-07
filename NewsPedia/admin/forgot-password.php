<?php
session_start();
error_reporting(0);
include('includes/config.php');

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $newpassword = md5($_POST['newpassword']);

    // Fetch admin details based on the provided username and email
    $query = $conn->prepare("SELECT id FROM tbladmin WHERE AdminEmailId=? AND AdminUserName=?");
    $query->bind_param("ss", $email, $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Update the password
        $query1 = $conn->prepare("UPDATE tbladmin SET AdminPassword=? WHERE AdminEmailId=? AND AdminUserName=?");
        $query1->bind_param("sss", $newpassword, $email, $username);
        if ($query1->execute()) {
            echo "<script>alert('Password successfully changed');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            exit; // It's good practice to exit after redirection
        } else {
            echo "<script>alert('Password update failed. Please try again.');</script>";
        }
        $query1->close();
    } else {
        echo "<script>alert('Invalid Details. Please try again.');</script>";
    }
    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="News Portal.">
        <meta name="author" content="PHPGurukul">

        <!-- App title -->
        <title>News Portal | Forgot Password</title>

        <!-- App css -->
        <link rel="stylesheet" href="styles.css">
        <script src="assets/js/modernizr.min.js"></script>
        <script type="text/javascript">
            function checkpass() {
                if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password field does not match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body class="bg-transparent">
        <section>
            <div class="login-container">
                <div class="login-form">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-content">
                                <h1>FORGOT PASSWORD</h1>
                                <form class="form-horizontal" method="post" onsubmit="return checkpass()">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" required name="username" placeholder="Username" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" required placeholder="Email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpassword">New Password</label>
                                        <input type="password" id="newpassword" name="newpassword" required placeholder="New Password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input type="password" id="confirmpassword" name="confirmpassword" required placeholder="Confirm Password" autocomplete="off">
                                    </div>
                                    <div class="form-group account-btn text-center m-t-10">
                                        <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit" name="submit">Change Password</button>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                                <a href="Home.php"><i class="mdi mdi-home"></i> Back Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login-image">
                    <img src="../images/main_pic.png" alt="" height="100%" width="100%">
                </div>
            </div>
        </section>

        <!-- jQuery  -->
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
