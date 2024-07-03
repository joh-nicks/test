<!-- <?php
include "db_config.php";
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Signup Page with Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .signup-form {
      max-width: 400px;
      margin: 0 auto;
    }
    .error-message {
      color: red;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h4 class="text-center">Sign Up</h4>
        </div>
        <div class="card-body">
          <form class="signup-form" id="signup-form" action="actsignup.php" method="POST" >
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="emailaddress" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              <small class="form-text text-muted">Password must be at least 6 characters long.</small>
            </div>
            
            
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            <div class="text-center mt-3">
              <p class="error-message" id="error-message"></p>
            </div>
            <p>Have an account?<a href="index.php" type="button" class="btn btn-link">Log in</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("signup-form").addEventListener("submit", function(event) {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error-message");

    if (!name || !email || !username || !password) {
      errorMessage.textContent = "Please fill out all fields.";
      event.preventDefault();
    } else if (password.length < 6) {
      errorMessage.textContent = "Password must be at least 6 characters long.";
      event.preventDefault();
    } else {
      errorMessage.textContent = "";
      // You can add your signup logic here
    }
  });
</script>

</body>
</html>
