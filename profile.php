<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "rupp_ecommerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];

// Check if form is submitted
if(isset($_POST["submit"])) {
    $name = $_POST["name"];

    // Check if an image is uploaded
    if($_FILES["image"]["error"] == 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        // Validate image extension and size
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } else if($fileSize > 1000000) {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            // Upload image to 'img/' directory
            if(move_uploaded_file($tmpName, 'img/' . $newImageName)) {
                // Update avatar field in the database
                $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE user_id = ?");
                $stmt->bind_param("si", $newImageName, $user_id);

                if ($stmt->execute()) {
                    echo "<script>alert('Successfully Added');</script>";
                    echo "<script>document.location.href = 'profile.php';</script>";
                } else {
                    echo "<script>alert('Error updating database');</script>";
                }
            } else {
                echo "<script> alert('Error uploading file'); </script>";
            }
        }
    }
}

// Fetch user's avatar from the database
$sql = "SELECT avatar FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $avatar = $row["avatar"];
} else {
    $avatar = "default_avatar.jpg"; 
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
</head>
<body>
    <img src="img/<?php echo $avatar; ?>" alt="Avatar">
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <div class="profile-details">
        <h2>User Profile</h2>
        <?php
        if (isset($_SESSION["user_email"])) {
            echo "<h2>Email: " . $_SESSION["user_email"] . "</h2>";
        }
        echo "<h2>id: " . $_SESSION["user_id"] . "</h2>";
        echo "<h2>username: " . $_SESSION["username"] . "</h2>";
        ?>
        <a href="logout.php" class="btn btn-warning">logout</a>
        <a href="index.php" class="btn btn-warning">index</a>
    </div>
</body>
</html>
