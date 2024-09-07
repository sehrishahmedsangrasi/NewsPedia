<?php
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {
    if($_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($con, "DELETE FROM survey_question WHERE question_id='$id'");
        
        if ($query) {
            $msg = "Question deleted successfully";
        } else {
            $msg = "Failed to delete question";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Survey</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>

            <!-- Left Sidebar Start -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page title and breadcrumb -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Survey</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Surveys</a></li>
                                        <li class="active">Manage Survey</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <!-- Notification Messages -->
                        <div class="row">
                            <div class="col-sm-6">  
                                <?php if($msg){ ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end row -->

                        <!-- Survey Questions Table -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">
                                    <div class="m-b-30">
                                        <a href="add-surveyques.php">
                                            <button id="addToTable" class="btn btn-success waves-effect waves-light">
                                                Add <i class="mdi mdi-plus-circle-outline"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-primary">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question ID</th>
                                                    <th>Admin ID</th>
                                                    <th>Question</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query = mysqli_query($con, "SELECT question_id, admin_id, question_text FROM survey_question");
                                                $cnt = 1;
                                                while($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                    <td><?php echo htmlentities($row['question_id']); ?></td>
                                                    <td><?php echo htmlentities($row['admin_id']); ?></td>
                                                    <td><?php echo htmlentities($row['question_text']); ?></td>
                                                    <td>
                                                        <a href="manage-surveyques.php?rid=<?php echo htmlentities($row['question_id']); ?>&action=del" onclick="return confirm('Do you really want to delete?')"> 
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="add-surveyques.php?rid=<?php echo htmlentities($row['question_id']); ?>&action=del" onclick="return confirm('Do you really want to delete?')"> 
                                                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    $cnt++;
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
                <?php include('includes/footer.php'); ?>
            </div> <!-- content-page -->
        </div> <!-- wrapper -->

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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
<?php } ?>
