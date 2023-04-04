<?php
    include_once "../db_conn.php";

if(isset($_SESSION['user_id'])){
    $response = array('response_status' => 1
    , 'user_id' => $user['user_id']
    , 'user_type' => $_SESSION['user_type']
    , 'full_name' => $user['full_name']
    , 'email_address' => $user['email_address']
    , 'contact_no' => $user['contact_no']
    , 'address' => $user['address']
);


}else {
    echo "awit";
}