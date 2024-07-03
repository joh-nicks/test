<?php
include "db_config.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
 
    $sql = "UPDATE admin
        INNER JOIN user_tbl ON admin.admin_id = user_tbl.admin_id
        SET admin.status = 'Inactive', user_tbl.status = 'Inactive'
        WHERE admin.id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
    $conn->close();
}
?>
