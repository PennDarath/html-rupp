<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_SESSION["user"])) {
    header("Location: profile.php");
    exit; // Stop script execution after redirect
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];  
    $password = $_POST["password"];
    require_once  "database.php";
    
    // Prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION["user"] = "yes";
            $_SESSION["user_email"] = $email;
            $_SESSION["username"] = $user['username'];
            $_SESSION["user_id"] = $user['user_id'];
            header("Location: profile.php"); 
            exit;
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <div class="form-group" >
                <input type="email" placeholder="Enter Email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <a href="signup.php" class="btn btn-warning">Go to Signup</a>
    </div>
</body>
</html>
