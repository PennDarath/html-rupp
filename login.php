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
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="./assets/img/apple-icon.png"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css"
    />
    <title>Login by Wesley Seng</title>
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
        
        <body class="text-gray-800 antialiased">
    <main>
        <section class="absolute w-full h-full">
            <div class="absolute top-0 w-full h-full bg-gray-900" style="background-image: url(https://wallpapercave.com/wp/wp7504297.jpg); background-size: 100%; background-repeat: no-repeat;"></div>
            <div class="container mx-auto px-4 h-full">
                <div class="flex content-center items-center justify-center h-full">
                    <div class="w-full lg:w-4/12 px-4">
                        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                            <div class="rounded-t mb-0 px-6 py-6">
                                <div class="text-center mb-3">
                                    <h6 class="text-black-600 text-xl font-bold "><i class="fa-solid fa-people-roof"></i> LOG IN</h6>
                                </div>
                                <div>
                                    <small>Welcome to Korng Jak</small>
                                </div>
                                <form action="login.php" method="POST">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-black-700 text-xs font-bold mb-2" for="email">Email</label>
                                        <input type="email" placeholder="Enter Email" name="email" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full">

                                    </div>

                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-black-700 text-xs font-bold mb-2" for="password">Password</label>
                                        <input type="password" placeholder="Enter Password" name="password" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full">
                                    </div>

                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-black-700 rounded" id="remember-me">
                                            <label for="remember-me" class="ml-2 text-gray-700">Remember me</label>
                                        </div>
                                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Forgot Password?</a>
                                    </div>

                                    <div class="text-center mt-6">
                                        <button type="submit" name="login" class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full">Login</button>
                                    </div>
                                </form>
                                <div class="flex items-center mt-3 justify-center">
                                    <p>Don't have an account? 
                                    <a href="signup.php" class="font-bold text-black" type="button" style="transition: all 0.15s ease 0s;">SIGN UP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

              
                      
                    </div>
                  </form>
                </div>
              </div>
             
                  
                </div>
              </div>
            </div>
          </div>
        </div>
       
              
              </div>
            </div>
          </div>
        </footer>
      </section>
    </main>
  </body>
  <script>
    function toggleNavbar(collapseID) {
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
    }
  </script>
</html>