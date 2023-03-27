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
    


    if(insert($conn, $table, $fields) ){
        $_SESSION['user_id'] = $user_id;
        $user_id = mysqli_insert_id($conn);
        echo "Success";
        exit();
    }  
    else{
        echo "Failed";
        exit();
    }
}