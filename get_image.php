<?php
include "db_config.php";

// Assuming you're retrieving the image based on the username parameter
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Prepare SQL statement to retrieve image data based on username
    $stmt = $conn->prepare("SELECT img FROM tbl_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($imgData);
    $stmt->fetch();
    
    // Set appropriate content type header
    header("Content-Type: image/jpeg"); // Adjust as per your image type
    
    // Output image data
    echo $imgData;
    
    // Close statement
    $stmt->close();
} else {
    echo "Username parameter is missing.";
}

// Close connection
$conn->close();
?>
