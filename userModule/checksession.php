<?php

   include_once "../db_conn.php";

// if theres a session
   if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
    

     $query = "SELECT * FROM user WHERE user.user_id = '$user_id";
    $result = mysqli_query($conn, $query);
        
      // if theres a match
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result);
              // create an array response
              $reponse = array('response_status' => 1
                                    , 'user_id' => $user_id
                                    , 'user_type' => $_SESSION['user_type']
                                    , 'full_name' => $user['full_name']
                                    , 'email_address' => $user['email_address']
                                    , 'contact_no' => $user['contact_no']);

              // send as JSON object to react
              echo json_encode($response);
              } else {
                echo 0;
              }
            }