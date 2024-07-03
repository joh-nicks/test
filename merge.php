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
    
</head>

<body>



<div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                   <tr class="table-primary">
                        <th>User ID</th>
                        <th>Adminid</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>name</th>
                        <th>Status</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
    <?php
    // Assuming you have established the database connection in $conn variable

    $sql = "SELECT user_tbl.*,
admin.* FROM admin 
LEFT JOIN user_tbl ON user_tbl.admin_id=admin.admin_id";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {

                $userid=$row['user_id'];
                $adminid=$row['admin_id'];
                $username=$row['username'];
                $password=$row['password'];
                
                $name=$row['name'];
                $status=$row['status'];
                ?>
                <tr>
                   
                
                        <td class="table-primary"><?php echo $userid; ?></td>
                        <td class="table-secondary"><?php echo $adminid; ?></td>
                        <td class="table-success"><?php echo $username; ?></td>
                        <td class="table-danger"><?php echo $password; ?></td>
                        <td class="table-warning"><?php echo $name; ?></td>
                
                        <td><?php echo $status; ?></td>
                        <td>
                        <button onclick="ajaxEdit(<?php echo $userid?>)" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                            Edit
                        </button>
                        <button onclick='ajaxDelete1(<?php echo  $userid; ?>)' type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            Delete
                        </button>
                    </td>

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

    <!-- start add split database -->
    <div class="container">
        <h2 class="mt-5 mb-3">User Table</h2><br>
        <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsplitModal">
    Add New User
</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsplitModal">
    Add New User232
</button>


    <div class="modal fade" id="addsplitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add split User</h5>
        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="actsplit.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
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

    <!-- end add split database -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post">
                        <input type="hidden" name="hdnEditId" id="editId" value="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="edit_username" name="username" value="<?php echo $row["username"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="edit_password" name="password" value="<?php echo $row["password"]; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">name:</label>
                        <input type="name" class="form-control" id="edit_name" name="name" value="<?php echo $row["name"]; ?>">
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



<!-- start select from,actions -->

<script>
    function ajaxEdit(id) {
        $.ajax({
            url: "eduser.php", // Endpoint to fetch user details
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                var userData = JSON.parse(data);
                console.log(userData);
                $('#editId').val(userData.id);
                $('#edit_username').val(userData.username);
                $('#edit_password').val(userData.password);
                $('#edit_name').val(userData.name);
                $('#editModal').modal('show'); // Show the edit modal after content is loaded
            }
        });
    }
    </script>
    <script>

    $(document).ready(function() {
    $(document).on('submit', '#updateForm', function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        var id = $('#id').val(); // Get the id value from the hidden input field
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        var name = $('#edit_name').val();
        $.ajax({
            url: "upuser.php",
            method: "POST",
            data: {
                id: id,
                username: username,
                password: password
            },
            success: function(response) {
                // alert(response); // Display success message or handle errors
                //$('#editModal').modal('hide'); // Hide the edit modal after update
                location.reload("merge.php");                // Reload user table or update specific row
                // Example: $('#userTable').load('load_user_table.php');
            }
        });
    });                                                                                                                                                                                                                                                             
});
</script>
<script>
    function ajaxDelete1(id) {
        alert("are you sure");
        $.ajax({
            url: "dltuser.php", // Endpoint to fetch user details
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

<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    

    </body>
</html>
