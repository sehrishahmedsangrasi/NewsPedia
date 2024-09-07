<?php
// Include the database connection script
// include('includes/config.php');
define('DB_SERVER','127.0.0.1');
define('DB_USER','root');
define('DB_PASS' ,'LAIBA0244m_');
define('DB_NAME','newsportal');
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Define the SQL query to fetch the latest news posts
$sql = "SELECT id, PostTitle, PostDetails, PostingDate, PostImage FROM tblposts WHERE Is_Active=1 ORDER BY PostingDate DESC LIMIT 5";

// Execute the query
$result = $conn->query($sql);

// Initialize an array to store the posts
$posts = [];

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through each row in the result set
    while($row = $result->fetch_assoc()) {
        // Add each row to the posts array
        $posts[] = $row;
    }
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>