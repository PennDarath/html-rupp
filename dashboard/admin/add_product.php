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

        <input type="submit" value="Add Product">
    </form>
</body>
</html>
