<?php
// Include your database connection file
include "db_config.php";

// Check if the request is an AJAX request
if(isset($_POST['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Fetch user details from the database
    $sql = "SELECT a.*, b.* FROM user_tbl AS a LEFT JOIN admin AS b ON a.admin_id=b.admin_id WHERE a.user_id = 'admin_id'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);
        // Return user data as JSON
        echo json_encode($row);
    } else {
        // Handle case where no user found
        echo json_encode(array("error" => "User not found"));
    }
} else {
    // Handle invalid request
    echo json_encode(array("error" => "Invalid request"));
}

// Close connection
mysqli_close($conn);
?>
 
