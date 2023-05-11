<?php

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");


    include_once "../db_conn.php";
    
    
if(isset($_POST['user_type'])){
    if($_POST['user_type'] == 'U'){
        // grab POST data
    $email = $_POST['log_email'];
    $password = $_POST ['log_password'];

    // get single row of user 
    $query = "SELECT * FROM user WHERE email_address = '$email' AND user_type = 'U'";
    $result = mysqli_query($conn, $query);
        
        // if user is existing
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result); //turn result into associative array
                    // check pass
                    if($password == $user['password']){

                    // if password matched
                    $_SESSION['user_id'] = $user['user_id']; //set session
                    $_SESSION['user_type'] = 'U';
                    
                    // create a response array
                    $response = array('response_status' => 1
                                    , 'user_id' => $user['user_id']
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'full_name' => $user['full_name']
                                    , 'email_address' => $user['email_address']
                                    , 'contact_no' => $user['contact_no']
                                    , 'address' => $user['address']
                                );

                    // send as json object to react
                    echo json_encode($response);
                    
                } else {
                    // if not matched
                    echo 3;
                }
        }
    }elseif ($_POST['user_type'] == 'A'){
         $admin_email = $_POST['admin_email'];
        $admin_pass = $_POST['admin_password'];

        $result= mysqli_query($conn,"SELECT * FROM user WHERE email_address = '$admin_email' AND user_type = 'A'");
        if(mysqli_num_rows($result) > 0){ // Use mysqli_num_rows instead of mysqli_fetch_assoc
            $row = mysqli_fetch_assoc($result); // Fetch the row only once and store it in $row
            if($admin_pass == $row['password']){

                $_SESSION['user_id'] = $row['user_id']; //set session
                    $_SESSION['user_type'] = 'A';

                    $response = array('response_status' => 1
                                    , 'admin_id' => $row['user_id']
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'admin_email' => $row['email_address']  
                                );
             
                    // send as json object to react
                    echo json_encode($response);
           
        
        } else {
            // if not matched
            echo 3;
        }
        }
    }else {
        // COURIER LOGIN
     $courier_email = $_POST['courier_email'];
        $courier_password = $_POST['courier_password'];
        $user_type = $_POST['user_type'];

        $result= mysqli_query($conn,"SELECT * FROM user WHERE email_address = '$courier_email' AND user_type = 'C'");
        if(mysqli_num_rows($result) > 0){ // Use mysqli_num_rows instead of mysqli_fetch_assoc
            $row = mysqli_fetch_assoc($result); // Fetch the row only once and store it in $row
            if($courier_password == $row['password']){

                $_SESSION['courier_id'] = $row['user_id']; //set session
                    $_SESSION['user_type'] = 'C';

                    $response = array('response_status' => 1
                                    , 'courier_id' => $row['user_id']
                                    ,'full_name' => $row['full_name']
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'courier_email' => $row['email_address']                             
                                );
             
                    // send as json object to react
                    echo json_encode($response);
           
        
        }else {
            // if not matched
            echo 3;
        }
    }
    }
}


// ?>












