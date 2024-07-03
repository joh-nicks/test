<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve username and password from form
  $name = $_POST['name'];
  $emailaddress = $_POST['emailaddress'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  



  // SQL query to insert data into database
  $sql = "INSERT INTO tbl_signup (name,email_address,username, password, img) VALUES ('$name','$emailaddress','$username', '$password', 'img')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>
