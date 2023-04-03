<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


    include_once "../db_conn.php";
    
    

if(isset($_POST ['log_email'], $_POST['log_password'])){
    $email = $_POST['log_email'];
    $password = $_POST ['log_password'];

if(isset($_POST ['log_email'], $_POST['log_password'])){
    $email = $_POST['log_email'];
    $password = $_POST ['log_password'];


                $query = "SELECT * FROM user WHERE email_address = '$email'";
                $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result);
                    if($password == $user['password']){

                    // if password matched
                    $_SESSION['user_id'] = $user['user_id']; //set session
                    $_SESSION['user_type'] = 'c';
                    
                    // create a response array
                    $response = array('response_status' => 1
                                    , 'user_id' => $user['user_id']
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'full_name' => $user['full_name']
                                    , 'email_address' => $user['email_address']
                                    , 'contact_no' => $user['contact_no']);

                    // send as json object to react
                    echo json_encode($response);
                    // echo var_dump($user);
                    
                } else {
                    // if theres not matched
                    echo 3;
                }
        }
            } 
// ?>












