<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include_once '../db_conn.php';

if(isset($_POST['reg_type'])){
    $fname=$_POST['full_name'];
    $cnumber=$_POST['contact_no'];
    $address=$_POST['address'];
    $email=$_POST['email_address'];
    $password=$_POST['password'];
    $reg_type =$_POST['reg_type'];
    
    // check first if the email address already exists shibar
    $email = mysqli_real_escape_string($conn, $_POST['email_address']);
    $sql = "SELECT * FROM user WHERE email_address = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        echo "Email address already exists.";
        exit();
    }
    
    if($_POST['reg_type'] == "admin"){
        //  admin
        $reg_type = "A";
        $stmt = $conn->prepare("INSERT INTO user (full_name, contact_no, address, email_address, password, user_type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $fname, $cnumber, $address, $email, $password, $reg_type);
        if($stmt->execute()){
            echo 1;
            exit();
        }
    } else {
        // courier
        $reg_type = "C";
        $stmt = $conn->prepare("INSERT INTO user (full_name, contact_no, address, email_address, password, user_type) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $fname, $cnumber, $address, $email, $password, $reg_type);
        if($stmt->execute()){
            echo 1;
            exit();
        }
    }
} 
    else if(isset($_POST['full_name'] )){
        $fname=$_POST['full_name'];
        $cnumber=$_POST['contact_no'];
        $address=$_POST['address'];
        $email=$_POST['email_address'];
        $password=$_POST['password'];

        $email = mysqli_real_escape_string($conn, $_POST['email_address']);
        $sql = "SELECT * FROM user WHERE email_address = '$email'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            echo "Email address already exists.";
            exit();
        }else {
        $stmt = mysqli_prepare($conn, "INSERT INTO user (full_name, contact_no, address, email_address, password) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sisss", $fname, $cnumber, $address, $email, $password);
        if(mysqli_stmt_execute($stmt)){
            $user_id = mysqli_insert_id($conn); //getting newly generated user_id
            
            // create session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_type'] = 'U';
            
            // create a response array
            $response = array('response_status' => 1
            , 'user_id' => $user_id
            , 'user_type' => $_SESSION['user_type']
            , 'full_name' => $fname
            , 'email_address' => $email
            , 'contact_no' => $cnumber
            , 'address' => $address);

            // send as JSON object to react
            echo json_encode($response);
            exit();
        }  
        else {
            // if failed
            echo 0;
            exit();
        }
}
}