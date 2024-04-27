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
    $productId = $_GET['id'];

    // Delete the product from the database
    $query = "DELETE FROM products WHERE product_id = $productId";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Set success message
        $_SESSION['success_message'] = "Product deleted successfully";
    } else {
        $_SESSION['error_message'] = "Error deleting product: " . mysqli_error($con);
    }
} else {
    $_SESSION['error_message'] = "Product ID not provided";
}

// Close database connection
mysqli_close($con);

// Redirect back to the dashboard
header("Location: products.php");
exit();
?>
