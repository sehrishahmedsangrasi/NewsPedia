<?php 
session_start();
include('admin/includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: /admin.php");
    exit;
}

// Generating CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
  // Verifying CSRF Token
  if (!empty($_POST['csrftoken'])) {
      if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
          $userId = $_SESSION['userId']; 
          $comment = $_POST['comment'];
          $postid = intval($_GET['nid']);
          
          // Insert the comment into tblcomments
          $query = mysqli_query($con, "INSERT INTO tblcomments(postId, comment,status) VALUES ('$postid', '$comment',1)");
          if ($query) {
              // Retrieve the ID of the inserted comment
              $commentId = mysqli_insert_id($con);
              
              // Insert the user and comment association into user_comments
              $query_user_comment = mysqli_query($con, "INSERT INTO user_comment(comm_id, userId) VALUES ('$commentId', '$userId')");
              
              if ($query_user_comment) {
                  echo "<script>alert('Comment successfully submitted. Comment will be displayed after admin review.');</script>";
              } else {
                  echo "<script>alert('Something went wrong while updating user comments. Please try again.');</script>";
              };
          } else {
              echo "<script>alert('Something went wrong. Please try again.');</script>";
          }
      }
  }
}
$postid = intval($_GET['nid']);
$sql = "SELECT viewCounter FROM tblposts WHERE id = '$postid'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visits = $row["viewCounter"];
        $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE id ='$postid'";
        $con->query($sql);
    }
} else {
    echo "no results";
}
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Home Page</title>
  

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
   
    <link rel="stylesheet" href="Homea.css">

  </head>

  <body>

    <!-- Navigation -->
    <?php include('headermain.php')?>

    <!-- Page Content -->
    <div class="container">
    <div class="row" style="margin-top: 10%">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Blog Post -->
            <?php
            $pid = intval($_GET['nid']);
            $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $query = mysqli_query($con, "SELECT tblposts.PostTitle as posttitle, tblposts.PostImage, tblcategory.CategoryName as category, tblcategory.id as cid, tblsubcategory.Subcategory as subcategory, tblposts.PostDetails as postdetails, tblposts.PostingDate as postingdate, tblposts.PostUrl as url, tblposts.postedBy, tblposts.lastUpdatedBy, tblposts.UpdationDate FROM tblposts LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId WHERE tblposts.id='$pid'");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
                        <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
                        <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
                        <p>
                            <b>Posted by </b> <?php echo htmlentities($row['postedBy']); ?> on </b><?php echo htmlentities($row['postingdate']); ?> |
                            <?php if ($row['lastUpdatedBy'] != ''): ?>
                            <b>Last Updated by </b> <?php echo htmlentities($row['lastUpdatedBy']); ?> on </b><?php echo htmlentities($row['UpdationDate']); ?></p>
                            <?php endif; ?>
                            <p><strong>Share:</strong> <a href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank">Facebook</a> |
                                <a href="https://twitter.com/share?url=<?php echo $currenturl; ?>" target="_blank">Twitter</a> |
                                <a href="https://web.whatsapp.com/send?text=<?php echo $currenturl; ?>" target="_blank">Whatsapp</a> |
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $currenturl; ?>" target="_blank">Linkedin</a> <b>Visits:</b> <?php print $visits; ?>
                            </p>
                            <hr />
                            <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">
                            <p class="card-text"><?php
                                $pt = $row['postdetails'];
                                echo (substr($pt, 0)); ?></p>
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php include('sidebar.php'); ?>
    </div>

    <!-- Comment Section -->
    <div class="row" style="margin-top: -8%">
        <div class="col-md-8">
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form name="Comment" method="post">
                        <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Comment Display Section -->
            <?php
            $query = mysqli_query($con, "SELECT c.comment, c.postingDate, u.fullName fullname FROM tblcomments c INNER JOIN user_comment uc ON c.comm_id = uc.comm_id INNER JOIN tblusers u ON uc.userId = u.userId WHERE c.postId='$pid' AND c.status=1  ");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo htmlentities($row['fullname']); ?> <br />
                            <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']); ?></span>
                        </h5>
                        <?php echo htmlentities($row['comment']); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 News Portal. All rights reserved.</p>
</footer>

<script>
    document.getElementById("loginButton").addEventListener("click", function() {
            window.location.href = "admin/";
        });
    </script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>