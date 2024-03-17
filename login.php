<?php
session_start();
require('afunctions.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check login credentials
    $username = $_POST['username'];
    $password = $_POST['password'];
   $dcon ="user_name='$username'";
   $admin =getSubject('admin', $dcon);
   foreach($admin as $adm){
	   $admin_user =$adm['user_name'];
	   $admin_password =$adm['password'];
   }
    // For simplicity, let's say correct login is "sesi" with password "admin123"
    if ($username === $admin_user && $password === $admin_password) {
        // Set session variable
        $_SESSION['username'] = $username;

        // Redirect to index.php after successful login
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .section {
            width: 50%;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: rgba(249, 249, 249, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="section">
            <h2 class="text-center">Login</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS (optional, for certain components like dropdowns) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
