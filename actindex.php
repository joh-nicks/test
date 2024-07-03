<?=
include "db_config.php";
$username=$_POST['username'];
$password=$_POST['password'];
// echo "<script>console.log($password)</script>";

$sql = "SELECT * FROM tbl_signup WHERE username='$username' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // If a record is found, authentication successful
    echo "Login successful!";
    header("location:dashboard.php");
} else {
    // If no record is found, authentication failed
    echo "Invalid username or password";
}

?>