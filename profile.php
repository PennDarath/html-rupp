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

            ?>
            <a href="logout.php" class="btn btn-warning">logout</a>


        </div>
    </div>
</body>

</html>