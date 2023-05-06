<?php

include_once "../db_conn.php";

    if(isset($_POST['admin_email'])){
        $admin_email = $_POST['admin_email'];
        $admin_pass = $_POST['admin_password'];

        $result= mysqli_query($conn,"SELECT * FROM admin WHERE admin_email = '$admin_email' AND admin_password = '$admin_pass'");
        if(mysqli_num_rows($result) > 0){ // Use mysqli_num_rows instead of mysqli_fetch_assoc
            $row = mysqli_fetch_assoc($result); // Fetch the row only once and store it in $row
            if($admin_pass == $row['admin_password']){

                $_SESSION['admin_id'] = $row['admin_id']; //set session
                    $_SESSION['user_type'] = 'a';

                    $response = array('response_status' => 1
                                    , 'admin_id' => $row['admin_id']
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'admin_email' => $row['admin_email']  
                                );
             
                    // send as json object to react
                    echo json_encode($response);
           
        }
        } else {
           die("maintenance mode");

        }
      

    }
