<?php 
session_start(); // Start a new session or resume the existing session
include('includes/config.php'); // Include the configuration file that contains database connection details
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal Layout</title>
    <link rel="stylesheet" href="Homea.css"> <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!-- Include Font Awesome icons -->
</head>

<body>
    <?php include('headermain.php')?>

    
   
        <!-- Section for displaying extra content like the most popular articles -->
        <section class="mextra-content">
            <div class="mmost-popular">
                <div class="mmost-popular-head">
                    <div class="mmost-p-icon"><i class="fa-regular fa-star"></i></div> <!-- Icon for most popular section -->
                    <div class="mm-p-text"><h3>Most Popular</h3></div> <!-- Heading for most popular articles -->
                </div>
                <div class="mpopular-articles">
                <?php
                // Database connection
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                // SQL query to fetch articles with more than 1000 views
                $sql = "SELECT id, PostTitle, PostDetails FROM tblposts WHERE viewCounter > 1000";
                $result = $conn->query($sql);
  
                if ($result === false) {
                    die("ERROR: Could not execute query: $sql. " . mysqli_error($conn)); // Display error if the query fails
                }

                // Check if there are any popular articles
                if ($result->num_rows > 0) {
                    $counter = 0; // Counter to limit the number of articles displayed
                    while($row = $result->fetch_assoc()) {
                        if ($counter >= 4) {
                            break; // Display only the top 4 articles
                        }
                        // Display each popular article with a link to its details
                        echo '<li>';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">' . $row['PostTitle'] . '</a>';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<div class="time">' . htmlspecialchars(substr($row['PostDetails'], 0, 50), ENT_QUOTES, 'UTF-8') . '...</div>';
                        echo '</a>';
                        echo '</li>';
                        $counter++;
                    }
                } else {
                    echo '<p>No popular articles found.</p>'; // Display message if no popular articles are found
                }
    
                mysqli_close($conn); // Close the database connection
                ?>
                </div>
            </div>
            <?php include('weather.php') ?> <!-- Include the weather widget -->
        </section>

        <!-- Section for displaying featured content -->
        <section class="mcontent">
            <div class="mfeatured-article">
                <div class="marticle-content">
                    <?php
                    // Reconnect to the database
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                    // Check the database connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error); // Display error if connection fails
                    }

                    // SQL query to fetch the latest active posts
                    $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage, viewCounter 
                            FROM tblposts 
                            WHERE Is_Active=1 
                            ORDER BY PostingDate DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {

                        function isVideoByExtension($filePath) {
                            $videoExtensions = ['mp4', 'avi', 'wmv', 'flv', 'mkv', 'mov', 'mpeg']; // List of video file extensions
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            return in_array(strtolower($fileExtension), $videoExtensions); // Check if the file is a video
                        }

                        $videoFound = false; // Flag to track if a video is found

                        while ($row = $result->fetch_assoc()) {
                            $filePath = $row['PostImage'];

                            if (isVideoByExtension($filePath)) {
                                $videoFound = true; // Set flag to true when a video is found
                                // Display the video post
                                echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
                                echo '<video width="100%" height="240" controls autoplay loop>
                                        <source src="admin/postimages/' . htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8') . '" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>';
                                echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 100), ENT_QUOTES, 'UTF-8') . '...</p>';
                                echo '<div class="meta">';
                                echo '<span>viewed by ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . ' people</span>';
                                echo '</div>';
                                break; // Exit the loop once a video is found
                            }
                        }

                        if (!$videoFound) {
                            echo "No video posts found."; // Display message if no video is found
                        }
                    } else {
                        echo "No posts found."; // Display message if no posts are found
                    }
                    $conn->close(); // Close the database connection
                    ?>
                </div>
            </div>

            <!-- Section for displaying side articles -->
            <div class="mside-articles">
                <?php
                // Reconnect to the database
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                // Check the database connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                
                // SQL query to fetch the latest side articles
                $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage FROM tblposts WHERE Is_Active=1  ORDER BY PostingDate DESC LIMIT 2";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Display each side article with a link to its details
                        echo '<div class="mside-article">';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<h3 class="mheading">' . $row['PostTitle'] . '</h3>';
                        echo '<img src="admin/postimages/' . $row['PostImage'] . '" alt="" height="60%" width="100%">';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No side articles found.</p>"; // Display message if no side articles are found
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
                                      
            <!-- Section for displaying recent news -->
            <aside class="mrecent-news">
                <h3>Recent News</h3>
                <ul>
                <?php
                // Reconnect to the database
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

                // Check the database connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
               
                // SQL query to fetch the recent news
                $sql = "SELECT id, PostTitle, DATE(PostingDate) as PostingDate  FROM tblposts WHERE Is_Active=1 ORDER BY PostingDate DESC LIMIT 4";
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Display each recent news item with a link to its details
                        echo '<li>';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">' . $row['PostTitle'] . '</a>';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<div class="time">' . htmlspecialchars($row['PostingDate'], ENT_QUOTES, 'UTF-8') . '</div>';
                        echo '</a>';
                        echo '</li>';
                    }
                } else {
                    echo "<p>No recent news found.</p>"; // Display message if no recent news is found
                }

                // Close the database connection
                $conn->close();
                ?>
                </ul>
            </aside>
        </section>
  

        

        <section class="mycontent">  
        <div class="mycontainer">
            <div class="mfeatured-article1">
                <?php
                // Reconnect to the database
                $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                
                // Define the SQL query to fetch the featured articles
                $sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage,viewCounter FROM tblposts WHERE Is_Active=1  ";
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
                            echo '<div class="mfeatured-article1">';
                        }
                    
                        echo '<div class="marticle-content1">';
                        echo '<a href="news-details.php?nid=' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
                        echo '<h2>' . htmlspecialchars($row['PostTitle'], ENT_QUOTES, 'UTF-8') . '</h2>';
                        echo '<img src="admin/postimages/' . htmlspecialchars($row['PostImage'], ENT_QUOTES, 'UTF-8') . '" alt="" height="60%" width="100%">';
                        echo '<p>' . htmlspecialchars(substr($row['PostDetails'], 0, 90), ENT_QUOTES, 'UTF-8') . '...</p>';
                        echo '<div class="meta">';
                        // Example meta data can be added here
                        echo '<span>viewed by: ' . htmlspecialchars($row['viewCounter'], ENT_QUOTES, 'UTF-8') . ' people</span>';
                        echo '</a>';
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

