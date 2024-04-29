<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the product from the database
    $query = "DELETE FROM users WHERE user_id = $userId";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Set success message
        $_SESSION['success_message'] = "User deleted successfully";
    } else {
        $_SESSION['error_message'] = "Error deleting user: " . mysqli_error($con);
    }
} else {
    $_SESSION['error_message'] = "User ID not provided";
}

// Close database connection
mysqli_close($con);

// Redirect back to the dashboard
header("Location: index.php");
exit();
?>
