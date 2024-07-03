<?php
include "db_config.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
 
    $sql = "UPDATE tbl_admin SET  status='Inactive' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $conn->close();
}
?>
