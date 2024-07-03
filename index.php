<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>
    
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            User Loginpassword
          </div>
          <div class="card-body">
            <form id="formid">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <p class="text-primary">Welcome to our website</p>
              <button type="submit" class="btn btn-primary">Login</button>
  <a href="signuppage.php"  type="button" class="btn btn-primary">Signup</a>      
      </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (optional, for Bootstrap features) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <script>
    //Student document ajax
$('#formid').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: "actindex.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            // dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                window.location.href="dashboard.php";
               
            },
            error: function(xhr, status, error) {
               
                // Re-enable the submit button on error
                $('#docSubmit').prop('disabled', false);
            }
        });
    });

  </script>

</body>
</html>
