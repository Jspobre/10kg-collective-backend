<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../db_conn.php';
    
if(isset($_POST['full_name'])){
    $fname=$_POST['full_name'];
    $cnumber=$_POST['contact_no'];
    $address=$_POST['address'];
    $email=$_POST['email_address'];
    $password=$_POST['password'];
    
    $table = "user";
    $fields = array('full_name' => $fname
                   , 'contact_no' => $cnumber
                   , 'address' => $address
                   , 'email_address' => $email
                   , 'password' => $password
                   );
    

// insert to db
    if(insert($conn, $table, $fields) ){
        // if successful

        $user_id = mysqli_insert_id($conn); //getting newly generated user_id
        
        // create session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_type'] = 'c';
        

        // create a response array
        $response = array('response_status' => 1
        , 'user_id' => $user_id
        , 'user_type' => $_SESSION['user_type']
        , 'full_name' => $fname
        , 'email_address' => $email
        , 'contact_no' => $cnumber);


        // send as JSON object to react
        echo json_encode($response);
        exit();
    }  
    else{
        // if failed
        echo 0;
        exit();
    }
}