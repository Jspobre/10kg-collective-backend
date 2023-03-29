<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


include_once "../db_conn.php";

if(isset($_POST ['log_email'], $_POST['log_password'])){
    $email = $_POST['log_email'];
    $password = $_POST ['log_password'];

    $query = "SELECT * FROM user WHERE email_address = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['user_id'];

        $_SESSION['user_id'] = $user_id;

        echo("Welcome to 10KG COLLECTIVE!");
        //header("location: ../orderModule/checkout.php");
        exit();
        }
        else {
            die ("Invalid email or password");
        }
    }
            else {
                die ("Maintenance mode");
            }

                mysqli_close($conn);

        if(!$conn){
                die("Connection error");
        }

?>







