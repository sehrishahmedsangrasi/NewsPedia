<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
} else {
    if(isset($_GET['action']) && $_GET['action']=='del') {
        $comm_id = intval($_GET['cid']);
        $query = mysqli_query($con, "UPDATE tblcomments SET status=0 WHERE comm_id='$comm_id'");
        if($query) {
            $msg = "Comment deleted";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }

    if(isset($_GET['action']) && $_GET['action']=='approve') {
        $comm_id = intval($_GET['cid']);
        $query = mysqli_query($con, "UPDATE tblcomments SET status=1 WHERE comm_id='$comm_id'");
        if($query) {
            $msg = "Comment deleted";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }

    $query = mysqli_query($con, "
        SELECT c.comm_id, c.comment, c.postingDate, u.fullName, u.userId
        FROM tblcomments c
        JOIN user_comment uc ON c.comm_id = uc.comm_id
        JOIN tblusers u ON uc.userId = u.userId
        WHERE c.status = 1
    ");

    $querydel= mysqli_query($con, "
    SELECT c.comm_id, c.comment, c.postingDate, u.fullName, u.userId
    FROM tblcomments c
    JOIN user_comment uc ON c.comm_id = uc.comm_id
    JOIN tblusers u ON uc.userId = u.userId
    WHERE c.status IN (0,NULL)
");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Newsportal | Manage Comments</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- Left Sidebar Start -->
            <?php include('includes/leftsidebar.php'); ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Approved Comments</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Comments</a></li>
                                        <li class="active">Manage Comments</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table table-colored table-centered table-inverse m-0">
                                            <thead>
                                                <tr>
                                                    <th>Comment</th>
                                                    <th>Name</th>
                                                    <th>UserID</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                while($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row['comment']); ?></td>
                                                    <td><?php echo htmlentities($row['fullName']); ?></td>
                                                    <td><?php echo htmlentities($row['userId']); ?></td>
                                                    <td><?php echo htmlentities($row['postingDate']); ?></td>
                                                    <td>
                                                        <a href="manage-comments.php?cid=<?php echo htmlentities($row['comm_id']);?>&action=del" onclick="return confirm('Do you really want to delete?')"> 
                                                            <i class="fa fa-trash" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->
                </div> <!-- content -->

                <!-- Start content for deleted comments -->
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Deleted Comments</h4>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="table-responsive">
                                    <table class="table table-colored table-centered table-inverse m-0">
                                        <thead>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Name</th>
                                                <th>UserID</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while($row = mysqli_fetch_array($querydel)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlentities($row['comment']); ?></td>
                                                <td><?php echo htmlentities($row['fullName']); ?></td>
                                                <td><?php echo htmlentities($row['userId']); ?></td>
                                                <td><?php echo htmlentities($row['postingDate']); ?></td>
                                                <td>
                                                        <a href="manage-comments.php?cid=<?php echo htmlentities($row['comm_id']);?>&action=approve"> 
                                                            <i class="fa-solid fa-check" style="color: #00ff00"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            <?php 
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->
                <!-- End content for deleted comments -->

                <?php include('includes/footer.php'); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="https://kit.fontawesome.com/61c3503030.js" crossorigin="anonymous"></script>

        <!-- CounterUp  -->
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!--Morris Chart-->
        <script src="../plugins/morris/morris.min.js"></script>
        <script src="../plugins/raphael/raphael-min.js"></script>

        <!-- Load page level scripts-->
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>

        <!-- Dashboard Init js -->
        <script src="assets/pages/jquery.blog-dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
<?php } ?>
