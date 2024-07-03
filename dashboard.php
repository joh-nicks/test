<?php
include "db_config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" >
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="jquery-3.6.4.min.js" ></script>
</head>

<body>
    <div class="container">
        <h2 class="mt-5 mb-3">User Table</h2><br>
        <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
    Add New User
</button>
<a href="js.html"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aUserModal">
   Page
</button> </a>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="AddNewUser.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          </div>
          <div class="form-group">
              <label for="file">Upload File</label>
              <input type="file" class="form-control-file" id="file" name="file">
            </div>
          <!-- Add more form fields as needed -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
 </div>


        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
    <?php
    // Assuming you have established the database connection in $conn variable

    $sql = "SELECT * FROM tbl_admin WHERE status = 'Active'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {

                $id=$row['id'];
                $username=$row['username'];
                $password=$row['password'];
                $status=$row['status'];
                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $password; ?></td>
                        <td><?php echo $status; ?></td>
                    <td>
                        <!-- Display image -->
                        <img src="<?php echo $row["img"]; ?>" alt="User Image" width="200px" height="100px">
                    </td>
                    <td>
                        <button onclick='ajaxEdit(<?php echo  $id; ?>)' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                            Edit
                        </button>
                        <button onclick='ajaxDelete(<?php echo  $id; ?>)' type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete
                        </button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "No records found";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close connection
    $conn->close();
    ?>
</tbody>

            </table>
        </div>
    </div>

    <!-- Modal -->
    


    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post">
                        <input type="hidden" name="hdnEditId" id="id" value="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="edit_username" name="username" value="<?php echo $row["username"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="edit_password" name="password" value="<?php echo $row["password"]; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateButton">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div>
        <input type="text">
    </div>

   <!-- Delete  -->
   

    <script>
    function ajaxEdit(id) {
        $.ajax({
            url: "edituser.php", // Endpoint to fetch user details
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                var userData = JSON.parse(data);
                $('#id').val(userData.id);
                $('#edit_username').val(userData.username);
                $('#edit_password').val(userData.password);
                $('#editModal').modal('show'); // Show the edit modal after content is loaded
            }
        });
    }

    $(document).ready(function() {
    $(document).on('submit', '#updateForm', function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        var id = $('#id').val(); // Get the id value from the hidden input field
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();

        $.ajax({
            url: "update_user.php",
            method: "POST",
            data: {
                id: id,
                username: username,
                password: password
            },
            success: function(response) {
                // alert(response); // Display success message or handle errors
                //$('#editModal').modal('hide'); // Hide the edit modal after update
                location.reload("dashboard.php");                // Reload user table or update specific row
                // Example: $('#userTable').load('load_user_table.php');
            }
        });
    });                                                                                                                                                                                                                                                             
});
</script>
<script>
    function ajaxDelete(id) {
        alert("are you sure");
        $.ajax({
            url: "delete_user.php", // Endpoint to fetch user details
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {               
                alert("deleted successfully");
                location.reload();
            }
        });
    }
</script>


</body>
</html>
