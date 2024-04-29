<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if form is submitted with user ID
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Sanitize user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($con, $username);
    $email = mysqli_real_escape_string($con, $email);
    
    // Update the user in the database
    $query = "UPDATE users SET 
                username = '$username',
                email = '$email'
              WHERE user_id = $user_id";

    if (mysqli_query($con, $query)) {
        // Display success message
        echo '<script>alert("User updated successfully!");</script>';
        // Redirect to index.php after successful update
        header("Location: index.php");
        exit(); // Ensure that script stops executing after redirection
    } else {
        echo "Error updating user: " . mysqli_error($con);
    }
} else {
    // Check if user ID is provided in the URL
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // Fetch user data based on the provided ID
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            // Fetch the user details
            $row = mysqli_fetch_assoc($result);

            // Render a form to update the user
            // You can pre-fill the form fields with existing data for easier editing
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit User</title>
                <style>
                    /* Add your custom styles here */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    h1 {
                        text-align: center;
                        color: #333;
                    }
                    form {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    label {
                        display: block;
                        font-weight: bold;
                        margin-bottom: 5px;
                    }
                    input[type="text"], textarea {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        box-sizing: border-box;
                    }
                    input[type="submit"] {
                        width: 100%;
                        padding: 10px;
                        border: none;
                        border-radius: 5px;
                        background-color: #007bff;
                        color: #fff;
                        cursor: pointer;
                    }
                    input[type="submit"]:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>
            <body>
                <h1>Edit User</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"><br>
                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
                    <br>
                    <input type="submit" value="Update User">
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "User not found.";
        }
    } else {
        echo "User ID not provided.";
    }
}

// Close database connection
mysqli_close($con);
?>
