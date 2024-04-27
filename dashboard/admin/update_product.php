<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if form is submitted with product ID
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $color = $_POST['color'];
    $storage = $_POST['storage'];

    // Sanitize user inputs to prevent SQL injection
    $product_name = mysqli_real_escape_string($con, $product_name);
    $price = mysqli_real_escape_string($con, $price);
    $description = mysqli_real_escape_string($con, $description);
    $quantity = mysqli_real_escape_string($con, $quantity);
    $color = mysqli_real_escape_string($con, $color);
    $storage = mysqli_real_escape_string($con, $storage);

    // Update the product in the database
    $query = "UPDATE products SET 
                product_name = '$product_name',
                product_price = '$price',
                product_details = '$description',
                quantity = '$quantity',
                color = '$color',
                phone_storage = '$storage'
              WHERE product_id = $product_id";

    if (mysqli_query($con, $query)) {
        // Display success message
        echo '<script>alert("Product added successfully!");</script>';
        // Redirect to products.php after successful update
        header("Location: products.php");
        exit(); // Ensure that script stops executing after redirection
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
} else {
    // Check if product ID is provided in the URL
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Fetch product data based on the provided ID
        $query = "SELECT * FROM products WHERE product_id = $product_id";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            // Fetch the product details
            $row = mysqli_fetch_assoc($result);

            // Render a form to update the product
            // You can pre-fill the form fields with existing data for easier editing
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Product</title>
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
                <h1>Edit Product</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

                    <label for="product_name">Product Name:</label><br>
                    <input type="text" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>"><br>
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br>
                    <label for="quantity">Quantity:</label><br>
                    <input type="text" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>"><br>
                    <label for="color">Color:</label><br>
                    <input type="text" id="color" name="color" value="<?php echo $row['color']; ?>"><br>
                    <label for="storage">Storage:</label><br>
                    <input type="text" id="storage" name="storage" value="<?php echo $row['storage']; ?>"><br>
                    <br>
                    <input type="submit" value="Update Product">
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product ID not provided.";
    }
}

// Close database connection
mysqli_close($con);
?>
