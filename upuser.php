<?php
include "db_config.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "UPDATE user_tbl AS a 
        LEFT JOIN admin AS b 
        ON a.admin_id = b.admin_id 
        SET a.username = '$username', 
            a.password = '$password', 
            b.name = '$name', 

        WHERE a.user_id = '$id'";


    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $conn->close();
}
?>