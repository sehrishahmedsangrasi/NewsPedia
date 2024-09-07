<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="posts_style.css">
    <link rel="stylesheet" href="homea.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<?php include("headermain.php")?>
<body>
  


    <main>
        <?php
        function fetchPostsByCategory() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $fullPath = $_SERVER['PHP_SELF'];

        // Extract the file name without the extension
        $fileNameWithoutExtension = pathinfo($fullPath, PATHINFO_FILENAME);
        $cat_id_query = "SELECT id FROM tblcategory WHERE categoryName = '" . mysqli_real_escape_string($conn, $fileNameWithoutExtension) . "'";
        $result2 = $conn->query($cat_id_query);
        $row = $result2->fetch_assoc();
        $categoryID = $row['id'];
        return $categoryID;
    }

    
    ?>
    <section class="content">
    <div class="featured-article">
        <div class="article-content">
            <?php
            // Include the database connection script
            define('DB_SERVER','localhost');
            define('DB_USER','root');
            define('DB_PASS' ,'');
            define('DB_NAME','newsfinal2');
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $fullPath = $_SERVER['PHP_SELF'];
            $fileNameWithoutExtension = pathinfo($fullPath, PATHINFO_FILENAME);
            $cat_id_query = "SELECT id FROM tblcategory WHERE categoryName = '" . mysqli_real_escape_string($conn, $fileNameWithoutExtension) . "'";
            $result2 = $conn->query($cat_id_query);

            if ($result2 && $result2->num_rows > 0) {
                $row = $result2->fetch_assoc();
                $categoryID = $row['id'];

                $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage, viewCounter 
                        FROM tblposts 
                        WHERE Is_Active=1 AND CategoryId = $categoryID
                        ORDER BY PostingDate DESC";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
    function isVideoByExtension($filePath) {
        $videoExtensions = ['mp4', 'avi', 'wmv', 'flv', 'mkv', 'mov', 'mpeg'];
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        return in_array(strtolower($fileExtension), $videoExtensions);
    }

    $videoFound = false; // Flag to track if video is found

    while ($row = $result->fetch_assoc()) {
        $filePath = $row['PostImage'];

        if (isVideoByExtension($filePath)) {
            $videoFound = true; // Set flag to true when video is found
            echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
            echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
            echo '<video width="100%" height="240" controls autoplay loop>
                    <source src="admin/postimages/' . htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>';
            echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 100), ENT_QUOTES, 'UTF-8') . '...</p>';
            echo '<div class="meta">';
            echo '<span>viewed by ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . ' people</span>';
            echo '</div>';
            echo'</a>';
            break; // Exit the loop once video is found
            
        }
    }

    if (!$videoFound) {
        // If no video was found, show default message
        echo "No video posts found.";
    }
} else {
    echo "No posts found.";
}}
$conn->close();
?>

        </div>
        <div class="side-articles">
            <?php
          $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $cat=fetchPostsByCategory();
            // Define the SQL query to fetch the latest side articles
            $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage FROM tblposts WHERE Is_Active=1 && CategoryId = $cat ORDER BY PostingDate DESC LIMIT 2";
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Display each post
                while($row = $result->fetch_assoc()) {
                    
                    echo '<div class="side-article">';
                    echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                    echo '<h3 class="heading">' . $row['PostTitle'] . '</h3>';
                    echo '<img src="admin/postimages/' . $row['PostImage'] . '" alt="" height="60%" width="100%">';
                    // echo '<p>By ' . $row['Author'] . '</p>';
                    echo'</a>';
                    echo '</div>';
                    
                }
            } else {
                echo "<p>No side articles found.</p>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>

        <aside class="recent-news">
            <h3>Recent News</h3>
            <ul>
                <?php
                // Reconnect to the database
                $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $cat=fetchPostsByCategory();
                // Define the SQL query to fetch the recent news
                $sql = "SELECT id, PostTitle,DATE(PostingDate) as PostingDate  FROM tblposts WHERE Is_Active=1 && CategoryId = $cat ORDER BY PostingDate DESC LIMIT 4";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Display each post
                    while($row = $result->fetch_assoc()) {
                        $postID = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
                        $postTitle = htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8');
                        $postingDate = htmlspecialchars($row['PostingDate'], ENT_QUOTES, 'UTF-8');
                    
                        // Generate the link and list item
                        echo '<li>';
                        echo '<a href="news-details.php?nid=' . $postID . '">' . $postTitle . '</a>';
                        echo '<span class="time">' . $postingDate . '</span>';
                        echo '</li>';
                    }
                } else {
                    echo "<li>No recent news found.</li>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </ul>
        </aside>
    </div>
</section>


    <section class="mycontent">
        <div class="mycontainer">
            <div class="featured-article1">
                <?php
                // Reconnect to the database
                $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $cat=fetchPostsByCategory();
                // Define the SQL query to fetch the featured articles
                $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage,viewCounter FROM tblposts WHERE Is_Active=1 && CategoryId = $cat ORDER BY PostingDate DESC";
                $result = $conn->query($sql);
          
                if ($result->num_rows > 0) {
                    echo '<section class="mycontent">';  
                    echo '<div class="mycontainer">';
                    
                    $count = 0;

                    while ($row = $result->fetch_assoc()) {
                        if ($count >= 6) {
                            break;
                        }
                        
                        if ($count % 3 == 0) {
                            if ($count > 0) {
                                echo '</div>'; // Close previous featured-article1 div
                            }
                            echo '<div class="featured-article1">';
                        }
                        $imagePath = 'admin/postimages/' . htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8');
                        if (getimagesize($imagePath)) {
                        echo '<div class="article-content1">';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
                        echo '<img src="admin/postimages/' . htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') . '" alt=""  height="50%" width="100%">';
                        echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 90), ENT_QUOTES, 'UTF-8') . '...</p>';
                        echo '<span>viewed by: ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . ' people</span>';
        
                        // Example meta data can be added here
                        
                        echo '</a>';
                        
                        echo '</div>';
                    
                        $count++;
                    }}
                    
                    if ($count > 0) {
                        echo '</div>'; // Close the last featured-article1 div if there were any articles
                    }
                    
                    echo '</div>'; 
                    echo '</section>';
                }           
                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
    </section>
</main>


    <footer>
        <p>&copy; 2024 News Portal. All rights reserved.</p>
    </footer>

</body>
</html>