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
     <div class="card_background_img">
        <div class="profile-container">
            <?php
            if (isset($_SESSION["user_avatar"])) {
                echo '<div class="profile-picture">
                <img src="' . $_SESSION["user_avatar"] . '" alt="Profile Picture">
              </div>';
            } else {
                echo '<div class="profile-picture">
                <img src="https://static-cdn.icons8.com/l/3d/images/2_thumb_up_man_1.webp" alt="Default Profile Picture">
              </div>';
            }
            ?>
            <div class="profile-details">
                <h2>User Profile</h2>
                <?php
                if (isset($_SESSION["user_email"])) {
                    echo "<h2>Email: " . $_SESSION["user_email"] . "</h2>";
                }
                ?>
                <a href="logout.php" class="btn btn-dark">Logout</a>
</html>            </div>
        </div>
    </div>
</body>


