


 
















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="politics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="head_padding">
            <div class="nav-box nav-box1">
                <h1>News Portal</h1>
            </div>
            <div class="nav-box nav-box2">
                <nav>
                    <ul>
                        <li><a href="Home1(1).php">Home</a></li>
                        <li><a href="politics.php">Politics</a></li>
                        <li><a href="entertainment.php">Entertainment</a></li>
                        <li><a href="style.php">Style</a></li>
                        <li><a href="sport.php">Sport</a></li>
                        <li><a href="health.php">Health</a></li>
                        <li><a href="food.php">Food</a></li>
                        <li><button class="nav-button" id="loginButton">LOGIN</button></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
    <section class="content">
    <div class="featured-article">
        <div class="article-content">
        <?php
// Include the database connection script
define('DB_SERVER', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'LAIBA0244m_');
define('DB_NAME', 'newsportal');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fullPath = $_SERVER['PHP_SELF'];

// Extract the file name without the extension
$fileNameWithoutExtension = pathinfo($fullPath, PATHINFO_FILENAME);
$cat_id_query = "SELECT id FROM tblcategory WHERE categoryName = '" . mysqli_real_escape_string($conn, $fileNameWithoutExtension) . "'";
$result2 = $conn->query($cat_id_query);

if ($result2 && $result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $categoryID = $row['id'];

    $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage, viewCounter 
            FROM tblposts 
            WHERE Is_Active=1 AND categoryName = $categoryID
            ORDER BY PostingDate DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['PostImage'];

        function isVideoByExtension($filePath) {
            $videoExtensions = ['mp4', 'avi', 'wmv', 'flv', 'mkv', 'mov', 'mpeg'];
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            return in_array(strtolower($fileExtension), $videoExtensions);
        }

        if (isVideoByExtension($filePath)) {
            echo "The file is a video.";
            echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
            echo '<video width="320" height="240" controls>
                    <source src="admin/postimages/' . htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>';
            echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 100), ENT_QUOTES, 'UTF-8') . '...</p>';
            echo '<div class="meta">';
            echo '<span>viewed by ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . ' people</span>';
            echo '</div>';
        } else {
            echo "The file is not a video.";
        }
    } else {
        echo "No posts found.";
    }
} else {
    echo "Category not found.";
}

        $conn->close();
        ?>
        </div>
    </div>
    <div class="side-articles">
            <?php
          $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            // Define the SQL query to fetch the latest side articles
            $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage FROM tblposts WHERE Is_Active=1 ORDER BY PostingDate DESC LIMIT 2";
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Display each post
                while($row = $result->fetch_assoc()) {
                    echo '<div class="side-article">';
                    echo '<p class="heading">' . $row['PostTitle'] . '</p>';
                    echo '<img src="admin/postimages/' . $row['PostImage'] . '" alt="" height="60%" width="100%">';
                    // echo '<p>By ' . $row['Author'] . '</p>';
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

                // Define the SQL query to fetch the recent news
                $sql = "SELECT id, PostTitle,DATE(PostingDate) as PostingDate  FROM tblposts WHERE Is_Active=1 ORDER BY PostingDate DESC LIMIT 4";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Display each post
                    while($row = $result->fetch_assoc()) {
                        echo '<li>';
                        echo '<a href="#">' . $row['PostTitle'] . '</a>';
                        echo '<span class="time">' . $row['PostingDate'] . '</span>';
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

                // Define the SQL query to fetch the featured articles
                $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage,viewCounter FROM tblposts WHERE Is_Active=1 ORDER BY PostingDate DESC";
                $result = $conn->query($sql);
          
                if ($result->num_rows > 0) {
                    echo '<section class="mycontent">';  
                    echo '<div class="mycontainer">';
                    
                    $count = 0;
                
                    while ($row = $result->fetch_assoc()) {
                        if ($count % 3 == 0) {
                            if ($count > 0) {
                                echo '</div>'; // Close previous featured-article1 div
                            }
                            echo '<div class="featured-article1">';
                        }
                
                        echo '<div class="article-content1">';
                        echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
                        echo '<img src="admin/postimages/' . $row['PostImage'] . '" alt="" height="60%" width="100%">';
                        echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 90), ENT_QUOTES, 'UTF-8') . '...</p>';
                        echo '<div class="meta">';
                        // Example meta data can be added here
                        echo '<span>viewed by:   ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . '  people</span>';
                        echo '</div>';
                        echo '</div>';
                
                        $count++;
                    }
                
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