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
if (isset($_POST["submit"])) {
    $name = $_POST["name"];

    // Check if an image is uploaded
    if ($_FILES["image"]["error"] == 4) {
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
        } else if ($fileSize > 1000000) {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            // Upload image to 'img/' directory
            if (move_uploaded_file($tmpName, 'img/' . $newImageName)) {
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
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .background-image {
            background-image: url('https://wallpapercave.com/wp/wp7504297.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profile-container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-color: #f2f2f2;
        }

        .profile-picture {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            text-align: center;

            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="background-image">
          <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
        <button type="submit" name="submit">Submit</button>
    </form>
        <div class="card_background_img">
            <div class="profile-container">
                <div class="profile-picture">
                    <img src="img/<?php echo $avatar; ?>" alt="Avatar">
                </div>

                <div class="profile-details">
                    <h2>User Profile</h2>
                    <?php
                    if (isset($_SESSION["user_email"])) {
                        echo "<h2>Email: " . $_SESSION["user_email"] . "</h2>";
                    }
                    ?>
                    <a href="logout.php" class="btn btn-dark">Logout</a>

                </div>
            </div>
        </div>
    </div>
  
</body>

</html>

