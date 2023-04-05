<?php
    include_once "../db_conn.php";

if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
        
        // if user is existing
        if(mysqli_num_rows($result) > 0){
            $user = mysqli_fetch_assoc($result); //turn result into associative array

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
                    echo 2;
                }
        }

// ?>