<section class="slider">
    <?php
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the most viewed posts
    $sql = "SELECT p.id, p.PostTitle, p.PostDetails, p.PostUrl, p.viewCounter
            FROM tblposts p 
            WHERE p.Is_Active = 1 
            ORDER BY p.viewCounter DESC 
            LIMIT 12";

    $result = $conn->query($sql);

    $posts = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Fetch comments for each post
            $postId = $row['id'];
            $commentSql = "SELECT comment FROM tblcomments WHERE postId = $postId";
            $commentResult = $conn->query($commentSql);
            
            $comments = [];
            if ($commentResult->num_rows > 0) {
                while($commentRow = $commentResult->fetch_assoc()) {
                    $comments[] = $commentRow['comment'];
                }
            }
            
            $row['comments'] = $comments;
            $posts[] = $row;
        }
    }
    $conn->close();
    ?>

<div>
    <h2>REVIEWS FROM OUR VALUED USERS</h2>
</div>
<hr>
<div class="slider-container">
    <div class="slide-group">
        <?php foreach ($posts as $post): ?>
            <?php if (!empty($post['comments'])): ?>
                <div class="slide-item">
                    <h3><?php echo htmlspecialchars($post['PostTitle']); ?></h3>
                    <div class="comments">
                        <h4>Comments:</h4>
                        <ul>
                            <?php foreach ($post['comments'] as $comment): ?>
                                <li><?php echo htmlspecialchars($comment); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <!-- Duplicate slide items for seamless loop -->
        <?php foreach ($posts as $post): ?>
            <?php if (!empty($post['comments'])): ?>
                <div class="slide-item">
                    <h3><?php echo htmlspecialchars($post['PostTitle']); ?></h3>
                    <div class="comments">
                        <h4>Comments:</h4>
                        <ul>
                            <?php foreach ($post['comments'] as $comment): ?>
                                <li><?php echo htmlspecialchars($comment); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>



</section>






            
    </main>
    <div id="surveyModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Would you like to participate in our survey?</p>
        <button onclick="handleSurveyClick()">Yes</button>
        <button id="noButton">No</button>
    </div>
</div>


    <footer>
        <p>&copy; 2024 News Portal. All rights reserved.</p>
    </footer>
    <?php include('slider.php') ?>
    <?php include('modal.php') ?>

    <script>
        
        
        document.getElementById("loginButton").addEventListener("click", function() {
            window.location.href = "admin/";
        });
    </script>
    
    
</body>
</html>
