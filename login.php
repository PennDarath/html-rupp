<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KorngJak</title>
    <link rel="icon" href="img/korngjak-modified.png" />
    <link rel="stylesheet" href="../css/login.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    
    <div class="container w-[70%]">
      <div class="design">
        <div class="pill-1 rotate-45"></div>
        <div class="pill-2 rotate-45"></div>
        <div class="pill-3 rotate-45"></div>
      </div>
      <div class="login">
        <h3 class="title">Login</h3>
        <p>Welcome back! Please login to your accounts</p>
         <form action="login.php" method="POST">
   
            <div class="text-input" >
              <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Enter Email" name="email" >
            </div>
            <div class="text-input">
              <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter Password" name="password" >
            </div>
            <div class="form-btn">
                <input type="submit" value="login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div class="text-input">
          <i class="fas fa-envelope"></i>
          <input type="text" placeholder="Email" />
        </div>
        <div class="text-input">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" />
        </div>
        <div class="text-input">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" />
        </div>
        <botton class="login-btn w-[60%] text-center">
          <a href="../index.php">Login</a>
        </botton>
        <p>
          <input type="checkbox" value="remember" />
          <label for="male">Remember Me</label>
        </p>
        <a href="#" class="forgot">Forgot Password</a>
        <div class="create">
          <a href="#">New User?</a>
          <a href="./signup.php" class="signup">
            <h4 class="pl-1 font-semibold text-base">SignIn</h4>
          </a>
        </div>
      </div>
    </div>
  </body>
</html> -->

<?php
session_start();
if(isset($_SESSION["user"])) {
    header("Location: profile.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];  
            $password = $_POST["password"];
            require_once  "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    $_SESSION["user_email"] = $email;
                    header("Location: index.php");
                    die();
                } else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <form action="login.php" method="POST">
            <div class="form-group" >
                <input type="email" placeholder="Enter Email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="login" name="login" class="btn btn-primary">
            </div>
        </form>
           <a href="signup.php" class="btn btn-warning">go to signup</a>
    </div>

</body>
</html>