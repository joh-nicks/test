<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert into admin table
    $stu_sql = "INSERT INTO admin (name) VALUES ('$name')";
    
    if ($conn->query($stu_sql) === TRUE) {
        // Retrieve the last inserted ID
        $last_admin_id = $conn->insert_id;
        
        // Insert into user_tbl table
        $stu_add_sql = "INSERT INTO user_tbl (admin_id, username, password) VALUES ('$last_admin_id', '$username', '$password')";

        if ($conn->query($stu_add_sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stu_add_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $stu_sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
