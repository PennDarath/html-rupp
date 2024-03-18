<?php
session_start();
if(isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Registeration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://wallpapercave.com/wp/wp7504297.jpg'); 
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex justify-center items-center h-screen bg-black-100 ">
    <div class="bg-gray rounded-lg shadow-lg p-8 max-w-md w-full">
        <?php
        if(isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Passwords do not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exist");
                
            }
            if (count($errors) > 0) {
                foreach($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registration successful</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="signup.php" method="post">
            
            <div class="mb-4">
                <input type="text" name="fullname" placeholder="Full Name" class="w-full px-3 py-2 border border-black-300 rounded-md focus:outline-none focus:border-red-500">
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 border border-black-300 rounded-md focus:outline-none focus:border-red-500">
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" class="w-full px-3 py-2 border border-black-300 rounded-md focus:outline-none focus:border-red-500">
            </div>
            <div class="mb-4">
                <input type="password" name="repeat_password" placeholder="Repeat Password" class="w-full px-3 py-2 border border-black-300 rounded-md focus:outline-none focus:border-red-500">
            </div>
            <div class="mb-4">
                <input type="submit" name="submit" value="Register" class="w-full px-3 py-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-red-600 cursor-pointer">
            </div>
        </form>
        <a href="login.php" class="block text-center text-black-700 font-semibold hover:underline">Go to Login</a>
    </div>
</body>
</html>
