<?php

include_once "../db_conn.php";

if(isset($_POST['courier_email'])){
        $courier_email = $_POST['courier_email'];
        $courier_password = $_POST['courier_password'];
        $user_type = $_POST['user_type'];

        $result= mysqli_query($conn,"SELECT * FROM user WHERE email_address = '$courier_email'");
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
           
        }
        } else {
           die("maintenance mode");

        }
      

    }