<?php
// Database configuration
if(isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    // Redirect or handle the case where user is not logged in
    // For demonstration, we'll simply exit here
    echo "User ID not found.";
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "rupp_ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a valid image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowed_extensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowed_extensions)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // File uploaded successfully, now insert filename into the database
        $filename = basename($_FILES["fileToUpload"]["name"]);
        $sql = "UPDATE users SET avatar = '$filename' WHERE user_id = 'your_user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "The file " . htmlspecialchars($filename) . " has been uploaded and linked to your account.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
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
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <?php
        if (isset($_SESSION["user_avatar"])) {
            echo '<div class="profile-picture">
            <img src="' . $_SESSION["user_avatar"] . '" alt="Profile Picture">
          </div>';
        } else {
            echo '<div class="profile-picture">
            <img src="https://www.psi.org.kh/wp-content/uploads/2019/01/profile-icon-300x300.png" alt="Default Profile Picture">
          </div>';
        }
        ?>
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


        </div>
    </div>
</body>

</html>






<?php
require 'database.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
        if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $query = "UPDATE INTO users VALUES('$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'index.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
  </head>
  <body>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <label for="image">Image : </label>
      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      <button type = "submit" name = "submit">Submit</button>
    </form>
    <br>
    <a href="index.php">Data</a>
  </body>
</html>