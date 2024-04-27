<?php
session_start();

if(isset($_POST['delete_user_id'])) {
    $user_id = $_POST['delete_user_id'];
if(isset($_POST['delete_username'])) {
    $username = $_POST['delete_username'];
    if(isset($_POST['delete_email'])) {
        $email = $_POST['delete_email'];
    
    
    $con = mysqli_connect("localhost", "root", "", "rupp_ecommerce");

    
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    
    $sql = "DELETE FROM users WHERE user_id = $user_id";
    $sql = "DELETE FROM users WHERE username = $username";
    $sql = "DELETE FROM users WHERE email = $email";
    

    
    if (mysqli_query($con, $sql)) {
        
        echo "User deleted successfully.";
    } else {
        
        echo "Error deleting user: " . mysqli_error($con);
    }

    
    mysqli_close($con);
}
?>
