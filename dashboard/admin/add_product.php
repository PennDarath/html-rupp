<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Process the form submission
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $color = $_POST['color'];
    $storage = $_POST['storage'];
    
    // File upload handling
    $target_dir = "img/";
    $image = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["image"]["size"] > 500000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert data into the database
            $sql = "INSERT INTO products (name, price, description, quantity, color, storage, image)
                    VALUES ('$name', '$price', '$description', '$quantity', '$color', '$storage', '$image')";

            if (mysqli_query($con, $sql)) {
                echo "Product added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product_process.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>

        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity"><br>

        <label for="color">Color:</label><br>
        <input type="text" id="color" name="color"><br>

        <label for="storage">Storage:</label><br>
        <input type="text" id="storage" name="storage"><br>

        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image"><br>

        <input type="submit" name="submit" value="Add Product">
    </form>
</body>
</html>
