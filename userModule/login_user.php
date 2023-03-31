<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


    include_once "../db_conn.php";
    
    

        if(isset($_POST ['log_email'], $_POST['log_password'])){
                $email = $_POST['log_email'];
                $password = $_POST ['log_password'];

                $query = "SELECT * FROM user WHERE email_address = '$email'";
                $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result);
                        if($password == $user['password']){
                    echo "Welcome to 10KG Collective!";
                }
        }
            } else {
           die ("maintenance mode");
        }


// ?>
