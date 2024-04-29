<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        form {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
// Database connection details (replace with your actual credentials)
$db_host = 'localhost';
$db_name = 'rupp_ecommerce';
$db_user = 'root';
$db_pass = '';

// Error message variable
$error_msg = '';

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize user input to prevent SQL injection attacks
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Validate email format using built-in PHP filter
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Invalid email format.";
    } else {

        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Default algorithm

        // Check if username or email already exists
        $sql_check = "SELECT username, email FROM users WHERE username = ? OR email = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error_msg = "Username or email already exists!";
        } else {
            // Upload avatar
            $avatar_name = $_FILES['avatar']['name'];
            $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
            $avatar_destination = 'img/' . $avatar_name;
            move_uploaded_file($avatar_tmp_name, $avatar_destination);

            // Insert user data into database using prepared statement
            $sql = "INSERT INTO users (username, email, password, avatar) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $avatar_destination);
            
            if ($stmt->execute()) {
                echo '<script>alert("User added successfully!");</script>';
            } else {
                $error_msg = "Error adding user: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <label for="avatar">Upload Avatar:</label>
    <input type="file" name="avatar" id="avatar"><br>
    <button type="submit" name="submit">Add User</button>
    <?php if (!empty($error_msg)) { ?>
        <p class="error-message"><?php echo $error_msg; ?></p>
    <?php } ?>
</form>
</body>
</html>
