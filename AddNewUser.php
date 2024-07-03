<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['username'], $_POST['password'], $_FILES['file'])) {
        // Retrieve username and password from form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // File upload handling
        $targetDir = "img/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        // $allowedExtensions = array('jpg', 'jpeg', 'png');
        // if (!in_array($fileType, $allowedExtensions)) {
        //     echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        //     exit; // Exit the script if file format is not allowed
        //}

        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully, now insert file location into database
            $stmt = $conn->prepare("INSERT INTO tbl_admin (username, password, img) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $targetFilePath);
            if ($stmt->execute()) {
                echo "New record created successfully";
                // Redirect to dashboard or any other page if needed
                 header("location: dashboard.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "All fields are required.";
    }
}

// Close connection
$conn->close();
?>
